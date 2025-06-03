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
        WHERE   CategoryID = :CategoryId
      SQL;
      $stmt = $this->_db->prepareStatement($sql);
      $stmt->bindValue(":CategoryId", $id, PDO::PARAM_INT);

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

  /**
   * Get the total number of categories (COUNT)
   *
   * @return int The number of categories
   */
  public function getNumberOfCategories(): int
  {
    try {
      // Open database connection
      $this->_db->connect();

      // Define SQL query, prepare statement, bind parameters
      $sql = <<<SQL
        SELECT  COUNT(*)
        FROM    Categories
      SQL;
      $stmt = $this->_db->prepareStatement($sql);

      // Execute SQL
      $value = $this->_db->executeSQLReturnOneValue($stmt);
      return $value;

    } catch (PDOException $ex) {
      throw $ex;
    }
  }

  /**
   * Add a category using values in object's properties
   *
   * @return integer The ID of the new category
   */
  public function insertCategory(): int
  {
    try {

      // NODO: Add validation to make sure data is OK before inserting into database
      
      // Open the database connection
      $this->_db->connect();

      // Define query, prepare statement, bind parameters
      $sql = <<<SQL
        INSERT INTO categories (CategoryName, Description)
        VALUES (:CategoryName, :Description)
      SQL;
      $stmt = $this->_db->prepareStatement($sql);
      $stmt->bindValue(":CategoryName", $this->_categoryName, PDO::PARAM_STR);
      $stmt->bindValue(":Description", $this->_description, PDO::PARAM_STR);

      // Execute query and return new ID
      // true means return the new ID (primary key value)
      return $this->_db->executeNonQuery($stmt, true);

    } catch (Exception $ex) {
      throw $ex;
    }
  }

  /**
   * Update a category using values in object's properties
   *
   * @param integer $id The current ID of the category to update
   * @return bool True if update successful
   */
  public function updateCategory(int $id): bool
  {
    try {

      // NODO: Add validation to make sure data is OK before updating the database
      
      // Open the database connection
      $this->_db->connect();

      // Define query, prepare statement, bind parameters
      $sql = <<<SQL
        UPDATE 	categories
        SET 	  CategoryName = :CategoryName, Description = :Description
        WHERE 	CategoryID = :CategoryID
      SQL;
      $stmt = $this->_db->prepareStatement($sql);
      $stmt->bindValue(":CategoryID", $id, PDO::PARAM_INT);
      $stmt->bindValue(":CategoryName", $this->_categoryName, PDO::PARAM_STR);
      $stmt->bindValue(":Description", $this->_description, PDO::PARAM_STR);

      // Execute query and return success value (true/false)
      return $this->_db->executeNonQuery($stmt);

    } catch (Exception $ex) {
      throw $ex;
    }
  }

  /**
   * Delete a category by ID
   *
   * @param integer $id The ID of the category to delete
   * @return bool True if delete successful
   */
  public function deleteCategory(int $id): bool
  {
    try {
      
      // Open the database connection
      $this->_db->connect();

      // Define query, prepare statement, bind parameters
      $sql = <<<SQL
        DELETE
        FROM 	  categories
        WHERE 	CategoryID = :CategoryID
      SQL;
      $stmt = $this->_db->prepareStatement($sql);
      $stmt->bindValue(":CategoryID", $id, PDO::PARAM_INT);

      // Execute query and return success value (true/false)
      return $this->_db->executeNonQuery($stmt);

    } catch (Exception $ex) {
      throw $ex;
    }
  }

  #endregion

}