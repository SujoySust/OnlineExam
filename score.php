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
                <tr>

                    <td>1</td>
                    <td>Sujoy Nath</td>
                    <td>5</td>
                </tr>
            </table>


        </div>


    </div>
<?php include 'inc/footer.php'; ?>