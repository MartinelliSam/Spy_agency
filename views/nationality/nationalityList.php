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

<h1 class="text-center">Liste des nationalités</h1>
<a href="<?= BASE_URL ?>/nationality/add" class="btn btn-success btn-lg">Ajouter une nationalité</a>
<table class="table table-hover text-center mt-3">
    <thead>
        <tr class="table-secondary">
            <th scope="col">Nom</th>
            <th scope="col" colspan="2">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach ($nationalities as $nationality) :
        $nationality = new Nationality($nationality['id'], $nationality['name'])
    ?>
        <tr>
            <td class="align-middle"><?= $nationality->getName(); ?></td>
            <td class="align-middle">
                <form action="<?= BASE_URL ?>/nationality/edit" method="POST">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="submit" class="btn btn-warning btn-sm">Modifier</button>
                        <input type="hidden" name="nationalityName" value="<?= $nationality->getName(); ?>">
                        <input type="hidden" name="idNationality" value="<?= $nationality->getId(); ?>">
                    </div>
                </form>
          </td>
          <td class="align-middle">
              <form action="<?= BASE_URL ?>/nationality" method="POST" onSubmit="return confirm('Êtes-vous sûr?');">
                  <div class="d-grid gap-2 col-6 mx-auto">
                      <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                      <input type="hidden" name="idNationality" value="<?= $nationality->getId(); ?>">
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
$title = 'Liste des pays';
require('views/global/layout.php');
?>