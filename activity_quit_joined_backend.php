<?php

//Contributed by Ivan
    session_start();
    $conn = mysqli_connect("localhost","root","","Habitracker");

$username = $_SESSION["username"];
$user_id = $_SESSION["user_id"];



function quitActivity($conn, $activity_id,$user_id){
  $sql1 = "delete from activity_users_list where activity_id = ? AND user_id = ?; ";


  $stmt1 = mysqli_prepare($conn,$sql1);


  if ($stmt1 == FALSE) {
    header("Location: index.php?error=sqlerror");
    exit();
  }
  else {
    mysqli_stmt_bind_param($stmt1, "ii", $activity_id, $user_id);
    mysqli_stmt_execute($stmt1);


    header('Location:activity_view_mine_joined.php?quit=success');



  }

}

if(isset($_GET['id'])){

  $conn = mysqli_connect("localhost","root","","Habitracker");

  quitActivity($conn,$_GET['id'],$user_id);


}
