<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/inc/header.php');
include 'inc/navbarwritten.php';
include_once ($filepath.'/../classes/exam.php');
$exm = new exam();
?>
<style>
    .adminpanel{width: 480px;color:#fff;margin: 20px auto 0; padding: 10px;border: 1px solid #ddd}
</style>

<?php
if ($_SERVER['REQUEST_METHOD']=='POST')
{
    $addQue = $exm->addWrittenQuestion($_POST);
}
$total =$exm->getTotalWrittenRows();
$next = $total+1;
echo $next;

?>



    <div class="main">
        <h1>Add Question</h1>
        <?php
        if(isset($addQue)){
            echo $addQue;
        }

        ?>

        <div class="adminpanel">
            <form action="" method="post">
                <table>

                    <tr>
                        <td> Question No </td>
                        <td>:</td>
                        <td><input type="number" value="<?php echo $next;?>" name="quesNo"></td>

                    </tr>
                    <tr>
                        <td>Question</td>
                        <td>:</td>
                        <td><input type="text" name="ques" placeholder="Enter Question .." required></td>

                    </tr>

                    <tr>
                        <td>Marks</td>
                        <td>:</td>
                        <td><input type="number" name="marks" required></td>

                    </tr>
                    <tr>
                        <td colspan="3" align="center">
                            <input type="submit"value="Add A Question">

                        </td>
                    </tr>
                </table>

            </form>

        </div>





    </div>
<?php include 'inc/footer.php'; ?>