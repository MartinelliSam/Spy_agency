<?php
ob_start();
// creating random token
$_SESSION['token'] = bin2hex(random_bytes(32));
?>

<?php 
if(!empty($_SESSION['error'])) :
?>

<div class="alert alert-danger mt-3" role="alert">
    <?= $_SESSION['error']['msg'] ?>
</div>

<?php 
unset($_SESSION['error']);
endif; 
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <form action="<?= BASE_URL . '/login'; ?>" method="POST">
          <fieldset>
              <div class="form-group">
              <label for="email" class="form-label mt-4">Email</label>
              <input 
                type="email" 
                name="email" 
                class="form-control" 
                id="exampleInputEmail1" 
                aria-describedby="emailHelp" 
                placeholder="Entrez votre email" 
                required>
            </div>
            <div class="form-group">
              <label for="password" class="form-label mt-4">Mot de passe</label>
              <input 
                type="password" 
                name="password" 
                class="form-control" 
                id="exampleInputPassword1" 
                placeholder="Entrez votre mot de passe" 
                autocomplete="off" 
                required>
            </div>
            <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
            <button type="submit" class="btn btn-success mt-3">Valider</button>
            <a href="<?= BASE_URL ?>/" type="button" class="btn btn-danger mt-3">Retour</a>
          </fieldset>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
$title = 'Se connecter';
require('views/global/layout.php')
?>