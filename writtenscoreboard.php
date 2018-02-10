<?php include 'inc/header.php'; ?>
<?php include 'inc/navsection.php';?>
<?php

Session::checkSession();
//$question = $exm->getQuestion();
//$total = $exm->getTotalRows();

?>
    <div class="main">
        <h1>Score Board</h1>
        <div class="profile">
            <table class="tblone">
                <tr>
                    <th>No</th>
                    <th width="20%">Reg No</th>
                    <th width="50%">Name</th>
                    <th width="20%">Marks</th>
                </tr>
                <?php

                $scoredata = $usr->getWrittenData();
                if($scoredata){
                    $i=0;
                    while($result = $scoredata->fetch_assoc())
                    {
                        $i++;
                        ?>
                        <tr>

                            <td><?php echo $i; ?></td>
                            <td><?php echo $result['reg']; ?></td>
                            <td><?php echo $result['username']; ?></td>
                            <?php if ($result['status']==0){?>
                            <td>Pending</td>
                            <?php }else{?>
                            <td><?php echo $result['marks']; ?></td>
                            <?php }?>

                        </tr>
                    <?php } }?>
            </table>


        </div>


    </div>
<?php include 'inc/footer.php'; ?>