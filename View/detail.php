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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }

        h2 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            margin-top: 20px;
        }

        table td,
        table th {
            padding: 8px;
            border: 1px solid #dddddd;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        a {
            display: inline-block;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h2>Product Details</h2>
    <a href="../index.php" class="btn btn-primary">Back to Product List</a>

    <?php if (count($data) > 0) : ?>
        <table class="table">
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
                    <td>Description:</td>
                    <td><?php echo $product['description']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p class="mt-3">0 Result</p>
    <?php endif ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>