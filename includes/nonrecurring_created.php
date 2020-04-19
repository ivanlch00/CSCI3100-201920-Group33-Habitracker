<?php
$successMarker = 0;
session_start();
if(isset($_POST['submitNonRecur'])){

  $conn = mysqli_connect("localhost","root","","Habitracker");
  $date = $_POST['date'];
  $time = $_POST['time'];
  $activity_one_off_datetime=$_POST['date'];
  $activity_one_off_datetime.=" ";

  
  $activity_name = mysqli_real_escape_string($conn, $_POST['activityName']);
  $activity_repetition = 0;
  $activity_one_off_datetime.=$time;
  $activity_time_remark = mysqli_real_escape_string($conn, $_POST['timeRemark']);
  $activity_location = mysqli_real_escape_string($conn, $_POST['Locationnumber']);
  $activity_remark = mysqli_real_escape_string($conn, $_POST['Remark']);
  $activity_status_open =2 ;

  if ($_POST['publicOption'] == "yes")  $activity_status_open = 1;
  else $activity_status_open = 0;

  $username = $_SESSION["username"];
  $user_id = $_SESSION["user_id"];

  if(empty($activity_name)||empty($date)||empty($time)){
    header("Location: ../activity_index_page.php?nonrecur_event_create=empty");
  }else{

    $sql = "INSERT INTO  `activity_table`(
      `activity_name`,`activity_repetition`,`activity_one_off_datetime`,  `activity_time_remark`,
      `activity_location`,  `activity_remark`,`activity_status_open`,  `username`)VALUES (?,?,?,?,?,?,?,?);";

      $stmt = mysqli_stmt_init($conn);

      if(!mysqli_stmt_prepare($stmt,$sql)){
        echo "sql statement not prepared";
      }else{
        mysqli_stmt_bind_param($stmt,"ssssssss",
        $activity_name,  $activity_repetition,$activity_one_off_datetime,$activity_time_remark,
        $activity_location,$activity_remark,  $activity_status_open,  $username);
        mysqli_stmt_execute($stmt);
        $successMarker = 1;
      }



      if($successMarker!=0){

        //query for activity id

        $sqlFind = "SELECT * FROM activity_table";
        $result = mysqli_query($conn,$sqlFind);

        $activityID = -1;
        while($row = mysqli_fetch_assoc($result))  {

          if( $row['activity_name'] == $activity_name && $row['username'] == $username)
          $activityID= $row['activity_id'];
        }
        //insert username into the users list table
        $sqlInsert = "INSERT INTO `activity_users_list` ( `user_id`, `activity_id`) VALUES ( '$user_id', '$activityID');";
          echo "$sqlInsert";
          mysqli_query($conn,$sqlInsert);


        header("Location: ../activity_index_page.php?nonrecur_event_create=done&id=$activityID");}
      
      if($successMarker==0)  {header("Location: ../activity_index_page.php?nonrecur_event_create=failure");}
}
}
}
?>
