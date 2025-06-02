<?php

  // Query to get categories
  $sql = <<<SQL
    SELECT  CategoryID, CategoryName
    FROM    categories
  SQL;

  // Prepare statement
  $stmt = $db->prepareStatement($sql);

  // Execute query
  $categories = $db->executeSQL($stmt);

  // $category = new Category();
  // $categories = $category->getCategories();

?>
<ul>
  <?php foreach ($categories as $category): ?>
    <li><a href="category.php?id=<?= $category["CategoryID"] ?>"><?= $category["CategoryName"] ?></a></li>
  <?php endforeach ?>
</ul>