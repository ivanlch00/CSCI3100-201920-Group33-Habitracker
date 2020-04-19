<?php
//Contributed by Ivan

require 'header.php';



$username = $_SESSION["username"];
$user_id = $_SESSION["user_id"];


function checkIfTheMemberIsTheCreator($activityID,$user_id){
  $cnt=0;

  $conn = mysqli_connect("localhost","root","","Habitracker");
  if($user_id==NULL){
    header("Location: index.php?query=failed");
  }else{
    $sql = "SELECT * FROM activity_users_list WHERE  user_id = '".$user_id." '";
  }

  $result = mysqli_query($conn,$sql);
  while($row = mysqli_fetch_assoc($result)){
    $cnt++;
  }

  if($cnt==0){
    echo '<br><form action = "activity_quit_joined_backend.php" method="GET">
    <button type="submit" name="id" value='.$activityID.'>Confirm Quit </button> </form>';
  }else{
    echo '<br>You are the creator of this event, you cannot quit this event.<br>If you plan to delete this event, please first make the event private<br>';
  }

}

function getActivityNameFromActivityID($data){
  $conn = mysqli_connect("localhost","root","","Habitracker");
  $sql = "SELECT * FROM activity_table WHERE activity_id = ".$data." ";
  $result = mysqli_query($conn,$sql);
  while($row = mysqli_fetch_assoc($result)){
    echo "<span>".$row['activity_name']."</span><br>";
  }
}

function getProperWeekDay($capWeekDay){
  if ($capWeekDay=="MON")return "Monday";
  elseif ($capWeekDay=="TUE")return "Tuesday";
  elseif ($capWeekDay=="WED")return "Wednesday";
  elseif ($capWeekDay=="THU")return "Thursday";
  elseif ($capWeekDay=="FRI")return "Friday";
  elseif ($capWeekDay=="SAT")return "Saturday";
  elseif ($capWeekDay=="SUN")return "Sunday";
}

if(isset($_GET['id'])){

  $activityID = $_GET['id'];
  getActivityNameFromActivityID($activityID);
  echo "<br><div>Details: </div>";
  $conn = mysqli_connect("localhost","root","","Habitracker");
  $sql = "SELECT * FROM activity_table WHERE activity_id = ".$activityID." ";
  $result = mysqli_query($conn,$sql);

  while($row = mysqli_fetch_assoc($result)){
    if(!empty($row['activity_one_off_datetime'])){
      $date= $row['activity_one_off_datetime'];
      echo "<div>The activity will be held on ".$date.". </div>";
    }
    if($row['activity_repetition']==1){

      echo "<div>The activity will be held once a week on ".
      getProperWeekDay($row['activity_recurring_date_0']).
      " at ".$row['activity_recurring_time_0'].". </div>";
    }
    if($row['activity_repetition']==2){

      echo "<div>The activity will be held twice a week on ".
      getProperWeekDay($row['activity_recurring_date_0']).
      " at ".$row['activity_recurring_time_0']." and ".
      getProperWeekDay($row['activity_recurring_date_1']).
      " at ".$row['activity_recurring_time_1'].". ".

      " </div>";
    }
    if($row['activity_repetition']==3){

      echo "<div>The activity will be held three times a week on ".
      getProperWeekDay($row['activity_recurring_date_0']).
      " at ".$row['activity_recurring_time_0']." , ".
      getProperWeekDay($row['activity_recurring_date_1']).
      " at ".$row['activity_recurring_time_1']." and ".
      getProperWeekDay($row['activity_recurring_date_2']).
      " at ".$row['activity_recurring_time_2'].". ".
      " </div>";
    }
    echo "<div>The location of this event is '".$row['activity_location']."'. </div>";

    if(!empty($row['activity_remark'])){
      echo "<div><br>The description of this event is as follow: <br> ".$row['activity_remark'].". </div>";

    }

    if(!empty($row['activity_time_remark'])){
      echo "<div><br>Special remark about the time:  <br> ".$row['activity_time_remark'].". </div>";

    }
  }
  checkIfTheMemberIsTheCreator($activityID,$user_id);

  echo '<form action = "index.php">
  <button type="submit">Go back to home page </button> </form>';
  echo"</div>";

}
?>
