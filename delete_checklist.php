<!-- delete_checklist.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Checklist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Delete Checklist</h1>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "checklist";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            $id = $_GET['id'];

            $stmt = $conn->prepare("SELECT * FROM checklists WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row) {
                ?>
                <p>Are you sure you want to delete the checklist with the title "<?php echo $row['title']; ?>"?</p>
                <form action="process_delete_checklist.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    <a href="view_checklists.php" class="btn btn-secondary">No, Cancel</a>
                </form>
                <?php
            } else {
                echo "Checklist not found.";
            }

            $stmt->close();
        }

        $conn->close();
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
