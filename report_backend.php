<?php
    session_start();
    if( !isset($_SESSION['username'])){
        echo "You are not authorized to view this page. Go back <a href= '/'>home</a>";
        exit();
    } 
    else if($_POST){
        require 'db_key.php';
        $conn = connect_db();
        
        if(isset($_POST['report_goal']) ){
            $report_type = "goal";
            $goal_id = $_POST['goal_id'];
            $reason = $_POST['reason'];
            $goal_name = $_POST['goal_name'];
            $reporter = $_SESSION['username'];
            $owner = $_POST['goal_creator'];
            
            $sql = "insert into reports (report_type, goal_id, reason, goal_name, reporter, owner) values (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: admin_index.php?error=sqlerror");
                exit();
            }
            else {
                mysqli_stmt_bind_param($stmt, "sissss", $report_type, $goal_id, $reason, $goal_name, $reporter, $owner);
                mysqli_stmt_execute($stmt);
                //echo "The report is submitted!. You may go back to <a href='search_goal.php'>search goals</a>";
                header("Location: ../Habitracker/search_goal.php?goal_reported=true");
                exit();
            }
        } 
        else if(isset($_POST['report_activity'])) {
            $report_type = "activity";
            $activity_id = $_POST['activity_id'];
            $reason = $_POST['reason'];
            $activity_name = $_POST['activity_name'];
            $reporter = $_SESSION['username'];
            $owner = $_POST['activity_creator'];
            
            $sql = "insert into reports (report_type, activity_id, reason, activity_name, reporter, owner) values (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: admin_index.php?error=sqlerror");
                exit();
            }
            else {
                mysqli_stmt_bind_param($stmt, "sissss", $report_type, $activity_id, $reason, $activity_name, $reporter, $owner);
                mysqli_stmt_execute($stmt);
                //echo "The report is submitted!. You may go back to <a href=activity_show_all_public_activities.php>view the activities</a> now";
                header("Location: ../Habitracker/activity_show_all_public_activities.php?activity_reported=true");
                exit();
            }
        }
    }else{
        header('location: index.php');
        exit();
    }
    //header('location: index.php');
    ?>
