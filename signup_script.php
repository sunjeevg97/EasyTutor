<?php

session_start();
  //require('db_connect.php');

  function newUser(){
    $fullname = $_POST['full_name'];
    $user = $_POST['email'];
    $password = $_POST['password'];
    $query = "INSERT INTO Users(Full_Name, Username, Password) VALUES('$fullname', '$user', '$password')";
    $data = mysqli_query($query) or die(mysql_error());

    if($data){
      echo "you successfully signed up";
    }
  }

  function signUp(){
		echo "HIII";
    if(!empty($_POST['email'])){
      $query = mysqli_query("SELECT * FROM Users WHERE Username = '$_POST[email]' AND Password = '$_POST[password]'");
    }

    if(!$row = mysql_fetch_array($query) or die(mysql_error())) {

        newUser();

      } else {
        echo "SORRY...YOU ARE ALREADY REGISTERED USER...";
      }

  }

  if(isset($_POST['submit']))
  {
	   signUp();
   }

 ?>
