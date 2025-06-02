<?php

class Category
{
  /*
   * Private properties
   */

  private int $_categoryId;
  private string $_categoryName;
  private string $_description;
  private DBAccess $_db;

  /*
   * Constructor - sets up the database connection (using DBAccess)
   */

  public function __construct()
  {
    // Create database connection and store into _db property (so other methods can use DBAccess)
    require INCLUDES_DIR . "database.php";
    $this->_db = $db;
  }

  /*
   * Getter and setter methods
   */

  public function getCategoryId(): int
  {
    return $this->_categoryId;
  }

  public function getCategoryName(): string
  {
    // Return value of private property
    return $this->_categoryName;
  }

  public function setCategoryName(string $categoryName): void
  {
    // Remove spaces
    $value = trim($categoryName);

    // Check string length (between 1 & 15)
    if (strlen($value) < 1 || strlen($value) > 15) {
      
      // Invalid new value - throw an exception
      throw new Exception("Category name must be 1-15 characters.");
    }

    // Store new value in the private property
    $this->_categoryName = $value;
  }

  public function getDescription(): string
  {
    // Return value of private property
    return $this->_description;
  }

  public function setDescription(string $description): void
  {
    // Store new value in the private property
    $this->_description = $description;
  }



  /*
   * Other methods
   */

  public function getCategory(int $id): void
  {
    try {
      
      // Open the database connection
      $this->_db->connect();

      // Define query, prepare statement, bind parameters
      $sql = <<<SQL
        SELECT  CategoryID, CategoryName, Description
        FROM    categories
        WHERE   CategoryID = :categoryId
      SQL;
      $stmt = $this->_db->prepareStatement($sql);
      $stmt->bindValue(":categoryId", $id, PDO::PARAM_INT);

      // Get data from database
      $rows = $this->_db->executeSQL($stmt);

      // Check if data found
      if (count($rows) === 0) {

        // Category not found

        // Option 1: Set default values to properties (stay silent)

        // Option 2: Throw exception (not found)
        throw new Exception("Category with ID '{$id}' not found");

      } else {

        // Category found

        // Get the first (and only) row of data - we are searching using the primary key
        $row = $rows[0];
        
        // Populate properties with data from database
        $this->_categoryId = $row["CategoryID"];
        $this->_categoryName = $row["CategoryName"];
        $this->_description = $row["Description"];

      }

    } catch (Exception $ex) {
      
      // Throw the exception back up a level (don't handle it here - this is not the UI)
      throw $ex;

    }
    
  }

  public function getCategories(): array
  {
    try {
      
      // Open the database connection
      $this->_db->connect();

      // Define query, prepare statement, bind parameters
      $sql = <<<SQL
        SELECT  CategoryID, CategoryName, Description
        FROM    categories
      SQL;
      $stmt = $this->_db->prepareStatement($sql);

      // Get data from database and return all rows
      return $this->_db->executeSQL($stmt);

    } catch (Exception $ex) {
      
      // Throw the exception back up a level (don't handle it here - this is not the UI)
      throw $ex;

    }
    
  }

}