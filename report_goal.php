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
    $sql = "select goal_id, goal_name, username from goals where goal_id = ?";
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

<div class="container mx-3">
    <h1>Please fill in the form</h1>
    
    <form action="report_backend.php" method="POST">
        <!-- this field is hidden -->
        <div class="form-group">
            <input type="hidden" name="goal_id" value="<?php echo $goal['goal_id'] ?>">
        </div>
        
        <div class="form-group">
            <label for="goal_name">Goal name:</label>
            <input class="form-control w-50" type="text" name="goal_name" value="<?php echo $goal['goal_name'] ?>" readonly>
        </div>
        <div class="form-group">
            <label for="goal_creator">Goal creator:</label>
            <input class="form-control w-50" type="text" name="goal_creator" value="<?php echo $goal['username'] ?>" readonly>
        </div>
        <div class="form-group">
            <label for="reason">Reason:</label>
            <textarea class="form-control" name="reason" required></textarea>
        </div>

        <button type="submit" class="btn btn-success" name="report_goal">Submit</button>
    </form>
</div>

<?php
    require "footer.php";
?>
