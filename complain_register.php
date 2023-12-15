<?php
include("conn.php"); // Assuming this file contains your database connection code


$subjectsQuery = "SELECT * FROM course_list";
$subjectsResult = mysqli_query($conn, $subjectsQuery);

$subjects = array();
while ($row = mysqli_fetch_assoc($subjectsResult)) {
    $subjects[] = $row['course_name'];
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $education = $_POST['education'];
    $experience = $_POST['experience'];
    // $teachingSubjects = $_POST['teaching_subjects'];
    $selectedSubject = $_POST['selected_subject'];

    // Handle file upload
    // $cvFileName = $_FILES['cv_file']['name']; // Uploaded file name
    // $cvTempName = $_FILES['cv_file']['tmp_name']; // Temporary file name

    $insertQuery = "INSERT INTO teacher_cv (name, email, education, experience, teaching_subjects) VALUES ('$name', '$email', '$education', '$experience', '$selectedSubject')";

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
        <!-- <textarea name="teaching_subjects" id="teaching_subjects" class="form-control form-control-lg" required="" placeholder="Teaching Subjects"></textarea><br> -->
        <select name="selected_subject" id="selected_subject" class="form-control form-control-lg" required="">
          <option value="" disabled selected>Select Teaching Subject</option>
          <?php
          foreach ($subjects as $subject) {
              echo "<option value='" . $subject . "'>" . $subject . "</option>";
          }
          ?>
        </select><br>
        <input type="file" name="cv_file" id="cv_file" class="form-control form-control-lg" required="" /> <!-- File Upload Input -->
  
      </div> 
      <div class="pt-1 col-md-6 mb-2">
        <button class="btn btn-dark btn-lg btn-success" type="submit" name="submit">Submit</button>
      </div>
    </form>
    <a href="index.php">Back</a>
  </center>
</body>
</html>
