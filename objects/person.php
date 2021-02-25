<?php
class Person
{
    private $conn, $tbName = "person";
    public $person_id, $name, $gender, $parent_id;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function read()
    {
        $query = "SELECT * FROM " . $this->tbName;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create()
    {
        $query = "INSERT INTO person VALUES(:person_id, :name, :gender, :parent_id)";
        if (empty($this->parent_id))
            $query = "INSERT INTO person(person_id, name, gender) VALUES(:person_id, :name, :gender)";
        $stmt = $this->conn->prepare($query);
        $this->person_id = htmlspecialchars(strip_tags($this->person_id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        if (!empty($this->parent_id))
            $this->parent_id = htmlspecialchars(strip_tags($this->parent_id));

        $stmt->bindParam(":person_id", $this->person_id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":gender", $this->gender);
        if (!empty($this->parent_id))
            $stmt->bindParam(":parent_id", $this->parent_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update()
    {
        $query = "UPDATE person SET name=:name, gender=:gender, parent_id=:parent_id WHERE person_id=:person_id";
        if (empty($this->parent_id))
            $query = "UPDATE person SET name=:name, gender=:gender WHERE person_id=:person_id";
        $stmt = $this->conn->prepare($query);
        $this->person_id = htmlspecialchars(strip_tags($this->person_id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        if (!empty($this->parent_id))
            $this->parent_id = htmlspecialchars(strip_tags($this->parent_id));

        $stmt->bindParam(":person_id", $this->person_id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":gender", $this->gender);
        if (!empty($this->parent_id))
            $stmt->bindParam(":parent_id", $this->parent_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete()
    {
        $query = "DELETE FROM person WHERE person_id=:person_id";
        $stmt = $this->conn->prepare($query);
        $this->person_id = htmlspecialchars(strip_tags($this->person_id));
        $stmt->bindParam(":person_id", $this->person_id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
