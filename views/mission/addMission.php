<?php 
ob_start(); 
if (!empty($_SESSION['error'])) :
?>

<div class="alert alert-danger" role="alert">
    <?= $_SESSION['error']['msg'] ?>
</div>

<?php 
unset($_SESSION['error']);
endif; 
?>

<?php
if (isset($_SESSION['connect']) && $_SESSION['role'] === '["ROLE_ADMIN"]') {
?>

<h1>Ajouter une mission</h1>
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

<form action="<?= BASE_URL ?>/mission/add" method="POST">
	<div class="form-group col-md-8">
		<label for="title" class="form-label">Nom de la mission</label>
		<input 
            type="text" 
            name="title" 
            maxlength="50" 
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
        ></textarea><br><br>
	</div>
	<div class="form-group col-md-8">
		<label for="codeName" class="form-label">Nom de code</label>
		<input 
            type="text" 
            name="codeName" 
            maxlength="50" 
            class="form-control" 
            required
        ><br><br>
	</div>
	<div class="form-group col-md-8">
        <label for="beginsAt" class="form-label">Début de la mission</label>
        <input 
            type="date" 
            name="beginsAt" 
            class="form-control begins" 
            required
        ><br><br>
    </div>
	<div class="form-group col-md-8">
        <label for="endsAt" class="form-label">Fin de la mission</label>
        <input 
            type="date" 
            name="endsAt" 
            class="form-control ends" 
            required
        ><br><br>
        <p class="text-danger"></p>
    </div>

	<div class="form-group col-md-8">
        <label for="idMissionType" class="form-label">Type de mission</label>
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
        <label for="idMissionStatus" class="form-label">Statut de la mission</label>
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
          <label for="idCountry" class="form-label">Pays de la mission</label>
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
        <label for="idSpeciality" class="form-label">Spécialité requise</label>
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
            <legend class="mt-4">Agents</legend>
            <?php
            foreach ($agents as $agent) :
                $agentNationality = $this->agentManager->showAgentNationality($agent['id']);
            ?>
            <div class="form-check">
                <input 
                    class="form-check-input idAgent" 
                    type="checkbox" 
                    name="idAgent[]" 
                    value="<?= $agent['id'] ?>" 
                    onclick="checkedAgent(this);" 
                    required
                >
                <label class="form-check-label" for="idAgent[]">
                    <?= $agent['lastName'] ?> <?= $agent['firstName'] ?> (<?= $agentNationality ?>)
                </label>
            </div>
            <?php
            endforeach;
            ?>
        </fieldset>
    </div>

	<div class="form-group col-md-8">
        <fieldset class="form-group">
            <legend class="mt-4">Contact</legend>
            <?php 
            foreach ($contacts as $contact) :
			    $contactNationality = $this->contactManager->showContactNationality($contact['id']);
            ?>
            <div class="form-check">
                <input 
                    class="form-check-input idContact" 
                    type="checkbox" 
                    name="idContact[]" 
                    value="<?= $contact['id'] ?>" 
                    onclick="checkedContact(this);" 
                    required>
                <label class="form-check-label" for="idContact[]">
                    <?= $contact['lastName'] ?> <?= $contact['firstName'] ?> (<?= $contactNationality ?>)
                </label>
            </div>
            <?php
            endforeach;
            ?>
        </fieldset>
    </div>

	<div class="form-group col-md-8">
        <fieldset class="form-group">
            <legend class="mt-4">Planques</legend>
            <?php 
            foreach ($hideouts as $hideout) :
            ?>
                <div class="form-check">
                    <input 
                        class="form-check-input" 
                        type="checkbox" 
                        name="idHideout[]" 
                        value="<?= $hideout['id'] ?>">
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
            <legend class="mt-4">Cibles</legend>
            <?php
            foreach ($targets as $target) :
            ?>
            <div class="form-check">
                <input 
                    class="form-check-input idTarget" 
                    type="checkbox" 
                    name="idTarget[]" 
                    value="<?= $target['id'] ?>" 
                    onclick="checkedTarget(this)" 
                    required>
                <label class="form-check-label" for="idTarget[]">
                    <?= $target['lastName'] ?> <?= $target['firstName'] ?> (<?= $target['nationality'] ?>)
                </label>
            </div>
            <?php
            endforeach;
            ?>
        </fieldset>
    </div>

	<button type="submit" name="nationality" class="btn btn-outline-success submit" disabled>Ajouter la mission</button>
	<a href="<?= BASE_URL ?>/mission" type="button" class="btn btn-outline-danger">Retour</a>
</form>
    
<?php
}
?>

<?php 
$content = ob_get_clean(); 
$title = 'Ajouter une mission';
require('views/global/layout.php');
?>
