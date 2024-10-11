<?php
// Database configuration
$host = "localhost"; // Database host (usually localhost)
$db_name = "Simple_School_Management_System"; //the name of your database
$username = "root"; //your database username
$password = ""; //your database password

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);

    // Set the PDO error mode to exception to handle errors properly
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Optional: Uncomment the line below to confirm connection
    // echo "Connected successfully"; 
}
catch(PDOException $e) {
    // Handle connection error
    echo "Connection failed: " . $e->getMessage();
}
?>