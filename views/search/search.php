<?php
ob_start();
?>

<?php
if (empty($missions)) {
?>

<div class="alert alert-danger mt-3" role="error">
    Aucun résultat trouvé
</div>

<?php
}
?>

<div class="row">
  <?php
  foreach ($missions as $mission) :
      $mission = new Mission(
          $mission['id'],
          $mission['title'],
          $mission['description'],
          $mission['codeName'],
          $mission['beginsAt'],
          $mission['endsAt'],
          $mission['missionType'],
          $mission['missionStatus'],
          $mission['country'],
          $mission['speciality']
      );
      $agents = $this->missionManager->showMissionAgents($mission->getId());
      $contacts = $this->missionManager->showMissionContacts($mission->getId());
      $missionType = $mission->getMissionType();
      $missionStatus = $mission->getMissionStatus();
      $country = $mission->getCountry();
      $speciality = $mission->getSpeciality();
      $targets = $this->missionManager->showMissionTargets($mission->getId());
      $hideouts = $this->missionManager->showMissionHideouts($mission->getId());
  ?>
    <div class="col-md-3">
      <div class="card border-dark mb-3 mt-3" style="max-width: 20rem;">
          <div class="card-header"><?= $mission->getTitle(); ?></div>
          <div class="card-body">
              <h4 class="card-title"><?= $mission->getCodeName(); ?></h4>
              <p class="card-text"><?= $mission->getDescription(); ?></p>
              <p class="card-text">Début : <?= date('d/m/Y', strtotime($mission->getBeginsAt())) ?></p>
              <p class="card-text">Fin : <?= date('d/m/Y', strtotime($mission->getEndsAt())) ?></p>
              <p class="card-text">Type : <?= $missionType ?></p>
              <p class="card-text">Status : <?= $missionStatus ?></p>
              <p class="card-text">Pays : <?= $country ?></p>
              <p class="card-text">Spécialité requise : <?= $speciality ?></p>
              <?php
              foreach ($agents as $agent) :
                  $agentNationality = $this->agentManager->showAgentNationality($agent['id']);
              ?>
              <p class="card-text">
                  Agent <?= $agent['lastName'] ?> <?= $agent['firstName'] ?> (<?= $agentNationality ?>)
              </p>
              <?php
              endforeach;
              ?>
              <p class="card-text">Cible(s) : </p>
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

              <p class="card-text">Planque(s) : </p>
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
              <p class="card-text">Contacts : </p>
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
          </div>
        </div>
    </div>
  <?php
  endforeach;
  ?>
</div>
<a href="<?= BASE_URL ?>/" type="button" class="btn btn-danger">Retour</a>

<?php
$content = ob_get_clean();
$title = 'Résultat de la recherche';
require('views/global/layout.php');
?>