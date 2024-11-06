<?php

// Debugging: output environment variable values
echo 'MYSQL_SERVER_NAME: ' . getenv('MYSQL_SERVER_NAME') . '<br>';
echo 'MYSQL_USER: ' . getenv('MYSQL_USER') . '<br>';
echo 'MYSQL_PASSWORD: ' . getenv('MYSQL_PASSWORD') . '<br>';
echo 'MYSQL_DATABASE: ' . getenv('MYSQL_DATABASE') . '<br>';

// Display PHP information
phpinfo();

// Check the connection to MariaDB
$servername = getenv('MYSQL_SERVER_NAME'); 
$username = getenv('MYSQL_USER');
$password = getenv('MYSQL_PASSWORD');
$dbname = getenv('MYSQL_DATABASE');

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully to database: " . $dbname;

$conn->close();
?>