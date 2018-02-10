<div class="menu">
    <ul>
        <?php

        $login = Session::get("login");
        if($login == true){
            ?>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="scoreboard.php">Scoreboard</a></li>
            <li><a href="writtenscoreboard.php">Written Scoreboard</a></li>
            <li><a href="exam.php">Exam</a></li>
            <li><a href="?action=logout">Logout</a></li>
            <span style="float: right;background: #00007C;padding: 10px 20px;"><strong><?php echo Session::get("name");?></strong></span>
        <?php }else{?>
            <li><a href="index.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
        <?php }?>

    </ul>

</div>