<?php
// Include connection.php to establish a database connection
include 'conn.php';

// Initialize variables
$course_id = $_GET['id'] ?? null;
$course_name = '';

// Check if the course ID is provided in the URL
if ($course_id) {
    // Retrieve the course details based on the provided course ID
    $query = "SELECT * FROM course_list WHERE course_id = $course_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $course_name = $row['course_name'];
    } else {
        echo "Course not found.";
        exit();
    }
} else {
    echo "Invalid course ID.";
    exit();
}

// Update course details when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_name = mysqli_real_escape_string($conn, $_POST['course_name']);

    // Update the course in the database
    $updateQuery = "UPDATE course_list SET course_name = '$course_name' WHERE course_id = $course_id";
    
    if (mysqli_query($conn, $updateQuery)) {
        // Redirect to manage_course_list.php after successful update
        header("Location: manage_course_list.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Course</title>
    <!-- Add your CSS links or stylesheets here -->
</head>
<body>
    <div class="container">
        <h1>Edit Course</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $course_id); ?>">
            <label for="course_name">Course Name:</label>
            <input type="text" id="course_name" name="course_name" value="<?php echo $course_name; ?>" required>
            <input type="submit" value="Update Course">
        </form>
    </div>
</body>
</html>
