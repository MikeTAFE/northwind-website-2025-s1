<?php

  // Config
  $title = "Home";

  // Start output buffering (trap output - don't display it yet)
  ob_start();

  // Include the page-specific template - change this comment!  🐈
  include_once "templates/_indexPage.html.php";

  // Stop output buffering - store output into the $content variable
  $contentzzz = ob_get_clean();

  // Include the main layout template
  include_once "templates/_layout.html.php";