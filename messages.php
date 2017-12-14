    <?php
      session_start();
     //$username='adam@students.com';
     $username=$_SESSION['email'];
      $con=new mysqli('classroom.cs.unc.edu','sgamage','finalproject','sgamagedb');

      $sql="SELECT Full_Name FROM Users WHERE Username='$username'";
      $result=$con->query($sql);
      $nameaccess=$result->fetch_assoc();
      $name=$nameaccess['Full_Name'];

      $sql="SELECT * FROM Messages WHERE Recipient='$username'";
      $result = $con->query($sql);
      $user_array = array();


      $sql="SELECT * FROM Users WHERE Username !='$username'";
      $collect= $con->query($sql);
      $usertype = $collect->fetch_assoc();

          while($row = $collect->fetch_assoc()) { //If user is a tutor display students

        // echo "<p class='userlist' id='".$idcounter."'>Student".$idcounter.": <b>" . $row['Full_Name'] . "</b></p>";

          array_push($user_array,array($row['Username']));


        }

        $num_inbox = $result->num_rows;
?>

<!DOCTYPE html>
<html>

  <head>

    <script src='https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js'></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/68976c17f4.js"></script>
    <link href="jumbotron-narrow.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

    <script>

        var userlist = <?php echo json_encode($user_array); ?>;

    </script>

    <style>
    body,html{
      width: 100%;
      height: 100%;
    }

    #nav-sent{
      width:100%;
      height:50%;
      overflow: auto;
    }

    #nav-inbox{
      width:100%;
      height:100%;
      overflow: auto;
    }

    #composition{
      float:right;
      width:50%;
      height:100%;
      padding-left: 10px;
      margin-top: -655px;
      position:sticky;
    }
    .jumbotron{
      margin-right: 10px;
      top: 15px;
      position:sticky;
    }
    .message-tabs{
      width:50%;
      height:100%;
    }

    </style>
  </head>

  <body>
    <!---Top navbar -->
    <nav class="nav nav-pills" style="margin-left:50px;">
      <a class="nav-link" href="aftersignin.php" data-toggle="tooltip" data-placement="bottom" title="<?echo $name. "'s Profile"?>">Profile</a>
      <a class="nav-link" href="geocode.php">
        <? if($usertype['Privileges'] == 'student'){
            echo "Find Tutors";
          }else{
            echo "Find Students";
          }
        ?>
    </a>
      <a class="nav-link active" href="#">Messages</a>
      <a class="nav-link" href="index.php">Logout</a>
    </nav>

    <!--Message navbar -->
    <div class = "message-tabs">
    <nav class="nav nav-tabs" id="myTab" role="tablist" style="margin-top:50px;">
      <a class="nav-item nav-link active" id="nav-inbox-tab" data-toggle="tab" href="#nav-inbox" role="tab" aria-controls="nav-inbox" aria-selected="true" data-toggle = "tab"><i class="fa fa-envelope" aria-hidden="true"></i> Inbox <span class="badge badge-pill badge-default"><? echo $num_inbox?></span></a>
      <a class="nav-item nav-link" id="nav-sent-tab" data-toggle="tab" href="#nav-sent" role="tab" aria-controls="nav-sent" aria-selected="false" data-toggle = "tab"><i class="fa fa-paper-plane" aria-hidden="true"></i> Sent</a>
    </nav>
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-inbox" role="tabpanel" aria-labelledby="nav-inbox-tab">
        <?
          if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              $sender =  $row["Sender"];
              $message = $row["Message"];
              $time = $row['timestamp'];
              $time= date( "m/d/Y", strtotime($time));
              echo "<div class='list-group'>
                    <a id ='message' href='#' class= 'list-group-item list-group-item-action flex-column align-items-start' data-toggle='modal' data-target= '#msgModal'>
                     <div class='d-flex w-100 justify-content-between'>
                        <h5 class='mb-1'>".$sender."</h5>
                        <small>".$time."</small>
                        </div>
                    <div class='d-flex w-100 justify-content-between'>
                        <p class='mb-1'>".$message."</p>
                        <button class = 'reply btn btn-sm btn-outline-info' value = ".$sender." style = 'float:right;' >Reply</button>
                      </div>
                      </a>

                    </div>";
            }
          } else {
                echo "0 results";
              }
        ?>
      </div>
      <div class="tab-pane fade" id="nav-sent" role="tabpanel" aria-labelledby="nav-sent-tab">
      <?
      //Get sent messages
              $sql="SELECT * FROM Messages WHERE Sender='$username'";
              $result = $con->query($sql);
                 //echo "<b>Sent Messages</b>".":".$username."<br>";
                 $num_sent = $result->num_rows;
            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $recipient = $row['Recipient'];
                $message = $row['Message'];
                $time = $row['timestamp'];
                $time= date( "m/d/Y", strtotime($time));
            echo "<div class='list-group'>
                  <a id ='message' href='#' class= 'list-group-item list-group-item-action flex-column align-items-start' data-toggle='modal' data-target= '#msgModal'>
                   <div class='d-flex w-100 justify-content-between'>
                      <h5 class='mb-1'>".$recipient."</h5>
                      <small>".$time."</small>
                      </div>
                    <p class='mb-1'>".$message."</p>

                   </a>

                  </div>
                  ";
            }
          }
          else{
              echo "No sent messages";
            }
            ?>
      </div>
    </div>
</div>
 <div id='composition'>
   <div class="jumbotron">
     <h1 class="display-4 col-md-auto">Send a message</h1>
     <form name='form1'>
       <div class = 'form-group'>
         <select id="selectUser" class = "form-control form-control-lg col-md-6" style = "margin-left:15px;">
           <option>Choose recipient</option>
         </select>
         <br>

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

        <div class = "w-85 p-3">
       <textarea class="form-control" name = 'notename'id='content' rows = "10" columns = "5"></textarea>
     </div>
   </div>
   </form>

     <p class="lead">
      <button type="submit" class="btn btn-lg btn-info" id='submitbutton' name="submit">Send</button>
     </p>
   </div>
    </div>


<script>
$(function(){
  $(".reply").click(function () {
       var button_value = $(this).val();
       $('#selectUser').val(button_value).trigger("change");
   });
});


$(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

  $(function(){

    $('.nav-tabs a').on('click', function (e) {
      e.preventDefault();
      $(this).tab('show');
    });
  });
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
                    console.log("message sent");
                  }
            });

             location.reload();

        });

</script>







  </body>


</html>
