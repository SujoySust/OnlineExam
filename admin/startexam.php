<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/inc/header.php');
include 'inc/navbar.php';
?>
<?php
// Session::checkLogin();
if(isset($_GET['del'])){

    $update1 = $exm->updateQuestion();
}
if(isset($_GET['fin'])){
    $update2 = $exm->finishExam();
}
?>

    <div class="main">
        <h1>Admin Panel</h1>
        <div class="starttest">
            <?php
            if (isset($update1)){
            ?>
            <h2 style="color: darkgreen"><?php echo $update1; ?></h2>
                <?php }?>

            <?php
            if (isset($update2)){
                ?>
                <h2 style="color: red"><?php echo $update2; ?></h2>
            <?php }?>
            <a href="?del=2"">Start Exam</a>
            <a href="?fin=3"">Finish Exam</a>
        </div>




    </div>
<?php include 'inc/footer.php'; ?>