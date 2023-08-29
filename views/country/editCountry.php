<?php 
ob_start(); 
?>

<?php
if (isset($_SESSION['connect']) && $_SESSION['role'] === '["ROLE_ADMIN"]') {
?>
<h1>Modifier un pays</h1>
	<form action="<?= BASE_URL ?>/country/editOk" method="POST">
	<div class="form-group col-md-8">
		<label for="name">Nom du pays</label>
		<input 
				type="text" 
				name="name" 
				value="<?= $_POST['countryName'] ?>" 
				required
		><br><br>
    <input type="hidden" name="id" value= "<?= $_POST['idCountry']?>">
		<button type="submit" class="btn btn-outline-warning">Modifier le pays</button>
		<a href="<?= BASE_URL ?>/country" type="button" class="btn btn-outline-danger">Retour</a>
	</div>
	</form>
<?php
}
?>

<?php 
$content = ob_get_clean(); 
$title = 'Modifier un pays';
require('views/global/layout.php');
?>
