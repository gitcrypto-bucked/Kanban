<?php


namespace App\Models;
use \Facades\DB;
use \Facades\ObjectArray;


class Status  extends \Core\Model
{
    public static function find($id)
    {
        return DB::getInstance()->table(self::getTable())->where('uid', '=', $id)->get();
    }

    public static function all()
    {
        return DB::getInstance()->table(self::getTable())->order('id', 'ASC')->get();
    }


    public static function getTable()
    {
        return self::$table;
    }


    private static $table = 'status';
}