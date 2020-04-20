<?php

//Contributed by Ivan

session_start();
$conn = mysqli_connect("localhost","root","","Habitracker");
$username = $_SESSION["username"];
$user_id = $_SESSION["user_id"];
    
function getActivityNameFromActivityID($data){
  $conn = mysqli_connect("localhost","root","","Habitracker");
  $sql = "SELECT * FROM activity_table WHERE activity_id = ".$data." ";
  $result = mysqli_query($conn,$sql);
  while($row = mysqli_fetch_assoc($result)){
    echo "<span>".$row['activity_name']."</span><br>";
  }


}

if(isset($_GET['id'])){

  $userName = $_SESSION['username'];
  $activityID = $_GET['id'];


  $conn = mysqli_connect("localhost","root","","Habitracker");
  $sql = "SELECT * FROM activity_users_list WHERE activity_id = ".$activityID." ";
  $result = mysqli_query($conn,$sql);

  $alreadyJoined = 0;

  while($row = mysqli_fetch_assoc($result)){
    if($row['username'] == $userName){
      $alreadyJoined++;
    }
  }

  if($alreadyJoined==0){//when equals to zero, the user HAS NOT joined the event
    $sqlInsert = "INSERT INTO `activity_users_list` ( `user_id`, `activity_id`) VALUES ( '$user_id', '$activityID');";
    $result = mysqli_query($conn,$sqlInsert);
    header("Location:activity_view_mine.php?join=success");
  }else{
    echo "You have already joined this event";
    header("Location:activity_view_mine.php?join=fail");


  }





}



?>
