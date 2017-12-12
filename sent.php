<?php

session_start();
$email=$_SESSION['email'];



$con=mysqli_connect('classroom.cs.unc.edu','sgamage','finalproject','sgamagedb');





		$message = $_POST['message'];
		$from = $_POST['from'];
		$to = $_POST['to'];

		echo json_encode($message);
		echo json_encode($from);
		echo json_encode($to);



		$sql="INSERT INTO Messages(Sender,Recipient,Message) VALUES
         ('$from','$to','$message')";
            $con->query($sql);


?>