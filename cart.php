<?php

  // Common includes for main PHP pages (controllers)
  require_once "includes/common.php";


  /*
    TESTING: Add items to the shopping cart 
   */

  // // Create testing CartItems
  // $item1 = new CartItem("Test Product 1", 2, 4.50, 1);
  // $item2 = new CartItem("Test Product 2", 4, 14.00, 2);
  // $item3 = new CartItem("Test Product 3", 7, 123.45, 3);

  // // Add items to the cart
  // $cart->addItem($item1);
  // $cart->addItem($item2);
  // $cart->addItem($item3);

  // // Save the cart back into the session (super important!)
  // $_SESSION["cart"] = $cart;

  // $cart->displayArray();
  // exit;


  // Config
  $title = "Shopping cart";

  // Start output buffering (trap output - don't display it yet)
  ob_start();

  // Include the page-specific template
  include_once "templates/_cartPage.html.php";

  // Stop output buffering - store output into the $content variable
  $content = ob_get_clean();

  // Include the main layout template
  include_once "templates/_layout.html.php";