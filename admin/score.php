<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/inc/header.php');
?>

<?php
if(isset($_GET['del'])){

   $remove =  $usr->resetPastScore();
}
?>

    <div class="main">
        <h1>Previous Score List</h1>
        <div class="starttest">
            <?php
            if (isset($remove)){
            ?>
            <h3><?php echo $remove ;?></h3>
                <?php }?>
            <a onclick="return confirm('Are You Sure to Delete All The Past Result')" href="?del=2">Delete All</a>
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
                $scoredata = $usr->getAllScoreTeacher();
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