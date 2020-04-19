<?php

require 'header.php';
function getActivityNameFromActivityID($data){
  $conn = mysqli_connect("localhost","root","","Habitracker");
  $sql = "SELECT * FROM activity_table WHERE activity_id = ".$data." ";
  $result = mysqli_query($conn,$sql);
  while($row = mysqli_fetch_assoc($result)){
    echo "<span>".$row['activity_name']."</span><br>";
  }

//Contributed by Ivan


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

  $userName = $_SESSION['username'];

}

if(isset($_GET['id'])){

  //$userName = $_SESSION['username'];

  $userName = "PikachuMasterHello";
  /* for testing purpose we use user PIKACHU id = 6*/


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
    $sql = "INSERT INTO `activity_users_list` ( `username`, `activity_id`) VALUES ( '".$userName."', '".$activityID."');";
    $result = mysqli_query($conn,$sql);
    header("Location:index.php?join=success");
  }else{
    echo "You have already joined this event";
    header("Location:index.php?join=fail");


  }





}



?>
