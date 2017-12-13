    <?php
      session_start();
     //$username='adam@students.com';
     $username=$_SESSION['email'];
      $con=new mysqli('classroom.cs.unc.edu','sgamage','finalproject','sgamagedb');
      $sql="SELECT * FROM Messages WHERE Recipient='$username'";
      $result = $con->query($sql);

      $user_array = array();

      $sql="SELECT * FROM Users WHERE Username !='$username'";
      $collect= $con->query($sql);
          while($row = $collect->fetch_assoc()) { //If user is a tutor display students

        // echo "<p class='userlist' id='".$idcounter."'>Student".$idcounter.": <b>" . $row['Full_Name'] . "</b></p>";

        array_push($user_array,array($row['Username']));

        
        }

//echo $user_array;



       echo "<b>Received Messages</b>".":".$username."</br>";




     if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<b>From: </b>" . $row["Sender"]." ";
       
        echo "<b>Message: </b>". $row["Message"]."<b> Time: </b>(".$row['timestamp'].")<br>";
        
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
        echo "<b>To: </b>" . $row["Recipient"]." ";
       
        echo "<b>Message: </b>". $row["Message"]."<b> Time: </b>(".$row['timestamp'].")<br>";
        
    }
} else {
    echo "0 results";
}



    ?>

<!DOCTYPE html>
<html>

  <head>

    <script src='https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js'></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="map.css">
    <link href="jumbotron-narrow.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>


    <script>

        var userlist = <?php echo json_encode($user_array); ?>;

    </script>


  </head>

  <body>

      <a href='index.php'>log out</a></br>

      <div id='composition' style='border-style: solid;'>
      Compose a message to any user of EasyTutor</br>
        <form name='form1'>
          <div class = 'form-group'>

            <select id="selectUser">
           <option>Choose recipient</option>
           </select><br/>

           <script>

            var select = document.getElementById("selectUser"); 

            for(var k=0;k<userlist.length;k++){
                  console.log(userlist[k]);


                  var opt = userlist[k];
                  var el = document.createElement("option");
                  el.textContent = opt;
                  el.value = opt;
                  select.appendChild(el);

            }

           </script>


            <label for='writemessage'>Write Message</label>
            <input id='content' type='text' name='notename'>

          </div>

        <p id='submitbutton' name="submit" type="submit">Send Message</p>
        </form>
      </div>


<script>
        $('#submitbutton').click(function(){

          var messToSend = $('#content').val();

          var recipname = $('#selectUser').val();
          console.log(messToSend);

          var username = <?php echo json_encode($username); ?>;
          

             $.ajax({
                  url: 'sent.php',
                  method: 'POST',
                  data: { 'message': messToSend, 'from': username, 'to':recipname },
                  success: function (data) {
                    console.log(data);
                  }
            });

             location.reload();

        });

</script>







  </body>


</html>


