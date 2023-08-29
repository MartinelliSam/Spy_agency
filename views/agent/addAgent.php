<?php
ob_start();
?>

<?php
if (isset($_SESSION['connect']) && $_SESSION['role'] === '["ROLE_ADMIN"]') {
?>

    <h1>Ajouter un agent</h1>
    <form action="<?= BASE_URL ?>/agent/add" method="POST">
        <div class="form-group col-md-8">
            <label for="lastName" class="form-label">Nom</label>
            <input 
                type="text" 
                name="lastName" 
                maxlength="50" 
                class="form-control" 
                required
            ><br><br>
        </div>
        <div class="form-group col-md-8">
            <label for="firstName" class="form-label">Prénom</label>
            <input 
                type="text" 
                name="firstName" 
                maxlength="50" 
                class="form-control" 
                required
            ><br><br>
        </div>
        <div class="form-group col-md-8">
            <label for="birthdate" class="form-label">Date de naissance</label>
            <input 
                type="date" 
                name="birthdate" 
                class="form-control" 
                required
            ><br><br>
        </div>
        <div class="form-group col-md-8">
            <label for="identificationCode" class="form-label">Code agent</label>
            <input 
                type="number" 
                name="identificationCode" 
                class="form-control" 
                min="001" 
                max="999" 
                required
            ><br><br>
        </div>
        <div class="form-group col-md-8">
            <label for="idNationality" class="form-label">Nationalité</label>
            <select class="form-select" id="idNationality" name="idNationality" required>
                <?php
                foreach ($nationalities as $nationality) :
                ?>
                    <option value="<?= $nationality['id'] ?>"><?= $nationality['name'] ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>

        <div class="form-group col-md-8">
            <fieldset class="form-group">
                <legend class="mt-4">Spécialité(s)</legend>
                <?php
                foreach ($specialities as $speciality) :
                ?>
                    <div class="form-check">
                        <input 
                            class="form-check-input" 
                            type="checkbox" 
                            name="idSpeciality[]" 
                            value="<?= $speciality['id'] ?>"
                        >
                        <label class="form-check-label" for="idSpeciality[]">
                            <?= $speciality['name'] ?> <small>(<?= $speciality['description'] ?>)</small>
                        </label>
                    </div>
                <?php
                endforeach;
                ?>
            </fieldset>
        </div>
        <button type="submit" name="agent" class="btn btn-outline-success mt-3">Ajouter l'agent</button>
        <a href="<?= BASE_URL ?>/agent" type="button" class="btn btn-outline-danger mt-3">Retour</a>
    </form>
<?php
}
?>

<?php
$content = ob_get_clean();
$title = 'Ajouter un agent';
require('views/global/layout.php');
?>