<?php if (empty($products)): ?>
  
  <p>No products.</p>

<?php else: ?>

  <ul class="product-list">

    <?php foreach ($products as $product): ?>

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