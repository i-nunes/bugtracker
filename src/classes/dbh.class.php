<?php

class Dbh {
    private $host = 'localhost';
    private $user = 'bugtrack';
    private $pwd = 'password';
    private $dbName = 'bugtrack';
    
    protected function connect() {
        $dns = 'pgsql:host=' . $this->host . ' user=' . $this->user . 
                ' dbname=' . $this->dbNAme . ' password=' . $this->pwd;
        $pdo = new PDO($dns, $this->user, $this->pwd);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}