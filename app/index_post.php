<?php

require 'includes/config.php';

$user = $_SESSION;

//! REQUETE INSERT

//? Je vérifie que le champ task est bien rempli (puisque c'est le seul qui nécessite vraiment un input de l'utilisateur)
if (!empty($_POST['task'])) {
    //? Je déclare des variables qui vont contenir les variables postés assainies
    $task = htmlspecialchars($_POST['task']);
    $description = htmlspecialchars($_POST['description']);

    //  if (empty($_POST['status'])) {
    //      $status = 4;
    //  } else {
    //      $status = htmlspecialchars($_POST['status']);
    //  }

    //? Dans un souci d'ergonomie, je propose un status et une date par défaut à l'utilisateur
    //* Utilisation de conditions ternaires
    $status = empty($_POST['status']) ? 4 : htmlspecialchars($_POST['status']);

    //* Condition ternaire + fonction date sur laquelle j'effectue une opération d'ajout d'heures
    $deadline = empty($_POST['deadline']) ? date('d-m-Y H:i:s', strtotime('+1 day')) : date('Y-m-d H:i:s', strtotime($_POST['deadline']));

    //  $created_at = date('d-m-Y H:i:s');

    //* Je prépare ma requête SQL avec des marqueurs nommés.
    $sqlInsertTask = $connection->prepare('INSERT INTO task (author_id, title, description, deadline, status_id) VALUES (:author_id,:title,:description,:deadline,:status_id)');

    $sqlInsertTask->bindValue(':author_id', intval($user['id']), PDO::PARAM_INT);
    $sqlInsertTask->bindValue(':title', $task, PDO::PARAM_STR);
    $sqlInsertTask->bindValue(':description', $description, PDO::PARAM_STR);
    $sqlInsertTask->bindValue(':deadline', $deadline, PDO::PARAM_STR);
    $sqlInsertTask->bindValue(':status_id', intval($status), PDO::PARAM_INT);

    if ($sqlInsertTask->execute()) {
        header('Location:index.php?s');
    // echo '<div class="alert alert-success" role="alert"> Tâche insérée </div>';
    } else {
        header('Location:index.php?e');
        // echo '<div class="alert alert-danger" role="alert"> Une erreur s\'est glissée dans le formulaire </div>';
    }
}
