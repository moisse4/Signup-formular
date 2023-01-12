<?php

$is_invalid = false;
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $mysqli = require __DIR__ . "/database.php";
    $sql = sprintf( "SELECT * FROM user
            WHERE email = '%s'",
            $mysqli->real_escape_string($_POST["email"]));

    $result =$mysqli->query($sql);
    $user = $result->fetch_assoc();
    if ($user){
        if (password_verify($_POST["password"], $user["password_hash"])){
            session_start();
            session_regenerate_id();
            $_SESSION["user_id"] = $user["id"];
            header("Location: session.php");
            exit;
        }
    }
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>Login</title>
</head>

<body>
    <h1>Login</h1>
    <?php if ($is_invalid): ?>
        <em>Invalid loging</em>
    <?php endif;?>
    <form method="POST">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email"
                value="<?= htmlspecialchars($_POST["email"] ?? " ") ?>">
                

        <label for="password">password</label>
        <input type="password" id="password" name="password">
        <button>Log in</button>
    </form>
</body>
</html>