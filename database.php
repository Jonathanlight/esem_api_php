<?php

$data = [];

try{
    $bdd = new PDO('mysql:host=localhost:8889;dbname=cours_cinema', 'root', 'root', 
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
} catch (PDOException $e) {
    return_json(false, 'Echec de la connexion : ' . $e->getMessage());
}

function return_json($success, $msg, $result=null) 
{
    $data['success'] = $success;
    $data['message'] = $msg;
    $data['data'] = $result;

    echo json_encode($data);
    exit;
}