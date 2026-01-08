<?php


namespace App\Models;
use \Facades\DB;


class Kanban  extends \Core\Model
{
    public static function find($id)
    {
        return DB::getInstance()->table(self::getTable())->where('uid', '=', $id)->get();
    }

    public static function save($data)
    {
        return DB::getInstance()->table(self::getTable())->insert($data);
    }

    public static function all($userID)
    {
        return DB::getInstance()->table(self::getTable())->where('todo', '=', '1')
                                                         ->whereOr('ongoing', '=', '1')
                                                         ->whereOr('done', '=', '1')
                                                         ->where('userID', '=', $userID)
                                                         ->get();
    }

     /**
     * Retorna o nome da tabela
     * @return string
     */
    public static function getTable()
    {
        return 'projetos';
    }
}