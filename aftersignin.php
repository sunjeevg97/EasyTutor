<?php
session_start();
$con=mysqli_connect('classroom.cs.unc.edu','sgamage','finalproject','sgamagedb');
$email=$_SESSION['email'];
$sql="SELECT Full_Name FROM Users WHERE Username='$email'";
$result=$con->query($sql);
$nameaccess=$result->fetch_assoc();
$name=$nameaccess['Full_Name'];

//determine whether user is a tutor or a student:
$whoToShow= "SELECT * FROM Users WHERE Username='$email'";
$answer = $con->query($whoToShow);

 $usertype = $answer->fetch_assoc();




echo "<h1 style='color:#16A085;font-family:Verdana;'>"."Hello ".$name."!"."</h1>";



if($usertype['Privileges']=='tutor'){
	echo"<a href='geocode.php'><button>Find Students!</button></a> ";
}
if($usertype['Privileges'] =='student'){
	echo"<a href='geocode.php'><button>Find Tutors!</button></a> ";
}

echo "<a href=''><button>View Messaging History</button></a></br>";
echo "<a href='index.php'>Log out</a></br>";






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
