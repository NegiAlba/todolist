<?php
    require 'includes/config.php';
    require 'includes/functions.php';
    

    var_dump($_POST);
    //! Quand l'user est connecté
    if (!empty($_SESSION)) {
        $user = $_SESSION;
        // var_dump($_POST);
    
        //! Si j'ai cliqué sur le bouton submit du premier formulaire
        if(isset($_POST['secret_post'])){
            //! Je vérifie si les champs sont bien remplis
            if(!empty($_POST['email']) && !empty($_POST['secret_phrase'])){
                $email = htmlspecialchars($_POST['email']);
                $secret_phrase = htmlspecialchars($_POST['secret_phrase']);
                $password = $_POST['password'];
    
                //! Je vérifie la concordance entre le mot de passe entré et celui de l'utilisateur connecté
                $getPassReq = "SELECT password FROM user WHERE id = '{$user['id']}'";
                $getPassData = $connection->query($getPassReq)->fetch();
    
                if(password_verify($password,$getPassData['password'])){
                    // $updateInfosReq = "UPDATE user SET email = '{$email}', secret_phrase = '{$secret_phrase}' WHERE id = '{$user['id']}'";
                    $updateSth = $connection->prepare("UPDATE user SET email = :email, secret_phrase = :secret_phrase WHERE id = :id");
                    $updateSth->bindValue(':email',$email,PDO::PARAM_STR); 
                    $updateSth->bindValue(':secret_phrase',$secret_phrase,PDO::PARAM_STR);
                    // $updateSth->bindValue(':secret_phrase',$secret_phrase,PDO::PARAM_STR);
                    $updateSth->bindValue(':id',$user['id'],PDO::PARAM_INT);
    
                    //* La différence entre bindValue et bindParam consiste en une différence de timing au niveau de l'assignation des valeurs.
                    //* Alors qu'un bindValue va récupérer la dernière valeur connue de notre variable au moment du bindValue()
                    //* Un bindParam va récupérer la dernière valeur connue au moment de l'execute()
    
                    // $secret_phrase = strtolower($secret_phrase);
                    if($updateSth->execute()){
                        echo "Tout va bien !";
                    }
                }
    
            }
        }
    
        if(isset($_POST['password_post'])){
            //! Je vérifie si les champs sont bien remplis
            if(!empty($_POST['new_password']) && !empty($_POST['secret_phrase_verif'])){
                $secret_phrase = htmlspecialchars($_POST['secret_phrase_verif']);
                $password = $_POST['new_password'];
    
                //! Je vérifie la concordance entre la phrase secrète entrée et celle de l'utilisateur connecté
                $getSecretReq = "SELECT secret_phrase FROM user WHERE id = '{$user['id']}'";
                $getSecretData = $connection->query($getSecretReq)->fetch();
    
                if($getSecretData['secret_phrase'] === $secret_phrase){
                    // $updateInfosReq = "UPDATE user SET email = '{$email}', secret_phrase = '{$secret_phrase}' WHERE id = '{$user['id']}'";
                    $updateSth = $connection->prepare("UPDATE user SET password = :password WHERE id = :id");
    
                    $password = password_hash($password,PASSWORD_DEFAULT);
                    $updateSth->bindValue(':password',$password,PDO::PARAM_STR);
                    $updateSth->bindValue(':id',$user['id'],PDO::PARAM_INT);
    
                    if($updateSth->execute()){
                        echo "Le mot de passe est modifié !";
                    }
                }
            }
        }
    }else{
        //! Pour l'inscription ou la connexion user

        //! Si le bouton submit a été cliqué
        if (isset($_POST['register_post'])) {
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

                //TODO : Execute la fonction register à l'aide des variables ci-dessus

                if(register($email,$username,$password,$password2)){
                echo '<div class="alert alert-success" role="alert">
                Vous êtes désormais inscrits, vous serez redirigés vers la page de connexion
                </div>';
                echo '<meta http-equiv="refresh" content="1.5;URL=signin.php">';
                }

            } else {
                //? Oubli des else pour les messages d'erreur
                echo '<div class="alert alert-warning" role="alert">
                des champs sont vides
                </div>';
            }
            unset($_POST);
        }

        if(isset($_POST['login_post'])){
            var_dump($_POST);
            //! Si tous les champs ont été remplis
            if (!in_array('', $_POST)) {
                //! Assainissement des variables
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);

                login($email,$password);
            } else {
                //? Oubli des else pour les messages d'erreur
                echo '<div class="alert alert-warning" role="alert">
                    des champs sont vides
                    </div>';
            }
            unset($_POST);
        }
    }

    