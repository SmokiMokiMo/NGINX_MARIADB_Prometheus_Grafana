<?php
// Відображає інформацію про PHP
phpinfo();

// Перевіряє з'єднання з MariaDB
$servername = "mariadb";
$username = "test_user";
$password = "test_password";
$dbname = "test_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Перевіряємо з'єднання
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully to database: " . $dbname;

$conn->close();
?>
