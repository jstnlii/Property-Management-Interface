<?php
try {
    $connection = new PDO('mysql:host=localhost;dbname=rentalDB', "root", "");
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>