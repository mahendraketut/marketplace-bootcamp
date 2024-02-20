<?php
require_once(__DIR__ . '/Config/init.php');

$productController = new ProductController();

$products = $productController->index();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["restoreAllProducts"])) {
    $productController->restore();
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Lists</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <div class="container ">
            <div class="row">
                <div class="col-md-8">
                    <h2>Product List</h2>
                </div>
                <div class="col-md-4">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <a class="col btn btn-outline-primary w-100" href="View/create.php">Add product</a>
                        </div>
                        <div class="col-md-6">
                            <form id="restoreForm" action="index.php" method="post">
                                <input type="hidden" name="restoreAllProducts" value="true">
                                <button class="btn btn-outline-success w-100" onclick="handleRestore()">Restore
                                    Data</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br><br>
        <form id="deleteForm" action="View/delete.php" method="post">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th>
                            <input class="form-check-input" type="checkbox" id="selectAll"
                                onclick="selectAllCheckboxes()">
                        </th>
                        <th>No</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($products) > 0) : ?>
                    <?php $counter = 1 ?>
                    <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><input class="form-check-input" type="checkbox" name="selected_ids[]"
                                value="<?php echo $product['id']; ?>"></td>
                        <td><?php echo $counter ?></td>
                        <td><?php echo $product['product_name'] ?></td>
                        <td><?php echo $product['description'] ?></td>
                        <td><?php echo number_format($product['price'], 2, '.', ',') ?></td>
                        <td><?php echo $product['quantity'] ?></td>
                        <td><?php echo number_format($product['price'] * $product['quantity'], 2, '.', ',') ?></td>
                        <td>
                            <a class="btn btn-outline-info"
                                href="View/detail.php?id=<?php echo $product['id'] ?>">View</a>
                            <a class="btn btn-outline-warning"
                                href="View/update.php?id=<?php echo $product['id'] ?>">Update</a>
                            <a class="btn btn-outline-danger"
                                href="View/delete.php?id=<?php echo $product['id'] ?>">Delete</a>
                        </td>
                    </tr>
                    <?php $counter++ ?>
                    <?php endforeach ?>
                    <?php else : ?>
                    <tr>
                        <td colspan="5">0 result</td>
                    </tr>
                    <?php endif ?>
                </tbody>
            </table>
            <input type="hidden" name="selectedIds" id="selectedIdsInput" value="">
            <button class="btn btn-danger" onclick="handleMultipleDelete()">Delete Selected</button>
        </form>

    </div>

    <!-- Include Bootstrap JS and Popper.js (required for Bootstrap components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function handleMultipleDelete() {
        var selectedIds = [];

        // Loop through checkboxes and collect selected IDs
        var checkboxes = document.getElementsByName('selected_ids[]');
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                selectedIds.push(checkbox.value);
            }
        });

        if (!selectedIds || selectedIds.length == 0) {
            alert("No products selected for deletion.");
            return false;
        } else {
            var confirmation = confirm("Are you sure to delete the products?");
            if (confirmation) {
                document.getElementById('selectedIdsInput').value = JSON.stringify(selectedIds);
                document.getElementById('deleteForm').submit();
            }
        }
    }

    function handleRestore() {
        var confirmation = confirm("Are you sure to restore all products?");
        if (confirmation) {
            // Submit the form
            document.getElementById('restoreForm').submit();
        }
    }

    function selectAllCheckboxes() {
        var selectAllCheckbox = document.getElementById('selectAll');
        var checkboxes = document.getElementsByName('selected_ids[]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = selectAllCheckbox.checked;
        });
    }
    </script>
</body>

</html>