<?php

  // Common includes for main PHP pages (controllers)
  require_once "includes/common.php";

  // Config
  $title = "Our Staff";

  // Start output buffering (trap output - don't display it yet)
  ob_start();

  // Get all staff (employees)
  $sql = <<<SQL
    SELECT    EmployeeID, LastName, FirstName, Title, PhotoPath
    FROM      employees
    ORDER BY  LastName ASC
  SQL;

  // Prepare the statement
  $stmt = $db->prepareStatement($sql);

  // Execute query
  $employees = $db->executeSQL($stmt);

  // Include the page-specific template
  include_once "templates/_staffPage.html.php";

  // Stop output buffering - store output into the $content variable
  $content = ob_get_clean();

  // Include the main layout template
  include_once "templates/_layout.html.php";