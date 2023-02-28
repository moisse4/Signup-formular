
<?php

require_once 'database.php';

// Fetch the registration data from the database
$registrierungen = fromDatabase();

// Pass the registration data to the Twig template
echo $twig->render('table.twig',$templateData);
