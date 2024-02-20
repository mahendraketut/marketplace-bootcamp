<?php
include(__DIR__ . '/../Config/init.php');

$id = $_GET['id'];

$productController = new ProductController();
$row = $productController->show($id);

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //validate product_name
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
    $description  = $_POST['description'];

    // If there are no validation errors, proceed with updating the product
    if (empty($errors)) {
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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Update Product</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }

        form {
            max-width: 600px;
            margin: auto;
        }

        label {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <h2>Update Product</h2>
    <a href="../index.php" class="btn btn-primary">Back to Product List</a>
    <br><br>
    <?php if (count($row) > 0) : ?>
        <form action="" id="update" method="post">
            <input type="hidden" name="id" value="<?php echo $row[0]['id']; ?>">
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name:</label>
                <input type="text" name="product_name" class="form-control <?php echo isset($errors['product_name']) ? 'is-invalid' : ''; ?>" value="<?php echo isset($row[0]['product_name']) ? $row[0]['product_name'] : ''; ?>" required>
                <div class="invalid-feedback">
                    <?php echo isset($errors['product_name']) ? $errors['product_name'] : ''; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price:</label>
                <input type="text" name="price" class="form-control <?php echo isset($errors['price']) ? 'is-invalid' : ''; ?>" value="<?php echo isset($row[0]['price']) ? $row[0]['price'] : ''; ?>" required>
                <div class="invalid-feedback">
                    <?php echo isset($errors['price']) ? $errors['price'] : ''; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity:</label>
                <input type="text" name="quantity" class="form-control <?php echo isset($errors['quantity']) ? 'is-invalid' : ''; ?>" value="<?php echo isset($row[0]['quantity']) ? $row[0]['quantity'] : ''; ?>" required>
                <div class="invalid-feedback">
                    <?php echo isset($errors['quantity']) ? $errors['quantity'] : ''; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea name="description" class="form-control"><?php echo $row[0]['description'] ?></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>

        </form>
    <?php else : ?>
        <p>Data not found</p>
    <?php endif ?>
    <!-- Include Bootstrap JS and Popper.js (required for Bootstrap components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>