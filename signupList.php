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



dump($_GET);


$templateData = [
    
];


        
include_once 'database.php';
$con = connectdatabase($host, $dbname, $username,$password);

// Fetch the registration data from the database
$registrierungen = fromDatabase($con/*, $_GET["sort"] ,$_GET["order"] */);
//dump($registrierungen);
$templateData['tabledata'] = $registrierungen;
// Pass the registration data to the Twig template



echo $twig->render('signupList.html.twig', $templateData);

