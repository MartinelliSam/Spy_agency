<?php
ob_start();
if (!empty($_SESSION['alert'])) :
?>

  <div class="alert alert-success mt-3" role="alert">
    <?= $_SESSION['alert']['msg'] ?>
  </div>

<?php
  unset($_SESSION['alert']);
endif;
?>

<h1>Bienvenue</h1>
<div class="row justify-content-between">
  <div class="col-md-4">
    <p class="lead">Rechercher une mission</p>
    <form action="<?= BASE_URL ?>/search" method="POST" name="search-form">
      <div class="form-group">
        <label for="name" class="form-label">Rechercher par nom</label>
        <input type="text" name="name" class="form-control" id="mission-name"><br><br>
      </div>
      <div class="form-group">
        <label for="idCountry" class="form-label">Rechercher par pays</label>
        <select class="form-select" id="idCountry" name="idCountry">
          <option value=""></option>
          <?php
          foreach ($countries as $country) :
          ?>
            <option value="<?= $country['id'] ?>" onclick="disableOthers()"><?= $country['name'] ?></option>
          <?php
          endforeach;
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="idAgent" class="form-label mt-5">Rechercher par agent</label>
        <select class="form-select" name="idAgent" id="idAgent">
          <option value=""></option>
          <?php
          foreach ($agents as $agent) :
          ?>
            <option value="<?= $agent['id'] ?>"><?= $agent['firstName'] ?> <?= $agent['lastName'] ?></option>
          <?php
          endforeach;
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="idTarget" class="form-label mt-5">Rechercher par cible</label>
        <select class="form-select" name="idTarget" id="idTarget">
          <option value=""></option>
          <?php
          foreach ($targets as $target) :
          ?>
            <option value="<?= $target['id'] ?>"><?= $target['firstName'] ?> <?= $target['lastName'] ?></option>
          <?php
          endforeach;
          ?>
        </select>
      </div>
      <button type="submit" name="submit" class="btn btn-outline-success mt-5">Lancer la recherche</button>
  </div>

  <div class="col-md-6">
    <p class="lead">Liste des missions</p>
    <div class="accordion" id="accordionExample">
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

        <div class="accordion-item">
          <h3 class="accordion-header" id="headingTwo">
            <button 
              class="accordion-button collapsed" 
              type="button" 
              data-bs-toggle="collapse" 
              data-bs-target="#<?= $mission->getId(); ?>" 
              aria-expanded="false" 
              aria-controls="collapseTwo">
              <?= $mission->getTitle(); ?> (Voir les détails)
            </button>
          </h3>
          <div 
            id="<?= $mission->getId(); ?>" 
            class="accordion-collapse collapse" 
            aria-labelledby="headingTwo" 
            data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <strong><?= $mission->getCodeName(); ?> :</strong>
              <?= $mission->getDescription(); ?>
              <p>Date début : <?= $mission->getBeginsAt(); ?></p>
              <p>Date fin : <?= $mission->getEndsAt(); ?></p>
              <p>Type de mission : <?= $missionType ?></p>
              <p>Statut mission : <?= $missionStatus ?></p>
              <p>Pays : <?= $country ?></p>
              <p>Spécialité requise : <?= $speciality ?></p>
              <strong>Agent(s) :</strong>
              <?php
              $agents = $this->missionManager->showMissionAgents($mission->getId());
              foreach ($agents as $agent) :
              ?>
                <p><?= $agent['firstName'] ?> <?= $agent['lastName'] ?></p>
              <?php
              endforeach;
              ?>
              <strong>Contact(s) :</strong>
              <?php
              $contacts = $this->missionManager->showMissionContacts($mission->getId());
              foreach ($contacts as $contact) :
              ?>
                <p><?= $contact['firstName'] ?> <?= $contact['lastName'] ?>, AKA <?= $contact['codeName'] ?></p>
              <?php
              endforeach;
              ?>
              <strong>Cible(s) :</strong>
              <?php
              $targets = $this->missionManager->showMissionTargets($mission->getId());
              foreach ($targets as $target) :
              ?>
                <p><?= $target['firstName'] ?> <?= $target['lastName'] ?>, AKA <?= $target['codeName'] ?></p>
              <?php
              endforeach;
              ?>
              <strong>Planque(s) :</strong>
              <?php
              $hideouts = $this->missionManager->showMissionHideouts($mission->getId());
              if ($hideouts) {
                foreach ($hideouts as $hideout) :
              ?>
                  <p>Code <?= $hideout['code'] ?> - <?= $hideout['address'] ?> (<?= $hideout['type'] ?>)</p>
                <?php
                endforeach;
              } else {
                ?>
                <p>Pas de planque</p>
              <?php
              }
              ?>

            </div>
          </div>
        </div>
      <?php
      endforeach;
      ?>
    </div>
  </div>
</div>
<?php
$content = ob_get_clean();
$title = 'Site des services secrets';
require('layout.php');
?>