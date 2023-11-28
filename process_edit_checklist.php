<!-- process_edit_checklist.php -->
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
    $title = $_POST['title'];
    $description = $_POST['description'];
    $link = $_POST['link'];

    $stmt = $conn->prepare("UPDATE checklists SET title = ?, description = ?, link = ? WHERE id = ?");
    $stmt->bind_param("sssi", $title, $description, $link, $id);

    if ($stmt->execute()) {
        header("Location: view_checklists.php");
        exit();
    } else {
        echo "Error updating checklist.";
    }

    $stmt->close();
}

$conn->close();
?>
