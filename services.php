<?php

  // Config
  $title = "Services";

  // Get list of services (e.g. from database)
  $services = [
    // "name" => "description",
    "Snack Attack Relief" => "We deliver snacks faster than your cravings can kick in.",
    "Freezer Filler" => "Stock up so you never have to leave the couch again.",
    "Spice It Up" => "We bring the heat to your kitchen (without setting off the smoke detector).",
    "Midnight Munchies" => "Cravings don't sleep, neither do we.",
    "Guilt-Free Grazing" => "Snacks that taste naughty but are secretly nice.",
    "Hangry Help" => "Curb the hangries with just one click.",
    "Food Coma Facilitators" => "Order now, nap later.",
    "Chef's Shortcuts" => "Skip the chopping and still impress your taste buds.",
    "Tasty Treasure Hunt" => "Explore new flavors without leaving your house.",
    "Snacklebox" => "A surprise box of snacks to satisfy all your cravings.",
  ];

  // Start output buffering
  ob_start();

  // Include the page-specific template
  include_once "templates/_servicesPage.html.php";

  // Stop output buffering
  $content = ob_get_clean();

  // Include the main layout template
  include_once "templates/_layout.html.php";