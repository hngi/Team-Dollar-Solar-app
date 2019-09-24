<?php
require_once('connect_db.php');

$sql = "CREATE TABLE electronics (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL,
volt VARCHAR(30),
amp VARCHAR(30),
watt VARCHAR(50),
date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

$conn->exec($sql);
echo "Table electronics created successfully";

?>