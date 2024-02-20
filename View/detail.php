<?php
include(__DIR__ . '/../Config/init.php');

$id = $_GET['id'];

$productController = new ProductController();

$data = $productController->show($id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
</head>

<body>
    <h2>Product Details</h2>
    <a href="../index.php">Back to Product List</a>
    <br><br>

    <!-- Detail data ditampilkan dengan kode php -->
    <?php if (count($data) > 0) : ?>
        <table>
            <?php foreach ($data as $product) : ?>
                <tr>
                    <td>ID:</td>
                    <td><?php echo $product["id"]; ?></td>
                </tr>
                <tr>
                    <td>Product Name:</td>
                    <td><?php echo $product["product_name"]; ?></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>$<?php echo $product["price"]; ?></td>
                </tr>
                <tr>
                    <td>Quantity:</td>
                    <td><?php echo $product["quantity"]; ?></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><?php echo $product['description']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p>0 Result</p>
    <?php endif ?>
</body>

</html>