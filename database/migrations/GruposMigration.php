<?php


namespace database\migrations;

use \Facades\Config;
use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;
use Monolog\Formatter\JsonFormatter;
use \Core\Datatables;

class GruposMigration
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
            $stmt = $conn->query("SELECT * FROM grupos ORDER BY id DESC LIMIT 1");
            $user = $stmt->fetchAll();

            if($user != false || !empty($user))
            {
                echo 'Table grupos already up'.PHP_EOL; die();;
            }

            $SQL = "CREATE TABLE `grupos` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `descricao` text NOT NULL,
                        `codigo` varchar(60) DEFAULT NULL,
                        `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
                        `ativo` char(1) DEFAULT '0',
                        `nome` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NOT NULL,
                        PRIMARY KEY (`id`),
                        UNIQUE KEY `nome` (`nome`),
                        UNIQUE KEY `codigo` (`codigo`)
                        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

            if($conn->exec($SQL))
            {
                echo "Table grupos created..".PHP_EOL; exit();
            }
        }
        catch(\Exception $err)
        {
            $logger->error("failed: " . $err->getMessage()); die();
        }


    }

    private $logger;
}

#return GruposMigration::up();