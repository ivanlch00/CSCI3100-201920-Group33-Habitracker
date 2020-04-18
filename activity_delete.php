<?php

function deleteActivity($conn, $activity_id){
  $sql = "delete from activity_table where activity_id = ?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: admin_index.php?error=sqlerror");
    exit();
  }
  else {
    mysqli_stmt_bind_param($stmt, "i", $activity_id);
    mysqli_stmt_execute($stmt);

    $sql = "update reports set deleted = true where activity_id = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: index.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "i", $activity_id);
      mysqli_stmt_execute($stmt);
      header('Location:index.php?delete=succcess');

      // delete group chat

    }
  }
}

if(isset($_GET['id'])){

  $conn = mysqli_connect("localhost","root","","Habitracker");


  deleteActivity($conn,$_GET['id']);

  header('Location:index.php?delete=fail');



}
