<div class="menu">
    <ul>
        <?php

        $login = Session::get("login");
        if($login == true){
            ?>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="scoreboard.php">Scoreboard</a></li>
            <li><a href="exam.php">Exam</a></li>
            <li><a href="?action=logout">Logout</a></li>
        <?php }else{?>
            <li><a href="index.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
        <?php }?>

    </ul>
    <span style="float: right;color: brown">
                <strong><?php echo Session::get("name");?></strong>
            </span>
</div>