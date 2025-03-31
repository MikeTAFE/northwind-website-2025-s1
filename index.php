<?php

  // Config
  $title = "Home";

  // Start output buffering (trap output - don't display it yet)
  ob_start();

  // Include the page-specific template
  include_once "templates/_indexPage.html.php";

  // Stop output buffering - store output into the $content variable
  $content = ob_get_clean();

  // Include the main layout template
  include_once "templates/_layout.html.php";