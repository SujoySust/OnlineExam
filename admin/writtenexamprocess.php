<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/inc/header.php');
Session::checkLogin();
include 'inc/navbarwritten.php'
?>

<?php
if (isset($_GET['id']))
{
    $userId = $_GET['id'];
}
$total = 0;
$question = $exm->getWrittenQues();
$count = $question->num_rows;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    for($i=0;$i<$count;$i++){
        $mark = "marks".$i;
        $total += $_POST[$mark];
        $scoredata = $usr->updateWrittenData($userId, $total);
    }
}

?>

    <div class="main" style="background: #00005C">
        <h1>Student Score List</h1>
        <?php if (isset($scoredata)){?>
        <h3><?php echo $scoredata;?></h3>
      <?php }?>

        <div class="quelist">
            <form method="post" action="">
                <table class="table">
                    <?php

                    $questionans = $exm->getWrittenAns($userId);
                    $i = 0;
                    if($questionans){
                        while ($result=$questionans->fetch_assoc()){

                            ?>
                            <tr>
                                <td style="width: 100%">
                                    <h5>Que <?php echo $result['quesNo'];?>: <?php echo $result['question'];?><strong style="float: right"><?php echo $result['marks'];?></strong></h5>
                                </td>
                                <td style="">
                                    <input type="number" name="marks<?php echo $i;?>" style="font-size: large;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p><?php echo $result['questionAns'];?></p>
                                </td>

                            </tr>

                            <?php $i++; } } ?>
                    <tr >
                        <td style="float: right;width: 0%">
                            <h5>Marks: </h5>
                            <?php if($total){ ?>
                            <h2><?php echo $total?></h2>
                            <?php }?>

                        </td>
                    </tr>
                    <tr >
                        <td style="float: right;width: 0%">
                            <input type="submit" name="submit" value="Total"/>

                        </td>
                    </tr>

                </table>

        </div>

    </div>
<?php include 'inc/footer.php'; ?>