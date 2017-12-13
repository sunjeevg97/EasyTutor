<?php
session_start();
$email=$_SESSION['email'];
//echo "<b>Username: </b>".$email."</br>";


$con=mysqli_connect('classroom.cs.unc.edu','sgamage','finalproject','sgamagedb');


$whoToShow= "SELECT * FROM Users WHERE Username='$email'";
$answer = $con->query($whoToShow);

$usertype = $answer->fetch_assoc();
 //echo "<b>Account type: </b>".$usertype['Privileges'];

 //echo"<a href='index.php'><h3>Log out</h3></a>";



$target_array = array();

$idcounter = 0;

 if($usertype['Privileges']=='tutor'){
  //echo "<b>Click on a student to contact:</b>";
$sql="SELECT * FROM Users WHERE Privileges='student'";
$result= $con->query($sql);
while($row = $result->fetch_assoc()) { //If user is a tutor display students

      //  echo "<p class='userlist' id='".$idcounter."'>Student".$idcounter.": <b>" . $row['Full_Name'] . "</b></p>";

        array_push($target_array,array($row['Full_Name'],$row['longitude'],$row['latitude'],$row['Username']));

        $idcounter++;
        }
}

  if($usertype['Privileges'] =='student'){//If user is a student, display tutors
    //echo "<b>Click on a tutor to contact:</b>";
    $sql="SELECT * FROM Users WHERE Privileges='tutor'";
    $result= $con->query($sql);
    while($row = $result->fetch_assoc()) {
          //$tutor_list =  "<p id='".$idcounter."'>Tutor".$idcounter.": <b>" . $row['Full_Name'] . "</b></p>";
        //echo"<script>$('#account0').click(function{alert('click')});</script>";

          array_push($target_array,array($row['Full_Name'],$row['longitude'],$row['latitude'],$row['Username']));

          $idcounter++;
      }
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

    <title>Geolocation</title>
    <meta name='viewport' content='initial-scale=1.0, user-scalable=no'>
    <meta charset='utf-8'>
    <style>
    #map{
      float:right;
      position:fixed;
      width: 50%;
      height: 106%;
      margin-top: -20px;
    }
    .nav{
      position: fixed !important;
      top: 30px;
      margin-left: 30px;
      width:500px;
    }

    .user-list{
      margin-top: 100px;
    }

    .list-group{
      padding: 3px 10px;
    }
    </style>
  </head>
  <body>
      <nav class="nav nav-pills">
        <a class="nav-link" href="aftersignin.php">Profile</a>
        <a class="nav-link active" href="#">
          <? if($usertype['Privileges'] == 'student'){
              echo "Find Tutors";
            }else{
              echo "Find Students";
            }
          ?>
        </a>
        <a class="nav-link" href="messages.php">Messages</a>
        <a class="nav-link" href="index.php">Logout</a>
      </nav>
    <!--<h3 id='searching'>Searching for you. Please allow your browser to use your location.</h3>-->
      <div id='map'></div>

      <div class = "user-list">
        <? if($usertype['Privileges'] =='student'){

            $sql="SELECT * FROM Users WHERE Privileges='tutor'";
            $result= $con->query($sql);
            $idcounter = 0;
            while($row = $result->fetch_assoc()) {
              echo "<div class='list-group'>
                    <a id = '".$idcounter. "' href='#' class= 'list-group-item list-group-item-action flex-column align-items-start' data-toggle='modal' data-target= '#msgModal'>
                      <div class='d-flex w-100 justify-content-between'>
                        <h5 class='mb-1'>". $row['Full_Name']. "</h5>
                      </div>
                      <p class='mb-1'></p>
                        </a>

                    </div>";
              //echo "<button class = 'btn btn-primary' id='".$idcounter."'>Tutor".$idcounter.": " . $row['Full_Name'] . "</button><br><br>";
                $idcounter++;
            }
          }

          if($usertype['Privileges']=='tutor'){
         $sql="SELECT * FROM Users WHERE Privileges='student'";
         $result= $con->query($sql);
         $idcounter = 0;
              while($row = $result->fetch_assoc()) { //If user is a tutor display students
                echo "<div class='list-group'>
                      <a id = '".$idcounter. "' href='#' class= 'list-group-item list-group-item-action flex-column align-items-start' data-toggle='modal' data-target= '#msgModal'>
                        <div class='d-flex w-100 justify-content-between'>
                          <h5 class='mb-1'>". $row['Full_Name']. "</h5>
                        </div>
                        <p class='mb-1'></p>
                          </a>

                      </div>";
               //  echo "<p class='userlist' id='".$idcounter."'>Student".$idcounter.": <b>" . $row['Full_Name'] . "</b></p>";

                 array_push($target_array,array($row['Full_Name'],$row['longitude'],$row['latitude'],$row['Username']));

                 $idcounter++;
                 }
         }
        ?>
      </div>
      <div class="modal fade" id="msgModal" tabindex="-1" role="dialog" aria-labelledby="msgModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                <?
                  if($usertype['Privileges'] == 'student'){
                      echo "Write a message to the tutor";
                    }else{
                      echo "Write a message to the student";
                    }
                ?>
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div id='messageform'>

                  <form name="form1">
                      <div class="form-group">
                        <textarea class="form-control" name = 'notename'id="note" rows="3"></textarea>
                      </div>
                    </form>
              </div>
            </div>
            <div class="modal-footer">
              <button id='sendbutton' name="submit" type="submit" class ="btn btn-lg btn-outline-warning" data-dismiss = "modal">Send</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error 'The Geolocation service
      // failed.', it means you probably did not give permission for the browser to
      // locate you.

      function distance(lat1, lon1, lat2, lon2) {
            var radlat1 = Math.PI * lat1/180;
            var radlat2 = Math.PI * lat2/180;
            var theta = lon1-lon2;
            var radtheta = Math.PI * theta/180;
            var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
            dist = Math.acos(dist);
            dist = dist * 180/Math.PI;
            dist = dist * 60 * 1.1515;

            return parseFloat(Math.round(dist * 100) / 100).toFixed(2);
      }

        //console.log("distance: "+distance(5,43,123,433));






      $('#messageform').hide();


        var targetjs = <?php echo json_encode($target_array); ?>;

        var recipient;

        var count =0;

        targetjs.forEach(function(){

                  $('#'+String(count)).on('click',function(){

                    var ident = $(this).attr('id');



                    console.log('You clicked on user '+ ident );



                    recipient = targetjs[ident][3];

                    console.log(recipient);

                    $('#messageform').show();


                 });

           count++;

        });



        $('#sendbutton').click(function(){

          var messToSend = $('#note').val();

          var recipname = recipient;

          var username = <?php echo json_encode($email); ?>;


             $.ajax({
                  url: 'sent.php',
                  method: 'POST',
                  data: { 'message': messToSend, 'from': username, 'to':recipname },
                  success: function (data) {
                    console.log(data);
                  }
            });

        });


         //for iterating through each individual element
         // for(var i=0; i < targetjs.length; i++){
         //  for(var j = 0; j < targetjs[i].length; j++) {
        //      console.log('jsrepresentation'+targetjs[i][j]);
        //  }
        // }



      var longitude;
      var latitude;

     // var mapTutor;

      var map, infoWindow, otherWindow;

        function initMap() {

            map = new google.maps.Map(document.getElementById('map'), {
              center: {lat: -34.397, lng: 150.644},
              zoom: 7,
              styles: [
            {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
            {
              featureType: 'administrative.locality',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'poi',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'poi.park',
              elementType: 'geometry',
              stylers: [{color: '#263c3f'}]
            },
            {
              featureType: 'poi.park',
              elementType: 'labels.text.fill',
              stylers: [{color: '#6b9a76'}]
            },
            {
              featureType: 'road',
              elementType: 'geometry',
              stylers: [{color: '#38414e'}]
            },
            {
              featureType: 'road',
              elementType: 'geometry.stroke',
              stylers: [{color: '#212a37'}]
            },
            {
              featureType: 'road',
              elementType: 'labels.text.fill',
              stylers: [{color: '#9ca5b3'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry',
              stylers: [{color: '#746855'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry.stroke',
              stylers: [{color: '#1f2835'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'labels.text.fill',
              stylers: [{color: '#f3d19c'}]
            },
            {
              featureType: 'transit',
              elementType: 'geometry',
              stylers: [{color: '#2f3948'}]
            },
            {
              featureType: 'transit.station',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'water',
              elementType: 'geometry',
              stylers: [{color: '#17263c'}]
            },
            {
              featureType: 'water',
              elementType: 'labels.text.fill',
              stylers: [{color: '#515c6d'}]
            },
            {
              featureType: 'water',
              elementType: 'labels.text.stroke',
              stylers: [{color: '#17263c'}]
            }
          ]
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

                      //set distances





                  for(var rowNum=0;rowNum<targetjs.length;rowNum++){
                  // targetjs.forEach(function(){


                    var otherLong=targetjs[rowNum][1];
                    var otherLat=targetjs[rowNum][2];

                    console.log(otherLong);
                    console.log(otherLat);

                    var distanceBetween = distance(pos.lat,pos.lng,otherLat,otherLong);


                      console.log(distanceBetween+"Miles");

                      $('#'+rowNum).append(distanceBetween+" miles away");



                  }













                    document.getElementById('searching').innerHTML = 'Found you! Here are your coordinates=> </br> (longitude: '+longitude+', latitude: '+latitude+')';



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



          console.log('arraylength: '+targetjs.length);



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
