<?php


namespace App\Models;
use \Facades\DB;

class User  extends \Core\Model
{
    public static function login($username, $password)
    {
        return DB::getInstance()->table('users')->where('email', '=', $username)->where('active', '=','1')->get();
    }

    public static function find($id)
    {
        return DB::getInstance()->table(self::getTable())->where('id', '=', $id)->get();
    }

    public static function save($id, $data)
    {
        return DB::getInstance()->table(self::getTable())->where('id', '=', $id)->update($data);
    }

    public static function all()
    {
        return DB::getInstance()->table(self::getTable())->order('id', 'ASC')->get();
    }

    public static function allPaginated($limit, $page =0)
    {
         return DB::getInstance()->table(self::getTable())->order('id', 'ASC')->paginate($limit, $page);
    }

    public static function delete($id)
    {
        return DB::getInstance()->table(self::getTable())->delete('id', '=', $id);
    }

    public static function usersNonGroup()
    {
                return DB::getInstance()->raw("SELECT id, name 
                            From users where grupo_id IS NULL 
                            OR grupo_id = '' ");

    }

    public static function groupUsers($id)
    {
        return DB::getInstance()->select(['id','name'])->table(self::getTable())->where('grupo_id', '=', $id)->get();
    }

    public static function freeUsers($id)
    {
        return DB::getInstance()->raw("SELECT id, name From users where grupo_id IS NULL OR grupo_id = '' OR grupo_id != $id");
    }


    public static function removeGroup($id, $data)
    {
         return DB::getInstance()->table(self::getTable())->where('grupo_id', '=', $id)->update($data);
    }
 

     /**
     * Retorna o nome da tabela
     * @return string
     */
    public static function getTable()
    {
        return 'users';
    }
}
