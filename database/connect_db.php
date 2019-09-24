<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

//$datatbase = new Db('localhost', 'njoku', 'nuhTMX6z', 'solar_app');
class Db{

    public $servername = null; //= "localhost";
    public $username = null; //= "njoku";
    public $password = null; //= "nuhTMX6z";
    public $database = null; //= "teamdollars";

    public function __construct($servername = 'localhost', $username, $password, $database){
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
  //      echo "Welcome to Db Class";
    }
    public function connect(){

        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=solar_app", $this->username, $this->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
            return $conn;
            }
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
            }


    }

  function create_table(){

      $conn = $this->connect();

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

    }
}

?>
