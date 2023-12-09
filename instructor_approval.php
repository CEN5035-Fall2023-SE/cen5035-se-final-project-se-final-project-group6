<?php include("conn.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Instructor Approval</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<h1 class="text-center text-white bg-dark col-md-12">Instructor Approval Page</h1>

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
        <th scope="col">TA FEEDBACK</th>
        <th scope="col">INSTRUCTOR ACTION</th>
    </tr>
    </thead>

    <?php

    $query = "SELECT * FROM ta_commitee_approve_reject WHERE status = 'pending' 
              AND id NOT IN (SELECT id FROM instructor_approve_reject) ORDER BY id ASC";

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
                <form action="instructor_approval.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
                    <input type="submit" name="instructor_approve" value="Approve"> &nbsp; &nbsp;
                    <input type="submit" name="instructor_reject" value="Reject">
                    <br>
                    <textarea name="instructor_feedback" placeholder="Feedback"></textarea>
                </form>
            </td>
        </tr>
        </tbody>
    <?php } ?>
</table>

<?php
if (isset($_POST['instructor_approve']) || isset($_POST['instructor_reject'])) {
    $id = $_POST['id'];
    $instructor_feedback = $_POST['instructor_feedback'];
    $status = isset($_POST['instructor_approve']) ? 'accepted' : 'rejected';

    // Fetch data of the selected CV
    $selectQuery = "SELECT * FROM ta_commitee_approve_reject WHERE id = '$id'";
    $selectResult = mysqli_query($conn, $selectQuery);
    $cvDetails = mysqli_fetch_array($selectResult);

    // Update or insert data into the instructor_approve_reject table
    $insertQuery = "INSERT INTO instructor_approve_reject (id, name, email, education, experience, teaching_subjects, status, feedback)
                    VALUES ('{$cvDetails['id']}', '{$cvDetails['name']}', '{$cvDetails['email']}', '{$cvDetails['education']}',
                            '{$cvDetails['experience']}', '{$cvDetails['teaching_subjects']}', '$status', '$instructor_feedback')
                    ON DUPLICATE KEY UPDATE status = '$status', feedback = '$instructor_feedback'";
    mysqli_query($conn, $insertQuery);

    // Update status in the ta_commitee_approve_reject table

    $updateQuery = "UPDATE ta_commitee_approve_reject, form_status 
                     SET ta_commitee_approve_reject.status = '$status', form_status.status = '$status'
                     WHERE ta_commitee_approve_reject.id = '$id' AND form_status.email = '{$cvDetails['email']}'";
    mysqli_query($conn, $updateQuery);


    // // Check if the record already exists in form_status table
    // $checkQuery = "SELECT * FROM form_status WHERE name = '{$cvDetails['name']}' AND email = '{$cvDetails['email']}'";
    // $checkResult = mysqli_query($conn, $checkQuery);

    // if (mysqli_num_rows($checkResult) > 0) {
    //     // Update record in the form_status table
    //     $updateFormStatusQuery = "UPDATE form_status SET status = '$status' WHERE name = '{$cvDetails['name']}' AND email = '{$cvDetails['email']}'";
    //     mysqli_query($conn, $updateFormStatusQuery);
    // } else {
    //     // Insert record into the form_status table
    //     $formStatusQuery = "INSERT INTO form_status (name, email, status) 
    //                         VALUES ('{$cvDetails['name']}', '{$cvDetails['email']}', '$status')";
    //     mysqli_query($conn, $formStatusQuery);
    // }

    header("location:instructor_approval.php");
}
?>




</body>
</html>
