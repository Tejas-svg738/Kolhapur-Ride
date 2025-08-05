<?php
// view.php
if (isset($_GET['file'])) {
    $file = $_GET['file'];
    $path = "uploads/" . basename($file); // Uploads फोल्डर ठेवा

    if (file_exists($path)) {
        echo "<h2>Document Viewer</h2>";
        echo "<img src='$path' alt='Document' style='max-width:90%; height:auto;'>";
    } else {
        echo "File not found.";
    }
} else {
    echo "No file specified.";
}
?>
