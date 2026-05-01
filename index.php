<?php
require_once "./db.php";

$rows = [];
$table_header = "";

// Get query if set, or set query to empty string.
if (isset($_GET["q"]) && $_GET["q"] !== "") {
  $q = $_GET["q"];
  $table_header = "Search Results for \"$q\"";
} else {
  $q = '';
  $table_header = "Product List";
}

// Create parameterized SQL statement.

$search_query = "%$q%";

if ($q === "") {
  $sql = "SELECT * FROM products";
  $stmt = mysqli_prepare($link, $sql);
} else {
  $sql = "SELECT * FROM products WHERE product_name LIKE ?";
  $stmt = mysqli_prepare($link, $sql);
  mysqli_stmt_bind_param($stmt, "s", $search_query);
}

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_stmt_close($stmt);
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Show Products</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <h1>Happy Hacker Hats Ltd.</h1>
  <?php if (isset($_GET['added'])): ?>
    <p>Product <?= htmlspecialchars($_GET['added']) ?> added successfully.</p>
  <?php endif; ?>
  <h2><?= htmlspecialchars($table_header) ?></h2>

<!-- Search form and add new product link -->

<form method="get" action="">
  <label for="q">Search:</label>
  <input type="text" name="q" id="q" placeholder="Search products (leave empty to show all)" value="<?= htmlspecialchars($q) ?>" size="30">
  <button type="submit">Search</button>
</form>

<p><a href="./add_product.php"><strong>+ Add Product</strong></a></p>

<!-- If no results -->
<?php if (empty($rows)): ?>
<p>No results found for "<?= htmlspecialchars($q) ?>".</p>

<!-- If there are results, create table. -->
<?php else: ?>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Product Name</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody>
<!-- For each row in the results, put in the table. --> 
  <?php $count = 1; ?>
  <?php foreach ($rows as $row): ?>
    <tr>
      <td><?= $count++; ?></td>
      <td><?= htmlspecialchars($row["product_name"]); ?></td>
      <td><?= htmlspecialchars($row["price"]); ?></td>
    </tr>
  <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>

</body>
</html>
