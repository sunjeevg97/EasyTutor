<?php
$connection = new mysqli('classroom.cs.unc.edu', 'sgamage', 'finalproject', 'sgamagedb');

if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}

?>
