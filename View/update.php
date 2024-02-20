<?php
include(__DIR__ . '/../Config/init.php');

$id = $_GET['id'];

$productController =  new ProductController();
$row =  $productController->show($id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $price  = $_POST['price'];
    $quantity = $_POST['quantity'];
    $description  = $_POST['description'];

    $data = [
        'product_name' => $product_name,
        'price' => $price,
        'quantity' => $quantity,
        'description' => $description
    ];

    if ($productController->update($id, $data)) {
        header("Location: ../index.php");
    } else {
        echo "Error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Update Product</title>
</head>

<body>
    <h2>Update Product</h2>
    <a href="../index.php">Back to Product List</a>
    <br><br>
    <?php if (count($row) > 0) : ?>
        <form action="" id="update" method="post">
            <input type="hidden" name="id" value="<?php echo $row[0]['id']; ?>">
            <label for="product_name">Product Name:</label>
            <input type="text" name="product_name" value="<?php echo isset($row[0]['product_name']) ? $row[0]['product_name'] : ''; ?>" required><br>
            <label for="price">Price:</label>
            <input type="text" name="price" value="<?php echo isset($row[0]['price']) ? $row[0]['price'] : ''; ?>" required><br>
            <label for="quantity">Quantity:</label>
            <input type="text" name="quantity" value="<?php echo isset($row[0]['quantity']) ? $row[0]['quantity'] : ''; ?>" required><br>
            <label for="description">Description</label>

            <textarea name="description">
                <?php echo $row[0]['description'] ?>
            </textarea><br>

            <input type="submit" value="Update Product">
        </form>
    <?php else : ?>
        <p>Data not found</p>
    <?php endif ?>

</body>

</html>