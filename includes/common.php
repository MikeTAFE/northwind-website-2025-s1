<?php

  /* Common includes for main PHP pages (controllers) */

  // Define constant that points to the root directory of the website, which helps when including files throughout your code when you don't know what the current directory is
  // ROOT_DIR will point to the "northwind-website" folder
  // INCLUDES_DIR will point to the "northwind-website/includes" folder
  // TEMPLATES_DIR will point to the "northwind-website/templates" folder
  define("ROOT_DIR", __DIR__ . "/../");
  define("INCLUDES_DIR", ROOT_DIR . "includes/");
  define("TEMPLATES_DIR", ROOT_DIR . "templates/");


  // Load Composer's autoloader (created by Composer, not included with PHPMailer)
  require_once ROOT_DIR . "vendor/autoload.php";

  // Include "secrets" that are not tracked by Git
  require_once INCLUDES_DIR . "secrets.php";

  
