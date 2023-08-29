<?php
ob_start();
?>

<?php
if (isset($_SESSION['connect']) && $_SESSION['role'] === '["ROLE_ADMIN"]') {
?>

    <h1>Modifier un agent</h1>
    <?php
    $agent = $this->agentManager->getAgentById($_POST['idAgent']);
    $agent = new Agent(
        $agent['id'],
        $agent['lastName'],
        $agent['firstName'],
        $agent['birthdate'],
        $agent['identificationCode'],
        $agent['nationality']
    );
    ?>
    <form action="<?= BASE_URL ?>/agent/editOk" method="POST">
        <div class="form-group col-md-8">
            <label for="lastName" class="form-label">Nom</label>
            <input 
                type="text" 
                name="lastName" 
                class="form-control" 
                value="<?= $agent->getLastName(); ?>" 
                required
            ><br><br>
        </div>
        <div class="form-group col-md-8">
            <label for="firstName" class="form-label">Prénom</label>
            <input 
                type="text" 
                name="firstName" 
                class="form-control" 
                value="<?= $agent->getFirstName(); ?>" 
                required
            ><br><br>
        </div>
        <div class="form-group col-md-8">
            <label for="birthdate" class="form-label">Date de naissance</label>
            <input 
                type="date" 
                name="birthdate" 
                class="form-control" 
                value="<?= $agent->getBirthDate(); ?>" 
                required
            ><br><br>
        </div>
        <div class="form-group col-md-8">
            <label for="codeName" class="form-label">Nom de code</label>
            <input 
                type="text" 
                name="identificationCode" 
                class="form-control" 
                value="<?= $agent->getIdentificationCode(); ?>" 
                required
            ><br><br>
        </div>
        <div class="form-group col-md-8">
            <label for="idNationality" class="form-label">Nationalité</label>
            <select class="form-select" name="idNationality">
                <?php
                foreach ($nationalities as $nationality) :
                ?>
                    <option value="<?= $nationality['id'] ?>" required><?= $nationality['name'] ?></option>
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
        <input type="hidden" name="id" value="<?= $agent->getId(); ?>">
        <button type="submit" name="agent" class="btn btn-outline-warning mt-3">Modifier l'agent</button>
        <a href="<?= BASE_URL ?>/agent" type="button" class="btn btn-outline-danger mt-3">Retour</a>
    </form>

<?php
}
?>

<?php
$content = ob_get_clean();
$title = 'Modifier un agent';
require('views/global/layout.php');
?>