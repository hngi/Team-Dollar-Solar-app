<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

//echo "How are you";
require_once ('../database/connect_db.php');
?>
<form method="POST" action="install.php">
    <input type="text" name="database" required placeholder="Database Name"><br/>
    <input type="text" name="username" required placeholder="Database Usernmae"><br/>
    <input type="password" name="password" required placeholder="Database Password"><br/>
    <input type="submit" value="Install Now" name="install_now">
</form>

<?php

  if(!isset($_POST['install_now'])){
    echo "Fill Your Database Credentials above";
    exit();
  }



  echo "Hello clicked";
  $username = $_POST['username'];
  $database = $_POST['database'];
  $password = $_POST['password'];

  echo "You entered: $username, $database, $password";
  //Database connection
  $database = new Db($servername = 'localhost', $username, $password, $database);
  $database->create_table();

//$database = new Db();
//$connection = $database->connect();

//var_dump($connection);

?>
