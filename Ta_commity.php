<?php include("conn.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title>TA Committee Check</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<h1 class="text-center text-white bg-dark col-md-12">TA Committee Check for Approved CVs</h1>

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
        <th scope="col">ADMIN FEEDBACK</th>
        <th scope="col">TA COMMITTEE ACTION</th>
    </tr>
    </thead>

    <?php
    $query = "SELECT * FROM approved_rejected_cv WHERE status = 'pending' 
              AND id NOT IN (SELECT id FROM ta_commitee_approve_reject) ORDER BY id ASC";
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
            <td><?php echo $row['feedback']; ?></td>

            <td>
                <form action="ta_commity.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
                    <input type="submit" name="ta_approve" value="Approve"> &nbsp; &nbsp;
                    <input type="submit" name="ta_reject" value="Reject">
                    <br>
                    <textarea name="ta_feedback" placeholder="Feedback"></textarea>
                </form>
            </td>
        </tr>
        </tbody>
    <?php } ?>
</table>


<?php
if (isset($_POST['ta_approve']) || isset($_POST['ta_reject'])) {
    $id = $_POST['id'];
    $ta_feedback = $_POST['ta_feedback'];
    $status = isset($_POST['ta_approve']) ? 'pending' : 'rejected';

    // Fetch data of the selected CV
    $selectQuery = "SELECT * FROM approved_rejected_cv WHERE id = '$id'";
    $selectResult = mysqli_query($conn, $selectQuery);
    $cvDetails = mysqli_fetch_array($selectResult);

    // Insert data into the ta_commitee_approve_reject table
    $insertQuery = "INSERT INTO ta_commitee_approve_reject (id, name, email, education, experience, teaching_subjects, status, feedback)
                    VALUES ('{$cvDetails['id']}', '{$cvDetails['name']}', '{$cvDetails['email']}', '{$cvDetails['education']}',
                            '{$cvDetails['experience']}', '{$cvDetails['teaching_subjects']}', '$status', '$ta_feedback')";
    mysqli_query($conn, $insertQuery);

    // Update status in the approved_rejected_cv table and form_status table
    $updateQuery = "UPDATE approved_rejected_cv, form_status 
                     SET approved_rejected_cv.status = '$status', form_status.status = '$status'
                     WHERE approved_rejected_cv.id = '$id' AND form_status.email = '{$cvDetails['email']}'";
    mysqli_query($conn, $updateQuery);

    header("location:ta_commity.php");
}
?>

</body>
</html>
