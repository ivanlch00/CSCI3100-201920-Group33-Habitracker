<?php
    $successMarker = 0;
    session_start();
$conn = mysqli_connect("localhost","root","","Habitracker");



if(isset($_POST['submitRecur'])){


  $activity_repetition = 0;
  $activity_recurring_date_0 = NULL;
  $activity_recurring_time_0 = NULL;
  $activity_recurring_date_1 = NULL;
  $activity_recurring_time_1 = NULL;
  $activity_recurring_date_2 = NULL;
  $activity_recurring_time_2 = NULL;

  $pickerTime[1] = $_POST['timepicker1'];
  $pickerTime[2] = $_POST['timepicker2'];
  $pickerTime[3]= $_POST['timepicker3'];
  $pickerTime[4] = $_POST['timepicker4'];
  $pickerTime[5] = $_POST['timepicker5'];
  $pickerTime[6] = $_POST['timepicker6'];
  $pickerTime[7] = $_POST['timepicker7'];



  for ($i =1; $i<=7; $i++){
    if($pickerTime[$i]!= NULL){
      $activity_repetition++;
      if($activity_repetition == 1){
        $activity_recurring_date_0 = $i;
        $activity_recurring_time_0 = $pickerTime[$i];
      }
      if($activity_repetition == 2){
        $activity_recurring_date_1 = $i;
        $activity_recurring_time_1 = $pickerTime[$i];
      }
      if($activity_repetition == 3){
        $activity_recurring_date_2 = $i;
        $activity_recurring_time_2 = $pickerTime[$i];
      }
    }
  }

  if($activity_repetition>=4){
    header("Location: ../activity_index_page.php?recur_event_num=$activity_repetition&recur_event_create=failbyoversize");
    //will do the alert by GET later
  }

  if($activity_repetition==0){
    header("Location: ../activity_index_page.php?recur_event_num=$activity_repetition&recur_event_create=notrecurring");
  }






  $activity_name = mysqli_real_escape_string($conn, $_POST['activityName']);
  $activity_time_remark = mysqli_real_escape_string($conn, $_POST['timeRemark']);
  $activity_location = mysqli_real_escape_string($conn, $_POST['Locationnumber']);
  $activity_remark = mysqli_real_escape_string($conn, $_POST['Remark']);
  $activity_status_open =-1 ;

  if ($_POST['publicOption'] == "yes")  $activity_status_open = 1;
  else $activity_status_open = 0;

  $username = $_SESSION["username"];
  $user_id = $_SESSION["user_id"];
    
  if(empty($activity_name)){
    header("Location: ../activity_index_page.php?recur_event_create=emptyname");
  }else{

    $sql = "INSERT INTO  `activity_table`(
      `activity_name`,`activity_repetition`,
      `activity_recurring_date_0`,`activity_recurring_time_0`,
      `activity_recurring_date_1`,`activity_recurring_time_1`,
      `activity_recurring_date_2`,`activity_recurring_time_2`,
      `activity_time_remark`,
      `activity_location`,  `activity_remark`,`activity_status_open`,  `username`)VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?);";

      $stmt = mysqli_stmt_init($conn);

      if(!mysqli_stmt_prepare($stmt,$sql)){
        echo "sql statement not prepared";
      }else{
        mysqli_stmt_bind_param($stmt,"sssssssssssss",
        $activity_name,  $activity_repetition,
        $activity_recurring_date_0,$activity_recurring_time_0,
        $activity_recurring_date_1,$activity_recurring_time_1,
        $activity_recurring_date_2,$activity_recurring_time_2,
        $activity_time_remark,
        $activity_location,$activity_remark,  $activity_status_open,  $username);

        mysqli_stmt_execute($stmt);

        $successMarker = 1;


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
          $sqlInsert = "INSERT INTO `activity_users_list` ( `username`, `activity_id`) VALUES ( '".$username."', '".$activityID."');";
          mysqli_query($conn,$sqlInsert);


          header("Location: ../activity_index_page.php?recur_event_create=done&id=$activityID");
        }
      if($successMarker==0)  {header("Location: ../activity_index_page.php?recur_event_create=failure");}


      }


  }
















}
