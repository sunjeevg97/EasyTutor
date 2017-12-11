<?php
session_start();
$email=$_SESSION['email'];
// echo $email."externalsession";

$con=mysqli_connect('classroom.cs.unc.edu','sgamage','finalproject','sgamagedb');


		$longitude = $_POST['longitude'];
		$latitude = $_POST['latitude'];
		echo json_encode($longitude);
		echo json_encode($latitude);
		echo json_encode("hello world");

//Need to make a query to set longitude for specific userID
$sql="UPDATE Users SET longitude=$longitude WHERE Username='$email'";
$con->query($sql);
$sql="UPDATE Users SET latitude=$latitude WHERE Username='$email'";
$con->query($sql);



// $sql="SELECT COUNT(*) AS 'count' FROM Users WHERE Privileges=1";
// $result=$con->query($sql);
// $row=$result->fetch_assoc();
// echo $row;






// $sql="INSERT INTO Users(Full_Name,Username,Password,Privileges,Phone_Number) VALUES
   //       ('William','bob@bob.com','kdsajfad',1,8329382943)";
   //          $con->query($sql);
	



?>



