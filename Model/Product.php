<?php

require(__DIR__ . '/../Config/init.php');

class Product extends Model
{
    /**
     * Constructor that calls the parent constructor and sets the table name for this class.
     * $this->tableName is refers to the table name in the database which will be used by this model.
     * $this->setTableName is a method from the parent class that sets the table name.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('products');
    }

    /**
     * Method  to get all products from the database and return the result as an associative array.
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
