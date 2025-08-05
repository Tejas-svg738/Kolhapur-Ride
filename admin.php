<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: adminlogin.php");
    exit();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

$conn = new mysqli("localhost", "root", "", "qweez");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

function generateUserID($firstname, $rcno) {
    return strtolower(substr($firstname, 0, 3)) . substr($rcno, -4);
}

function generatePassword() {
    return substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 6);
}

function sendLoginLink($emailid, $firstname, $username, $password_plain) {
    $login_url = "http://localhost/Kolhapur/Driver/test/driverlogin.php";
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'sender.qweez@gmail.com';
        $mail->Password = 'jhjn ljpm aazb ijhz'; // Gmail App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('sender.qweez@gmail.com', 'Cab Service');
        $mail->addAddress($emailid, $firstname);
        $mail->isHTML(true);
        $mail->Subject = 'Your Login Credentials';
        $mail->Body = "
            <h3>Hello $firstname,</h3>
            <p>Your account has been approved. Below are your login credentials:</p>
            <p><strong>Username:</strong> $username<br>
            <strong>Password:</strong> $password_plain</p>
            <p><a href='$login_url'>Click here to login</a></p>
            <p>Please keep these details secure.</p>
        ";
        $mail->send();
        $_SESSION['mail_sent'] = "Email successfully sent to: $emailid";
    } catch (Exception $e) {
        $_SESSION['mail_sent'] = "Error sending email: {$mail->ErrorInfo}";
    }
}

$tables = [
    'sedan_cars' => 'Sedan Cars',
    'hatchback_cars' => 'Hatchback Cars',
    'gear_bikes' => 'Gear Bikes',
    'non_gear_bikes' => 'Non-Gear Bikes',
    'auto_vehicles' => 'Auto Vehicles'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'], $_POST['id'], $_POST['table'])) {
        $id = (int)$_POST['id'];
        $table = $conn->real_escape_string($_POST['table']);
        $status = ($_POST['action'] === 'approve') ? 'Approved' : 'Rejected';

        if (!array_key_exists($table, $tables)) die("Invalid table name!");

        $query = "UPDATE `$table` SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        if (!$stmt) die("Prepare failed: " . $conn->error);
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
        $stmt->close();

        header("Location: admin.php");
        exit();
    }

    if (isset($_POST['send_mail'], $_POST['id'], $_POST['table'])) {
        $vehicle_id = (int)$_POST['id'];
        $table = $conn->real_escape_string($_POST['table']);

        if (!array_key_exists($table, $tables)) die("Invalid table name!");

        $info_query = "SELECT d.id AS driver_id, d.firstname, d.emailid, v.number AS rcno
                       FROM `$table` v
                       JOIN drivedatabase d ON v.number = d.rcno
                       WHERE v.id = ?";
        $stmt = $conn->prepare($info_query);
        if (!$stmt) die("Prepare failed: " . $conn->error);
        $stmt->bind_param("i", $vehicle_id);
        $stmt->execute();
        $stmt->bind_result($driver_id, $firstname, $emailid, $rcno);

        if ($stmt->fetch()) {
            $stmt->close();

            $username = generateUserID($firstname, $rcno);
            $password_plain = generatePassword();

            $update_stmt = $conn->prepare("UPDATE drivedatabase SET username = ?, password = ?, password_plain = ? WHERE rcno = ?");
            if (!$update_stmt) die("Prepare failed: " . $conn->error);
            $update_stmt->bind_param("ssss", $username, $password_plain, $password_plain, $rcno);
            $update_stmt->execute();
            $update_stmt->close();

            sendLoginLink($emailid, $firstname, $username, $password_plain);
        } else {
            $_SESSION['mail_sent'] = "Driver details not found.";
            $stmt->close();
        }

        header("Location: admin.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Panel</title>
  <style>
    body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; background: #fff; font-size: 12px; }
    th, td { border: 1px solid #ccc; padding: 6px; text-align: center; }
    .btn { padding: 4px 10px; margin: 2px; border: none; border-radius: 4px; cursor: pointer; }
    .approve { background-color: #28a745; color: #fff; }
    .reject { background-color: #dc3545; color: #fff; }
    .view-btn { padding: 4px 8px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
    h2 { margin-top: 40px; }
  </style>
</head>
<body>
  <center><h1>Admin Panel - Driver & Vehicle Approval</h1></center>

<?php foreach ($tables as $table => $title): ?>
<?php
$query = "SELECT v.id, d.id AS driver_id, d.firstname, d.lastname, d.emailid, d.mobileno,
                 d.idphoto, d.aadharno, d.aadhar_photo, d.pancardno, d.pancard_photo,
                 d.drivingliscenceno, d.driving_photo, d.rcno, d.rc_photo,
                 d.pucno, d.puc_photo, d.insuranceno, d.insurance_photo,
                 v.model, v.fuel, v.number, v.average, v.price, v.status
          FROM `$table` v
          JOIN drivedatabase d ON v.number = d.rcno";
$result = $conn->query($query);
$vehicle_type = $title;
?>

<h2><?= $title ?></h2>
<table>
  <thead>
    <tr>
      <th>Vehicle ID</th><th>Driver ID</th><th>First</th><th>Last</th><th>Email</th><th>Mobile</th>
      <th>ID Photo</th><th>Aadhar No</th><th>Aadhar Photo</th><th>PAN No</th><th>PAN Photo</th>
      <th>DL No</th><th>DL Photo</th><th>RC No</th><th>RC Photo</th><th>PUC No</th><th>PUC Photo</th>
      <th>Insurance No</th><th>Insurance Photo</th><th>Vehicle Type</th>
      <th>Model</th><th>Fuel</th><th>Vehicle No</th><th>Average</th><th>Price</th><th>Status</th><th>Action</th>
    </tr>
  </thead>
  <tbody>
  <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= $row['driver_id'] ?></td>
      <td><?= $row['firstname'] ?></td>
      <td><?= $row['lastname'] ?></td>
      <td><?= $row['emailid'] ?></td>
      <td><?= $row['mobileno'] ?></td>
      <td><?= $row['idphoto'] ? "<button class='view-btn' onclick=\"showModal('{$row['idphoto']}')\">View</button>" : "N/A" ?></td>
      <td><?= $row['aadharno'] ?></td>
      <td><?= $row['aadhar_photo'] ? "<button class='view-btn' onclick=\"showModal('{$row['aadhar_photo']}')\">View</button>" : "N/A" ?></td>
      <td><?= $row['pancardno'] ?></td>
      <td><?= $row['pancard_photo'] ? "<button class='view-btn' onclick=\"showModal('{$row['pancard_photo']}')\">View</button>" : "N/A" ?></td>
      <td><?= $row['drivingliscenceno'] ?></td>
      <td><?= $row['driving_photo'] ? "<button class='view-btn' onclick=\"showModal('{$row['driving_photo']}')\">View</button>" : "N/A" ?></td>
      <td><?= $row['rcno'] ?></td>
      <td><?= $row['rc_photo'] ? "<button class='view-btn' onclick=\"showModal('{$row['rc_photo']}')\">View</button>" : "N/A" ?></td>
      <td><?= $row['pucno'] ?></td>
      <td><?= $row['puc_photo'] ? "<button class='view-btn' onclick=\"showModal('{$row['puc_photo']}')\">View</button>" : "N/A" ?></td>
      <td><?= $row['insuranceno'] ?></td>
      <td><?= $row['insurance_photo'] ? "<button class='view-btn' onclick=\"showModal('{$row['insurance_photo']}')\">View</button>" : "N/A" ?></td>
      <td><?= $vehicle_type ?></td>
      <td><?= $row['model'] ?></td>
      <td><?= $row['fuel'] ?></td>
      <td><?= $row['number'] ?></td>
      <td><?= $row['average'] ?></td>
      <td><?= $row['price'] ?></td>
      <td><?= $row['status'] ?></td>
      <td>
        <?php if (strcasecmp($row['status'], 'Pending') === 0): ?>
          <form method="POST" style="display:inline;">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <input type="hidden" name="table" value="<?= $table ?>">
            <button class="btn approve" name="action" value="approve">Approve</button>
            <button class="btn reject" name="action" value="reject">Reject</button>
          </form>
        <?php elseif (strcasecmp($row['status'], 'Approved') === 0): ?>
          <form method="POST" style="display:inline;">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <input type="hidden" name="table" value="<?= $table ?>">
            <button class="btn" name="send_mail" value="send_mail">Send Mail</button>
          </form>
        <?php endif; ?>
      </td>
    </tr>
  <?php endwhile; ?>
  </tbody>
</table>
<?php endforeach; ?>

<div style="text-align: right; padding: 10px;">
    <a href="adminlogin.php" style="color: red; font-weight: bold;">Logout</a>
</div>

<script>
function showModal(imagePath) {
    var modal = document.createElement('div');
    modal.innerHTML = "<img src='" + imagePath + "' style='width: 100%; max-width: 600px;'>";
    modal.style.position = "fixed";
    modal.style.top = 0;
    modal.style.left = 0;
    modal.style.width = "100%";
    modal.style.height = "100%";
    modal.style.backgroundColor = "rgba(0, 0, 0, 0.8)";
    modal.style.display = "flex";
    modal.style.alignItems = "center";
    modal.style.justifyContent = "center";
    modal.style.zIndex = "1000";
    modal.addEventListener('click', function() {
        document.body.removeChild(modal);
    });
    document.body.appendChild(modal);
}
</script>

</body>
</html>
