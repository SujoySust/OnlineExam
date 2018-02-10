<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/inc/header.php');
include 'inc/navbarwritten.php';
?>
<?php
// Session::checkLogin();
if(isset($_GET['del'])){

    $updatewritten = $exm->updateAllWrittenQuestion();
}
if(isset($_GET['fin'])){
    $finishwritten = $exm->finishWrittenExam();
}
?>

    <div class="main">
        <h1>Admin Panel</h1>
        <div class="starttest">
            <?php
            if (isset($updatewritten)){
            ?>
            <h2 style="color: darkgreen"><?php echo $updatewritten; ?></h2>
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