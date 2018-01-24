<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/inc/header.php');
?>

<?php
if(isset($_GET['del'])){

    $scoredata = $usr->getAllScore();
    if($scoredata){
        while($result = $scoredata->fetch_assoc())
        {
            $userId = $result['userId'];
            $reg =$result['reg'];
            $name = $result['name'];
            $score = $result['score'];
            $usr->addToTeacherScore($userId,$reg, $name,$score);
            $usr->addToStudentScore($userId,$reg, $name,$score);
        }
    }
    $usr->resetScoreBord();
}
?>

    <div class="main">
        <h1>Student Score List</h1>
        <div class="starttest">
            <a href="?del=2"">Reset ScoreBoard</a>
        </div>


        <div class="quelist">
            <table class="tblone">
                <tr>
                    <th>No</th>
                    <th width="20%">Reg No</th>
                    <th width="50%">Name</th>
                    <th width="20%">Score</th>
                </tr>
                <?php
                $scoredata = $usr->getAllScore();
                if($scoredata){
                    $i=0;
                    while($result = $scoredata->fetch_assoc())
                    {
                        $i++;
                      ?>
                        <tr>
                            <td>
                                <?php echo "<span>".$i."</span>";?>

                            </td>

                            <td><?php echo $result['reg'];?></td>
                            <td><?php echo $result['name'];?></td>
                            <td><?php echo $result['score'];?></td>
                        </tr>
                    <?php } }?>
            </table>

        </div>

    </div>
<?php include 'inc/footer.php'; ?>