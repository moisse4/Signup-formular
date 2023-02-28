<?php
$host = "localhost";
$dbname = "login_db1";
$username = "root";
$password = "";

/*$mysqli = new mysqli(hostname: $host,
                    username: $username,
                    password: $password,
                    database: $dbname);

if ($mysqli->connect_errno){
    die("Connection error: " . $mysqli->connect_error);
}else{
    return $mysqli;
}
*/

function connectdatabase($host, $dbname, $username,$password){
    
    //global $host, $dbname, $username,$password;
    // Connect to the database
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}
function fromDatabase($pdo, $sort=null, $order=null) {
    $sql = "SELECT * FROM user";
    if ($sort!= null && $order != null){
    $sql = $sql  . " Order by " . $sort . " ". $order;
    
    };
    // SELECT * FROM user order by nachname DESC;
    
    // hadaad haysto 
   // $sql = $sql . "";
   //dump($sort);
   //dump($order);
    //dump($sql );
    //die;
    // Fetch the registration data from the database
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $registrierungen = $stmt->fetchAll();

    // Return the registration data
    return $registrierungen;
}

