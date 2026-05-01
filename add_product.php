<?php
require_once "./db.php";

$product_name_err = "";
$price_err = "";

$product_name = "";
$price = "";

// Validate input

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty(trim($_POST["product_name"]))) {
    $product_name_err = "Product name field is required.";
  } else {
    $product_name = trim($_POST["product_name"]);

    if (strlen($product_name) > 255) {
      $product_name_err = "Product name too long.";
    }
  }

  if (empty(trim($_POST["price"]))) {
    $price_err = "Price field is required.";
  } else {
    $price = trim($_POST["price"]);
    if (!is_numeric($price)) {
      $price_err = "Price must be a numeric value only.";
    } else {
      $price_float = (float)$price;
      if ($price_float < 0) {
        $price_err = "Price cannot be negative.";
      }
    }
  }

// If no error, create the parameterized SQL statement and insert product.

  if (empty($product_name_err) && empty($price_err)) {
    $sql = "INSERT INTO products (product_name, price) VALUES (?, ?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
      mysqli_stmt_bind_param($stmt, "sd", $product_name, $price_float);

// Redirect to index with new product name.

      if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php?added=" . urlencode($product_name), true, 303);
        exit;
      } else {
        echo "Entry into database failed. Please try again later.";
      }
    }

    mysqli_stmt_close($stmt);
  }

  mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Add product</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <h1>Happy Hacker Hats Ltd.</h1>
  <h2>Add product</h2>
    <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <label for="product_name">Product Name</label>
          <input type="text" name="product_name" id="product_name" value="<?= htmlspecialchars($product_name); ?>" maxlength="255" required>
          <small><?= htmlspecialchars($product_name_err); ?></small>
          
          <label for="price">Price</label>
          <input type="number" name="price" id="price" value="<?= htmlspecialchars($price); ?>" min="0" step="0.01" required>
          <small><?= htmlspecialchars($price_err); ?></small>
          <button type="submit">Add Product</button>
    </form>
  <p><a href="./">Back to search</a></p>
</body>

</html>
