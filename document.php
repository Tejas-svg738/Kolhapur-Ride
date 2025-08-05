<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: driverlogin.php");
    exit();
}

$rcno = $_SESSION['user']['rcno'] ?? '';
$conn = new mysqli("localhost", "root", "", "qweez");
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT firstname, lastname, emailid, mobileno,
    idphoto, aadharno, aadhar_photo, pancardno, pancard_photo,
    drivingliscenceno, driving_photo, rc_photo,
    pucno, puc_photo
    FROM drivedatabase WHERE rcno = ?");
$stmt->bind_param("s", $rcno);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Driver Dashboard</title>
    <style>
        body { font-family: Arial; background-color: #f8f8f8; padding: 20px; }
        h1 { text-align: center; }
        .info {
            background-color: #fff;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 0 6px rgba(0,0,0,0.1);
        }
        .info p { margin: 5px 0; }
        .doc-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        .card {
            background: white;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }
        .card img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
        }
        .label { font-weight: bold; margin-top: 5px; }
    </style>
</head>
<body>

<h1>Welcome <?= htmlspecialchars($row['firstname'] ?? 'Driver') ?></h1>

<div class="info">
    <p><strong>First Name:</strong> <?= htmlspecialchars($row['firstname']) ?></p>
    <p><strong>Last Name:</strong> <?= htmlspecialchars($row['lastname']) ?></p>
    <p><strong>Mobile No:</strong> <?= htmlspecialchars($row['mobileno']) ?></p>
    <p><strong>Email ID:</strong> <?= htmlspecialchars($row['emailid']) ?></p>
</div>

<div class="doc-container">
    <?php if (!empty($row['aadharno'])): ?>
    <div class="card">
        <div class="label">Aadhar No:</div> <?= $row['aadharno'] ?>
        <img src="<?= $row['aadhar_photo'] ?>" alt="Aadhar Photo">
    </div>
    <?php endif; ?>

    <?php if (!empty($row['pancardno'])): ?>
    <div class="card">
        <div class="label">PAN No:</div> <?= $row['pancardno'] ?>
        <img src="<?= $row['pancard_photo'] ?>" alt="PAN Photo">
    </div>
    <?php endif; ?>

    <?php if (!empty($row['drivingliscenceno'])): ?>
    <div class="card">
        <div class="label">Driving Licence No:</div> <?= $row['drivingliscenceno'] ?>
        <img src="<?= $row['driving_photo'] ?>" alt="Driving Licence">
    </div>
    <?php endif; ?>

    <?php if (!empty($row['rc_photo'])): ?>
    <div class="card">
        <div class="label">RC Number:</div>
        <img src="<?= $row['rc_photo'] ?>" alt="RC Photo">
    </div>
    <?php endif; ?>

    <?php if (!empty($row['pucno'])): ?>
    <div class="card">
        <div class="label">PUC No:</div> <?= $row['pucno'] ?>
        <img src="<?= $row['puc_photo'] ?>" alt="PUC Photo">
    </div>
    <?php endif; ?>
</div>

</body>
</html>