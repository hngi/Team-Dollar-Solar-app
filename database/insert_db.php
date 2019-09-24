<?php
require_once('connect_db.php');

$sql = "INSERT INTO electronics (name, volt, amp, watt)
VALUES ('Fidge', 90, 2, 180)";

$conn->exec($sql);
echo "Added item successfully";

?>