<?php

  // Common includes for main PHP pages (controllers)
  require_once "includes/common.php";

  // Config
  $title = "Home";

  // Start output buffering (trap output - don't display it yet)
  ob_start();

  /*
   * Search for products < $20
   */

  // Define SQL query
  // LIMIT 0, 6 means: skip 0 rows (0 offset), only return 6 rows (count)
  $sql = <<<SQL
    SELECT	ProductID, ProductName, UnitPrice, QuantityPerUnit
    FROM	  products
    WHERE   UnitPrice < 20
    LIMIT   0, 6
  SQL;

  // Prepare the statement
  $stmt = $db->prepareStatement($sql);

  // Bind values (if needed)
  // $stmt->bindValue(":categoryId", $categoryId, PDO::PARAM_INT);

  // Execute query (get the list of products under $20)
  $productsUnder20 = $db->executeSQL($stmt);

  /*
   * Search for products > $50
   */

  // Define SQL query
  $sql = <<<SQL
    SELECT	ProductID, ProductName, UnitPrice, QuantityPerUnit
    FROM	  products
    WHERE   UnitPrice > 50
    LIMIT   0, 6
  SQL;

  // Prepare the statement
  $stmt = $db->prepareStatement($sql);

  // Execute query (get the list of products over $50)
  $productsOver50 = $db->executeSQL($stmt);

  // Include the page-specific template
  include_once "templates/_indexPage.html.php";

  // Stop output buffering - store output into the $content variable
  $content = ob_get_clean();

  // Include the main layout template
  include_once "templates/_layout.html.php";