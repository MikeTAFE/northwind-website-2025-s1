<h2>Shopping cart</h2>

<?php if ($cart->count() === 0): ?>

  <p>Your shopping cart is empty, you should <a href="index.php">browse for something to buy</a>!</p>

<?php else: ?>

  <table>
    <tr>
      <th>Item</th>
      <th>Price</th>
      <th>Qty</th>
    </tr>
    
    <?php foreach ($cart->getItems() as $item): ?>

      <tr>
        <td><?= $item->getItemName() ?></td>
        <td><?= sprintf('$%1.2f', $item->getPrice() ?? "--") ?></td>
        <td><?= $item->getQuantity() ?></td>
      </tr>
    
    <?php endforeach ?>

  </table>

  <p>Total price: <?= $cart->calculateTotal() ?></p>

<?php endif ?>