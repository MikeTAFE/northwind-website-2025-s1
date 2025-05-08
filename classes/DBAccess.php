<?php

/**
 * Provides access to a MySQL database using PDO prepared statements (parameterised queries)
 */
class DBAccess
{
  // Holds DB config
  private $_dsn;
  private $_username;
  private $_password;

  // Holds the PDO object used for all DB operations
  private $_pdo;

  /**
   * Constructor: set up database config
   *
   * @param string $server The database server/host name
   * @param string $database The database name
   * @param string $username The database username
   * @param string $password The database password
   * @return void
   */
  public function __construct($server, $database, $username, $password)
  {
    $this->_dsn = "mysql:host=$server;dbname=$database;charset=utf8";
    $this->_username = $username;
    $this->_password = $password;
  }
  
  /**
   * Connect to the database
   *
   * @return void
   */
  public function connect()
  {
    try {
      // Create a new PDO instance (DB connection)
      $this->_pdo = new PDO($this->_dsn, $this->_username, $this->_password);

      // Change PDO configuration
      // Forces PDO to always throw exceptions (so we can catch & handle them)
      $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // Forces PDO to return an associative array by default (no numeric indexes)
      $this->_pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die("Connection failed: " . $e->getMessage());
    }
  }
 
  /**
   * Disconnect from the database
   *
   * @return void
   */
  public function disconnect()
  {
    $this->_pdo = null;
  }
  
  /**
   * Prepares a PDOStatement from the SQL query using the current database connection
   *
   * @param  string $sql SQL query to execute (optionally with PDO parameter placeholders, e.g. :id)
   * @return PDOStatement PDO prepared statement
   */
  public function prepareStatement($sql)
  {
    return $this->_pdo->prepare($sql);
  }
    
  /**
   * Execute a PDO statement returning a resultset (rows)
   *
   * @param PDOStatement $stmt PDO prepared statement to execute
   * @return array Resultset data (rows) as array of arrays
   */
  public function executeSQL($stmt)
  {
    try
    {
      // Execute query and get all rows of data
      $stmt->execute();
      $rows = $stmt->fetchAll();
    }
    catch (PDOException $e)
    {
      die("Query failed: " . $e->getMessage());
    }

    // Return query resultset (rows)
    return $rows;
  }
  
  /**
   * Execute a PDO statement returning a single (scalar) value
   *
   * @param PDOStatement $stmt PDO prepared statement to execute
   * @return mixed Single value that is the result of the query
   */
  public function executeSQLReturnOneValue($stmt)
  {
    try
    {
      // Execute query and get single value (first row, first column)
      $stmt->execute();
      $value = $stmt->fetchColumn();
    }
    catch(PDOException $e)
    {
      die("Query failed: " . $e->getMessage());
    }

    // Return query result (single value)
    return $value;
  }

  /**
   * Execute a PDO statement for an INSERT, UPDATE, DELETE query
   *
   * @param PDOStatement $stmt PDO prepared statement to execute
   * @param bool $getLastInsertId True to return the last-inserted ID (primary key value)
   * @return bool|int True/false on success/failure or the last-inserted ID (primary key value)
   */
  public function executeNonQuery($stmt, $getLastInsertId = false)
  {
    try
    {
      // Execute query
      $value = $stmt->execute();

      // Check if we need to get the last-inserted ID (for INSERT with auto-increment)
      if ($getLastInsertId) {

        // Get the ID
        $value = $this->_pdo->lastInsertId();
      }
    }
    catch (PDOException $e)
    {
      die("Query failed: " . $e->getMessage());
    }

    // Return the last ID (primary key value) or true/false (success/failure)
    return $value;
  }
}
