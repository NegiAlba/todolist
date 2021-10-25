<?php

    require 'includes/header.php';

    //! Si le bouton submit a été cliqué
    if (!empty($_POST)) {
        // var_dump($_POST);
        // if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password'])){
        //     $email
        // }
        //! Si tous les champs ont été remplis
        if (!in_array('', $_POST)) {
            //! Assainissement des variables
            $email = htmlspecialchars($_POST['email']);
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
            $password2 = htmlspecialchars($_POST['password2']);

            //! Si l'adresse e-mail ou l'username existe déja dans la BDD
            $verifMail = "SELECT * FROM user WHERE email = '{$email}'";
            $resultVerifMail = $connection->query($verifMail)->fetchColumn();
            //! S'il l'adresse n'a pas été utilisée on vérifie l'username
            //? Ajout d'un filtre de validation de l'email
            if (filter_var($email, FILTER_VALIDATE_EMAIL) && !$resultVerifMail) {
                //! S'il l'username n'a pas été utilisé
                $verifUsername = "SELECT * FROM user WHERE username = '{$username}'";
                $resultVerifUsername = $connection->query($verifUsername)->fetchColumn();
                if (!$resultVerifUsername) {
                    //! Si les mots de passes concordent alors on initie l'inscription
                    if ($password === $password2) {
                        $password = password_hash($password, PASSWORD_DEFAULT);
                        //? J'utilise une requête préparée avec des valeurs nommées :nom que je vais définir sur mes variables avec des bindValue afin qu'elles soient verrouillées.
                        $sth = $connection->prepare('INSERT INTO user (username,password,email) VALUES (:username,:password,:email)');

                        $sth->bindValue(':username', $username, PDO::PARAM_STR);
                        $sth->bindValue(':password', $password, PDO::PARAM_STR);
                        $sth->bindValue(':email', $email, PDO::PARAM_STR);

                        $sth->execute();

                        echo 'Tout va bien';
                    } else {
                        //? Oubli des else pour les messages d'erreur
                        echo '<div>Mots de passes différents</div>';
                    }
                } else {
                    //? Oubli des else pour les messages d'erreur
                    echo '<div>username existe</div>';
                }
            } else {
                //? Oubli des else pour les messages d'erreur
                echo '<div>cette adresse mail existe déja ou n\'est pas dans un format valide</div>';
            }
        } else {
            //? Oubli des else pour les messages d'erreur
            echo '<div>Des champs sont vides</div>';
        }
        unset($_POST);
    }

/*
 * ! Etapes logiques de l'inscription
 *
 *  TODO Vérification intro
 *
 *  TODO Initialisation variables ... C'est une étape de confort, mais elle servira pour la suite
 *
 *  TODO Assainissement des variables
 *
 *  TODO Vérification email dans la BDD : Pour que l'email ne soit pas existante
 *
 *  TODO Verification email avec filter_var($email, FILTER_VALIDATE_EMAIL)
 *
 *  TODO Vérification username dans la BDD : Pour que l'username ne soit pas existant
 *
 *  TODO Vérification mdp : Concordance password
 *
 *  TODO Hashage du mdp : Crypter le mot de passe
 *
 *  TODO Enregistrement données utilisateur
 *
 *
 *  TODO Message d'erreur
 */
?>
    <form action="" method="post">
        <input type="text" name="username" id="form_username" placeholder="username" required>
        <input type="email" name="email" id="form_email" placeholder="mail" required>
        <input type="password" name="password" id="form_password" required>
        <input type="password" name="password2" id="form_password2" required>
        <input type="submit" value="S'inscrire">
    </form>