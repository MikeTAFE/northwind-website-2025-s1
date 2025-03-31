<?php

  // Navigation items
  $navLinks = [
    // "page.php" => "Nav Title",
    "index.php" => "Home",
    "services.php" => "Services",
    "register.php" => "Register",
  ];

  // Get the currently-loaded PHP page/script, e.g. index.php
  $currentPage = basename($_SERVER["SCRIPT_NAME"]);

?>
<ul>
  <!-- <li><a href="index.php">Home</a></li> -->
  <?php foreach ($navLinks as $linkHref => $linkText): ?>
  <?php
    // Check if current page
    // (condition) ? true : false
    $cssClass = $linkHref === $currentPage ? "active" : "";
  ?>
    <li class="<?= $cssClass ?>"><a href="<?= $linkHref ?>"><?= $linkText ?></a></li>
  <?php endforeach ?>
</ul>