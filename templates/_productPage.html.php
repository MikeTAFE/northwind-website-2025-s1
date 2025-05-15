<h2>Product: <?= esc($product["ProductName"]) ?></h2>

<table class="product-details">
  <tr>
    <th>Price (per unit)</th>
    <td><?= esc(sprintf('$%1.2f', $product["UnitPrice"])) ?></td>
  </tr>
  <tr>
    <th>Unit quantity</th>
    <td><?= esc($product["QuantityPerUnit"]) ?></td>
  </tr>
  <tr>
    <th># in stock</th>
    <td><?= esc($product["UnitsInStock"]) ?></td>
  </tr>
  <tr>
    <th>Category</th>
    <td><?= esc($product["CategoryName"]) ?></td>
  </tr>
  <tr>
    <th>Supplier</th>
    <td><?= esc($product["CompanyName"]) ?></td>
  </tr>
</table>
