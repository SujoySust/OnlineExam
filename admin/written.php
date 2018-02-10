<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include 'inc/navbarwritten.php';
?>
<?php
  // Session::checkLogin();
?>

<?php
if(isset($_GET['del'])){

    $updatewritten = $exm->updateAllWrittenQuestion();
}
if(isset($_GET['fin'])){
    $finishwritten = $exm->finishWrittenExam();
}
?>


<div class="main">
<h1>WRITTEN EXAMINATION CONTROLLER PANEL</h1>

    <h3 style="padding: 2%;border: 1px solid black;background: #000000;">Welcome Teacher to Your Written Examination Controller Panel </h3>

    <?php
    $writtenques = $exm->getWrittenQues();
    if($writtenques == null){
    ?>
        <h3 style="text-align: center;margin: 5%">Written Examination is Finished or Not Started </h3>

        <?php }else{?>
        <h3 style="text-align: center;margin: 5%">Written Examination is Running On .....</h3>

        <?php }?>


    <div class="starttest">
        <?php
        if (isset($updatewritten)){
            ?>
            <h2 style="color: #00ffff"><?php echo $updatewritten; ?></h2>
        <?php }?>

        <?php
        if (isset($finishwritten)){
            ?>
            <h2 style="color: red"><?php echo $finishwritten; ?></h2>
        <?php }?>
        <a href="?del=2"">Start Exam</a>
        <a href="?fin=3"">Finish Exam</a>
    </div>

	
</div>
<?php include 'inc/footer.php'; ?>