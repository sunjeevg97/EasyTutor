<?php
$con=mysqli_connect('classroom.cs.unc.edu','sgamage','finalproject','sgamagedb');
    if(isset($_POST['submit'])){
        $fullname= $_POST['full_name'];
        $email= $_POST['email'];
        $pass= $_POST['password'];
        $phone= $_POST['phone'];
		$tutor=$_POST['type'];
		$error= "";
		echo $fullname;
    
    if (empty($fullname)){
        $error="Name is required.\n";
		echo $error;
    }
     if (empty($email)){
        $error="Email is required.\n";
		echo $error;
    }
     if (empty($pass)){
        $error="Password is required.\n";
		echo $error;
    }
     if (empty($phone)){
        $error="Phone Number is required.\n";
		echo $error;
    }
		 $sql="INSERT INTO Users(Full_Name,Username,Password,Privileges,Phone_Number) VALUES
         ('$fullname','$email','$pass',1,'$phone')";
            $con->query($sql);
	unset($name);
	unset($email);
	unset($pass);
	unset($error);
	}


?>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </head>
<body>





 </body>

</html>

