<?php


namespace App\Models;
use \Facades\DB;


class Dash  extends \Core\Model
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

    public static function projetos($userID = null)
    {
        if(!is_null($userID))
        { 
            $SQL = "SELECT count(p.id) as total from projetos as p
                    JOIN grupos as g on g.id = p.grupo_id
                    LEFT JOIN users as u on u.grupo_id = g.id
                    WHERE u.id = {$userID}
                    ";
        }        
        else
        {
            $SQL = "SELECT count(p.id) as total from projetos as p
                    JOIN grupos as g on g.id = p.grupo_id
                    LEFT JOIN users as u on u.grupo_id = g.id
                    ";
        } 
        
        return DB::getInstance()->raw($SQL);
    }

    public static function atividades($userID = null)
    {
        if(!is_null($userID))
        { 
            $SQL = "SELECT count(a.uid) as total from atividades as a
                    JOIN projetos as p ON a.projetos_id = p.id
                    JOIN grupos as g on g.id = p.grupo_id
                    LEFT JOIN users as u on u.grupo_id = g.id
                    WHERE u.id= {$userID}
                    ";
        }        
        else
        {
            $SQL = "SELECT count(a.uid) as total from atividades as a
                    JOIN projetos as p ON a.projetos_id = p.id
                    JOIN grupos as g on g.id = p.grupo_id
                    LEFT JOIN users as u on u.grupo_id = g.id
                    ";
        } 
        
        return DB::getInstance()->raw($SQL);
    }

    public static function done($userID)
    {
        if(!is_null($userID))
        { 
            $SQL = "SELECT count(a.uid) as total from atividades as a
                    JOIN projetos as p ON a.projetos_id = p.id
                    JOIN grupos as g on g.id = p.grupo_id
                    LEFT JOIN users as u on u.grupo_id = g.id
                    WHERE a.done <>'0' AND a.userID= {$userID}
                    ";
        }        
        else
        {
            $SQL = "SELECT count(a.uid) as total from atividades as a
                    JOIN projetos as p ON a.projetos_id = p.id
                    JOIN grupos as g on g.id = p.grupo_id
                    LEFT JOIN users as u on u.grupo_id = g.id
                    WHERE a.done <>'0'";
        } 
        
        return DB::getInstance()->raw($SQL);
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