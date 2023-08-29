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

<h1 class="text-center">Liste des planques</h1>
<a href="<?= BASE_URL ?>/hideout/add" class="btn btn-success btn-lg">Ajouter une planque</a>
<table class="table table-hover text-center mt-3">
    <thead>
        <tr class="table-secondary">
            <th scope="col">Code</th>
            <th scope="col">Adresse</th>
            <th scope="col">Type</th>
            <th scope="col">Pays</th>
            <th scope="col" colspan="2">Actions</th>
        </tr>
    </thead>
  <tbody>
  <?php 
  foreach ($hideouts as $hideout) :
      $hideout = new Hideout($hideout['id'], $hideout['code'], $hideout['address'], $hideout['type'], 
                             $hideout['country']);
  ?>
        <tr>
            <td class="align-middle"><?= $hideout->getCode(); ?></td>
            <td class="align-middle"><?= $hideout->getAddress(); ?></td>
            <td class="align-middle"><?= $hideout->getType(); ?></td>
            <td class="align-middle"><?= $hideout->getCountry(); ?></td>
            <td class="align-middle">
            <form action="<?= BASE_URL ?>/hideout/edit" method="POST">
                <button type="submit" class="btn btn-warning btn-sm">Modifier</button>
                <input type="hidden" name="idHideout" value= "<?= $hideout->getId(); ?>">
            </td>
            </form>
            <td class="align-middle">
            <form action="<?= BASE_URL ?>/hideout" method="POST" onSubmit="return confirm('Êtes-vous sûr?');">
                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                <input type="hidden" name="idHideout" value= "<?= $hideout->getId(); ?>">
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
$title = 'Liste des pays';
require('views/global/layout.php');
?>