<?php

// Get the Category class definition
require_once "includes/common.php";
require_once CLASSES_DIR . "Category.php";

try
{

  // Create new object instance (using the constructor)
  $category = new Category();

  // Get a category from the database by its ID (load object properties)
  $category->getCategory(123);

  // $category->setCategoryName("   ");

  // Print category info
  echo <<<HTML
  
  <p>Name: {$category->getCategoryName()}, Description: {$category->getDescription()}</p>

  HTML;

} catch (Exception $ex) {

  // "Handle" exception
  echo "<p>Catastrophic error: {$ex->getMessage()}</p>";

}