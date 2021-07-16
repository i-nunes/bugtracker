<?php

class Project extends Dbh {
    private $projectId;
    private $name;
    private $prefix;

    public function __construct($name, $prfx) {
        $this->name = $name;
        $this->prefix = $prfx;
    }

    //Interact with db
            //Create
    public function createProject() {
        $sql = 'INSERT INTO projects_tb(project_name, project_prefix) VALUES(?,?)';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$this->name, $this->prefix]);
        $this->projectId = $this->connect()->lastInsertedId();
    }
        // Read
    protected function viewProject($projectId) {
        $sql = 'SELECT * FROM projects_tb WHERE project_id =?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$projectId]);
        return $stmt->fetchAll();
    }
        // Update
    protected function editProject() {
        $sql = 'UPDATE projects_tb SET (project_name=?, project_prefix=?) WHERE project_id=?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$this->name, $this->prefix, $this->projectId]);
    }
        // Delete
    protected function deleteProject($projectId) {
        $sql = 'DELETE FROM projects_tb WHERE project_id=?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$projectId]);
    }

    //getters and setters
    public function getId() {
        return $this->projectId;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getPrefix() {
        return $this->prefix;
    }

    public function setPrefix($prfx) {
        $this->prefix = $prfx;
    }
}