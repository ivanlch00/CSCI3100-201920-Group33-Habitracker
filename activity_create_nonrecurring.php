<!doctype html>
<html lang="en">

<?php
//Contributed by Ivan

require 'header.php';
?>

<head>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>




  <script>
  $( function() {
    $( "#datepicker" ).datepicker({  dateFormat: "yy-mm-dd"});
  } );
  //https://jqueryui.com/datepicker/
  </script>

  <script>
  $( function() {
    $( "#timepicker" ).timepicker({interval: 15,timeFormat: 'HH:mm:ss',startTime: new Date(0,0,0,0,0,0) });
  } );
  //https://timepicker.co/options/
  </script>

</head>

<body>
<div><h1>Create non-recurring activity</h1></div>
<div><p>You can create an one-off activity now and see if the activity mode and your new hobby-buddies suit you!</p></div>
  <form action="includes/nonrecurring_created.php" method="POST">
    <p>Name: <input type="text" name="activityName" placeholder="Name of the activity"></p>
    <p>Select Date: <input type="text" id="datepicker" name="date" placeholder="2020-01-01"></p>
    <p>Select Time: <input type="text" id="timepicker" name="time" placeholder="00:00:00"></p>

    <p>Location: 
    <select name="Locationnumber" id="Locationnumber">
        <option>Islands</option>
        <option>Kwai Tsing</option>
        <option>North</option>
        <option>Sai Kung</option>
        <option>Sha Tin</option>
        <option>Tai Po</option>
        <option>Tsuen Wan</option>
        <option>Tuen Mun</option>
        <option>Yuen Long</option>
        <option>Kowloon City</option>
        <option>Kwun Tong</option>
        <option>Sham Shui Po</option>
        <option>Wong Tai Sin</option>
        <option>Yau Tsim Mong</option>
        <option>Central & Western</option>
        <option>Eastern</option>
        <option>Southern</option>
        <option>Wan Chai</option>
        <option>Online</option>
    <option selected="selected">Others</option>
    </select></p>

    <p>Remark on the date and time (Optional): <input type="text" name="timeRemark" placeholder="Time remark of the activity"></p>
    <p>General Remark (Optional): <input type="text" name="Remark" placeholder="General remark of the activity"> </p>

      <button type="submit" name="submitNonRecur">Create!</button>

    </form>

    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

  </body>
  </html>
