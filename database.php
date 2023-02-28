<?php
$host = "localhost";
$dbname = "login_db1";
$username = "root";
$password = "";

$mysqli = new mysqli(hostname: $host,
                    username: $username,
                    password: $password,
                    database: $dbname);

if ($mysqli->connect_errno){
    die("Connection error: " . $mysqli->connect_error);
}
return $mysqli;

function fromDatabase() {
    try {
        // Connect to the database
        $pdo = new PDO("mysql:host=localhost;dbname=login_db1", "username");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch the registration data from the database
        $stmt = $pdo->prepare("SELECT * FROM user");
        $stmt->execute();
        $templateData = $stmt->fetchAll();

        // Return the registration data
        return $templateData;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
