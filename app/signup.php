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

                        echo '<div class="alert alert-success" role="alert">
                        Vous êtes désormais inscrits
                      </div>';
                    } else {
                        //? Oubli des else pour les messages d'erreur
                        echo '<div class="alert alert-danger" role="alert">
                        Mots de passes différents
                        </div>';
                    }
                } else {
                    //? Oubli des else pour les messages d'erreur
                    echo '<div class="alert alert-danger" role="alert">
                    Username existe déja
                    </div>';
                }
            } else {
                //? Oubli des else pour les messages d'erreur
                echo '<div class="alert alert-danger" role="alert">
                cette adresse mail existe déja ou n\'est pas dans un format valide
                </div>';
            }
        } else {
            //? Oubli des else pour les messages d'erreur
            echo '<div class="alert alert-warning" role="alert">
            des champs sont vides
            </div>';
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
    <!-- <form action="" method="post">
        <input type="text" name="username" id="form_username" placeholder="username" required>
        <input type="email" name="email" id="form_email" placeholder="mail" required>
        <input type="password" name="password" id="form_password" required>
        <input type="password" name="password2" id="form_password2" required>
        <input type="submit" value="S'inscrire">
    </form> -->

<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        <h1 class="display-4 fw-bold lh-1 mb-3">Sign-up on our todolist !</h1>
        <p class="col-lg-10 fs-4">Front-end Snippet is from Twitter Bootstrap ©. Using PHP to signup via PDO and processing post infos.</p>
      </div>
      <div class="col-md-10 mx-auto col-lg-5">
        <form action="" method="POST" class="p-4 p-md-5 border rounded-3 bg-light">
          <div class="form-floating mb-3">
            <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Your beautiful email address 🌹</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="username" id="floatingInput" placeholder="JohnRambo">
            <label for="floatingInput">A unique username ✨</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">A strong password ! ⛔</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control" name="password2" id="floatingPassword" placeholder="Re-type your password">
            <label for="floatingPassword">Confirm your password (to be sure) ! ⛔</label>
          </div>
          <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up 🖌</button>
          <hr class="my-4">
          <small class="text-muted">By clicking Sign up, you agree to the terms of use.</small>
        </form>
      </div>
    </div>
  </div>