<?php
ob_start();
?>
<?php
if (isset($_SESSION['connect']) && $_SESSION['role'] === '["ROLE_ADMIN"]') {
?>
		<h1>Ajouter un pays</h1>
		<form action="<?= BASE_URL ?>/country/add" method="POST">
				<div class="form-group col-md-8">
						<label for="name">Nom du pays</label>
						<input 
								type="text" 
								name="name" 
								maxlength="50" 
								required
						><br><br>
				</div>
				<button type="submit" name="country" class="btn btn-outline-success mt-3">Ajouter le pays</button>
				<a href="<?= BASE_URL ?>/country" type="button" class="btn btn-outline-danger mt-3">Retour</a>
		</form>
<?php
}
?>

<?php
$content = ob_get_clean();
$title = 'Ajouter un pays';
require('views/global/layout.php');
?>