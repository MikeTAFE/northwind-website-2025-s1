<?php

/**
 * Defines a shopping cart item (product)
 */
class CartItem
{

  #region Properties (private)

  private string $_itemName;
  private float $_quantity;
  private float $_price;
  private int $_productId;

  #endregion

  #region Constructor
        
  /**
   * Build a new CartItem using provided data
   *
   * @param  string $itemName The name of the item
   * @param  float $quantity Number of items to purchase
   * @param  float $price The individual item price
   * @param  int $productId The ID of the product in the database
   * @return void
   */
  public function __construct(string $itemName, float $quantity, float $price, int $productId)
  {
    $this->_itemName = $itemName;
    $this->_quantity = $quantity;
    $this->_price = $price;
    $this->_productId = $productId;
  }

  #endregion

  #region Getter and setter methods
  
  /**
   * Get quantity
   *
   * @return float The quantity
   */
  public function getQuantity(): float
  {
    return $this->_quantity;
  }

  /**
   * Set quantity
   *
   * @param  float $value The new quantity
   * @return void
   */
  public function setQuantity(float $value)
  {
    if((int)$value >= 0)
    {     	
      $this->_quantity = (int)$value;
    }
    else
    {
      throw new Exception("Quantity must be positive");
    }
  }

  /**
   * Get price
   *
   * @return float The price
   */
  public function getPrice(): float
  {
    return $this->_price;
  }

  /**
   * Get database item ID
   *
   * @return int The database item ID
   */
  public function getItemId(): int
  {
    return $this->_productId;
  }

  /**
   * Get item name
   *
   * @return string The item name
   */
  public function getItemName(): string
  {
    return $this->_itemName;
  }

  #endregion

}
