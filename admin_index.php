<?php
    $title = "Admin Home";
    require "admin_header.php";
?>

    <main>
        <?php
            if (isset($_SESSION['admin_username'])){
                echo '<div class="mx-2"><p>Welcome '.$_SESSION['admin_username'].'</p></div>';
            }
            else {
                echo "<div class='mx-2'><p>You don't have permission to access this page! Please log in as administator.</p><div>";
            }
        ?>
    </main>

<?php
    require "footer.php";
?>
