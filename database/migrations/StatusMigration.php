<?php


namespace database\migrations;

use \Facades\Config;
use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;
use Monolog\Formatter\JsonFormatter;
use \Core\Datatables;

class StatusMigration
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
            $stmt = $conn->query("SELECT * FROM status ORDER BY id DESC LIMIT 1");
            $user = $stmt->fetchAll();

            if($user != false || !empty($user))
            {
                echo 'Table projetos status up'.PHP_EOL; die();;
            }

            $SQL = "CREATE TABLE `status` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `status` varchar(191) NOT NULL,
                    PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci";

            if($conn->exec($SQL))
            {
                echo "Table status created..".PHP_EOL; exit();
            }
        }
        catch(\Exception $err)
        {
            $logger->error("failed: " . $err->getMessage()); die();
        }


    }

    private $logger;
}

#return StatusMigration::up();