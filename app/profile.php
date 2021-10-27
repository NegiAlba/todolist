<?php

    require 'includes/header.php';

     if (!empty($_SESSION)) {
         $user = $_SESSION;

         $userReq = "SELECT * FROM user WHERE id = '{$user['id']}'";
         $userData = $connection->query($userReq)->fetch();

     }
?>

<div class="container">

<?php

//! MODIF ICI
    if (isset($user)) {
    ?>
    <form action="profile_post.php" method="post">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" value="<?= $userData['email'] ?>" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Secret Phrase</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="secret_phrase" rows="3"><?= $userData['secret_phrase'] ?></textarea>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput2" class="form-label">Enter password to validate changes</label>
            <input type="password" class="form-control" name="password" id="exampleFormControlInput2">
        </div>
        <div class="col-12">
            <button class="btn btn-danger" name="secret_post" type="submit">Change infos</button>
        </div>
    </form>
    <hr>
    <form action="profile_post.php" method="post">
        <div class="mb-3">
            <label for="exampleFormControlTextarea2" class="form-label">Enter Secret Phrase</label>
            
            <textarea class="form-control" id="exampleFormControlTextarea2" name="secret_phrase_verif" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput3" class="form-label">Enter new password</label>
            <input type="password" class="form-control" name="new_password" id="exampleFormControlInput3">
        </div>
        <div class="col-12">
            <button class="btn btn-success" name="password_post" type="submit">Change password</button>
        </div>
    </form>
    <?php
    } else {
        ?>
		<div class="p-5 mb-4 bg-light rounded-3">
			<div class="container-fluid py-5">
				<h1 class="display-5 fw-bold">Connectez-vous pour accéder à votre page de profil 💙🤍❤! </h1>
				<p class="col-md-8 fs-4">Veuillez vous inscrire/connecter pour accéder à votre liste personnelle !</p>
				<a href="signin.php" class="btn btn-primary btn-lg" >Se connecter</a>
				<a href="signup.php" class="btn btn-danger btn-lg" >S'inscrire</a>
			</div>
		</div>
		<?php
    }
?>
</div>