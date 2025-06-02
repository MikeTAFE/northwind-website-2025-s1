<?php

/**
 * Defines a Category (part of the business logic layer)
 */
class Category
{

  #region Properties (private)

  private int $_categoryId;
  private string $_categoryName;
  private string $_description;
  private DBAccess $_db;

  #endregion

  #region Constructor - sets up the database connection (using DBAccess)

  /**
   * Create Category instance with database connection
   */
  public function __construct()
  {
    // Create database connection and store into _db property (so other methods can use DBAccess)
    require INCLUDES_DIR . "database.php";
    $this->_db = $db;
  }

  #endregion
  
  #region Getter and setter methods

  /**
   * Get category ID (there is NO setter for category ID to make it read-only)
   *
   * @return int The category ID
   */
  public function getCategoryId(): int
  {
    return $this->_categoryId;
  }

  /**
   * Get category name
   *
   * @return string The category name
   */
  public function getCategoryName(): string
  {
    // Return value of private property
    return $this->_categoryName;
  }

  /**
   * Set category name
   *
   * @param  string $categoryName The new category name
   * @return void
   */
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

  /**
   * Get category description
   *
   * @return string The category description
   */
  public function getDescription(): string
  {
    // Return value of private property
    return $this->_description;
  }
    
  /**
   * Set description
   *
   * @param  string $description The new description
   * @return void
   */
  public function setDescription(string $description): void
  {
    // Store new value in the private property
    $this->_description = $description;
  }

  #endregion

  #region Methods

  /**
   * Get a category by ID and populate the object's properties
   *
   * @param  int $id The ID of the category to get
   * @return void
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

  /**
   * Get all categories
   *
   * @return array The collection of categories
   */
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

  #endregion

}