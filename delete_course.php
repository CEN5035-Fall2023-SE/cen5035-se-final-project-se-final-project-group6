<?php
// Include connection.php to establish a database connection
include 'conn.php';

// Check if course ID is provided in the URL
if (isset($_GET['id'])) {
    $course_id = $_GET['id'];

    // Delete the course from the database
    $deleteQuery = "DELETE FROM course_list WHERE course_id = $course_id";
    
    if (mysqli_query($conn, $deleteQuery)) {
        // Redirect to manage_course_list.php after successful deletion
        header("Location: manage_course_list.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid course ID.";
    exit();
}

// Close the database connection
mysqli_close($conn);
?>
