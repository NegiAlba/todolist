<?php

require 'includes/config.php';

    //! Si le bouton submit a été cliqué
    if (!empty($_POST)) {
        //! Si tous les champs ont été remplis
        if (!in_array('', $_POST)) {
            //! Assainissement des variables
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            //! Shit is getting real : Début de la requête de vérification de l'email
            //? Requete SQL pour répurer la ligne qui correspond à l'email
            $getRowByEmail = "SELECT * FROM user WHERE email = '{$email}'";

            //? Lancement de ma requête
            $getUser = $connection->query($getRowByEmail);

            //? Si ma requête a pu être effectuée, alors crée une variable $userInfos avec les infos
            if ($userInfos = $getUser->fetch()) {
                echo '<pre>';
                print_r($userInfos);
                echo '</pre>';

                if (password_verify($password, $userInfos['password'])) {
                    $_SESSION['id'] = $userInfos['id'];
                    $_SESSION['username'] = $userInfos['username'];
                    $_SESSION['email'] = $userInfos['email'];

                    header('Location:index.php');
                } //! Rajouter messages d'erreur
            }
        } else {
            //? Oubli des else pour les messages d'erreur
            echo '<div class="alert alert-warning" role="alert">
                des champs sont vides
                </div>';
        }
        unset($_POST);
    }
