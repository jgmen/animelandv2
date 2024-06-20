<?php
if (!isset($content)) {
    $content = '<p>No content</p>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
  <script src="https://unpkg.com/htmx.org@1.9.12" integrity="sha384-ujb1lZYygJmzgSwoxRggbCHcjc0rB2XoQrxeTUQyRjrOnlCoYta87iKBWq3EsdM2" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <title>Animeland</title>
</head>
<body>


  <header class="navbar hero">
    <nav class="p-5 is-flex is-justify-content-space-between">
      <div> 
        <a href="/anime"><img style="width: 13rem;" src="https://i.ibb.co/9n6yYhm/white.png" alt="white" border="0"></a>
      </div>

    <div class="is-flex">
      <div class="bd-nav-search mx-6">
        <button class="bd-nav-item is-search-desktop is-icon js-burger is-active" data-target="js-search">
          <a href="/search/-">
            <span class="icon">
              <i class="fas fa-search fa-lg"></i>
            </span>
          </a>
        </button>
      </div>

     <div class="mr-6">
        <button class="bd-nav-item is-search-desktop is-icon js-burger is-active">
          <span class="icon">
            <i class="fas fa-user fa-lg"></i>
          </span>
        </button>
      </div>
    </div>

    </nav>

  </header>

      <?php echo $content; ?>

  <footer class="footer">
    <nav> 
      <p>&copy; <?php echo date('Y'); ?> Animeland.</p>
    </nav>
  </footer>
</body>
</html>
