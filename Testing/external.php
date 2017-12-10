<?php
//session_start();
$con=mysqli_connect('classroom.cs.unc.edu','sgamage','finalproject','sgamagedb');


		$longitude = $_POST['longitude'];
		$latitude = $_POST['latitude'];
		echo json_encode($longitude);
		echo json_encode($latitude);
		echo json_encode("hello world");



	// $sql="INSERT INTO Users(Full_Name,Username,Password,Privileges,Phone_Number) VALUES
   //       ('William','bob@bob.com','kdsajfad',1,8329382943)";
   //          $con->query($sql);


$sql="UPDATE Users SET longitude=$longitude WHERE Privileges=1";
$con->query($sql);


//$sql="SELECT Full_Name FROM Users WHERE Privileges=1";
//$result= $con->query($sql);
//while($row = $result->fetch_assoc()) {
//        echo "Tutor: " . $row["Full_Name"] . "<br>";    }


?>

