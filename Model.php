<?php
require_once('Config.php');
require_once('Database.php');

class Model extends Database
{
    public function __construct()
    {
        $this->connect();
    }

    public function __destruct()
    {
        $this->disconnect();
    }
    
    protected function connect()
    {
        $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
        try 
        {
            $this->conn = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);
        } 
        catch (\PDOException $e) 
        {
            throw new \Exception($e->getMessage(), $e->getCode());
            exit;
        }
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    protected function disconnect()
    {
        $this->conn = null;
    }

    public function insert($table, $fields, $values, array $params)
    {
        $SQL ='INSERT INTO '.$table.' '.$fields.' VALUES '.$values;
        $stmt = $this->conn->prepare($SQL);
        if($stmt->execute($params)==true)
        {
            return true;
        }
        else return false;
    }

    public function getAll($table,  $params='*', $order='', $limit='')
    {
       $SQL = 'SELECT ';
       $SQL.= strlen($params) ? $params : ' * ';
       $SQL.= ' FROM '.$table;
       $SQL.= strlen($order) ? ' ORDER BY '.$order : '';
       $SQL.= strlen($limit) ? ' Limit'.$limit : '';

        $stmt = $this->conn->query($SQL);
        $result =  $stmt ->fetchAll(\PDO::FETCH_ASSOC);       
        return $result;
    }

    public function get($table,  $params='*', $where='' ,$order='', $limit='')
    {
        $SQL = 'SELECT ';
        $SQL.= strlen($params) ? $params : ' * ';
        $SQL.= ' FROM '.$table;
        $SQL.= strlen($where) ? ' WHERE '.$where : '';
        $SQL.= strlen($order) ? ' ORDER BY '.$order : '';
        $SQL.= strlen($limit) ? ' Limit'.$limit : '';
        $stmt = $this->conn->query($SQL);
        $result =  $stmt ->fetchAll(\PDO::FETCH_ASSOC);       
        return $result;
    }
    
    public function update($table, $fileds, $where, array $params)
    {
        $SQL='UPDATE '.$table.' SET '.$fileds.' WHERE '.$where;
        $stmt = $this->conn->prepare($SQL);  
        if($stmt->execute($params)==true)
        {
            return true;
        }
        else return false;
    }


    private $conn;

}
?>