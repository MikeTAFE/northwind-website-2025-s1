<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?? "NO TITLE" ?> - Northwind</title>
</head>
<body>
  
  <?= $content ?? 'NO CONTENT - $content not defined' ?>

  <!-- Some comment in the layout file -->

  <div class="random-content">
    <h1>Random content</h1>
    <p>This is some really random content... I have no idea why it's here!  🤷‍♀️</p>
  </div>

</body>
</html>