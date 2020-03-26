<?php
    session_start();
    if( !isset( $_SESSION['username']) ){
        echo "You are not authorized to view this page. Go back <a href= '/'>home</a>";
        exit();
    } else if($_POST){
        require 'db_key.php';
        $conn = connect_db();
        if(isset($_POST['create_goal']) ){
            $goal_name = $_POST['goal_name'];
            $goal_description = $_POST['goal_description'];
            $goal_subtask = $_POST['goal_subtask'];
            $username = $_SESSION['username'];
            $goal_enddate = date("Y-m-d", strtotime("+{$_POST['duration']} days"));
            $goal_starttime = "{$_POST['goal_starttime_hh']}:{$_POST['goal_starttime_mm']}:00";
            $goal_endtime = "{$_POST['goal_endtime_hh']}:{$_POST['goal_endtime_mm']}:00";
            $goal_public = (isset($_POST['goal_public'])) ? 1 : 0;
            //sanitize your input
            $goal_name = mysqli_real_escape_string($conn, $goal_name);
            $goal_description = mysqli_real_escape_string($conn, $goal_description);
            $goal_subtask = mysqli_real_escape_string($conn, $goal_subtask);
            
            $sql = "Insert Into goals (username, goal_name, goal_description, goal_subtask, goal_enddate, goal_starttime, goal_endtime, goal_public) VALUES ('$username', '$goal_name', '$goal_description', '$goal_subtask', '$goal_enddate', '$goal_starttime', '$goal_endtime', '$goal_public')";
            $sql = $conn->query($sql);
            if($sql){
                echo "Goal creation successful. You may <a href=mygoals.php>view your goal list</a> now";
            }
        } else if (isset($_POST['edit_goal'])) {
            $goal_id = $_SESSION['goal_id'];
            $goal_name = $_POST['goal_name'];
            $goal_description = $_POST['goal_description'];
            $goal_subtask = $_POST['goal_subtask'];
            $username = $_SESSION['username'];
            $goal_enddate = date("Y-m-d", strtotime("+{$_POST['duration']} days"));
            $goal_starttime = "{$_POST['goal_starttime_hh']}:{$_POST['goal_starttime_mm']}:00";
            $goal_endtime = "{$_POST['goal_endtime_hh']}:{$_POST['goal_endtime_mm']}:00";
            $goal_public = (isset($_POST['goal_public'])) ? 1 : 0;
            //sanitize your input
            $goal_name = mysqli_real_escape_string($conn, $goal_name);
            $goal_description = mysqli_real_escape_string($conn, $goal_description);
            $goal_subtask = mysqli_real_escape_string($conn, $goal_subtask);
            
            $sql = "Update goals Set goal_name = '$goal_name', goal_description = '$goal_description',goal_subtask = '$goal_subtask',goal_enddate = '$goal_enddate',goal_starttime = '$goal_starttime',goal_endtime = '$goal_endtime',goal_public = '$goal_public' Where goal_id = '$goal_id'";
            $sql = $conn->query($sql);
            if($sql){
                echo "Goal updated. You may <a href=mygoals.php>view your goal list</a> now";
            }
        } else if (isset($_POST['delete_goal'])){
            
        }
    }else{
        header('location: index.php');
        exit();
    }
    //header('location: index.php');
    ?>
