<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
     include 'inc/navbar.php';
?>
<?php
  // Session::checkLogin();
?>

<?php
if(isset($_GET['del'])){

    $updatemcq = $exm->updateQuestion();
}
if(isset($_GET['fin'])){
    $finishmcq = $exm->finishExam();
}
?>


<div class="main">
<h1>MCQ EXAMINATION CONTROLLER PANEL </h1>

    <h3 style="padding: 2%;border: 1px solid black;background: #000000;">Welcome Teacher to Your MCQ Examination Controller Panel </h3>

    <?php
    $writtenques = $exm->getAllMcqQues();
    if($writtenques == null){
        ?>
        <h3 style="text-align: center;margin: 5%;color: red">MCQ Examination is Finished or Not Started </h3>

    <?php }else{?>
        <h3 style="text-align: center;margin: 5%">MCQ Examination is Running On .....</h3>

    <?php }?>


    <div class="starttest">
        <?php
        if (isset($updatemcq)){
            ?>
            <h2 style="color: #00ffff"><?php echo $updatemcq; ?></h2>
        <?php }?>

        <?php
        if (isset($finishmcq)){
            ?>
            <h2 style="color: red"><?php echo $finishmcq; ?></h2>
        <?php }?>
        <a href="?del=2"">Start Exam</a>
        <a href="?fin=3"">Finish Exam</a>
    </div>





</div>
<?php include 'inc/footer.php'; ?>