<!-- process_delete_checklist.php -->
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
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM checklists WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: view_checklists.php");
        exit();
    } else {
        echo "Error deleting checklist.";
    }

    $stmt->close();
}

$conn->close();
?>
