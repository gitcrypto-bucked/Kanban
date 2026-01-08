<?php


namespace database\migrations;

use \Facades\Config;
use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;
use Monolog\Formatter\JsonFormatter;
use \Core\Datatables;

class ProjetosMigration
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
                echo 'Table projetos already up'.PHP_EOL; die();;
            }

            $SQL = "CREATE TABLE `projetos` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `titulo` varchar(191) DEFAULT NULL,
                        `data_inicio` timestamp NULL DEFAULT NULL,
                        `status_id` int(11) DEFAULT NULL,
                        `grupo_id` int(11) DEFAULT NULL,
                        `descricao` text DEFAULT NULL,
                        `ativo` char(1) DEFAULT '0',
                        PRIMARY KEY (`id`)
                        ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci";

            if($conn->exec($SQL))
            {
                echo "Table projetos created..".PHP_EOL; exit();
            }
        }
        catch(\Exception $err)
        {
            $logger->error("failed: " . $err->getMessage()); die();
        }


    }

    private $logger;
}

#return ProjetosMigration::up();