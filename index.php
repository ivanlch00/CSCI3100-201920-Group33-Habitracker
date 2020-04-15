<?php
    require "header.php";
?>


    <main>
        <?php
            if (isset($_SESSION['user_id'])){
                echo '<p>You are logged in! You can access different functions of Habitracker using links at the header. Explore your journey in Habitracker!</p>';
            }
            else {
                echo '<p>You are not logged in! Please log in to use Habitracker.</p>';
            }
        ?>
    </main>

<?php
    require "footer.php";
?>
