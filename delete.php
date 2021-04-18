<?php

require "config.php";

$get_id = $_GET['id'];
$data = "DELETE FROM city WHERE ID=:id";
$statement = $connection->prepare($data);
$message = "";

if ($statement->execute([":id" => $get_id])) {
  $message = "Delete Successfully";
}
?>

<?php require "header.php" ?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2><a href="index.php" class="btn btn-primary">BACK</a> DELETE</h2>
        </div>

        <div class="card-body">
            <?php if (!empty($message)) { ?>
            <div class="alert alert-success">
                <?= $message ?>
            </div>
            <?php
      } ?>
        </div>
    </div>
</div>



<?php require "footer.php" ?>