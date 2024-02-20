<?php
require(__DIR__ . '/../Config/init.php');

$productController = new ProductController();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate product_name
    if (empty($_POST["product_name"])) {
        $errors['product_name'] = "Product Name is required";
    } else {
        $product_name = $_POST["product_name"];
    }

    // Validate price
    if (empty($_POST["price"])) {
        $errors['price'] = "Price is required";
    } else if (is_numeric($_POST["price"]) == false) {
        $errors['price'] = "Price must be a number";
    } else if (floatval($_POST["price"]) <= 0) {
        $errors['price'] = "Price should be greater than zero";
    } else {
        $price = $_POST["price"];
    }

    // Validate quantity
    if (!isset($_POST["quantity"]) || empty($_POST["quantity"])) {
        $errors['quantity'] = "Quantity is required";
    } else if (!is_numeric($_POST["quantity"])) {
        $errors['quantity'] = "Quantity must be a valid number";
    } else if ((int)$_POST["quantity"] < 0) {
        $errors['quantity'] = "Quantity cannot be negative";
    } else if ($_POST["quantity"] != (string)(int)$_POST["quantity"]) {
        $errors['quantity'] = "Quantity must be an integer";
    } else {
        $quantity = $_POST["quantity"];
    }

    $description = $_POST["description"];

    // If there are no validation errors, proceed with creating the product
    if (empty($errors)) {
        $data = [
            'product_name' => $product_name,
            'price' => $price,
            'quantity' => $quantity,
            'description' => $description
        ];

        if ($productController->create($data)) {
            echo "<script>alert('Product added successfully!')</script>";
            header("Location: ../index.php");
            exit();
        } else {
            echo "<script>alert('Failed to add product!')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

    </style>
</head>

<body>
    <div class="container mt-4">
        <h2>Create Product</h2>
        <a href="../index.php" class="btn btn-secondary">Back to Product List</a>
        <br><br>
        <form action="" method="post">
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name:</label>
                <input type="text" name="product_name" class="form-control <?php echo isset($errors['product_name']) ? 'is-invalid' : ''; ?>" required value="<?php echo isset($product_name) ? $product_name : ''; ?>">
                <?php if (isset($errors['product_name'])) : ?>
                    <div class="invalid-feedback"><?php echo $errors['product_name']; ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price:</label>
                <input type="text" name="price" class="form-control <?php echo isset($errors['price']) ? 'is-invalid' : ''; ?>" required value="<?php echo isset($price) ? $price : ''; ?>">
                <?php if (isset($errors['price'])) : ?>
                    <div class="invalid-feedback"><?php echo $errors['price']; ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity:</label>
                <input type="text" name="quantity" class="form-control <?php echo isset($errors['quantity']) ? 'is-invalid' : ''; ?>" required value="<?php echo isset($_POST["quantity"]) ? $_POST["quantity"] : ""; ?>" />
                <?php if (isset($errors['quantity'])) : ?>
                    <div class="invalid-feedback"><?php echo $errors['quantity']; ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea name="description" class="form-control"><?php echo isset($description) ? $description : ''; ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>