<?php

  // Common includes for main PHP pages (controllers)
  require_once "includes/common.php";

  // Config
  $title = "Home";

  // Start output buffering (trap output - don't display it yet)
  ob_start();

  // Include the page-specific template
  include_once "templates/_aboutPage.html.php";

  // Stop output buffering - store output into the $content variable
  $content = ob_get_clean();

  // Include the main layout template
  include_once "templates/_layout.html.php";