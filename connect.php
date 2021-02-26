<?php
$servername = "localhost";
$username = "id16253557_vkdbsp_u";
$password = "xFg7n01Laaa+";
$database = "id16253557_vkdbsp";

try {
    $connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    } catch(PDOException $e) {    
    echo "Connection failed: " . $e->getMessage();
    }
?>