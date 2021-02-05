<?php

header('Content-Type: application/json');

// Connexion à la base de donnée
require_once "database.php";

$data = [
    'username' => 'john',
    'password' => 'azerty'
];

echo json_encode($data);

?>