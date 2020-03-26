<?php
    require "header.php";
?>


    <main>
        <h1>Reset your password</h1>
        <p>An e-mail will be send to you with instructions on how to reset your password.</p>
        <form action="includes/reset-request.inc.php" method="post">
            <input type="text" name="email" placeholder="Enter your e-mail address...">
            <button type="submit" name="reset-request-submit">Receive new password by e-mail</button>
        </form>
        <?php
            if (isset($_GET["reset"])){
                If ($_GET["reset"] == "success"){
                    echo '<p>Check your e-mail</p>';
                }
            }
        ?>
    </main>

<?php
    require "footer.php";
?>