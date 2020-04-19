<?php

//Contributed by Ivan

require 'header.php';


$username = $_SESSION["username"];
$user_id = $_SESSION["user_id"];


function getdetailsFromActivityID($data){
  $conn = mysqli_connect("localhost","root","","Habitracker");
  $sql = "SELECT * FROM activity_table WHERE activity_id = ".$data." ";
  $result = mysqli_query($conn,$sql);
  
  while($row = mysqli_fetch_assoc($result)){

    echo "<span>".$row['activity_name']."</span>";

    echo "<br><a href='activity_display_details.php?id=".$data."'> View Details  </a>";


    echo "<br><a href='activity_quit_joined.php?id=".$data."'> Quit this</a><br>";



  }


}


$stackActivityIDs = array();
$conn = mysqli_connect("localhost","root","","Habitracker");
if($user_id==NULL){
  header("Location: index.php?queryViewJoined=failed");
}else{
  $sql = "SELECT * FROM activity_users_list WHERE  user_id = '".$user_id." '";
}
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){
  array_push($stackActivityIDs,$row['activity_id']);
}

$cnt = 0;

do{

  $displayNum = $cnt + 1;

  echo"<br>";

  echo"$displayNum";
  echo")";

  getdetailsFromActivityID($stackActivityIDs[$cnt]);

  $cnt++;



}while(isset($stackActivityIDs[$cnt]));
