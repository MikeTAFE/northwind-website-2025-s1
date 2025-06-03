<?php

/* 
  
  NOTE: When using this business object in a "real" webpage using user-supplied data:

  1. Get data from the user
  2. Validation (and sanitisation) - in the class or using FormValidator
  3. Image upload logic (if you have images)
  4. Create new object (from business object class)
  5. Assign property values, e.g. $object->setProperty("value")
  6. Insert/update into database
  7. Get new ID (if inserting) and display message to user

 */

// Common includes such as class definitions and constants
require_once "includes/common.php";

try
{

  // Create new object instance (using the constructor)
  $category = new Category();

  // Get a category from the database by its ID (load object properties)
  $category->getCategory(5);

  // $category->setCategoryName("   ");

  // Print category info
  echo <<<HTML
  <p>Name: {$category->getCategoryName()}, Description: {$category->getDescription()}</p>
  HTML;


  /* 
   * TESTING: Adding a new category 
   */

  // // Create new object, add data, insert into datbase
  // $category = new Category();
  // $category->setCategoryName("Added from PHP");
  // $category->setDescription("This is a beautiful description from PHP...");
  // $newCategoryId = $category->insertCategory();

  // echo <<<HTML
  // <p>New category added successfully: {$newCategoryId}</p>
  // HTML;


  /* 
   * TESTING: Updating a category 
   */

  // // Get category from database, change its data, update in the datbase
  // $categoryIdToUpdate = 11;
  // $category = new Category();
  // $category->getCategory($categoryIdToUpdate);
  // // $category->setCategoryName("Edited in PHP");
  // $category->setDescription("This is an updated description from PHP...");
  // $updateSuccess = $category->updateCategory($categoryIdToUpdate);

  // if ($updateSuccess) {
  //   echo <<<HTML
  //   <p>✔ Category updated successfully: {$categoryIdToUpdate}</p>
  //   HTML;
  // } else {
  //   echo <<<HTML
  //   <p>☠ Category update failed: {$categoryIdToUpdate}</p>
  //   HTML;
  // }


  /* 
   * TESTING: Deleting a category 
   */

  // // Get category from database, change its data, update in the datbase
  // $categoryIdToDelete = 9;
  // $category = new Category();
  // $deleteSuccess = $category->deleteCategory($categoryIdToDelete);

  // if ($deleteSuccess) {
  //   echo <<<HTML
  //   <p>✔ Category deleted successfully: {$categoryIdToDelete}</p>
  //   HTML;
  // } else {
  //   echo <<<HTML
  //   <p>☠ Category delete failed: {$categoryIdToDelete}</p>
  //   HTML;
  // }

} catch (Exception $ex) {

  // "Handle" exception
  echo "<p>Catastrophic error: {$ex->getMessage()}</p>";

}