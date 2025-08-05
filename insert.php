<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "qweez");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect all form data
$firstname = $_POST['firstname'] ?? '';
$lastname = $_POST['lastname'] ?? '';
$email = $_POST['email'] ?? '';
$mobileno = $_POST['mobileno'] ?? '';
$idimage = $_POST['idimage'] ?? '';
$aadhar_no = $_POST['aadhar_number'] ?? '';
$aadhaar_image = $_POST['aadhaar_image'] ?? '';
$pan_number = $_POST['pan_number'] ?? '';
$pan_image = $_POST['pan_image'] ?? '';
$dlNumber = $_POST['dlNumber'] ?? '';
$dlFile = $_POST['dlFile'] ?? '';
$rcNumber = $_POST['rcNumber'] ?? '';
$rcFile = $_POST['rcFile'] ?? '';
$expiryDate = $_POST['expiryDate'] ?? '';
$fileInput = $_POST['fileInput'] ?? ''; // PUC photo
$insuranceNo = $_POST['insuranceNo'] ?? '';
$insurance_photo = ''; // Initially empty

// ✅ Handle insurance_photo file upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['insurance_photo']) && $_FILES['insurance_photo']['error'] === 0) {
    $tmpName = $_FILES['insurance_photo']['tmp_name'];
    $fileName = basename($_FILES['insurance_photo']['name']);
    $uploadDir = 'uploads/';
    $destination = $uploadDir . uniqid() . "_" . $fileName;

    // Create uploads folder if it doesn't exist
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Move uploaded file
    if (move_uploaded_file($tmpName, $destination)) {
        $insurance_photo = $destination; // ✅ Set only if upload successful
    }
}

// ✅ Check if RC Number already exists
$check_rcno = $conn->prepare("SELECT COUNT(*) FROM drivedatabase WHERE rcno = ?");
$check_rcno->bind_param("s", $rcNumber);
$check_rcno->execute();
$check_rcno->bind_result($count);
$check_rcno->fetch();
$check_rcno->close();

if ($count > 0) {
    echo "<script>alert('Vehicle RC Number already registered!'); window.location.href='vehical.php';</script>";
    exit;
}

// ✅ Insert into database
$sql = "INSERT INTO drivedatabase (
    firstname, lastname, emailid, mobileno,
    idphoto, aadharno, aadhar_photo, pancardno, pancard_photo,
    drivingliscenceno, driving_photo, rcno, rc_photo,
    pucno, puc_photo, insuranceno, insurance_photo
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("sssssssssssssssss",
    $firstname, $lastname, $email, $mobileno,
    $idimage, $aadhar_no, $aadhaar_image, $pan_number, $pan_image,
    $dlNumber, $dlFile, $rcNumber, $rcFile,
    $expiryDate, $fileInput, $insuranceNo, $insurance_photo
);

// ✅ Execute and check result
if ($stmt->execute()) {
    echo "<script>alert('Insurance photo and all details submitted successfully!'); window.location.href='vehical.php';</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>







