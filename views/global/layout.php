<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/style.css">
    <link rel="stylesheet" href="https://bootswatch.com/5/sketchy/bootstrap.min.css">
    <title><?= $title ?></title>
  </head>
  <body>

      <header>
        <?php require_once 'header.php' ?>
      </header>

      <div class="container">
        <main>
          <?= $content ?>
        </main>

        <footer>
          <?php require_once 'footer.php' ?>
        </footer>
    </div>
    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" 
        crossorigin="anonymous">
    </script>
    <script src="<?= BASE_URL ?>/assets/mission.js" type="text/javascript"></script>
    <script src="<?= BASE_URL ?>/assets/search.js" type="text/javascript"></script>
  </body>
</html>

