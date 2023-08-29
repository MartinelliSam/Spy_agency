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
if (isset($_SESSION['connect']) && $_SESSION['role'] === '["ROLE_ADMIN"]') {
?>

  <h1 class="text-center">Liste des agents</h1>

  <a href="<?= BASE_URL ?>/agent/add" class="btn btn-success btn-lg">Ajouter un agent</a>
  <table class="table table-hover text-center mt-3">
      <thead>
          <tr class="table-secondary">
              <th scope="col">Nom</th>
              <th scope="col">Prénom</th>
              <th scope="col">Date de naissance</th>
              <th scope="col">Code agent</th>
              <th scope="col">Nationalité</th>
              <th scope="col">Spécialité</th>
              <th scope="col" colspan="2">Actions</th>
          </tr>
      </thead>
      <tbody>

      <?php
      foreach ($agents as $agent) :
          $agent = new Agent(
              $agent['id'],
              $agent['lastName'],
              $agent['firstName'],
              $agent['birthdate'],
              $agent['identificationCode'],
              $agent['nationality']
          );
          $specialities = $this->agentManager->showAgentSpeciality($agent->getId());
      ?>
          <tr>
            <td class="align-middle"><?= $agent->getlastName(); ?></td>
            <td class="align-middle"><?= $agent->getFirstName(); ?></td>
            <td class="align-middle"><?= date('d/m/Y', strtotime($agent->getBirthDate())); ?></td>
            <td class="align-middle"><?= str_pad($agent->getIdentificationCode(), 3, '0', STR_PAD_LEFT); ?></td>
            <td class="align-middle"><?= $agent->getNationality(); ?>
            <td class="align-middle">
              <?php
              if ($specialities) {
                  foreach ($specialities as $speciality) :
              ?>
                  <p class="text-center mt-3"><?= $speciality ?>
                  </p>
              <?php
                  endforeach;
              } else {
              ?>
              <em>Pas de spécialité</em>
              <?php
              }
              ?>
            </td>
            <td class="align-middle">
                <form action="<?= BASE_URL ?>/agent/edit" method="POST">
                    <button type="submit" class="btn btn-warning btn-sm">Modifier</button>
                    <input type="hidden" name="idAgent" value="<?= $agent->getId(); ?>">
                </form>
            </td>
            <td class="align-middle">
                <form action="<?= BASE_URL ?>/agent" method="POST" onSubmit="return confirm('Êtes-vous sûr?');">
                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    <input type="hidden" name="idAgent" value="<?= $agent->getId(); ?>">
                </form>
            </td>
          </tr>
      <?php
      endforeach;
      ?>
      </tbody>
  </table>

<?php
}
?>

<?php
$content = ob_get_clean();
$title = 'Liste des agents';
require('views/global/layout.php');
?>