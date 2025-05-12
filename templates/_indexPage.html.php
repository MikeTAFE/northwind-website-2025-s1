<h2>Home page</h2>

<p>Welcome to the Northwind website, where you can find some great products! We believe that our product quality is far superior to Southbreeze, so shop with us instead of those dodgy fellows!</p>

<h3>Top 6 products under $20</h3>

<?php
  $products = $productsUnder20;
  include "_products.html.php";
?>

<h3>Top 6 products over $50</h3>

<?php
  $products = $productsOver50;
  include "_products.html.php";
?>