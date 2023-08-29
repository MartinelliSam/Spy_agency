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

  <h1 class="text-center">Liste des contacts</h1>
  <a href="<?= BASE_URL ?>/contact/add" class="btn btn-success btn-lg">Ajouter un contact</a>
  <table class="table table-hover text-center mt-3">
    <thead>
      <tr class="table-secondary">
        <th scope="col">Nom</th>
        <th scope="col">Prénom</th>
        <th scope="col">Date de naissance</th>
        <th scope="col">Nom de code</th>
        <th scope="col">Nationalité</th>
        <th scope="col" colspan="2">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($contacts as $contact) :
        $contact = new Contact(
          $contact['id'],
          $contact['lastName'],
          $contact['firstName'],
          $contact['birthdate'],
          $contact['codeName'],
          $contact['nationality']
        );
      ?>
        <tr>
          <td class="align-middle"><?= $contact->getLastName(); ?></td>
          <td class="align-middle"><?= $contact->getFirstName(); ?></td>
          <td class="align-middle"><?= date('d/m/Y', strtotime($contact->getBirthDate())) ?></td>
          <td class="align-middle"><?= $contact->getCodeName(); ?></td>
          <td class="align-middle"><?= $contact->getNationality(); ?></td>
          <td class="align-middle">
            <form action="<?= BASE_URL ?>/contact/edit" method="POST">
              <button type="submit" class="btn btn-warning btn-sm">Modifier</button>
              <input type="hidden" name="idContact" value="<?= $contact->getId(); ?>">
            </form>
          </td>
          <td class="align-middle">
            <form action="<?= BASE_URL ?>/contact" method="POST" onSubmit="return confirm('Êtes-vous sûr?');">
              <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
              <input type="hidden" name="idContact" value="<?= $contact->getId(); ?>">
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
$title = 'Liste des contacts';
require('views/global/layout.php');
?>