<?php
    require 'includes/config.php';

    var_dump($_POST);

    //! UPDATE REQUEST

    //? Si on appuie sur le bouton edit alors on lance la procédure pour l'édition
    if(isset($_POST['edit_post'])){
        if(!empty($_POST['title'])){
            //? Je déclare des variables qui vont contenir les variables postés assainies
            $title = htmlspecialchars($_POST['title']);
            $description = htmlspecialchars($_POST['description']);
            $status = htmlspecialchars($_POST['status']);
            $updated_at = date('Y-m-d H:i:s');
            $deadline = date('Y-m-d H:i:s', strtotime($_POST['deadline']));
            $id = intval(($_POST['task_id']));


            //? Si l'auteur de la modification, est l'auteur de la tâche alors initialiser la tâche

            $updateSql = "UPDATE task SET title = :title, description = :description, status_id = :status_id, updated_at = :updated_at, deadline = :deadline WHERE task_id=:id";

            $updateReq = $connection->prepare($updateSql);
            $updateReq->bindValue(':title', $title, PDO::PARAM_STR);
            $updateReq->bindValue(':description', $description, PDO::PARAM_STR);
            $updateReq->bindValue(':status_id', $status, PDO::PARAM_INT);
            $updateReq->bindValue(':updated_at', $updated_at, PDO::PARAM_STR);
            $updateReq->bindValue(':deadline', $deadline, PDO::PARAM_STR);
            $updateReq->bindValue(':id', $id, PDO::PARAM_INT);

            if($updateReq->execute()){
                header('Location:index.php?u2');
            }else{
                header('Location:index.php?u1');
            }
        }
    }
?>