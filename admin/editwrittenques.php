<?php include 'inc/header.php'; ?>
<?php include 'inc/navbarwritten.php';?>
<?php
//Session::checkSession();
$userId = Session::get("userId");

?>

<?php
if(isset($_GET['edit'])){
    $quesNo = (int)$_GET['edit'];
}
?>

<?php
if ($_SERVER['REQUEST_METHOD']=='POST')
{
    $updateQues=$exm->updateWrittenQuestion ($quesNo,$_POST);
}
?>
    <style>
        .profile{width: 530px;margin: 0 auto;border: 1px solid #3399FF;padding:30px 50px 50px 138px}

    </style>

    <div class="main">
        <h1>Edit Question</h1>


        <div class="profile">
            <?php
            if(isset($updateQues)){
                echo $updateQues;

            }
            ?>
            <form action="" method="post">
                <?php
                $getData= $exm->getQuestionData($quesNo);
                if($getData){
                    $result = $getData->fetch_assoc();
                    ?>
                    <table class="tbl">
                        <tr>
                            <td>Ques No </td>
                            <td style="padding: 1%"><?php echo $result['quesNo'];?></td>
                        </tr>
                        <tr>
                            <td>Question</td>
                            <td><input name="question" type="text" value="<?php echo $result['question'];?>" style="margin: 2%;"></td>
                        </tr>
                        <tr>
                            <td>Marks</td>
                            <td><input name="marks" type="number" value="<?php echo $result['marks'];?>" style="margin: 2%"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" value="Update" style="margin: 2%">
                            </td>
                        </tr>
                    </table>
                <?php }?>
            </form>
        </div>
    </div>
<?php include 'inc/footer.php'; ?>