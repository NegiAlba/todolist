<?php

//Utilisation d'un bloc try-catch pour capturer les erreurs de connexion
try {
    // Connexion à la BDD via PDO
    $connection = new PDO(DB_HOST, DB_USER, DB_PASS);
    // Définition du mode d'erreur sur Exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {
    echo 'Erreur : '.$error->getMessage();
}
