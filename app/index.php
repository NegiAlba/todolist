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
     }

     $selectStatusReq = 'SELECT * FROM status';
     $selectStatusData = $connection->query($selectStatusReq)->fetchAll();

     $displayTasksReq = "SELECT * FROM task WHERE author_id = '{$user['id']}'";
     $displayTasksData = $connection->query($displayTasksReq)->fetchAll();

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
             echo '<div class="alert alert-success" role="alert"> Tâche insérée </div>';
         } else {
             echo '<div class="alert alert-danger" role="alert"> Une erreur s\'est glissée dans le formulaire </div>';
         }
     }
?>

<div class="container">

<?php

//! MODIF ICI
    if (isset($user)) {
        ?>
			<form class="row gy-2 gx-3 align-items-center" action="" method="POST">
				<div class="col-auto">
					<label class="visually-hidden" for="autoSizingInput">Task</label>
					<input type="text" class="form-control" name="task" id="autoSizingInput" placeholder="Title of your task">
				</div>
				<div class="col-auto">
					<label class="visually-hidden" for="autoSizingInput2">Description</label>
					<input type="text" class="form-control" name="description" id="autoSizingInput2" placeholder="Description for task">
				</div>
				<div class="col-auto">
					<label class="visually-hidden" for="autoSizingSelect">Status</label>
					<select class="form-select" id="autoSizingSelect" name="status">
						<!-- Afficher ici mes status de manière dynamique -->
						<option value='' selected>How is it going ?</option>
						<?php
                            foreach ($selectStatusData as $data) {
                                echo "<option value='{$data['status_id']}'>{$data['label']}</option>";
                            } ?>
					</select>
				</div>
				<div class="col-auto">
					<input type="datetime-local" name="deadline" id="dateInput">
				</div>
				<div class="col-auto">
					<button type="submit" class="btn btn-primary">+</button>
				</div>
			</form>
			<div class="tasks">
				<div class="container">
					<ul>
						<?php
                            foreach ($displayTasksData as $task) {
                                echo "<li>{$task['title']}</li>";
                            } ?>
					</ul>
				</div>
			</div>
		<?php
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