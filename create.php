<?php

require "config.php";
$message = "";
$warning = "";

if (isset($_POST["Name"]) && isset($_POST["CountryCode"]) && isset($_POST["District"]) && isset($_POST["Population"])) {
    $nama = $_POST["Name"];
    $kode = $_POST["CountryCode"];
    $distrik = $_POST["District"];
    $populasi = $_POST["Population"];
    if (strlen($nama) == 0) {
        $warning = "Name can't empty!";
    } elseif (strlen($kode) == 0) {
        $warning = "Country Code can't empty";
    } elseif (strlen($kode) > 3) {
        $warning = "Country Code only 3 character";
    } elseif (strlen($distrik) == 0) {
        $warning = "District can't empty";
    } elseif (strlen($populasi) == 0) {
        $warning = "Population can't empty";
    } elseif (!is_numeric($populasi)) {
        $warning = "Population must number";
    } else {
        $data = "INSERT INTO city(Name, CountryCode, District, Population) VALUES (:Name, :CountryCode, :District, :Population)";
        $statement = $connection->prepare($data);
        if ($statement->execute([":Name" => $nama, ":CountryCode" => $kode, ":District" => $distrik, ":Population" => $populasi])) {
            $message = "New Data Added Successfully";
        };
    }
}
?>
<?php require "header.php" ?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2><a href="index.php" class="btn btn-primary">BACK</a> Create New Data</h2>
        </div>

        <div class="card-body">
            <?php if (!empty($message)) { ?>
            <div class="alert alert-success">
                <?= $message ?>
            </div>
            <?php
            }
            if (!empty($warning)) {
            ?>
            <div class="alert alert-warning">
                <?= $warning ?>
            </div>
            <?php
            }
            ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="Name">NAME</label>
                    <input type="text" name="Name" id="Name" placeholder="Name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="CountryCode">COUNTRY CODE</label>
                    <input type="text" name="CountryCode" id="CountryCode" placeholder="Country Code"
                        class="form-control">
                </div>
                <div class="form-group">
                    <label for="District">DISTRICT</label>
                    <input type="text" name="District" id="District" placeholder="District" class="form-control">
                </div>
                <div class="form-group">
                    <label for="Population">POPULATION</label>
                    <input type="number" name="Population" id="Population" placeholder="123xxx" class="form-control">
                </div>

                <div class="form-group">
                    <button type="reset" class="btn btn-outline-danger">Reset</button>
                    <button type="submit" class="btn btn-outline-success">Create Data</button>
                </div>
            </form>
        </div>
    </div>
</div>



<?php require "footer.php" ?>