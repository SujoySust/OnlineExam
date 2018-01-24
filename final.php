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

Session::checkSession();
$question = $exm->getQuestion();
$total = $exm->getTotalRows();

?>
    <div class="main">
        <h1>You are Done</h1>
        <div class="starttest">
            <p>Congrats! You have just completed the test</p>
            <h2>Your Score : <strong>
                    <?php
                    if(isset($_SESSION['score'])){
                       echo $_SESSION['score'];
                        $userId = Session::get("userId");
                        $reg = Session::get("reg");
                        $name = Session::get("name");
                        $score = $_SESSION['score'];
                        $getscore = $usr->getUserScore($userId);
                       // $result=$getscore->num_rows;

                        if($getscore==null){

                            $usr->userScoreBoard($userId,$reg,$name,$score);
                        }

                       unset($_SESSION['score']);
                    }
                    ?>
                </strong></h2>
            <a href="viewans.php">View Answer</a>
            <a href="scoreboard.php">Score Board</a>

        </div>


    </div>
<?php include 'inc/footer.php'; ?>