<nav class="navbar navbar-expand-md bg-dark" data-bs-theme="dark">
  <div class="container-fluid">
    <img src="<?= BASE_URL ?>/assets/pictures/logo.png" alt="logo" id="logo"class="navbar-brand">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor02">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link text-light" href="<?= BASE_URL ?>/">Accueil
          </a>
        </li>
        <?php
        if(isset($_SESSION['connect']) && $_SESSION['role'] === '["ROLE_ADMIN"]') {
        ?>
        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_URL ?>/mission">Missions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_URL ?>/agent">Agents</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_URL ?>/target">Cibles</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_URL ?>/hideout">Planques</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_URL ?>/country">Pays</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_URL ?>/nationality">Nationalités</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_URL ?>/contact">Contacts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_URL ?>/speciality">Spécialités</a>
        </li>
        <?php
        }
        ?>
      </ul>
        <?php
        if (!isset($_SESSION['connect'])) { 
        ?>
        <a class="btn btn-secondary my-2 my-sm-0" type="button" href="<?= BASE_URL ?>/login">Se connecter</a>
          <?php
        }
        ?>
                <?php
        if (isset($_SESSION['connect'])) { 
        ?>
        <a class="btn btn-secondary my-2 my-sm-0" type="button" href="<?= BASE_URL ?>/logout">Se déconnecter</a>
          <?php
        }
        ?>
    </div>
  </div>
</nav>