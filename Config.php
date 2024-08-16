<?php
declare(strict_types=1);
ini_set('allow_url_fopen','1');
date_default_timezone_set('America/Sao_Paulo');
define("ROOT", dirname(__DIR__,1).DIRECTORY_SEPARATOR);  
header("Access-Control-Allow-Origin: *");


class Config
{

    const DOMAIN = 'http://localhost';

    const FOLDER ='kanban';

    const URL = self::DOMAIN.'/'.self::FOLDER;
    
    const DATABASE_DRIVER ='mysql';

    const DB_HOST ='127.0.0.1';

    const DB_NAME ='kanban';

    const DB_USER ='root';

    const DB_PASSWORD ='fast9002';

    const RESULTS_PER_PAGE = 18;
}