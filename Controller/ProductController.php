<?php
require(__DIR__ . '/../Config/init.php');
class ProductController
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new Product();
    }

    /**
     * Index: this method allows users to  view all products in the database.
     */
    public function index()
    {
        $products = $this->productModel->getAllProducts();

        return $products;
    }

    /**
     * Create: this method allows user to create a new product
     */
    public function create($data)
    {
        try {
            $this->productModel->createProduct($data);
            return true;
        } catch (PDOException $e) {
            die("Error when adding product: " . $e->getMessage());
        }
    }
    /**
     * Show: This method is used to show one specific product by its id.
     *   @param int $id - The id of the product that needs to be shown.
     *   @return array $product - An associative array containing information about the selected product.
     *   If no product with the given id exists, an empty array will be returned.
     */
    public function show($id)
    {
        $product = $this->productModel->getProductById($id);

        return $product;
    }

    public function  update($id, $data)
    {
        try {
            $this->productModel->updateProduct($id, $data);
            return true;
        } catch (PDOException $e) {
            die('Error updating product: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->productModel->deleteProduct($id);
            return true;
        } catch (PDOException $e) {
            die('Error deleting product: ' . $e->getMessage());
        }
    }

    public function restore()
    {
        $this->productModel->restoreProduct();
    }
}
