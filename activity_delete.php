<?php
//Contributed by Ivan

function deleteActivity($conn, $activity_id){
  $sql1 = "delete from activity_table where activity_id = ? ; ";


  $stmt1 = mysqli_prepare($conn,$sql1);


  if ($stmt1 == FALSE) {
    header("Location: index.php?error=sqlerror1");
    exit();
  }
  else {
    mysqli_stmt_bind_param($stmt1, "i", $activity_id);
    mysqli_stmt_execute($stmt1);

    $sql2 = "delete from activity_users_list where activity_id = ? ;";
    $stmt2 = mysqli_prepare($conn,$sql2);

    if ($stmt2 == FALSE) {
      header("Location: index.php?error=sqlerror2");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt2, "i", $activity_id);
      mysqli_stmt_execute($stmt2);

      header('Location: activity_view_mine.php?delete=success');

    }
  }
}

if(isset($_GET['id'])){

  $conn = mysqli_connect("localhost","root","","Habitracker");


  deleteActivity($conn,$_GET['id']);




}
