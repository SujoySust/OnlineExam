<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/inc/header.php');
include 'inc/navbarwritten.php'
?>

<?php
if(isset($_GET['del'])){

    $scoredata = $usr->getWrittenData();
    if($scoredata){
        while($result = $scoredata->fetch_assoc())
        {
            $userId = $result['userId'];
            $reg =$result['reg'];
            $name = $result['username'];
            $marks = $result['marks'];
            $usr->addToTeacherWrittenScore($userId,$reg, $name,$marks);
            $usr->addToStudentWrittenScore($userId,$reg, $name,$marks);
        }
    }
    $usr->resetWrittenScoreBord();
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
                    <th width="10%">Marks</th>
                    <th width="10%">Action</th>
                </tr>
                <?php
                $scoredata = $usr->getWrittenData();
                if($scoredata){
                    $i=0;
                    while($result = $scoredata->fetch_assoc())
                    {
                        $i++;
                        if($result['status']==0){
                      ?>

                        <tr>
                            <td style="color: red">
                                <?php echo "<span>".$i."</span>";?>

                            </td>

                            <td style="color: red"><?php echo $result['reg'];?></td>
                            <td style="color: red"><?php echo $result['username'];?></td>
                            <td style="color: red">pending</td>
                            <td><a href="writtenexamprocess.php?id=<?php echo $result['userId'];?>" style="text-decoration: none;color: #ffff40">Check</a></td>
                        </tr>
                    <?php }else {?>

                            <tr>
                                <td>
                                    <?php echo "<span>".$i."</span>";?>

                                </td>

                                <td><?php echo $result['reg'];?></td>
                                <td><?php echo $result['username'];?></td>
                                <td><?php echo $result['marks'];?></td>
                                <td><a href="writtenexamprocess.php?id=<?php echo $result['userId'];?>" style="text-decoration: none">ReCheck</a></td>
                            </tr>
                            <?php } } }?>
            </table>

        </div>

    </div>
<?php include 'inc/footer.php'; ?>