<?php

/**
 * Defines a Product
 * NOTE: THIS IS ONLY A PARTIAL IMPLEMENTATION - NO INSERT, UPDATE, DELETE, ETC
 */
class Product
{
  
  #region Properties (private)

  private int $_productId;
  private string $_productName;
  private float $_unitPrice;
  private DBAccess $_db;

  #endregion

  #region Constructor - sets up the database connection (using DBAccess)

  public function __construct()
  {
    // Create database connection and store into _db property (so other methods can use DBAccess)
    require INCLUDES_DIR . "database.php";
    $this->_db = $db;
  }

  #endregion
  
  #region Getter and setter methods

  /**
   * Get product ID (there is NO setter for product ID to make it read-only)
   *
   * @return int The product ID
   */
  public function getProductId()
  {
    return $this->_productId;
  }

  /**
   * Get product name
   *
   * @return string The product name
   */
  public function getProductName()
  {
    return $this->_productName;
  }

  /**
   * Set product name
   *
   * @param  string $productName The new product name
   * @return void
   */
  public function setProductName($productName)
  {
    // Remove spaces
    $value = trim($productName);

    // Check string length (between 1 & 40)
    if (strlen($value) < 1 || strlen($value) > 40) {
      
      // Invalid new value - throw an exception
      throw new Exception("Product name must be between 1 and 40 characters.");

    } else {
      
      // Store new value in private property
      $this->_productName = $value;

    }
  }

  /**
   * Get product price
   *
   * @return string The product price
   */
  public function getUnitPrice()
  {
    return $this->_unitPrice;
  }

    
  /**
   * Set price
   *
   * @param  string $unitPrice The new price
   * @return void
   */
  public function setUnitPrice($unitPrice)
  {
    $this->_unitPrice = $unitPrice;
  }

  #endregion

  #region Methods

  /**
   * Get a product by ID and populate the object's properties
   *
   * @param  int $id The ID of the product to get
   * @return void
   */
  public function getProduct($id)
  {
    try {

      // Open database connection
      $this->_db->connect();

      // Define SQL query, prepare statement, bind parameters
      $sql = <<<SQL
        SELECT  ProductID, ProductName, UnitPrice
        FROM    products
        WHERE   ProductID = :ProductID
      SQL;
      $stmt = $this->_db->prepareStatement($sql);
      $stmt->bindParam(":ProductID", $id, PDO::PARAM_INT);

      // Execute query
      $rows = $this->_db->executeSQL($stmt);

      // Get the first (and only) row - we are searching by a unique primary key
      $row = $rows[0];

      // Populate the private properties with the retrieved values
      $this->_productId = $row["ProductID"];
      $this->_productName = $row["ProductName"];
      $this->_unitPrice = $row["UnitPrice"];

    } catch (PDOException $e) {
      
      // Throw the exception back up a level (don't handle it here)
      throw $e;
    }
  }

  /**
   * Get all products
   *
   * @return array The collection of products
   */
  public function getProducts()
  {
    try {

      // Open database connection
      $this->_db->connect();

      // Define SQL query, prepare statement, bind parameters
      $sql = <<<SQL
        SELECT  ProductID, ProductName, UnitPrice
        FROM    Products
      SQL;
      $stmt = $this->_db->prepareStatement($sql);

      // Execute SQL
      $rows = $this->_db->executeSQL($stmt);
      return $rows;

    } catch (PDOException $e) {
      throw $e;
    }
  }

  /**
   * Get the total number of products (COUNT)
   *
   * @return int The number of products
   */
  public function getNumberOfProducts()
  {
    try {

      // Open database connection
      $this->_db->connect();

      // Define SQL query, prepare statement, bind parameters
      $sql = <<<SQL
        SELECT  COUNT(*)
        FROM    Products
      SQL;
      $stmt = $this->_db->prepareStatement($sql);

      // Execute SQL
      $value = $this->_db->executeSQLReturnOneValue($stmt);
      return $value;

    } catch (PDOException $e) {
      throw $e;
    }
  }
    
  #endregion

}