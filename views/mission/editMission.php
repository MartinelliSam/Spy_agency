<?php 
ob_start(); 
?>

<?php
if(isset($_SESSION['connect']) && $_SESSION['role'] === '["ROLE_ADMIN"]') {
?>

<h1>Modifier une mission</h1>
<div class="row">
<div class="alert alert-warning col-md-4 m-1">
  <p class="mb-0">La ou les cibles ne peuvent pas avoir la même nationalité que le ou les agents.</p>
  <p class="mb-0">Les contacts sont obligatoirement de la nationalité du pays de la mission.</p>
  <p class="mb-0">La planque est obligatoirement dans le même pays que la mission.</p>
  <p class="mb-0">Il faut assigner au moins un agent disposant de la spécialité requise.</p>
</div>
<div class="alert alert-warning col-md-4 m-1">
  <p class="mb-0">Une misson peut avoir un ou plusieurs agents.</p>
  <p class="mb-0">Une misson peut avoir un ou plusieurs contacts.</p>
  <p class="mb-0">Une misson peut avoir une ou plusieurs cibles.</p>
  <p class="mb-0">Une misson peut avoir zéro ou plusieurs planques.</p>
</div>
</div>
<?php 

    $mission = $this->missionManager->getMissionById($_POST['idMission']);

    $mission = new Mission ($mission['id'], $mission['title'], $mission['description'], $mission['codeName'], 
                            $mission['beginsAt'], $mission['endsAt'], $mission['missionType'], 
                            $mission['missionStatus'], $mission['missionCountry'], $mission['missionSpeciality']);
?>

	<form action="<?= BASE_URL ?>/mission/editOk" method="POST">
        <div class="form-group col-md-8">
            <label for="title" class="form-label">Nom</label>
            <input 
                type="text" 
                name="title" 
                maxlength="50" 
                class="form-control" 
                value="<?= $mission->getTitle(); ?>" 
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
                    id="description"
                    maxlength="500" 
                    required
                ><?= $mission->getDescription(); ?>
                </textarea><br><br>
        </div>

        <div class="form-group col-md-8">
            <label for="codeName" class="form-label">Nom de code</label>
            <input 
                type="text" 
                name="codeName" 
                maxlength="50" 
                class="form-control" 
                value="<?= $mission->getCodeName(); ?>" 
                required
            ><br><br>
        </div>

        <div class="form-group col-md-8">
            <label for="beginsAt" class="form-label">Date de début</label>
            <input 
                type="date" 
                name="beginsAt" 
                class="form-control begins" 
                value="<?= $mission->getBeginsAt(); ?>" 
                required
            ><br><br>
        </div>  

        <div class="form-group col-md-8">
            <label for="endsAt" class="form-label">Date de fin</label>
            <input 
                type="date" 
                name="endsAt" 
                class="form-control ends" 
                value="<?= $mission->getEndsAt(); ?>" 
                required
            ><br><br>
            <p class="text-danger"></p>
        </div>

        <div class="form-group col-md-8">
            <label for="idMissionType" class="form-label mt-3">Type de mission</label>
            <select class="form-select" name="idMissionType" required>
            <?php 
                foreach ($missionTypes as $missionType) :
            ?>
                <option value="<?= $missionType['id']?>"><?= $missionType['name']?></option>
            <?php
                endforeach;
            ?>
            </select>
        </div>

        <div class="form-group col-md-8">
            <label for="idMissionStatus" class="form-label mt-3">Statut de la mission</label>
            <select class="form-select" name="idMissionStatus" required>
            <?php 
                foreach ($missionStatuses as $missionStatus) :
            ?>
                <option value="<?= $missionStatus['id']?>"><?= $missionStatus['name']?></option>
            <?php
                endforeach;
            ?>
            </select>
        </div>

        <div class="form-group col-md-8">
            <label for="idCountry" class="form-label mt-3">Pays de la mission</label>
            <select class="form-select" name="idCountry" required>
            <?php 
                foreach ($countries as $country) :
            ?>
                <option value="<?= $country['id']?>"><?= $country['name']?></option>
            <?php
                endforeach;
            ?>
            </select>
        </div>

        <div class="form-group col-md-8">
            <label for="idSpeciality" class="form-label mt-3">Spécialité requise</label>
            <select class="form-select" name="idSpeciality" required>
            <?php 
                foreach ($specialities as $speciality) :
            ?>
                <option value="<?= $speciality['id']?>"><?= $speciality['name']?></option>
            <?php
                endforeach;
            ?>
            </select>
        </div>

        <div class="form-group col-md-8">
            <fieldset class="form-group">
                <legend class="mt-4">Agent(s)</legend>
            <?php 
            foreach ($agents as $agent) :
            $agentNationality = $this->agentManager->showAgentNationality($agent['id']);
            ?>
            <div class="form-check">
                <input 
                    class="form-check-input" 
                    type="checkbox" 
                    name="idAgent[]" 
                    value="<?= $agent['id'] ?>" 
                    onclick="enableDisableButton(this, 'a')"
                >
                <label class="form-check-label" for="idAgent[]">
                    <?= $agent['firstName']?> <?= $agent['lastName']?> (<?= $agentNationality?>)
                </label>
            </div>
            <?php
            endforeach;
            ?>
            </fieldset>
        </div>

        <div class="form-group col-md-8">
            <fieldset class="form-group">
                <legend class="mt-4">Contact(s)</legend>
            <?php 
            foreach ($contacts as $contact) :
            $contactNationality = $this->contactManager->showContactNationality($contact['id']);
            ?>
            <div class="form-check">
                <input 
                    class="form-check-input" 
                    type="checkbox" 
                    name="idContact[]" 
                    value="<?= $contact['id'] ?>" 
                    onclick="enableDisableButton(this, 'b')"
                >
                <label class="form-check-label" for="idContact[]">
                    <?= $contact['firstName']?> <?= $contact['lastName']?> (<?= $contactNationality?>)
                </label>
            </div>
            <?php
            endforeach;
            ?>
            </fieldset>
        </div>

        <div class="form-group col-md-8">
            <fieldset class="form-group">
                <legend class="mt-4">Planque(s)</legend>
            <?php 
            foreach ($hideouts as $hideout) :
            ?>
            <div class="form-check">
                <input 
                    class="form-check-input" 
                    type="checkbox" 
                    name="idHideout[]" 
                    value="<?= $hideout['id'] ?>"
                >
                <label class="form-check-label" for="idHideout[]">
                    <?= $hideout['code'] ?> <?= $hideout['address'] ?>, 
                    <?= $hideout['country'] ?> (<?= $hideout['type'] ?>)
                </label>
            </div>
            <?php
            endforeach;
            ?>
            </fieldset>
        </div>

        <div class="form-group col-md-8">
            <fieldset class="form-group">
                <legend class="mt-4">Cible(s)</legend>
            <?php 
            foreach ($targets as $target) :
            ?>
            <div class="form-check">
                <input 
                    class="form-check-input idTarget" 
                    type="checkbox" 
                    name="idTarget[]" 
                    value="<?= $target['id'] ?>" 
                    onclick="enableDisableButton(this, 'c')"
                >
                <label class="form-check-label" for="idTarget[]">
                    <?= $target['lastName'] ?> <?= $target['firstName'] ?> (<?= $target['nationality'] ?>)
                </label>
            </div>
            <?php
            endforeach;
            ?>
            </fieldset>
        </div>

        <input type="hidden" name="id" value="<?= $mission->getId(); ?>">
        <button type="submit" name="mission" class="btn btn-outline-warning mt-3 submit" disabled>
            Modifier la mission
        </button>
        <a href="<?= BASE_URL ?>/mission" type="button" class="btn btn-outline-danger mt-3">Retour</a>
	</form>

<?php
}
?>

<?php 
$content = ob_get_clean(); 
$title = 'Modifier une mission';
require('views/global/layout.php');
?>
