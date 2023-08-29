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

<h1 class="text-center">Liste des spécialités</h1>
<a href="<?= BASE_URL ?>/speciality/add" class="btn btn-success btn-lg">Ajouter une spécialité</a>
<table class="table table-hover text-center mt-3">
    <thead>
        <tr class="table-secondary">
            <th scope="col">Nom</th>
            <th scope="col">Description</th>
            <th scope="col" colspan="2">Actions</th>
        </tr>
    </thead>
  <tbody>
  <?php 
  foreach ($specialities as $speciality) :
      $speciality = new Speciality($speciality['id'], $speciality['name'], $speciality['description']);
  ?>
      <tr>
          <td class="align-middle"><?= $speciality->getName(); ?></td>
          <td class="align-middle"><?= $speciality->getDescription(); ?></td>
          <td class="align-middle">
              <form action="<?= BASE_URL ?>/speciality/edit" method="POST">
                <div class="d-grid gap-2 col-6 mx-auto">
                    <button type="submit" class="btn btn-warning btn-sm">Modifier</button>
                    <input type="hidden" name="specialityName" value= "<?= $speciality->getName(); ?>">
                    <input type="hidden" name="idSpeciality" value= "<?= $speciality->getId(); ?>">
                </div>
            </form>
          </td>
          <td class="align-middle">
              <form action="<?= BASE_URL ?>/speciality" method="POST" onSubmit="return confirm('Êtes-vous sûr?');">
                  <div class="d-grid gap-2 col-6 mx-auto">
                      <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                      <input type="hidden" name="idSpeciality" value= "<?= $speciality->getId(); ?>">
                  </div>
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
$title = 'Liste des spécialités';
require('views/global/layout.php');
?>