<!DOCTYPE html>
<html>

  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </head>

  <body>

    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-3">EasyTutor</h1>
        <p class="lead">Find tutors in your area</p>
      </div>
    </div>

    <div class="container">

      <form class="form-signin" method = "POST" action = "index.php">
        <div class ="form-group">

        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="email" id="inputEmail" class="form-control-lg" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control-lg" placeholder="Password" required>
        </div>

        <button class="btn btn-lg btn-outline-success .col-md-3" type="submit" name="login" action="aftersignin.php">Sign in</button>
      </form>

        <a href="signup.php" class="">Don't have an account? Sign up here!</a>

    </div>

  </body>

</html>



<?php
session_start();
$con=mysqli_connect('classroom.cs.unc.edu','sgamage','finalproject','sgamagedb');

if(isset($_POST['login'])){ 
  //text was entered into form fields


$email=$_POST['email'];
$pass= $_POST['password'];
$error="";
$_SESSION['email']=$email;

$sql="SELECT * FROM Users WHERE Username='$email'";
$result=$con->query($sql); 
if($result->num_rows==0){
  echo("<span class ='incorrect' style ='color:red;'>The email and password you entered do not correspond to those in our records. Please try again.</span>");
}else{
$correctpass=$result->fetch_assoc();
if($pass != $correctpass['Password']){
  echo("<span class ='incorrect' style='color:red;'>The password you entered is incorrect.</span>");
  
}else{

  ?>
  <script>
   window.location='aftersignin.php';
  </script>
    <?php
}


}


}


?>








