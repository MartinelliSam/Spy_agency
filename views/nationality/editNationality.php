<?php 
ob_start(); 
?>

<?php
if (isset($_SESSION['connect']) && $_SESSION['role'] === '["ROLE_ADMIN"]') {
?>

<h1>Modifier une nationalité</h1>
<form action="<?= BASE_URL ?>/nationality/editOk" method="POST">
		<label for="name">Nom</label>
		<input 
				type="text" 
				name="name" 
				value="<?= $_POST['nationalityName'] ?>" 
				required
		><br><br>
    <input type="hidden" value="<?= $_POST['idNationality']?>">
		<button type="submit" class="btn btn-outline-warning">Modifier la nationalité</button>
		<a href="<?= BASE_URL ?>/hideout" type="button" class="btn btn-outline-danger">Retour</a>
</form>
	
<?php
}
?>

<?php 
$content = ob_get_clean(); 
$title = 'Modifier une nationalité';
require('views/global/layout.php');
?>
