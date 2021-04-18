<?php

try {
    $connection = new PDO("mysql:host=localhost;dbname=uts192410101093", "192410101093", "secret");
} catch (PDOException $exception) {
    print("DB Error dengan kode" . $exception->getMessage());
}
?>
