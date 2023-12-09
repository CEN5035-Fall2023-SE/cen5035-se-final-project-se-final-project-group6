<?php include("conn.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher CV Approval</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<h1 class="text-center text-white bg-dark col-md-12">TEACHER CV APPROVAL</h1>

<table class="table table-bordered col-md-12">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">NAME</th>
        <th scope="col">EMAIL</th>
        <th scope="col">EDUCATION</th>
        <th scope="col">EXPERIENCE</th>
        <th scope="col">TEACHING SUBJECTS</th>
        <th scope="col">STATUS</th>
        <th scope="col">ACTION</th>
    </tr>
    </thead>

    <?php
    $query = "SELECT * FROM teacher_cv WHERE status = 'pending' 
              AND id NOT IN (SELECT id FROM approved_rejected_cv) ORDER BY id ASC";

    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) { ?>

        <tbody>
        <tr>
            <th scope="row"><?php echo $row['id']; ?></th>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['education']; ?></td>
            <td><?php echo $row['experience']; ?></td>
            <td><?php echo $row['teaching_subjects']; ?></td>
            <td><?php echo $row['status']; ?></td>

            <td>
                <form action="teacher_cv_approval.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
                    <input type="submit" name="approve" value="Approve"> &nbsp; &nbsp;
                    <input type="submit" name="reject" value="Reject">
                    <br>
                    <textarea name="feedback" placeholder="Feedback"></textarea>
                </form>
            </td>
        </tr>
        </tbody>
    <?php } ?>
</table>

<?php
if (isset($_POST['approve']) || isset($_POST['reject'])) {
    $id = $_POST['id'];
    $feedback = $_POST['feedback'];
    $status = isset($_POST['approve']) ? 'pending' : 'reject';
    

    // Fetch data of the selected CV
    $selectQuery = "SELECT * FROM teacher_cv WHERE id = '$id'";
    $selectResult = mysqli_query($conn, $selectQuery);
    $cvDetails = mysqli_fetch_array($selectResult);

    // Insert data into the approved_rejected_cv table
    $insertQuery = "INSERT INTO approved_rejected_cv (id, name, email, education, experience, teaching_subjects, status, feedback)
                    VALUES ('{$cvDetails['id']}', '{$cvDetails['name']}', '{$cvDetails['email']}', '{$cvDetails['education']}',
                            '{$cvDetails['experience']}', '{$cvDetails['teaching_subjects']}', '$status', '$feedback')";
    mysqli_query($conn, $insertQuery);

    // Insert data into the form_status table
    $formStatusQuery = "INSERT INTO form_status (name, email, status) 
                        VALUES ('{$cvDetails['name']}', '{$cvDetails['email']}', '$status')";
    mysqli_query($conn, $formStatusQuery);

    // Update status in the teacher_cv table
    $updateStatusQuery = "UPDATE teacher_cv SET status = '$status' WHERE id = '$id'";
    mysqli_query($conn, $updateStatusQuery);

    header("location:teacher_cv_approval.php");
}
?>

</body>
</html>
