<?php include 'inc/header.php'; ?>
<?php include 'inc/navbar.php';?>
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
    $updateQues=$exm->updateMcqQuestion ($quesNo,$_POST);
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
                $getData= $exm->getMcqQuestion($quesNo);
                $getAns= $exm->getMcqQuestionAns($quesNo);
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
                            <td><input name="question" type="text" value="<?php echo $result['ques'];?>" style="margin: 2%;"></td>
                        </tr>


                            <?php if($getAns){
                                $i = 1;
                               while($option =$getAns->fetch_assoc())
                               {
                            ?>
                            <tr>
                            <td>Option<?php echo $i;?></td>
                            <td><input name="ans<?php echo $i;?>" type="text" value="<?php echo $option['ans'];?>" style="margin: 2%;"></td
                                <td><input type="hidden" name="id<?php echo $i;?>" value="<?php echo $option['id'];?>"></td>
                            </tr>
                            <?php $i++; } }?>

                        <tr>
                            <td>Correct Answer: </td>
                            <td>
                                <select name="taskOption" style="
                                                        width: 38%;
                                                        padding: 1%;
                                                        margin: 2%;
                                                        background: #0092FF;
                                                        color: #ffffff;
                                                        font-size: 16px;
                                                        text-align: center;
                                                    ">
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                    <option value="4">Option 4</option>

                                </select>
                            </td>

                        </tr>
                        <tr>
                            <td><input type="submit" value="Update" style="margin: 2%">
                            </td>
                        </tr>
                    </table>
                <?php }?>
            </form>
        </div>
    </div>
<?php include 'inc/footer.php'; ?>