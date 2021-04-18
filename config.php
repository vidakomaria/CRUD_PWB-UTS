<?php

try {
    $connection = new PDO("mysql:host=localhost;dbname=uts192410101093", "root", "");
} catch (PDOException $exception) {
    print("DB Error dengan kode" . $exception->getMessage());
}