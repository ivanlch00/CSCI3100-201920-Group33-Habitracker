<?php

//Contributed by Ivan

require 'header.php';


if( !isset( $_SESSION['username']) ){
  echo "You are not authorized to view this page. Go back <a href= '/'>home</a>";
  exit();
}


?>

<div>
  <div><h1>Search activities by keyword</h1></div>
</div>
<form action = 'activity_search_backend.php' method = 'POST'>
  <label>You can search activities through keywords.</label><br><br>
  <label>Keyword: </label>
  <input class = 'form-control w-50' type="text" name="activity_keyword"><br><br>

  <div class ='text-center mt-3 w-50'>
    <button class = 'btn btn-outline-info' type = 'submit' value = 'submit' name= 'search_activity'>Submit</button></br></br>
  </form>

require 'header.php';



function getActivityNameFromActivityID($data){
  $conn = mysqli_connect("localhost","root","","Habitracker");
  $sql = "SELECT * FROM activity_table WHERE activity_id = ".$data." ";
  $result = mysqli_query($conn,$sql);
  while($row = mysqli_fetch_assoc($result)){
    echo "<span>".$row['activity_name']."</span><br>";
  }


}

if(isset($_GET['id'])){


  $activityID = $_GET['id'];

  getActivityNameFromActivityID($activityID);

  echo "<div>Participants: </div>";

  $conn = mysqli_connect("localhost","root","","Habitracker");
  $sql = "SELECT * FROM activity_users_list WHERE activity_id = ".$activityID." ";
  $result = mysqli_query($conn,$sql);

  while($row = mysqli_fetch_assoc($result)){
    echo "<span>".$row['username']."</span><br>";
    //printing all users in this event
  }

  echo '<form action = "activity_display_details.php" method="GET">
  <button type="submit" name="id" value='.$activityID.'>Details of this event </button> </form>';

  echo '<form action = "activity_join.php" method="GET">
  <button type="submit" name="id" value='.$activityID.'>Join this event </button> </form>';


  echo '<form action = "index.php">
  <button type="submit">Go back to home page </button> </form>';

  echo"</div>";



}



?>

<body>

  <div>Write this later</div>


</body>



</html>

