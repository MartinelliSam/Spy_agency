<?php 
ob_start(); 
?>

<?php
if (isset($_SESSION['connect']) && $_SESSION['role'] === '["ROLE_ADMIN"]') {
?>

<h1>Ajouter une nationalité</h1>
<form action="<?= BASE_URL ?>/nationality/add" method="POST">
		<label for="name">Nom de la nationalité</label>
		<input 
				type="text" 
				name="name" 
				maxlength="50" 
				required
		><br><br>

		<button type="submit" name="nationality" class="btn btn-outline-success">Ajouter la nationalité</button>
		<a href="<?= BASE_URL ?>/hideout" type="button" class="btn btn-outline-danger">Retour</a>
</form>

<?php
}
?>

<?php 
$content = ob_get_clean(); 
$title = 'Ajouter une nationalité';
require('views/global/layout.php');
?>
