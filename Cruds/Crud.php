<?php 

class Crud {

    private $servername = "localhost";
    private $username = "webshop_user";
    private $password = "AXN4OSdTm@ua]r4M";
    private $dbname = "my_webshop";

    private function connect_to_db() {
        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            return $conn;
        }
        catch (PDOException $e) {
            echo "Error: ".$e->getMessage(); 
        }
    }
    private function prepare_sql($conn, $sql, $params) {
        $stmt = $conn->prepare($sql);
        if (!is_null($params)) {
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
        }
        $stmt->execute();
        return $stmt;
    }
    public function createRow($sql,$params) {
        try {
            $conn = $this->connect_to_db();
            $stmt = $this->prepare_sql($conn, $sql, $params);
            $last_id = $conn->lastInsertId();
            return $last_id;
        }
        catch (PDOException $e) {
            echo $sql."<br>".$e->getMessage();
        }
        finally {
            $conn = NULL;
        }
    }
    public function readOneRow($sql, $params=NULL) {
        try {
            $conn = $this->connect_to_db();
            $stmt = $this->prepare_sql($conn, $sql, $params);
            $row = $stmt->fetch();
            return $row;
        }
        catch (PDOException $e) {
            echo "Error: ".$e->getMessage();
        }
        finally {
            $conn = NULL;
        }
    }
    private function sort_rows($rows, $key_column) {
        $sorted_rows = array();
        foreach ($rows as $key => $value) {
            $key = $value->$key_column;
            $sorted_rows[$key] = $value;
        }
        return $sorted_rows;
    }
    public function readMultipleRow($sql, $params=NULL, $key_column) {
        try {
            $conn = $this->connect_to_db();
            $stmt = $this->prepare_sql($conn, $sql, $params);
            $rows = $stmt->fetchAll();
            $rows = $this->sort_rows($rows, $key_column);
            return $rows;
        }
        catch (PDOException $e) {
            echo "Error: ".$e->getMessage();
        }
        finally {
            $conn = NULL;
        }
    }
    public function updateOneRow($sql, $params=NULL) {
        try {
            $conn = $this->connect_to_db();
            $stmt = $this->prepare_sql($conn, $sql, $params);
        }
        catch (PDOException $e) {
            echo "Error: ".$e->getMessage();
        }
        finally {
            $conn = NULL;
        }
    }
}