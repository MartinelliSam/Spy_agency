<?php
ob_start();
?>

<?php
if (isset($_SESSION['connect']) && $_SESSION['role'] === '["ROLE_ADMIN"]') {
?>

    <h1>Modifier un contact</h1>
    <?php
    $contact = $this->contactManager->getContactById($_POST['idContact']);
    $contact = new Contact(
        $contact['id'],
        $contact['lastName'],
        $contact['firstName'],
        $contact['birthdate'],
        $contact['codeName'],
        $contact['nationality']
    );
    ?>
    <form action="<?= BASE_URL ?>/contact/editOk" method="POST">
        <div class="form-group col-md-8">
            <label for="lastName" class="form-label">Nom</label>
            <input 
                type="text" 
                name="lastName" 
                class="form-control" 
                maxlength="50" 
                value="<?= $contact->getLastName(); ?>" 
                required
            ><br><br>
        </div>
        <div class="form-group col-md-8">
            <label for="firstName" class="form-label">Prénom</label>
            <input 
                type="text" 
                name="firstName" 
                class="form-control" 
                maxlength="50" 
                value="<?= $contact->getFirstName(); ?>" 
                required
            ><br><br>
        </div>
        <div class="form-group col-md-8">
            <label for="birthdate" class="form-label">Date de naissance</label>
            <input 
                type="date" 
                name="birthdate" 
                class="form-control" 
                maxlength="50" 
                value="<?= $contact->getBirthDate(); ?>" 
                required
            ><br><br>
        </div>
        <div class="form-group col-md-8">
            <label for="codeName" class="form-label">Nom de code</label>
            <input 
                type="text" 
                name="codeName" 
                class="form-control" 
                maxlength="50" 
                value="<?= $contact->getCodeName() ?>" 
                required
            ><br><br>
        </div>
        <div class="form-group col-md-8">
            <label for="idNationality" class="form-label">Nationalité</label>
            <select class="form-select" id="idNationality" name="idNationality" required>
                <?php
                foreach ($nationalities as $nationality) :
                ?>
                    <option value="<?= $nationality['id'] ?>"><?= $nationality['name'] ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
        <input type="hidden" name="id" value="<?= $_POST['idContact'] ?>">
        <button type="submit" name="contact" class="btn btn-outline-warning mt-3">Modifier la cible</button>
        <a href="<?= BASE_URL ?>/contact" type="button" class="btn btn-outline-danger mt-3">Retour</a>
    </form>

<?php
}
?>

<?php
$content = ob_get_clean();
$title = 'Modifier un contact';
require('views/global/layout.php');
?>