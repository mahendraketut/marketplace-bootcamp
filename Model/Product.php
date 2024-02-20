<?php

require(__DIR__ . '/../Config/init.php');

class Product extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('products');
    }

    /**
     * Method  to get all products from the database
     */
    public function getAllProducts()
    {
        $stmt = $this->db->selectData($this->tableName, null, 0);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id)
    {
        $stmt = $this->db->selectData($this->tableName, $id, 0);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createProduct($data)
    {
        $fillable = [
            'product_name' => $data['product_name'],
            'price' => $data['price'],
            'quantity' => $data['quantity'],
            'description' => $data['description'],
        ];
        $stmt = $this->db->insertData($this->tableName, $fillable);
        return $stmt;
    }

    public function updateProduct($id, $data)
    {
        $stmt = $this->db->updateData($this->tableName, $id, $data);
        return $stmt;
    }

    public function deleteProduct($id)
    {
        $this->db->deleteRecord($this->tableName, $id);
    }

    public function restoreProduct()
    {
        $this->db->restoreRecord($this->tableName);
    }
}
