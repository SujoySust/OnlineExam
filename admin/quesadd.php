<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/inc/header.php');
include 'inc/navbar.php';
include_once ($filepath.'/../classes/exam.php');
$exm = new exam();
?>
<?php
// Session::checkLogin();
?>

<?php
if ($_SERVER['REQUEST_METHOD']=='POST')
{
    $addQue = $exm->addQuestion($_POST);
}
$total =$exm->getTotalRows();
$next = $total+1;

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
                        <td>Choice One</td>
                        <td>:</td>
                        <td><input type="text" name="ans1" placeholder="Enter Choice one .." required></td>

                    </tr>
                    <tr>
                        <td>Choice Two</td>
                        <td>:</td>
                        <td><input type="text" name="ans2" placeholder="Enter Choice Two." required></td>

                    </tr>
                    <tr>
                        <td>Choice Three</td>
                        <td>:</td>
                        <td><input type="text" name="ans3" placeholder="Enter Choice Three .." required></td>

                    </tr>
                    <tr>
                        <td> Choice Four</td>
                        <td>:</td>
                        <td><input type="text" name="ans4" placeholder="Enter Choice Four .." required></td>

                    </tr>
                    <tr>
                        <td>Correct Number</td>
                        <td>:</td>
                        <td><input type="number" name="rightans" required></td>

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