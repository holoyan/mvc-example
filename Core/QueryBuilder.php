<?php

namespace Core;

use PDO;
// Core
interface DB {
    public function insert($data);
    public function update($id, $data);
    public function last();
    public function delete($id);
    public function find($id);
    public function first();
}

abstract class QueryBuilder implements DB {
    private $pdo;
    public function __construct(){
        $configs = require_once ROOT . DIRECTORY_SEPARATOR . "configs/database.php";
        $host = $configs['host'];
        $dbname = $configs['dbName'];
        $user = $configs['user'];
        $psw = $configs['psw'];
        $charset = $configs['charset'];
        try {
            $this->pdo = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=$charset",
                $user,
                $psw,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function insert($data){
        $columnArr = array_keys($data);
        $columns = implode(', ', $columnArr);
        $paramsArr = array_map(function($item){
            return ':'.$item;
        }, $columnArr);
        $params = implode(', ', $paramsArr);
        $query = "insert into " . $this->getTable() . " (" . $columns . ") values (" . $params . ")";

        $stmt = $this->pdo->prepare($query);
        return $stmt->execute($data);
    }
    public function update($id, $data)
    {
        $paramArr = [];
        foreach ($data as $key => $value) {
            $paramArr[] = $key . '=:' . $key;
        }
        $params = implode(', ', $paramArr);
        $query = "update " . $this->getTable() . " set " . $params . " where id=$id";

        $stmt = $this->pdo->prepare($query);
        return $stmt->execute($data);
    }
    public function last()
    {
        $query = "select * from " . $this->getTable() . " order by id desc limit 1";
        return $this->pdo->query($query)->fetch();
    }
    public function delete($id){
        $query = "delete from " . $this->getTable() . " where id=$id";
        return $this->pdo->prepare($query)->execute();
    }
    public function find($id){
        $query = "select * from " . $this->getTable() . " where id=$id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function first()
    {
        $query = "select * from " . $this->getTable() . " order by id asc limit 1";
        return $this->pdo->query($query)->fetch();
    }

    abstract public function getTable();

}