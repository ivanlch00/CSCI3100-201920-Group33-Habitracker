<?php
    if($_SERVER['REQUEST_METHOD'] == 'PUT'){
        parse_str(file_get_contents("php://input"), $post_vars);
                
        require 'db_key.php';
        $conn = connect_db();
        $sql = "update reports set dismissed = true where report_id = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: admin_index.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "i", $post_vars['report_id']);
            mysqli_stmt_execute($stmt);
            exit();
        }
    }
    else{
        header("Location: ../admin_index.php");
        exit();
    }
?>
