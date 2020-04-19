<?php

//Contributed by Ivan


$username = $_SESSION["username"];
$user_id = $_SESSION["user_id"];



function quitActivity($conn, $activity_id,$user_id){
  $sql1 = "delete from activity_table where activity_id = ? AND user_id = ?; ";


  $stmt1 = mysqli_prepare($conn,$sql1);


  if ($stmt1 == FALSE) {
    header("Location: index.php?error=sqlerror");
    exit();
  }
  else {
    mysqli_stmt_bind_param($stmt1, "i", $activity_id);
    mysqli_stmt_execute($stmt1);


    header('Location:index.php?quit=success');



  }
  header('Location:index.php?quit=fail');

}

if(isset($_GET['id'])){

  $conn = mysqli_connect("localhost","root","","Habitracker");

  deleteActivity($conn,$_GET['id'],$user_id);


}
