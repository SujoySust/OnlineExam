<?php include 'inc/header.php'; ?>
<?php include 'inc/navsection.php';?>
<?php

Session::checkSession();
$question = $exm->getQuestion();
$total = $exm->getTotalRows();

?>
    <div class="main">
        <h1>Score Board</h1>
        <div class="starttest">
            <table class="tblone">
                <tr>
                    <th>No</th>
                    <th width="70%">Name</th>
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

                    <td><?php echo $i; ?></td>
                    <td><?php echo $result['name']; ?></td>
                    <td><?php echo $result['score']; ?></td>
                </tr>
                    <?php } }?>
            </table>


        </div>


    </div>
<?php include 'inc/footer.php'; ?>