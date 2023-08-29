<?php
ob_start();
?>
<?php
if (isset($_SESSION['connect']) && $_SESSION['role'] === '["ROLE_ADMIN"]') {
?>
    <h1>Ajouter une planque</h1>
    <form action="<?= BASE_URL ?>/hideout/add" method="POST">
        <div class="form-group col-md-8">
            <label for="code" class="form-label">Code</label>
            <input 
                type="number" 
                name="code" 
                min="0001" 
                max="9999" 
                class="form-control" 
                required
            ><br><br>
        </div>
        <div class="form-group col-md-8">
            <label for="address" class="form-label">Adresse</label>
            <input 
                type="text" 
                name="address" 
                maxlength="100" 
                class="form-control" 
                required
            ><br><br>
        </div>
        <div class="form-group col-md-8">
            <label for="type" class="form-label">Type</label>
            <input 
                type="text" 
                name="type" 
                maxlength="50" 
                class="form-control" 
                required
            ><br><br>
        </div>
        <div class="form-group col-md-8">
            <label for="idCountry" class="form-label">Pays</label>
            <select class="form-select" name="idCountry" required>
            <?php
            foreach ($countries as $country) :
            ?>
                <option value="<?= $country['id'] ?>"><?= $country['name'] ?></option>
            <?php
            endforeach;
            ?>
            </select>
        </div>
        <button type="submit" name="hideout" class="btn btn-outline-success mt-3">Ajouter la planque</button>
        <a href="<?= BASE_URL ?>/hideout" type="button" class="btn btn-outline-danger mt-3">Retour</a>
    </form>

<?php
}
?>

<?php
$content = ob_get_clean();
$title = 'Ajouter une planque';
require('views/global/layout.php');
?>