<?php

  // Common includes for main PHP pages (controllers)
  require_once "includes/common.php";

  // Config
  $title = "Products by category";

  // Start output buffering (trap output - don't display it yet)
  ob_start();


  // Check if category ID has been given
  if (!empty($_GET["id"])) {

    // Get the ID (and sanitise/validate it)
    $categoryId = intval($_GET["id"]);

    // TODO: Redirect if category ID is zero (invalid)

    // Search for category by ID (get its name)
    $sql = <<<SQL
      SELECT  CategoryName
      FROM    categories
      WHERE   CategoryID = :categoryId
    SQL;

    // Prepare the statement
    $stmt = $db->prepareStatement($sql);

    // Bind values (if needed)
    $stmt->bindValue(":categoryId", $categoryId, PDO::PARAM_INT);

    // Get category name from database
    $categoryName = $db->executeSQLReturnOneValue($stmt);

    // Check if category does NOT exist
    if ($categoryName === false) {

      // Display error
      $errorMessage = "Category doesn't exist.";
      include TEMPLATES_DIR . "_error.html.php";

    } else {
      
      // Load the category's products
      $sql = <<<SQL
      SELECT	ProductID, ProductName, UnitPrice, QuantityPerUnit, UnitsInStock
      FROM	  products
      WHERE   CategoryID = :categoryId
      SQL;

      // Prepare the statement
      $stmt = $db->prepareStatement($sql);

      // Bind values (if needed)
      $stmt->bindValue(":categoryId", $categoryId, PDO::PARAM_INT);

      // Get the list of products (for display in template)
      $products = $db->executeSQL($stmt);

      // Include the page-specific template
      include_once TEMPLATES_DIR . "_categoryPage.html.php";

    }

  } else {

    // No category ID given - display error
    $errorMessage = "Invalid category ID: 'id' parameter missing.";
    include TEMPLATES_DIR . "_error.html.php";

  }

  // Stop output buffering - store output into the $content variable
  $content = ob_get_clean();

  // Include the main layout template
  include_once TEMPLATES_DIR . "_layout.html.php";