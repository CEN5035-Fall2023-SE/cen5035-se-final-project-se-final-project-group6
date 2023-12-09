<!DOCTYPE html>
<html>
<head>
    <title>TA APPLICANT</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <header>
        <div class="main">
            <div class="logo">
                <h3>COLLEGE LOGO</h3>
                <img src="#">
                <h1></h1>
            </div>
            <ul>
                <li class="active"><a href="#"><i class="fa fa-home"></i>Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Know more</a></li>
            </ul>
        </div>

        <div class="title">
            <h1>TA APPLICANT</h1>
        </div>

        <div class="user-section">
            <?php
            // Check if the username is set in session after login
            session_start();
            if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
                echo '<p>Welcome, ' . $username . '</p>';
            }
            ?>
        </div>

        <div class="button">
            <a href="complain_register.php" class="btn">Form</a>
            <a href="approved.php" class="btn">Check</a>
        </div>
    </header>
</body>
</html>
