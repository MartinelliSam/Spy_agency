<?php 
ob_start(); 
?>

<?php
if(isset($_SESSION['connect']) && $_SESSION['role'] === '["ROLE_ADMIN"]') {
?>

<h1>Ajouter une spécialité</h1>
<form action="<?= BASE_URL ?>/speciality/add" method="POST">
		<div class="form-group col-md-8">
				<label class="form-label" for="name">Nom de la spécialité</label>
				<input 
						type="text" 
						name="name" 
						class="form-control" 
						maxlength="50" 
						required
				><br><br>
		</div>

		<div class="form-group col-md-8">
				<label for="description" class="form-label">Description</label>
				<textarea 
						class="form-control" 
						cols="50" 
						rows="3" 
						name="description" 
						maxlength="500" 
						required
				>
				</textarea><br><br>
		</div>
		<button type="submit" name="speciality" class="btn btn-outline-success mt-3">Ajouter la spécialité</button>
    <a href="<?= BASE_URL ?>/speciality" type="button" class="btn btn-outline-danger mt-3">Retour</a>
</form>

<?php
}
?>

<?php 
$content = ob_get_clean(); 
$title = 'Ajouter une spécialité';
require('views/global/layout.php');
?>
