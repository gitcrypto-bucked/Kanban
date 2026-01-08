<?php


namespace database\migrations;

use \Facades\Config;
use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;
use Monolog\Formatter\JsonFormatter;
use \Core\Datatables;

class SessionMigration
{
    public static function up()
    {
        Config::env();
        $conn = Datatables::getInstance()->getConnection();
        $logger = new Logger("Connection Error");
        $formatter = new JsonFormatter();

        $stream_handler = new StreamHandler("php://stdout");
        $stream_handler->setFormatter($formatter);
        $logger->pushHandler($stream_handler);

        try
        {
            $stmt = $conn->query("SELECT * FROM projetos ORDER BY id DESC LIMIT 1");
            $user = $stmt->fetchAll();

            if($user != false || !empty($user))
            {
                echo 'Table session already up'.PHP_EOL; die();;
            }

            $SQL = "CREATE TABLE `sessions` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `sessid` varchar(200) DEFAULT NULL,
                    `user_id` int(11) NOT NULL,
                    `user` varchar(200) DEFAULT NULL,
                    `data_criacao` timestamp NULL DEFAULT NULL,
                    `ativo` char(1) DEFAULT '0',
                    `uagent` text DEFAULT NULL,
                    PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";

            if($conn->exec($SQL))
            {
                echo "Table session created..".PHP_EOL; exit();
            }
        }
        catch(\Exception $err)
        {
            $logger->error("failed: " . $err->getMessage()); die();
        }


    }

    private $logger;
}

#return SessionMigration::up();