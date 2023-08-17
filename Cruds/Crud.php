<?php 

class Crud {

    private $servername = "localhost";
    private $username = "webshop_user";
    private $password = "AXN4OSdTm@ua]r4M";
    private $dbname = "my_webshop";

    private function connectToDb() {
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
    private function prepareSql($conn, $sql, $params) {
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
        $conn = $this->connectToDb();
        $stmt = $this->prepareSql($conn, $sql, $params);
        $last_id = $conn->lastInsertId();
        $conn = NULL;
        return $last_id;
}
    public function readOneRow($sql, $params=NULL) {
        $conn = $this->connectToDb();
        $stmt = $this->prepareSql($conn, $sql, $params);
        $row = $stmt->fetch();
        $conn = NULL;
        return $row;
    }
    private function sortRows($rows, $key_column) {
        $sorted_rows = array();
        foreach ($rows as $key => $value) {
            $key = $value->$key_column;
            $sorted_rows[$key] = $value;
        }
        return $sorted_rows;
    }
    public function readMultipleRow($sql, $params=NULL, $key_column) {
        $conn = $this->connectToDb();
        $stmt = $this->prepareSql($conn, $sql, $params);
        $rows = $stmt->fetchAll();
        $rows = $this->sortRows($rows, $key_column);
        $conn = NULL;
        return $rows;
    }
    public function updateOneRow($sql, $params=NULL) {
        $conn = $this->connectToDb();
        $stmt = $this->prepareSql($conn, $sql, $params);
        $conn = NULL;
    }
}