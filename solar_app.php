<?php 
require 'database/connect_db.php';

$database = new Db();
$connection = $database->connect();
var_dump($connection);
?>