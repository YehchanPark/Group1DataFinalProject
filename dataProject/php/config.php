<?php
define('USER', 'root'); //config file. Just creating the connection
define('PASSWORD', 'Password');
define('HOST', 'localhost');
define('DATABASE', 'finalProject');
try {
    $connection = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}

?>