<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?? "NO TITLE" ?> - Northwind</title>
  <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
  <div class="site-wrapper">
    <header class="site-header">
      <h1 class="site-title">Northwind Website</h1>
      <div class="main-nav-container">
        <nav class="main-nav">
          <?php include "_navigation.html.php"; ?>
        </nav>
        <form action="search.php" method="get" class="search">
          <input type="search" name="search" class="search__input" aria-label="Product search">
          <button type="submit" class="search__submit">Search</button>
        </form>
      </div>
      <nav class="category-nav">
        <?php include "_categoryNavigation.html.php" ?>
      </nav>
    </header>
    <main class="main-content">

      <?= $content ?? 'NO CONTENT - $content not defined' ?>

    </main>
    <footer class="site-footer">
      <p class="copyright">Copyright &copy;<?= date('Y') ?> Northwind</p>
    </footer>
  </div>

  
  <!-- 1. Include the jQuery library -->
  <script 
    src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
    crossorigin="anonymous"></script>

  <!-- 2. Include jQuery plugin resources -->
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

  <!-- 3. Include your own custom JS code (that uses the jQuery plugin) -->
  <?= $footerScripts ?? '' ?>
</body>
</html>