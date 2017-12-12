<?php
session_start();
$email=$_SESSION['email'];
echo "<b>Username: </b>".$email."</br>";


$con=mysqli_connect('classroom.cs.unc.edu','sgamage','finalproject','sgamagedb');


$whoToShow= "SELECT * FROM Users WHERE Username='$email'";
$answer = $con->query($whoToShow);

 $usertype = $answer->fetch_assoc();
 echo "<b>Account type: </b>".$usertype['Privileges'];

 echo"<a href='index.php'><h3>Log out</h3></a>";



$target_array = array();

$idcounter = 0;

 if($usertype['Privileges']=='tutor'){
  echo "<b>Here are some students you may want to get in contact with:</b>";
$sql="SELECT * FROM Users WHERE Privileges='student'";
$result= $con->query($sql);
while($row = $result->fetch_assoc()) { //If user is a tutor display students

        echo "<p class='userlist' id='account".$idcounter."'>Message Student".$idcounter.": " . $row['Full_Name'] . "(long:".$row['longitude'].",lat:".$row['latitude'].")</p>";

        array_push($target_array,array($row['Full_Name'],$row['longitude'],$row['latitude']));

        $idcounter++;
        }
}

if($usertype['Privileges'] =='student'){//If user is a student, display tutors
  echo "<b>Here are some tutors who may be able to help you:</b>";
$sql="SELECT * FROM Users WHERE Privileges='tutor'";
$result= $con->query($sql);
while($row = $result->fetch_assoc()) {
        
        echo "<p id='account".$idcounter."'>Message Tutor".$idcounter.": " . $row['Full_Name'] . "(long:".$row['longitude'].",lat:".$row['latitude'].")</p>";

        //echo"<script>$('#account0').click(function{alert('click')});</script>";

        array_push($target_array,array($row['Full_Name'],$row['longitude'],$row['latitude']));

        $idcounter++;
        }    
}


// //print php array for testing
// for($layer=0;$layer<$idcounter;$layer++){

//         for($col=0;$col<3; $col++){
//             echo ' | '.$target_array[$layer][$col];

//         }
//         echo '</br>';

// }




?>


<!DOCTYPE html>
<html>


  <head>
    <script src='https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js'></script>

    <title>Geolocation</title>
    <meta name='viewport' content='initial-scale=1.0, user-scalable=no'>
    <meta charset='utf-8'>
    <style>
      
      body {background-color: gray;}
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Set proportions of html*/
      html, body {
        height: 70%;
        width: 80%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>


  <body>
    <h3 id='searching'>Searching for you. Please allow your browser to use your location.</h3>
    <div id='map'></div>
  </br>

 

    
    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error 'The Geolocation service
      // failed.', it means you probably did not give permission for the browser to
      // locate you.

        var targetjs = <?php echo json_encode($target_array); ?>;


          $(document).ready(function () {

            var count = 0;

            //use for each loop (targetjs array?) to fix error or maybe figure out how to add click listener

            for(var i = 0; i < targetjs.length; i++) {

              $('#account'+String(count)).on('click',function(){

                alert('You clicked on user '+String(count));

                count++;
            });


              // //for iterating through each individual element
              // for(var j = 0; j < targetjs[i].length; j++) { 
              //     console.log('jsrepresentation'+targetjs[i][j]);
              // }

            
          }

            
        
        });


      var longitude;
      var latitude;
      
     // var mapTutor;

      var map, infoWindow, otherWindow;
      
      function initMap() {

            map = new google.maps.Map(document.getElementById('map'), {
              center: {lat: -34.397, lng: 150.644},
              zoom: 6
            });
        

            infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {

          navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                      lat: position.coords.latitude,
                      lng: position.coords.longitude
                    };
            

                    longitude = pos.lng;
                    latitude = pos.lat;



                    console.log('longitudeGeocoded: ' + longitude);
                    console.log('latitudeGeocoded: ' + latitude);

                    // var user_lat = latitude;


                     $.ajax({
                        url: 'external.php',
                        method: 'POST',
                        data: { 'longitude': longitude, 'latitude': latitude },
                        success: function (data) {
                          console.log(data);
                          }
                    });




                    infoWindow.setPosition(pos);
                    infoWindow.setContent('YOU ARE HERE');
                    infoWindow.open(map);

                    document.getElementById('searching').innerHTML = 'Found you! Here are your coordinates=> </br> (longitude: '+longitude+', latitude: '+latitude+')';
            
            
                    // mapTutor(-79.0533723-1,35.9102378-1,'tutor1');
                    
            
                    map.setCenter(pos);


          }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }


        var mapTutor = function (insertLong, insertLat,tutorName) {
              var newWindow = new google.maps.InfoWindow;

              var newguy = {
                    lat:insertLat,
                    lng:insertLong
              };
              
              newWindow.setPosition(newguy);
              newWindow.setContent(tutorName);
              newWindow.open(map);
        
        
        }


          




          for(var i = 0; i < targetjs.length; i++) {
              var nameinput=targetjs[i][0];
              var longinput=Number(targetjs[i][1]);
              var latinput=Number(targetjs[i][2]);
              
              mapTutor(longinput,latinput,nameinput);


              // //for iterating through each individual element
              // for(var j = 0; j < targetjs[i].length; j++) { 
              //     console.log('jsrepresentation'+targetjs[i][j]);
              // }

            
          }



          console.log('arraylenght: '+targetjs.length);



          console.log(targetjs);


      }




          function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                                  'Error: The Geolocation service failed.' :
                                  'Error: Your browser doesn\'t support geolocation.');
            infoWindow.open(map);
          }


       

  
   </script>

    <script async defer
    src='https://maps.googleapis.com/maps/api/js?key=AIzaSyD6aQaHYbG5Bzu3lFUQMw3V-jeOEuyvP2U&callback=initMap'>
    </script>
    
    


  </body>
</html>








