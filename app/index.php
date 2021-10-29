<?php

    require 'includes/header.php';

    /*
     * TODOLIST :
     * TODO INSERT d'un nouvel élément à partir d'un formulaire qui aura un champ prédéfini (status), mais qui peut être variable
     * TODO SELECT des éléments existants dans une liste
     * TODO UPDATE via des champs updatables en temps réel (Ajax ?)
     * TODO DELETE via une croix c'est tout :/
     *
     * Ideas
     * Partage des todo ?
     * Exporter la liste en pdf ?
     */

     //! MODIF ICI
     if (!empty($_SESSION)) {
         $user = $_SESSION;

         $selectStatusReq = 'SELECT * FROM status';
         $selectStatusData = $connection->query($selectStatusReq)->fetchAll();

         //  $displayTasksReq = "SELECT * FROM task WHERE author_id = '{$user['id']}' ORDER BY deadline";
         $displayTasksReq = "SELECT * FROM task INNER JOIN status ON task.status_id = status.status_id WHERE author_id = '{$user['id']}' ORDER BY deadline";
         $displayTasksData = $connection->query($displayTasksReq)->fetchAll();

         //* Si j'ai un seul résultat (une seule ligne dans la table) à récupérer, j'utilise fetch(), sinon j'utilise fetchAll().
         //* SI je souhaite seulement compter le nombre de résultat, je peux faire un fetchColumn().
     }

     if (isset($_GET['s'])) {
         echo '<div class="alert alert-success" role="alert"> Tâche insérée !</div>';
     }

     if (isset($_GET['e'])) {
         echo '<div class="alert alert-danger" role="alert"> Une erreur s\'est glissée dans le formulaire </div>';
     }

     if (isset($_GET['u1'])) {
         echo '<div class="alert alert-warning" role="alert"> Votre tâche n\'a pas pu être mise à jour </div>';
     }

     if (isset($_GET['u2'])) {
         echo '<div class="alert alert-success" role="alert"> Tâche mise à jour ! </div>';
     }

     if (isset($_GET['d1'])) {
         echo '<div class="alert alert-warning" role="alert"> Votre tâche n\'a pas pu être supprimée </div>';
     }

     if (isset($_GET['d2'])) {
         echo '<div class="alert alert-danger" role="alert"> Tâche supprimée </div>';
     }
?>

<div class="container">

<?php

//! MODIF ICI
    if (isset($user)) {
        require 'todolist.php';
    } else {
        ?>
		<div class="p-5 mb-4 bg-light rounded-3">
			<div class="container-fluid py-5">
				<h1 class="display-5 fw-bold">Bienvenue sur todolist 💙🤍❤! </h1>
				<p class="col-md-8 fs-4">Veuillez vous inscrire/connecter pour accéder à votre liste personnelle !</p>
				<a href="signin.php" class="btn btn-primary btn-lg" >Se connecter</a>
				<a href="signup.php" class="btn btn-danger btn-lg" >S'inscrire</a>
			</div>
		</div>
		<?php
    }
?>
</div>