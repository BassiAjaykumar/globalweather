<?php
  if(isset($_GET['submit'])){
    $error=$weather="";
    if(!$_GET['city']){
      $error = "Please Enter a city name";
    }
    if($_GET['city']){
      $apiData = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q="
      .$_GET['city']."&appid=f8919dfb66d85e6de004cf41f9aa2b14");

      if($apiData){
        $weatherArray = json_decode($apiData , true);

        if($weatherArray && $weatherArray['cod']==200)
        {
          $tempCelcius = $weatherArray['main']['temp']-273.15;
          $weather = "<b>" .$weatherArray['name']." , " .$weatherArray['sys']['country']."</b> <br>";
          $weather .= "<b>Temperature : </b>".intval($tempCelcius). "&degC <br>";
          $weather .= "<b>Weather Condition : </b> " .$weatherArray['weather'][0]['description'] ."<br>";
          $weather .= "<b>Atmospheric Pressure : </b> " .$weatherArray['main']['pressure']." hPa <br>";
          $weather .= "<b>Wind Speed : </b> " .$weatherArray['wind']['speed']." meter/sec <br>";
          $weather .= "<b>Cloudness : </b> " .$weatherArray['clouds']['all']."% <br>";

          date_default_timezone_set("Asia/Kolkata");
          $sunrise = $weatherArray['sys']['sunrise'];
          $weather .= "<b>Sunrise : </b>" .date("F j , Y,g:i a" , $sunrise)."<br>";
          $sunset = $weatherArray['sys']['sunset'];
          $weather .= "<b>Sunset : </b>" .date("F j , Y,g:i a" , $sunset) ."<br>";
          $weather .= "<b>Current Time : </b>" .date("F j , Y,g:i a") ."<br>";
        }
      }
      else
      {
        $error = "Couldn't be process , Your city name is not valid";
      }
    }
  }
 ?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Weather App</title>

      <style>

        body{
          margin:0px;
          padding:0px;
          box-sizing:border-box;
          background-image : url(imm.jpg);
          color:white;
          font-family: poppin , 'Times New Roman' , Times , serif;
          font-size:large;
          background-size:cover;
          background-attachment:fixed;
        }

        .container{
          text-align:center;
          justify-content:center;
          align-items:center;
          width:440px;
        }

        h1{
          font-weight:700;
          margin-top:150px;
          color:orange;
        }
        label{
          font-size:25px;
          margin-top:5px;
          margin-bottom:-5px;
          color:white;
        }
        input{
          width:400px;
          padding:10px;
          border : none;
          border-radius :5px;
        }
      </style>

  </head>
  <body>
    <div class="container">
      <h1>Search Global Weather</h1>
      <form action="" method="GET">
        <p><label for="city">Enter your city name</label></p>
        <p><input type="text" name="city" id="city" placeholder="City Name"></p>
        <button type="submit" name="submit" class="btn btn-success">Submit</button>

        <div class="output mt-3">

          <?php
          if($weather==TRUE)
          {
            echo '<div class="alert alert-success" role="alert">
            '. $weather.'
            </div>';
          }
          else{
            echo " ";
          }
          if($error==TRUE)
          {
            echo '<div class="alert alert-danger" role="alert">
            '. $error.'
            </div>';
          }
          else{
            echo " ";
          }
           ?>
        </div>
      </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>
