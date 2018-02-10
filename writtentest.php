<?php include 'inc/header.php'; ?>
<?php include 'inc/navsection.php';?>
<?php

Session::checkSession();
$total = $exm->getTotalWrittenRows();

?>
    <div class="main">
        <h1>Welcome to Online Exam</h1>
        <div class="starttest">
            <h2>Test Your Knowledge</h2>
            <ul>

                <li><strong>Number of Question: </strong> <?php echo $total;?></li>
                <li><strong>Question Type: </strong> Written</li>
            </ul>
           <?php
           $userId = Session::get('userId');
           $getscore = $usr->getWrittenScore($userId);
           if($getscore==null){
           ?>
            <a href="writtenexam.php">Start Test</a>
          <?php }else {
               header("Location:writtenfinal.php");

               }
               ?>

        </div>


    </div>
<?php include 'inc/footer.php'; ?>