<?php

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

    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-3">EasyTutor</h1>
        <p class="lead">Find all the tutors in your area</p>
      </div>
    </div>

    <div class="container">

      <form class="form-signup" method = "POST" action = "aftersignup.php">

        <div class = "form-group">
        <label for="inputName" class="sr-only">Full name</label>
        <input type="name" name = "full_name" id="inputName" class="form-control-lg" placeholder="Full Name" required>
        </div>

        <div class = "form-group">
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name = "email" id="inputEmail" class="form-control-lg" placeholder="Email address" required autofocus>
        </div>

        <div class = "form-group">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name = "password" id="inputPassword" class="form-control-lg" placeholder="Password" required>
        </div>

        <div class = "form-group">
        <label for="inputPhone" class="sr-only">Phone number</label>
        <input type="phone" name = "phone" id="inputPhone" class="form-control-lg" placeholder="Phone number" required>
        </div>

        <div class = "form-group">
        <select class="form-control-lg" name="type" placeholder = "User Type">
          <option>tutor</option>
          <option>student</option>
        </select>
        </div>
          <button class="btn btn-lg btn-outline-success .col-md-3" name="submit" type="submit">Sign Up</button>
          <a href="index.php" class="">Already have an account? Sign in</a>
        </div>
      </form>

    </div>

  </body>

</html>
