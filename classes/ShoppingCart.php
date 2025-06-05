<?php

require_once "CartItem.php";
require_once "DBAccess.php";

/**
 * Defines a shopping cart (collection of items)
 */
class ShoppingCart
{

  #region Properties (private)

  private array $_cartItems = [];
  private int $_shoppingOrderId;
  private DBAccess $_db;

  #endregion

  #region Constructor - sets up the database connection (using DBAccess)

  /**
   * Create a new shopping cart
   */
  public function __construct()
  {
    // Create database connection and store into _db property so other methods can use DBAccess
    require INCLUDES_DIR . "database.php";
    $this->_db = $db;
  }

  #endregion

  #region Getter and setter methods

  /**
   * Set the shopping order ID
   *
   * @param integer $id The shopping order ID
   * @return void
   */
  public function setShoppingOrderId(int $id)
  {
    $this->_shoppingOrderId = $id;
  }
  
  /**
   * Get all cart items
   *
   * @return array The array of cart items
   */
  public function getItems(): array
  {
    return $this->_cartItems;
  }
  
  #endregion

  #region Methods

  /**
   * Get the total number of items in the cart
   *
   * @return integer The total number of cart items
   */
  public function count(): int
  {
    return count($this->_cartItems);
  }

  /**
   * Add an item to the cart. If the item already exists, the quantity will be updated.
   *
   * @param CartItem $cartItem The cart item with all details to add
   * @return void
   */
  public function addItem(CartItem $cartItem): void
  {
    // If cartItem already exists update quantity
    $found = $this->inCart($cartItem);

    if($found != null) {
      // Update quantity
      $this->updateItem($cartItem);
    } else {
      // Insert new cart item
      $this->_cartItems[] = $cartItem;
    }
  }

  /**
   * Update an item in the cart (adjust quantity)
   *
   * @param CartItem $cartItem The cart item with quantity (matched by item ID)
   * @return void
   */
  public function updateItem(CartItem $cartItem): void
  {
    $index = $this->itemIndex($cartItem);

    // Get current quantity
    $oldQty = $this->_cartItems[$index]->getQuantity();
    $additionalQty = $cartItem->getQuantity();

    // Calculate new quantity
    $newQty = $oldQty + $additionalQty;

    // Update cart item with new quatity
    $this->_cartItems[$index]->setQuantity($newQty);
  }

  /**
   * Remove an item from the cart
   *
   * @param CartItem $cartItem The cart item to search for (by item ID)
   * @return void
   */
  public function removeItem(CartItem $cartItem): void
  {
    // $index = array_search($cartItem, $this->_cartItems);
    $index = $this->itemIndex($cartItem);
      
    if($index >= 0) {
      // Remove array element
      unset($this->_cartItems[$index]);
      // Reorganise values
      $this->_cartItems = array_values($this->_cartItems);
    }
  }

  /**
   * Calculate the total price of the cart
   *
   * @return float The total price
   */
  public function calculateTotal(): float
  {
    $total = 0.0;

    foreach ($this->_cartItems as $item) {
      $total += $item->getQuantity() * $item->getPrice();
    }
    
    return $total;
  }

  #endregion

  #region Helper methods

  /**
   * Find an item in the cart item array
   *
   * @param CartItem $cartItem The cart item to search for (by item ID)
   * @return CartItem|null The cart item if found or null if not found
   */
  private function inCart(CartItem $cartItem): CartItem | null
  { 
      $found = null;

      foreach($this->_cartItems as $item) 
      {
          if ($item->getItemId() == $cartItem->getItemId() )
          {
              $found = $item;
          }
      }
      return $found;
  }

  /**
   * Get the index/position of a cart item in the array
   *
   * @param CartItem $cartItem The cart item to search for (by item ID)
   * @return integer The index of the item or -1 if not found
   */
  private function itemIndex(CartItem $cartItem): int
  {
    $index = -1;

    for($i=0; $i<$this->count(); $i++) {
      if($cartItem->getItemId() == $this->_cartItems[$i]->getItemId())
      {
          $index = $i;
      }
    }

    return $index;
  }

  #endregion

  #region Testing

  /**
   * Print the contents of the cart items array (for testing)
   *
   * @return void
   */
  public function displayArray(): void
  {
    echo "<pre>";
    print_r($this->_cartItems);
    echo "</pre>";
  }

  #endregion
  
}
