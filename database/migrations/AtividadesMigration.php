<?php


namespace database\migrations;

use \Facades\Config;
use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;
use Monolog\Formatter\JsonFormatter;
use \Core\Datatables;

class AtividadesMigration
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
            $stmt = $conn->query("SELECT * FROM atividades ORDER BY uid DESC LIMIT 1");
            $user = $stmt->fetchAll();

            if($user != false || !empty($user))
            {
                echo 'Table atividades already up'.PHP_EOL; die();;
            }

            $SQL = "CREATE TABLE `atividades` (
                    `uid` int(11) NOT NULL AUTO_INCREMENT,
                    `titulo` varchar(50) NOT NULL,
                    `tarefa` varchar(100) NOT NULL,
                    `dataHoraCadastro` varchar(50) NOT NULL DEFAULT '',
                    `todo` char(1) DEFAULT '0',
                    `ongoing` char(1) DEFAULT '0',
                    `done` char(1) DEFAULT '0',
                    `gone` char(1) DEFAULT '0',
                    `userID` int(11) DEFAULT NULL,
                    `comentarios` mediumtext DEFAULT NULL,
                    `git` varchar(191) DEFAULT NULL,
                    `aproved` char(1) DEFAULT '0',
                    `projetos_id` tinyint(4) NOT NULL,
                    PRIMARY KEY (`uid`)
                    ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

            if($conn->exec($SQL))
            {
                echo "Table atividades created..".PHP_EOL; exit();
            }
        }
        catch(\Exception $err)
        {
            $logger->error("failed: " . $err->getMessage()); die();
        }


    }

    private $logger;
}

#return AtividadesMigration::up();