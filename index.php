<?php
require "config.php";

$data = "SELECT * FROM city";
$statement = $connection->prepare($data);
$statement->execute();
$list_city = $statement->fetchAll(PDO::FETCH_OBJ);

?>

<?php require "header.php" ?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <table>
                <tr>
                    <td>
                        <h1>CITY</h1>
                        <a href="create.php" class="btn btn-primary">CREATE</a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="card-body">
            <table class="table ">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">NO</th>
                        <th scope="col">ID</th>
                        <th scope="col">NAME</th>
                        <th scope="col">COUNTRY CODE</th>
                        <th scope="col">DISTRICT</th>
                        <th scope="col">POPULATION</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count_data = 0;
                    foreach ($list_city as $item) {
                        $count_data += 1;
                    }
                    ?>
                    <?php
                    $limit_data = 20;
                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $first_page = ($page > 1) ? ($page * $limit_data) - $limit_data : 0;

                    $previous = $page - 1;
                    $next = $page + 1;
                    $count_page = ceil($count_data / $limit_data);
                    $data = "SELECT * FROM city ORDER BY id DESC LIMIT $first_page, $limit_data";
                    $statement = $connection->prepare($data);
                    $statement->execute();
                    $list_city = $statement->fetchAll(PDO::FETCH_OBJ);
                    $number = $previous * $limit_data;
                    foreach ($list_city as $item) {
                      $number++;
                    ?>
                    <tr>
                        <th scope="row"><?= $number; ?></th>
                        <td><?= $item->ID; ?></td>
                        <td><?= $item->Name; ?></td>
                        <td><?= $item->CountryCode; ?></td>
                        <td><?= $item->District; ?></td>
                        <td><?= $item->Population; ?></td>
                        <td>
                            <a href="update.php?id=<?= $item->ID;?>" class="btn btn-primary">UPDATE</a>
                            <a href="delete.php?id=<?= $item->ID; ?>" class="btn btn-danger">DELETE</a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div>
            <nav>
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" <?php
                                                if ($page > 1) {
                                                    echo "href='?page=$previous'";
                                                } ?>>Previous</a>
                    </li>
                    <?php
                    $limit_pagination = 10;
                    $y = 1;
                    for ($x = 1; $x <= $count_page; $x++) {
                      if ($y <= $limit_pagination) {
                        $y ++;
                        ?>
                    <li class="page-item"><a class="page-link" href="?page=<?php echo $x ?>"><?php echo $x; ?></a></li>
                    <?php
                      }
                      elseif ($y == 10) {
                        $y = 0;
                        $count_pagination++;
                      }
                    }
                    ?>
                    <li class="page-item">
                        <a class="page-link" <?php if ($page < $count_page ) {
                          echo "href='?page=$next'";
                        } ?>>Next</a>
                    </li>
                </ul>
            </nav>
        </div>

        <?php require "footer.php" ?>