<?php

  // Common includes for main PHP pages (controllers)
  require_once "includes/common.php";

  // Config
  $title = "Product details";

  // Start output buffering (trap output - don't display it yet)
  ob_start();


  // Check if product ID has been given
  if (!empty($_GET["id"])) {

    // Get the ID (and sanitise/validate it)
    $productId = intval($_GET["id"]);

    // TODO: Redirect if product ID is zero (invalid)

    // Search for product by ID
    $sql = <<<SQL
      SELECT	ProductID, ProductName, UnitPrice, QuantityPerUnit, UnitsInStock, categories.CategoryName, suppliers.CompanyName
      FROM	  products
        INNER JOIN categories ON products.CategoryID = categories.CategoryID
        INNER JOIN suppliers ON products.SupplierID = suppliers.SupplierID
      WHERE   ProductID = :productId
    SQL;

    // Prepare the statement
    $stmt = $db->prepareStatement($sql);

    // Bind values (if needed)
    $stmt->bindValue(":productId", $productId, PDO::PARAM_INT);

    // Execute query
    $product = $db->executeSQL($stmt);

    // Check if product does NOT exist (no rows returned)
    if (empty($product)) {

      // Display error
      $errorMessage = "Product doesn't exist.";
      include TEMPLATES_DIR . "_error.html.php";

    } else {
      
      // Extract the first and only row
      $product = $product[0];

      // Include the page-specific template
      include_once TEMPLATES_DIR . "_productPage.html.php";

    }

  } else {

    // No product ID given - display error
    $errorMessage = "Invalid product ID: 'id' parameter missing.";
    include TEMPLATES_DIR . "_error.html.php";

  }

  // Stop output buffering - store output into the $content variable
  $content = ob_get_clean();

  // Include the main layout template
  include_once TEMPLATES_DIR . "_layout.html.php";