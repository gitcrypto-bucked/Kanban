<?php

namespace database;
include_once("../vendor/autoload.php");
include_once('../Facades/Config.php');
include_once('../Core/Datatables.php');

use \Facades\Config;
use \Core\Datatables;
use database\migrations\UserMigration;
use database\migrations\StatusMigration;
use database\migrations\GruposMigration;
use database\migrations\AtividadesMigration;
use database\migrations\SessionMigration;
use database\migrations\ProjetosMigration;



class Migration
{
    public static function start()
    {
        Config::env();
        $conn = self::getConnection();

        $db = getenv('DB_DATABASE');
        $SQL = "USE {$db}; ";

        try
        {
            $conn->exec($SQL);
        }
        catch(\Exception $err)
        {

        }
        finally
        {
            $SQL = "CREATE DATABASE {$db}";
            $conn->exec($SQL);
            $SQL = "USE {$db}; ";
            $conn->exec($SQL);

            UserMigration::up();
            StatusMigration::up();
            SessionMigration::up();
            ProjetosMigration::up();
            GruposMigration::up();
            AtividadesMigration::up();

            echo "Database {$db} created and migrations executed".PHP_EOL;
            die();
        }
         
    }

    private static function getConnection()
    {
        switch(trim(getenv('DB_CONNECTION')))
        {
            case 'mysql ': 
            case 'mysql':
               return  self::mysqlConn();
            break;
            case 'postgres':
                return self::postgresConn();
            break;          
            case 'sqlserver';
                return self::sqlserverConn();
            break;
        }
    }

    private static function mysqlConn()
    {
       try 
       {
            $dsn = 'mysql:host='.trim(getenv('DB_HOST')).';dbname=';
            $username = trim(getenv('DB_USERNAME'));
            $password = trim(getenv('DB_PASSWORD'));

            $pdo = new \PDO($dsn, $username, $password);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        catch (\PDOException $e) 
        {
            echo "Connection failed: " . $e->getMessage(); die('Connection failed');
        }
        return $pdo;
    }

    private static function sqlserverConn()
    {
       try 
       {
            $dsn = 'sqlsrv:Server='.trim(getenv('DB_HOST')).';Database=';
            $username = trim(getenv('DB_USERNAME'));
            $password = trim(getenv('DB_PASSWORD'));

            $pdo = new \PDO($dsn, $username, $password);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        catch (\PDOException $e) 
        {
            echo "Connection failed: " . $e->getMessage(); die('Connection failed');
        }
        return $pdo;
    }

    private static function postgresConn()
    {
       try 
       {
            $dsn = 'pgsql:host='.trim(getenv('DB_HOST')).';dbname=';
            $username = trim(getenv('DB_USERNAME'));
            $password = trim(getenv('DB_PASSWORD'));

            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        catch (\PDOException $e) 
        {
            echo "Connection failed: " . $e->getMessage(); die('Connection failed');
        }
        return $pdo;
    }
}
return Migration::start();