<!DOCTYPE html>
<html>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
   
  </head>
  <body>
    
    <script>

$(document).ready(function () {
      var longitude = 5;

      $.ajax({
          url: "external.php",
          method: "POST",
          data: { "longitude": longitude },
          success: function (data) { console.log(data) }
      });
});



    </script>

      

    
  </body>
</html>







