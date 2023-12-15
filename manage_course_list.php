<?php
// Include connection.php to establish a database connection
include 'conn.php';

// Assuming you have already established a database connection using connection.php

// Fetch the course list from the database
$query = "SELECT * FROM course_list";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Manage Course List</title>
	<!-- Add your CSS links or stylesheets here -->
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			background-color: #f4f4f4;
		}
		.container {
			width: 80%;
			margin: 20px auto;
			background-color: #fff;
			padding: 20px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			border-radius: 5px;
		}
		h1 {
			text-align: center;
		}
		table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 20px;
		}
		table th, table td {
			border: 1px solid #ccc;
			padding: 8px;
			text-align: left;
		}
		table th {
			background-color: #f2f2f2;
		}
		a {
			text-decoration: none;
			color: #007bff;
		}
		a:hover {
			text-decoration: underline;
		}
	</style>
</head>
<body>
	<div class="container">
		<h1>Manage Course List</h1>
		<!-- Display the list of courses -->
		<table>
			<thead>
				<tr>
					<th>Course ID</th>
					<th>Course Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				// Loop through the fetched courses and display them in a table
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>" . $row['course_id'] . "</td>";
					echo "<td>" . $row['course_name'] . "</td>";
					// Add any actions you want for each course, such as edit or delete
					echo "<td><a href='edit_course.php?id=" . $row['course_id'] . "'>Edit</a> | <a href='delete_course.php?id=" . $row['course_id'] . "'>Delete</a></td>";
					echo "</tr>";
				}
				?>
			</tbody>
		</table>
		<!-- Add a form or button to add a new course -->
		<a href="add_course.php">Add New Course</a>
	</div>
</body>
</html>

<?php
// Close the database connection after displaying the course list
mysqli_close($conn);
?>
