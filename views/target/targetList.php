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

<h1 class="text-center">Liste des cibles</h1>
<a href="<?= BASE_URL ?>/target/add" class="btn btn-success btn-lg">Ajouter une cible</a>
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
        foreach ($targets as $target) :
            $target = new Target ($target['id'], $target['lastName'], $target['firstName'], $target['birthdate'],
                                  $target['codeName'], $target['nationality']);
        ?>
        <tr>
            <td class="align-middle"><?= $target->getlastName(); ?></td>
            <td class="align-middle"><?= $target->getfirstName(); ?></td>
            <td class="align-middle"><?= date('d/m/Y', strtotime($target->getBirthDate()))?></td>
            <td class="align-middle"><?= $target->getCodeName(); ?></td>
            <td class="align-middle"><?= $target->getNationality(); ?></td>
            <td class="align-middle">
            <form action="<?= BASE_URL ?>/target/edit" method="POST">
                <button type="submit" class="btn btn-warning btn-sm">Modifier</button>
                <input type="hidden" name="idTarget" value= "<?= $target->getId(); ?>">
            </td>
            </form>
            <td class="align-middle">
            <form action="<?= BASE_URL ?>/target" method="POST" onSubmit="return confirm('Êtes-vous sûr?');">
                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                <input type="hidden" name="idTarget" value= "<?= $target->getId(); ?>">
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