<?php

class Category extends Dbh {

    private $categoryId;
    private $categoryName;

    public function __construct($name) {
        $this->categoryName = $name;
    }

    //Interact with db
            //Create
    public function createCategory() {
        $sql = 'INSERT INTO categories_tb(category_name) VALUES(?)';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$this->categoryName]);
        $this->categoryId = $this->connect()->lastInsertedId();
    }
        // Update
    protected function editCategory() {
        $sql = 'UPDATE categories_tb SET (category_name=?) WHERE category_id=?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$this->categoryName]);
    }
        // Delete
    protected function deleteCategory($categoryId) {
        $sql = 'DELETE FROM categories_tb WHERE category_id=?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$categoryId]);
    }

    //getters and setters
    public function getId() {
        return $this->categoryId;
    }

    public function setName($name) {
        $this->categoryName = $name;
    }

    public function getName() {
        return $this->categoryName;
    }
}