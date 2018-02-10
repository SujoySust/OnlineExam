<?php include 'inc/header.php'; ?>
    <div class="menu">
        <ul>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="?action=logout">Logout</a></li>

        </ul>
        <span style="float: right;color: brown">
                <strong><?php echo Session::get("name");?></strong>
            </span>
    </div>
<?php

//Session::checkSession();
//$question = $exm->getQuestion();
//$total = $exm->getTotalRows();

?>
    <div class="main">
        <h1>You are Done</h1>
        <div class="starttest">
            <p>Congrats! You have just completed the test</p>
            <p>You will get your marks to Written Scoreboard page.....</p>
            <a href="writtenscoreboard.php">Score Board</a>

        </div>


    </div>
<?php include 'inc/footer.php'; ?>