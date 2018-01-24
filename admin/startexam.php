<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/inc/header.php');
?>
<?php
// Session::checkLogin();
if(isset($_GET['del'])){

    $update = $exm->updateQuestion();
}
if(isset($_GET['fin'])){
    $update = $exm->finishExam();
}
?>

    <div class="main">
        <h1>Admin Panel</h1>
        <div class="starttest">
            <?php
            if (isset($update)){
            ?>
            <h2><?php echo $update; ?></h2>
                <?php }?>
            <a href="?del=2"">Start Exam</a>
            <a href="?fin=3"">Finish Exam</a>
        </div>




    </div>
<?php include 'inc/footer.php'; ?>