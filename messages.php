    <?php
      session_start();
     //$username='adam@students.com';
     $username=$_SESSION['email'];
      $con=new mysqli('classroom.cs.unc.edu','sgamage','finalproject','sgamagedb');
      $sql="SELECT * FROM Messages WHERE Recipient='$username'";
      $result = $con->query($sql);
       echo "<b>Received Messages</b>".":".$username."<br>";
     if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "From: " . $row["Sender"]." ";
       
        echo "Message: ". $row["Message"]."<br>";
        
    }
} else {
    echo "0 results";
}
    echo "<br>";
    echo "<br>";
    $sql="SELECT * FROM Messages WHERE Sender='$username'";
      $result = $con->query($sql);
         echo "<b>Sent Messages</b>".":".$username."<br>";
     if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "To: " . $row["Recipient"]." ";
       
        echo "Message: ". $row["Message"]."<br>";
        
    }
} else {
    echo "0 results";
}




echo"</br><a href='index.php'>log out</a>";
    
    
    
    
    
    ?>