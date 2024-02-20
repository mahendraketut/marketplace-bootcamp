<?php
require(__DIR__ . '/../Config/init.php');

$productController = new ProductController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST["product_name"];
    $price  = $_POST["price"];
    $quantity = $_POST["quantity"];
    $description = $_POST["description"];

    // Create an array with the form data
    $data = [
        'product_name' => $product_name,
        'price' => $price,
        'quantity' => $quantity,
        'description' => $description
    ];
    if ($productController->create($data)) {
        echo "<script>alert('Product added successfully!')</script>";
        // Redirect to index.php or any other page after successful addition
        header("Location: ../index.php");
        exit();
    } else {
        echo "<script>alert('Failed to add product!')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>

<body>
    <h2>Create Product</h2>
    <a href="../index.php">Back to Product List</a>
    <br><br>
    <form action="" method="post">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" required><br>
        <label for="price">Price:</label>
        <input type="text" name="price" required><br>
        <label for="quantity">Quantity:</label>
        <input type="text" name="quantity" required><br>
        <label for="description">Description:</label>
        <textarea name="description"></textarea><br>
        <input type="submit" value="Add Product">
    </form>
</body>

</html>