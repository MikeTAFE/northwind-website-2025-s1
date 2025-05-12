<h2>Home page</h2>

<p>Welcome to the Northwind website, where you can find some great products! We believe that our product quality is far superior to Southbreeze, so shop with us instead of those dodgy fellows!</p>

<h3>Top 6 products under $20</h3>

<?php if (empty($productsUnder20)): ?>
  
  <p>No products.</p>

<?php else: ?>

  <ul class="product-list">

    <?php foreach ($productsUnder20 as $product): ?>

      <li class="product">
        <a href="#" class="product__link">
          <h4 class="product__name"><?= $product["ProductName"] ?></h4>
          <p class="product__price"><?= sprintf('$%1.2f', $product["UnitPrice"]) ?></p>
          <p class="product__unit-quantity"><?= $product["QuantityPerUnit"] ?></p>
        </a>
      </li>

    <?php endforeach ?>

  </ul>

<?php endif ?>