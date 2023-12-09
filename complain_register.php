<?php
include("conn.php"); // Assuming this file contains your database connection code

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $education = $_POST['education'];
    $experience = $_POST['experience'];
    $teachingSubjects = $_POST['teaching_subjects'];

    $insertQuery = "INSERT INTO teacher_cv (name, email, education, experience, teaching_subjects) VALUES ('$name', '$email', '$education', '$experience', '$teachingSubjects')";

    if (mysqli_query($conn, $insertQuery)) {
        echo "Your CV has been submitted successfully!";
    } else {
        echo "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Teacher CV Submission</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <br><br>
  <center>
    <form method="post" action="">
      <div class="form-outline text-left col-md-6 mb-4">
        <input type="text" name="name" id="name" class="form-control form-control-lg" required="" placeholder="Your Name" /><br>
        <input type="email" name="email" id="email" class="form-control form-control-lg" required="" placeholder="Your Email" /><br>
        <textarea name="education" id="education" class="form-control form-control-lg" required="" placeholder="Education Details"></textarea><br>
        <textarea name="experience" id="experience" class="form-control form-control-lg" required="" placeholder="Work Experience"></textarea><br>
        <textarea name="teaching_subjects" id="teaching_subjects" class="form-control form-control-lg" required="" placeholder="Teaching Subjects"></textarea><br>
      </div> 
      <div class="pt-1 col-md-6 mb-2">
        <button class="btn btn-dark btn-lg btn-success" type="submit" name="submit">Submit</button>
      </div>
    </form>
    <a href="index.php">Back</a>
  </center>
</body>
</html>
