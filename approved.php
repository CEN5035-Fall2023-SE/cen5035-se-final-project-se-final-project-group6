<?php include("conn.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Status Check</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<h1 class="text-center text-white bg-success col-md-12">Check Status</h1>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <button type="submit" class="btn btn-primary" name="check_status">Check Status</button>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['check_status'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Check status in form_status table
    $form_status_query = "SELECT * FROM form_status WHERE name = '$name' AND email = '$email'";
    $form_status_result = mysqli_query($conn, $form_status_query);

    if (mysqli_num_rows($form_status_result) > 0) {
        $status_row = mysqli_fetch_assoc($form_status_result);
?>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Status</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>ID:</strong> <?php echo $status_row['id']; ?></p>
                            <!-- Display other relevant fields and status -->
                            <p><strong>Status:</strong> <?php echo $status_row['status']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    } else {
        echo "<p class='text-center mt-4'>No record found for the provided name and email.</p>";
        exit;
    }
}
?>

</body>
</html>
