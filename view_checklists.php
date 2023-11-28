<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Checklists</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Checklists</h1>
        <a href="add_checklist.html" class="btn btn-primary">Add Checklist</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Web Link</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                 $servername = "localhost";
                 $username = "root";
                 $password = "";
                 $dbname = "checklist";
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $result = $conn->query("SELECT * FROM checklists");

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>
                                <th scope="row">' . $row["id"] . '</th>
                                <td>' . $row["title"] . '</td>
                                <td>' . $row["description"] . '</td>
                                <td><a href="' . $row["link"] . '" target="_blank">' . $row["link"] . '</a></td>
                                <td>
                                    <a href="edit_checklist.php?id=' . $row["id"] . '" class="btn btn-warning">Edit</a>
                                <!--    <a href="delete_checklist.php?id=' . $row["id"] . '" class="btn btn-danger">Delete</a> -->
                                </td>
                            </tr>';
                    }
                } else {
                    echo '<tr><td colspan="5">No checklists found.</td></tr>';
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
