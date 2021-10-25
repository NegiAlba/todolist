<?php

    require 'includes/header.php';

    //! Si le bouton submit a été cliqué
    if (!empty($_POST)) {
        //! Si tous les champs ont été remplis
        if (!in_array('', $_POST)) {
            //! Assainissement des variables
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
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


<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        <h1 class="display-4 fw-bold lh-1 mb-3">Login on todolist !</h1>
        <p class="col-lg-10 fs-4">Front-end Snippet is from Twitter Bootstrap ©. Using PHP to log in via PDO and processing post infos.</p>
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
          <button class="w-100 btn btn-lg btn-primary" type="submit">Log In 🖌</button>
        </form>
      </div>
    </div>
  </div>