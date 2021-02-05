<?php

header('Content-Type: application/json');

// Connexion à la base de donnée
require_once "database.php";

$data = [];
const APP_USER = 'add_user';

if ($_POST) {
    if(isset($_GET['q'])) {
        if($_GET['q'] === 'add_user') {

            if(!isset($_POST['username']) || empty($_POST['username']) ) {
                return_json(false, 'Username invalid ou vide', $data);
            }

            if(!isset($_POST['password']) || empty($_POST['password']) ) {
                return_json(false, 'Mot de passe invalid ou vide', $data);
            }

            if(strlen($_POST['password']) < 6) {
                return_json(false, 'Mot de passe est inferieur à 6 valeurs', $data);
            }

            if(!isset($_POST['email']) || empty($_POST['email']) ) {
                return_json(false, 'Email invalid', $data);
            }

            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $email = $_POST['email'];
            $d = new DateTime();
            $created = $d->format('Y-m-d H-i-s');

            $stmt = $bdd->prepare('INSERT INTO user (username, password, email, created) VALUES (:username, :password, :email, :created)');
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':created', $created);

            // Execution de la requete SQL
            $query = $stmt->execute();

            if($query === true) {
                $data['error'] = null;
                $data['data'] = [
                    'username' => $username,
                    'password' => $password,
                    'email' => $email,
                    'created' => $created,
                ];

                return_json(true, 'Utilisateur inscrit avec succès', $data);
            } else {
                return_json(false, $stmt->errorInfo(), $data);
            }
        } else {
            return_json(false, 'Votre appel est incorrect !', $data);
        }
    } else {
        return_json(false, 'Votre appel est incorrect !', $data);
    }
}

return_json(false, 'Bad query !', $data);

?>