<?php  include('conn.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body style="background-image: url('bg_2.jpeg'); background-size: cover; background-repeat: no-repeat;">

<div class = login >
      <br>  <br>  <br>  <br>
    <div class="pt-1 mb-2 text-center">

    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">User Login</button>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">

    </div>
    <div class="modal-body">





    <form  method="post" action="">

    <div class="form-outline mb-4">
    <input type="text" id="email"   name="email" class="form-control form-control-lg" required="" /><br>
    <label class="form-label" for="form2Example17">Email address</label>
    </div>

    <div class="form-outline mb-4">
    <input type="text" id="password"  name="password"  class="form-control form-control-lg" required="" /><br>
    <label class="form-label" for="form2Example27"  >Password</label>
    <span style="padding-left: 10px; cursor: pointer;">FORGOT PASSWORD?</span>
    </div>
    <select name="user" id="">
      <option value="user">user</option>
      <option value="admin">admin</option>
      <option value="ta commitee">commitee</option>
      <option value="admin">instructor</option>
    </select>
    <div class="pt-1 mb-2">
    <button class="btn btn-dark btn-lg btn-success" type="submit" name="submit">Login</button>
    </div>
    </form>



    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    </div>
    </div>
    </div>



    </div>
</div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<?php 

if (isset($_POST['submit'])) 
       {

        $email =   $_POST['email'];
        $password = $_POST['password'];
        $type =$_POST['user'];
        $checkuser = "select * from  emp_table where email = '$email'";
        $result = mysqli_query($conn,$checkuser);
        $count = mysqli_num_rows($result);
        if ($count>0) 
        {
          $row = mysqli_fetch_array($result);
          if($row['user'] == 'admin'){
          header("location:admin_login.php");
        }
        elseif($row['user'] == 'user'){
          header("location:user _login.php");
        }
        elseif($row['user'] == 'TA_commite'){
          header("location:tcommity.php");
        }
        elseif($row['user'] == 'Instructor'){
          header("location:instructor.php");
        }
      }

   else{
        
          header("location:login.php");  
          echo "Worng password ! ";

      }

      }

?>