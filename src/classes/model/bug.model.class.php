<?php

class Bug extends Dbh{
    private $bugId;
    private $userId;
    private $categoryId;
    private $projectId;
    private $description;
    private $severity;
    private $title;
    private $createdAt;
    private $isResolved=false;

    public function __construct($userId, $projectId, $title, $description=null, $severity=null, $categoryId=null) {
        $this->userId = $userId;
        $this->categoryId = $categoryId;
        $this->projectId = $projectId;
        $this->description = $description;
        $this->severity = $severity;
        $this->title = $title;
        $this->createdAt = date("Y/m/d");
    }

    //Interact with db
        // Create
    protected function createBug() {
        $sql = 'INSERT INTO bugs_tb(bug_description, 
                                    bug_severity, bug_title, 
                                    user_id,category_id, project_id, date)
                                    VALUES (?,?,?,?,?,?,?);';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$this->description, $this->severity, $this->title, 
                        $this->userId, $this->categoryId, $this->projectId, 
                        $this->createdAt]);
        $this->bugId = $this->connect()->lastInsertedId();
    }
        // Read
    protected function viewBug($bugId) {
        $sql = 'SELECT * FROM bugs_tb WHERE bug_id =?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$bugId]);
        return $stmt->fetchAll();
    }
        // Update
    protected function editBug() {
        $sql = 'UPDATE bugs_tb SET bug_description=?, bug_serevity=?, 
                bug_title=?, category_id=? WHERE bug_id=?';
        $stmt = $this->connect()->prepare($sql);

        $stmt->execute([$this->description, $this->severity, 
                        $this->title, $this->categoryId, $this->bugId]);
    }
        // Delete
    protected function deleteBug($bugId) {
        $sql = 'DELETE FROM bugs_tb WHERE bug_id=?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$bugId]);
    }



    // getters and setters
    public function setCategory($catId) {
        $this->categoryId  = $catId;
    }

    public function getCategory() {
        return $this->categoryId;
    }

    public function setProject($projectId) {
        $this->projectId = $projectId;
    }

    public function getProject() {
        return $this->projectId;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setSeverity($severity) {
        $this->severity = $severity;
    }

    public function getSeverity() {
        return $this->severity;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getTItle() {
        return $this->title;
    }

    public function setResolved($resolved) {
        $this->isResolved = $resolved;
    }

    public function getResolved() {
        return $this->isResolved;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }
}