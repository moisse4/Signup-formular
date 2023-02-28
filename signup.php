<?php

// Load our autoloader
require_once __DIR__ . '/vendor/autoload.php';

// Specify our Twig templates location
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
// Instantiate our Twig
$twig = new \Twig\Environment($loader, [
    'debug' => true,
    // ...
]);
$function = new Twig\TwigFunction('url', function () { return 'MyURL'; });
    $twig -> addFunction($function);
    
$twig->addExtension(new \Twig\Extension\DebugExtension());






$templateData = [
    'name' => isset($_POST['name']) ? $_POST['name'] : '',
    'nachname' => isset($_POST['nachname']) ? $_POST['nachname'] : '',
    'email' => isset($_POST['email']) ? $_POST['email'] : '',
    'validationErrors' => [],
    'msg' => '',
    'msg_color' => ''
];

// was form data sent?
$isFormPost = false;
if (isset($_POST["action"]) && $_POST["action"] === "register") {
    $isFormPost = true;
}





if ($isFormPost) {
    // validate post form data
    $validationErrors = array();
    if (empty($_POST["name"])) {
        $validationErrors["name"] = 'Please enter your name';
    }
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $validationErrors["email"] = "valid email is required";
    }
    if (strlen($_POST["password"]) < 5) {
        $validationErrors["password"] = "Password must be at least 5 characters";
    }

    
    if (count($validationErrors) > 0) {
        // there were validation errors
            $templateData['validationErrors']=$validationErrors;


        
    } else {

        // data is valid, store in database

        $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $mysqli = require __DIR__ . "/database.php";

        $sql = "INSERT INTO user (name, nachname, email, password_hash) 
                    VALUES (?, ?, ?, ?)";

        $stmt = $mysqli->stmt_init();

        if (!$stmt->prepare($sql)) {
            die("SQL error: " . $mysqli->error);
        }

        $stmt->bind_param(
            "ssss",
            $_POST["name"],
            $_POST["nachname"],
            $_POST["email"],
            $password_hash
        );

        if ($stmt->execute()) {
            $templateData['msg'] = 'Danke für Ihre Registrierung';
            $templateData['msg_color'] = 'green';
            
        }else {
            $templateData['msg'] = 'Ihre Registrierung konnte leider nicht gespeichert werden';
            $templateData['msg_color'] = 'red';
        
        }
    }
    
}

echo $twig->render('signup.html.twig', $templateData);

