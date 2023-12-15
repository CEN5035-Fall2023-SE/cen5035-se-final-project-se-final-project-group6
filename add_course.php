<?php
// Include connection.php to establish a database connection
include 'conn.php';

// Initialize variables to store form input
$courseName = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $courseName = mysqli_real_escape_string($conn, $_POST['course_name']);

    // Insert the new course into the course_list table
    $insertQuery = "INSERT INTO course_list (course_name) VALUES ('$courseName')";
    
    if (mysqli_query($conn, $insertQuery)) {
        // Redirect to manage_course_list.php after successful insertion
        header("Location: manage_course_list.php");
        exit();
    } else {
        echo "Error: " . $insertQuery . "<br>" . mysqli_error($con);
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Course</title>
    <!-- Add your CSS links or stylesheets here -->
</head>
<body>
    <div class="container">
        <h1>Add New Course</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="course_name">Course Name:</label>
            <input type="text" id="course_name" name="course_name" required>
            <input type="submit" value="Add Course">
        </form>
    </div>
</body>
</html>
