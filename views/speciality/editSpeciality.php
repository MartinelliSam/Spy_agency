<?php 
ob_start(); 
?>

<?php
if(isset($_SESSION['connect']) && $_SESSION['role'] === '["ROLE_ADMIN"]') {
?>

<h1>Modifier une spécialité</h1>
	<form action="<?= BASE_URL ?>/speciality/editOk" method="POST">
	<div class="form-group col-md-8">
			<label for="name" class="form-label">Nom de la spécialité</label>
			<input 
					type="text" 
					name="name" 
					value="<?= $_POST['specialityName'] ?>"
					class="form-control"
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
					<?= $speciality['description'] ?>
      </textarea><br><br>
	</div>

    <input type="hidden" name="id" value= "<?= $_POST['idSpeciality']?>">
		<button type="submit" class="btn btn-outline-warning">Modifier la spécialité</button>
		<a href="<?= BASE_URL ?>/speciality" type="button" class="btn btn-outline-danger">Retour</a>

	</form>

<?php
}
?>

<?php 
$content = ob_get_clean(); 
$title = 'Modifier un pays';
require('views/global/layout.php');
?>
