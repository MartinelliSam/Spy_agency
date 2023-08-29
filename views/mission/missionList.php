<?php 
ob_start(); 
if (!empty($_SESSION['alert'])) :
?>

<div class="alert alert-success" role="alert">
    <?= $_SESSION['alert']['msg'] ?>
</div>

<?php 
unset($_SESSION['alert']);
endif; 
?>

<?php 
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

<div class="row justify-content-center">
    <h1 class="text-center">Liste des missions</h1>
        <div class="col-md-4 text-center">
            <a href="<?= BASE_URL ?>/mission/add" class="btn btn-success btn-lg">Ajouter une mission</a>
        </div>
</div>

<div class="row justify-content-center">
<?php 
foreach ($missions as $mission) :
    $mission = new Mission ($mission['id'], $mission['title'], $mission['description'], $mission['codeName'], 
                            $mission['beginsAt'], $mission['endsAt'], $mission['missionType'], 
                            $mission['missionStatus'], $mission['country'], $mission['speciality']);
    $agents = $this->missionManager->showMissionAgents($mission->getId());
    $contacts = $this->missionManager->showMissionContacts($mission->getId());
    $missionType = $mission->getMissionType();
    $missionStatus = $mission->getMissionStatus();
    $country = $mission->getCountry();
    $speciality = $mission->getSpeciality();
    $targets = $this->missionManager->showMissionTargets($mission->getId());
    $hideouts = $this->missionManager->showMissionHideouts($mission->getId());
?>

<div class="card mb-3 col-md-3 m-3">
    <h3 class="card-header"><?= $mission->getTitle(); ?></h3>
    <div class="card-body">
        <h5 class="card-title"><?= $mission->getCodeName(); ?></h5>
        <p class="card-text"><?= $mission->getDescription(); ?></p>
    </div>

    <div class="card-body">
        <h4 class="card-title">Détails mission</h4>
        <h6 class="card-text">Agent(s) : </h6>
        <?php 
        foreach ($agents as $agent) :
        $agentNationality = $this->agentManager->showAgentNationality($agent['id']);
        ?>  
        <p class="card-text"><?= $agent['lastName'] ?> <?= $agent['firstName'] ?> (<?= $agentNationality ?>)</p>
        <?php
        endforeach;
        ?>
        <h6 class="card-text">Type de mission : </h6>
        <p class="card-text"><?= $missionType; ?></p>
        <h6 class="card-text">Cible(s) : </h6>
        <?php 
        foreach ($targets as $target) :
        ?>  
        <p class="card-text">
            <?= $target['lastName'] ?> <?= $target['firstName'] ?>, 
            AKA <?= $target['codeName'] ?> (<?= $target['nationality'] ?>)
        </p>
        <?php
        endforeach;
        ?>
        <h6 class="card-text">Contact(s) : </h6>
        <?php 
        foreach ($contacts as $contact) :
            $contactNationality = $this->contactManager->showContactNationality($contact['id']);
        ?>  
        <p class="card-text">
            <?= $contact['lastName'] ?> <?= $contact['firstName'] ?>, 
            AKA <?= $contact['codeName'] ?> (<?= $contactNationality ?>)
        </p>
        <?php
        endforeach;
        ?>
        <h6 class="card-text">Spécialité(s) requise(s) : </h6>
        <p class="card-text"><?= $speciality; ?></p>
        <h6 class="card-text">Statut mission : </h6>
        <p class="card-text"><?= $missionStatus; ?></p>
        <h6 class="card-text">Pays : </h6>
        <p class="card-text"><?= $country ?></p>
        <h6 class="card-text">Planque(s) : </h6>
        <?php 
        if (!empty($hideouts)) {
        foreach ($hideouts as $hideout) :
        ?>  
        <p class="card-text">
            - n° <?= $hideout['code'] ?>, <?= $hideout['type'] ?>, 
            <?= $hideout['address'] ?> (<?= $hideout['country'] ?>)
        </p>
        <?php
        endforeach;
        } else {
        ?>
        <p class="card-text">Pas de planque</p>
        <?php
        }
        ?>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">Début de la mission : <?= date('d/m/Y', strtotime($mission->getBeginsAt()))?></li>
        <li class="list-group-item">Fin de la mission : <?= date('d/m/Y', strtotime($mission->getEndsAt()))?></li>
    </ul>

    <form action="<?= BASE_URL ?>/mission/edit" method="POST">
        <div class="d-grid gap-2 mx-auto">
            <button type="submit" class="d-block btn btn-warning mt-3">Modifier</button>
            <input type="hidden" name="idMission" value= "<?= $mission->getId(); ?>">
        </div>
    </form>

    <form action="<?= BASE_URL ?>/mission" method="POST" onSubmit="return confirm('Êtes-vous sûr?');">
        <div class="d-grid gap-2 mx-auto">
            <button type="submit" class="d-block btn btn-danger mt-2 mb-2">Supprimer</button>
            <input type="hidden" name="idMission" value= "<?= $mission->getId(); ?>">
        </div>
    </form>
</div>
<?php
endforeach;
?>
</div>

<?php
}
?>

<?php 
$content = ob_get_clean(); 
$title = 'Liste des missions';
require('views/global/layout.php');
?>