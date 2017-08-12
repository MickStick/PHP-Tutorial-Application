<?php
define('DB_SERVER', 'us-cdbr-iron-east-05.cleardb.net');//define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'bd787d6c551941');//define('DB_USERNAME', 'root');
define('DB_PASSWORD', '43ab084c');//define('DB_PASSWORD', '');
define('DB_DATABASE', 'heroku_1df9baf112de306');//define('DB_DATABASE', 'test_php');
$conn = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

if (!$conn){
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>