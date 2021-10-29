<?php

    function register($email,$username,$password,$password2){
        global $connection;
        
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
                    
                    return $sth->execute();
                }
            } else {
                echo '<div class="alert alert-warning" role="alert">
                Username existe déja
                </div>';
            }
        } else {
            echo '<div class="alert alert-warning" role="alert">
                Email existe déja
            </div>';
        }
    }

    function login($email,$password){
        global $connection;

        //! Shit is getting real : Début de la requête de vérification de l'email
            //? Requete SQL pour répurer la ligne qui correspond à l'email
            $getRowByEmail = "SELECT * FROM user WHERE email = '{$email}'";

            //? Lancement de ma requête
            $getUser = $connection->query($getRowByEmail);

            //? Si ma requête a pu être effectuée, alors crée une variable $userInfos avec les infos
            if ($userInfos = $getUser->fetch()) {

                if (password_verify($password, $userInfos['password'])) {
                    $_SESSION['id'] = $userInfos['id'];
                    $_SESSION['username'] = $userInfos['username'];
                    $_SESSION['email'] = $userInfos['email'];
                    $_SESSION['token'] = uniqid(rand(),true);

                    header('Location:index.php');
                } //! Rajouter messages d'erreur
            }
    }