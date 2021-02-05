<?php

header('Content-Type: application/json');

// Connexion à la base de donnée
require_once "database.php";

$data = [];

if(isset($_GET['q'])) {
    if($_GET['q'] === 'all') {
        $stmt = $bdd->prepare('SELECT * FROM user');
        $stmt->execute();

        $responses = $stmt->fetchAll();

        $data['data'] = $responses;
        $data['totalItems'] = count($responses);

        return_json(true, 'list users', $data);
    }
}

if(isset($_GET['id'])) {
    if($_GET['id'] !== '') {

        $id = $_GET['id'];

        $stmt = $bdd->prepare('SELECT * FROM user WHERE id=:id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $data['data'] = $stmt->fetch();

        return_json(true, 'find one user', $data);
    }
}


?>