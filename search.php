<?php

  // Common includes for main PHP pages (controllers)
  require_once "includes/common.php";

  // Config
  $title = "Search results";

  // Start output buffering
  ob_start();


  // Check if search query has been given
  if (isset($_GET["search"])) {

    // Get the search query
    $search = $_GET["search"];

    
    // Search for products
    $sql = <<<SQL
    SELECT	ProductID, ProductName, UnitPrice, QuantityPerUnit, UnitsInStock
    FROM	  products
    WHERE   ProductName LIKE :search
    SQL;

    // Prepare the statement
    $stmt = $db->prepareStatement($sql);

    // Bind values (if needed)
    $stmt->bindValue(":search", "%$search%", PDO::PARAM_STR);

    // Get the list of products (for display in template)
    $products = $db->executeSQL($stmt);

    // Include the page-specific template
    include_once TEMPLATES_DIR . "_searchPage.html.php";

  } else {

    // No search query given - display error
    $errorMessage = "Please specify a search query: 'search' parameter missing.";
    include TEMPLATES_DIR . "_error.html.php";

  }

  // Stop output buffering - store output into the $content variable
  $content = ob_get_clean();

  // Include the main layout template
  include_once TEMPLATES_DIR . "_layout.html.php";