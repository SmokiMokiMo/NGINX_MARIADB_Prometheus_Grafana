<?php

// Fetching environment variable values
$mysql_server_name = getenv('MYSQL_SERVER_NAME');
$mysql_user = getenv('MYSQL_USER');
$mysql_password = getenv('MYSQL_PASSWORD');
$mysql_database = getenv('MYSQL_DATABASE');

// Display PHP information
phpinfo();

// Database connection details
$servername = $mysql_server_name; 
$username = $mysql_user;
$password = $mysql_password;
$dbname = $mysql_database;

// Create a connection using MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully to database: " . htmlspecialchars($dbname) . "<br>";

// Create a sample table if it does not exist
$tableSql = "CREATE TABLE IF NOT EXISTS SampleTable (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    value VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($tableSql) === TRUE) {
    echo "Table 'SampleTable' created or already exists.<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Insert sample data into the table (with error check for duplicate data)
$insertSql = "INSERT INTO SampleTable (name, value) VALUES (?, ?)";
$stmt = $conn->prepare($insertSql);

if ($stmt) {
    // Adding some sample data
    $name = 'Example Name';
    $value = 'Example Value';

    $stmt->bind_param("ss", $name, $value);
    if ($stmt->execute()) {
        echo "New record created successfully in 'SampleTable'.<br>";
    } else {
        echo "Error inserting data: " . $stmt->error . "<br>";
    }
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error . "<br>";
}

// Optimized Read Operation with Error Handling
$readSql = "SELECT id, name, value, created_at FROM SampleTable ORDER BY created_at DESC LIMIT 10";
$result = $conn->query($readSql);

if ($result) {
    if ($result->num_rows > 0) {
        echo "<br>Data in 'SampleTable':<br>";
        echo "<table border='1'><tr><th>ID</th><th>Name</th><th>Value</th><th>Created At</th></tr>";
        
        // Using `fetch_assoc()` to iterate over rows
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row["id"]) . "</td>
                    <td>" . htmlspecialchars($row["name"]) . "</td>
                    <td>" . htmlspecialchars($row["value"]) . "</td>
                    <td>" . htmlspecialchars($row["created_at"]) . "</td>
                  </tr>";
        }
        echo "</table><br>";
    } else {
        echo "No data found in 'SampleTable'.<br>";
    }
    $result->free(); // Free result set
} else {
    echo "Error fetching data: " . $conn->error . "<br>";
}

// Close the connection
$conn->close();

?>