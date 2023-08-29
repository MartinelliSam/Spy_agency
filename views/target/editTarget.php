<?php
ob_start();
?>

<?php
if (isset($_SESSION['connect']) && $_SESSION['role'] === '["ROLE_ADMIN"]') {
?>

<h1>Modifier une cible</h1>
<form action="<?= BASE_URL ?>/target/editOk" method="POST">
    <div class="form-group col-md-8">
        <label for="lastName" class="form-label">Nom</label>
        <input 
            type="text" 
            name="lastName" 
            class="form-control" 
            value="<?= $target['lastName'] ?>" 
            required
        ><br><br>
    </div>
    <div class="form-group col-md-8">
        <label for="firstName" class="form-label">Prénom</label>
        <input 
            type="text" 
            name="firstName" 
            class="form-control"
            value="<?= $target['firstName'] ?>" 
            required
        ><br><br>
    </div>
    <div class="form-group col-md-8">
        <label for="birthdate" class="form-label">Date de naissance</label>
        <input 
            type="date" 
            name="birthdate" 
            class="form-control" 
            value="<?= $target['birthdate'] ?>" 
            required
        ><br><br>
    </div>
    <div class="form-group col-md-8">
        <label for="codeName" class="form-label">Nom de code</label>
        <input 
            type="text" 
            name="codeName" 
            class="form-control" 
            value="<?= $target['codeName'] ?>" 
            required
        ><br><br>
    </div>
    <div class="form-group col-md-8">
        <label for="idNationality" class="form-label">Nationalité</label>
        <select class="form-select" name="idNationality" required>
        <?php
        foreach ($nationalities as $nationality) :
        ?>
            <option value="<?= $nationality['id'] ?>"><?= $nationality['name'] ?></option>
        <?php
        endforeach;
        ?>
        </select>
    </div>
    <input type="hidden" name="id" value="<?= $_POST['idTarget'] ?>">
    <button type="submit" name="target" class="btn btn-outline-warning mt-3">Modifier la cible</button>
    <a href="<?= BASE_URL ?>/target" type="button" class="btn btn-outline-danger mt-3">Retour</a>
</form>

<?php
}
?>

<?php
$content = ob_get_clean();
$title = 'Modifier un pays';
require('views/global/layout.php');
?>