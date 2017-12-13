
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

 if($usertype['Privileges']=='tutor'){
   $result = "<a class = 'btn btn-lg btn-primary .col-md-3' href='geocode.php'>Find Students!</a>";
 }
 if($usertype['Privileges'] =='student'){
   $result = "<a class = 'btn btn-lg btn-primary .col-md-3' href='geocode.php'>Find Tutors!</a>";
 }

 $view =  "<a href='messages.php'><button>View Messaging History</button></a></br>";

?>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  <link href="jumbotron-narrow.css" rel="stylesheet">
</head>

  <body>
    <div class="container">
      <header class="header clearfix">
      <nav>
        <ul class="nav nav-pills float-right">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Logout<span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </nav>
      <h3 class="text-muted"><?php echo $name. "'s Profile"?></h3>
    </header>

        <div class="jumbotron">
          <h1>Find Tutors in Your Area</h1>
          <p class="lead"></p>
          <?php echo $result; ?>
          <a class = 'btn btn-lg btn-primary .col-md-3' href='messages.php'>Messages</a>
        </div>

      </div> <!-- /container -->

  </body>
