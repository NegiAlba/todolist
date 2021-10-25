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
?>

<div class="container">
	<form class="row gy-2 gx-3 align-items-center">
	  <div class="col-auto">
		<label class="visually-hidden" for="autoSizingInput">Name</label>
		<input type="text" class="form-control" id="autoSizingInput" placeholder="Jane Doe">
	  </div>
	  <div class="col-auto">
		<label class="visually-hidden" for="autoSizingSelect">Preference</label>
		<select class="form-select" id="autoSizingSelect">
		  <option selected>Choose...</option>
		  <option value="1">One</option>
		  <option value="2">Two</option>
		  <option value="3">Three</option>
		</select>
	  </div>
	  <div class="col-auto">
		<button type="submit" class="btn btn-primary">+</button>
	  </div>
	</form>
</div>