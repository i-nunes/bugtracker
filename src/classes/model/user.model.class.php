<?php

class User extends Dbh {
    private $userId;
    private $isAdmin;
    private $username;
    private $password;
    private $createdAt;
    
    public function __construct($usrname, $pwd, $admin=false) {
        $this->username = $usrname;
        $this->password = $pwd;
        $this->isAdmin = $admin;
        $this->createdAt = date("Y/m/d");
    }

    //interact with db
        //Create
    public function createUser() {
        $sql = 'INSERT INTO users_tb(username, password, role) VALUES(?,?,?)';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$this->username, $this->password, $this->isAdmin]);
        $this->userId = $this->connect()->lastInsertedId();
    }
        // Read
    protected function viewUser($userId) {
        $sql = 'SELECT * FROM users_tb WHERE user_id =?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }
        // Update
    protected function editUser() {
        $sql = 'UPDATE users_tb SET (password=?) WHERE user_id=?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$this->password]);
    }
        // Delete
    protected function deleteUser($userId) {
        $sql = 'DELETE FROM users_tb WHERE user_id=?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userId]);
    }

    //getters and setters
    public function getId() {
        return $this->userId;
    }

    public function getIsAdmin() {
        return $this->isAdmin;
    }

    public function set($admin) {
        $this->isAdmin =$admin;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($usrname) {
        $this->username =$usrname;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($pwd) {
        $this->password = $pwd;
    }

    
}