<?php
    require 'header.php';
    if( !isset($_SESSION['username'])){
        echo "You are not authorized to view this page. Go back <a href= '/'>home</a>";
        exit();
    }
    else if(!isset($_GET['id'])){
        header("Location: index.php");
        exit();   
    }

    require 'db_key.php';
    $conn = connect_db();
    
    $goal = null;
    $sql = "select goal_id, goal_name, username, goal_description, goal_subtask, goal_enddate, goal_starttime, goal_endtime from goals where goal_id = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: admin_index.php?error=sqlerror");
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "i", $_GET['id']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $goal = mysqli_fetch_assoc($result);
    }
?>
<link rel="stylesheet" href="report_form.css">

<div class="loginbox">
    <h1>Report Inappropriate</h1>
    
    <form action="report_backend.php" method="POST">
        <!-- this field is hidden -->
        <div class="form-group">
            <input type="hidden" name="goal_id" value="<?php echo $goal['goal_id'] ?>">
            <input type="hidden" name="goal_name" value="<?php echo $goal['goal_name'] ?>" readonly>
            <input type="hidden" name="goal_creator" value="<?php echo $goal['username'] ?>" readonly>
        </div>

        <div class="form-group">
            <p>User: <?php echo $goal['username'];?></p></br>
            <p>Goal ID: <?php echo $goal['goal_id'];?></p></br>
            <p>Goal name: <?php echo $goal['goal_name'];?></p></br>
            <p>Description: <?php echo ($goal['goal_description']==''? "-" : $goal['goal_description']);?></p></br>
            <p>Subtask: <?php echo ($goal['goal_subtask']==''? "-" : $goal['goal_subtask']);?></p></br>
            <p>End date: <?php echo $goal['goal_enddate'];?></p></br>
            <p>Start time: <?php echo (($goal['goal_starttime'] != NULL)? date("H:i", strtotime($goal['goal_starttime'])) : '-'); ?></p></br>
            <p>End time: <?php echo (($goal['goal_endtime'] != NULL)? date("H:i", strtotime($goal['goal_endtime'])) : '-'); ?></p></br>
                        <label for="reason">Reason:</label>

            <textarea class="form-control" name="reason" required></textarea>
        </div>

        <br><button type="submit" class="btn btn-success" name="report_goal">Submit</button>
    </form>
</div>

<?php
    require "footer.php";
?>
