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
  <header class="navbar">
<nav class="p-5">
      <h1 class="title"> 
        <a href="/anime">Animeland</a>
      </h1>
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
