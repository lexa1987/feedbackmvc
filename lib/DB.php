<?php

namespace feedback\lib;

/**
 * Подключение к БД
 *
 * @author Lexa
 */
class DB
{
    protected $connection;
    
    function getConnection() {
        return $this->connection;
    }

        
    public function __construct($host, $user, $password, $db_name) 
    {
        try {
            $this->connection = new \PDO('mysql:host='.$host.';dbname='.$db_name, $user, $password);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
    
//    public function query($sql)
//    {
//        if ( !$this->connection ) {
//            return false;
//        }
//        
//        $result = $this->connection->query($sql);
//        
//        if ( is_bool($result) )
//        {
//            return $result;
//        }
//        
//        $data = [];
//        
//        while ($row = $result->fetch()) {
//            $data[] = $row;
//        }
//        
//        return $data;
//    }
    /**
     * Выполняет запрос
     * @param String $sql Запрос SQL
     * @param Array $sql_params Массив параметров. Типа ['param1, 'param2', ...]
     * @return Array Строки из БД в виде массивов
     */
    public function query($sql, $sql_params=null)
    {
        if ( !$this->connection ) {
            return false;
        }
        
        $sth = $this->connection->prepare($sql);
        
        if ( $sql_params ) {
            $execRes = $sth->execute($sql_params);
        } else {
            $execRes = $sth->execute();
        }
        
        if ( stripos($sql, 'select') !== FALSE ) {
            $result = $sth->fetchAll();
        } else {
            return $execRes;
        }
        
        if ( is_bool($result) ) {
            return $result;
        }
        
        $data = [];
        
        foreach ($result as $row) {
            $data[] = $row;
        }
        
        return $data;
    }
    
    public function beginTransaction() {
        $this->connection->beginTransaction();
    }
    
    public function commitTransaction() {
        $this->connection->commit();
    }
    
    public function rollbackTransaction() {
        $this->connection->rollBack();
    }
    
    public function getLastInsertId() {
        return $this->connection->lastInsertId();
    }
}
