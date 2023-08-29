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
  <h1 class="text-center">Liste des pays</h1>
  <a href="<?= BASE_URL ?>/country/add" class="btn btn-success btn-lg">Ajouter un pays</a>
  <table class="table table-hover text-center mt-3">
    <thead>
      <tr class="table-secondary">
        <th scope="col">Nom du pays</th>
        <th scope="col" colspan="2">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($countries as $country) :
        $country = new Country($country['id'], $country['name']);
      ?>
        <tr>
          <td class="align-middle"><?= $country->getName(); ?></td>
          <td class="align-middle">
            <form action="<?= BASE_URL ?>/country/edit" method="POST">
              <div class="d-grid gap-2 col-6 mx-auto">
                <button type="submit" class="btn btn-warning btn-sm">Modifier</button>
                <input type="hidden" name="countryName" value="<?= $country->getName(); ?>">
                <input type="hidden" name="idCountry" value="<?= $country->getId(); ?>">
              </div>
            </form>
          </td>
          <td class="align-middle">
            <form action="<?= BASE_URL ?>/country" method="POST" onSubmit="return confirm('Êtes-vous sûr?');">
              <div class="d-grid gap-2 col-6 mx-auto">
                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                <input type="hidden" name="idCountry" value="<?= $country->getId(); ?>">
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