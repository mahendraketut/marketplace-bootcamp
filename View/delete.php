<?php
require_once(__DIR__ . '/../Config/init.php');



$productController = new ProductController();
$productDetails = [];

if (empty($_GET['id'])) {
    $selectedIdsJson = isset($_POST['selectedIds']) ? $_POST['selectedIds'] : '[]';
    $selectedIds = json_decode($selectedIdsJson);

    foreach ($selectedIds as $selectedId) {
        $productDetails[]  = $productController->show($selectedId);
        $deletedProduct = $productController->destroy($selectedId);
    }
} else {
    $id = $_GET['id'];
    $productDetails[] = $productController->show($id);
    $deletedProduct = $productController->destroy($id);
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body class="container mt-4">
    <h2>Delete Product</h2>
    <a href="../index.php" class="btn btn-primary">Back to Product List</a>
    <br><br>
    <p>Deleted data: </p>
    <?php if (count($productDetails) > 0) : ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productDetails as $productArray) : ?>
                    <?php foreach ($productArray as $product) : ?>
                        <tr>
                            <td><?php echo $product["id"]; ?></td>
                            <td><?php echo $product["product_name"]; ?></td>
                            <td><?php echo $product["price"]; ?></td>
                            <td><?php echo $product["quantity"]; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No products deleted</p>
    <?php endif ?>
</body>

</html>