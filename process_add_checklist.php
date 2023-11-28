<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "checklist";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $link = $_POST['link'];

    $stmt = $conn->prepare("INSERT INTO checklists (title, description, link) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $description, $link);

    if ($stmt->execute()) {
        header("Location: view_checklists.php");
        exit();
    } else {
        echo "Error adding checklist.";
    }

    $stmt->close();
}

$conn->close();
?>
