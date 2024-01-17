<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Operations</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .action-buttons {
            display: flex;
        }
        .action-buttons a {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "seconddb";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create operation
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])) {
        $student_id = $_POST["student_id"];
        $student_name = $_POST["student_name"];
        $student_sem = $_POST["student_sem"];
        $student_dept = $_POST["student_dept"];

        // Validation (you can add more validation as needed)
        if (empty($student_id) || empty($student_name) || empty($student_sem) || empty($student_dept)) {
            echo "All fields are required.";
        } else {
            $sql = "INSERT INTO student (student_id, student_name, student_sem, student_dept) VALUES ('$student_id', '$student_name', '$student_sem', '$student_dept')";

            if ($conn->query($sql) === TRUE) {
                echo "Record created successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    

    // Read operation
    $sql = "SELECT student_id, student_name, student_sem, student_dept FROM student";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Students</h2>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Name</th><th>Semester</th><th>Department</th><th>Action</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["student_id"] . "</td><td>" . $row["student_name"] . "</td><td>" . $row["student_sem"] . "</td><td>" . $row["student_dept"] . "</td>";
            echo "<td class='action-buttons'><a href='?edit=" . $row["student_id"] . "'>Edit</a><a href='?delete=" . $row["student_id"] . "'>Delete</a></td></tr>";
        }

        echo "</table>";
    } else {
        echo "No students found.";
    }

    // Update operation
    if (isset($_GET["edit"])) {
        $edit_id = $_GET["edit"];
        $edit_sql = "SELECT * FROM student WHERE student_id = '$edit_id'";
        $edit_result = $conn->query($edit_sql);

        if ($edit_result->num_rows == 1) {
            $edit_row = $edit_result->fetch_assoc();

            echo "<h2>Edit Student</h2>";
            echo "<form action='' method='post'>";
            echo "<input type='hidden' name='edit_id' value='" . $edit_row["student_id"] . "'>";
            echo "<label for='student_id'>Student ID:</label>";
            echo "<input type='text' name='student_id' value='" . $edit_row["student_id"] . "' required>";
            echo "<label for='student_name'>Student Name:</label>";
            echo "<input type='text' name='student_name' value='" . $edit_row["student_name"] . "' required>";
            echo "<label for='student_sem'>Student Semester:</label>";
            echo "<input type='text' name='student_sem' value='" . $edit_row["student_sem"] . "' required>";
            echo "<label for='student_dept'>Student Department:</label>";
            echo "<input type='text' name='student_dept' value='" . $edit_row["student_dept"] . "' required>";
            echo "<button type='submit' name='update'>Update Student</button>";
            echo "</form>";
        }
    }

    // Update operation (handle form submission)
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
        $edit_id = $_POST["edit_id"];
        $student_id = $_POST["student_id"];
        $student_name = $_POST["student_name"];
        $student_sem = $_POST["student_sem"];
        $student_dept = $_POST["student_dept"];

        $update_sql = "UPDATE student SET student_id='$student_id', student_name='$student_name', student_sem='$student_sem', student_dept='$student_dept' WHERE student_id='$edit_id'";

        if ($conn->query($update_sql) === TRUE) {
            echo "Record updated successfully.";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    // Delete operation
    if (isset($_GET["delete"])) {
        $delete_id = $_GET["delete"];
        $delete_sql = "DELETE FROM student WHERE student_id = '$delete_id'";

        if ($conn->query($delete_sql) === TRUE) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }

    // Close connection
    $conn->close();
    ?>
    <h2>Create Student</h2>
    <form action="" method="post">
        <label for="student_id">Student ID:</label>
        <input type="text" name="student_id" required>

        <label for="student_name">Student Name:</label>
        <input type="text" name="student_name" required>

        <label for="student_sem">Student Semester:</label>
        <input type="text" name="student_sem" required>

        <label for="student_dept">Student Department:</label>
        <input type="text" name="student_dept" required>

        <button type="submit" name="create">Create Student</button>
</body>
</html>
