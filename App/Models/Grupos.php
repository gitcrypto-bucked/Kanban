<?php


namespace App\Models;
use \Facades\DB;
use \Facades\ObjectArray;

class Grupos  extends \Core\Model
{
    public static function find($id)
    {
        return DB::getInstance()->table(self::getTable())->where('id', '=', $id)->get();
    }

    public static function groupUsers($id)
    {
        return \App\Models\User::groupUsers($id);
    }

    public static function save($data)
    {
        return DB::getInstance()->table(self::getTable())->insert_last_ID($data);
    }

    public static function allPaginated(int $limit, $page = 0)
    {
        $reg =  DB::getInstance()->raw(' SELECT g.*, count(u.id) as usarios 
                                        FROM grupos as g 
                                        LEFT JOIN users as u ON g.id = u.grupo_id
                                        ');
        if(!empty($reg) && !in_array(null, $reg))
        {
             $pages = intval(intval(sizeof($reg)) / intval($limit));
        }
        else
        {
            $pages = 1;
        }

        $sql = 'SELECT g.*, count(u.id) as usarios 
                FROM grupos as g 
                LEFT JOIN users as u ON g.id = u.grupo_id
                ';

        if(is_null($page) || intval($page) ==1 || intval($page) == 0)
        {
              $sql.= " LIMIT 0, {$limit} ";
        }
        else
        {
            $till = ($page -1) * $limit;
            $sql.= " LIMIT {$till}, {$limit} ";
        }
        $items =  DB::getInstance()->raw($sql);
        #var_dump(ObjectArray::validArray($items), $items); exit;
        if(ObjectArray::validArray($items)!=false)
        {
           return  ['items'=>$items, 'pages'=>$pages];
        }    
        return  ['items'=>[], 'pages'=>$pages];
    
    }

    public static function update($id, $data)
    {
        return DB::getInstance()->table(self::getTable())->where('id', '=', $id)->update($data);
    }

    public static function delete($id)
    {
        return DB::getInstance()->table(self::getTable())->delete('id', '=', $id);
    }

    public static function gruposNonProjet()
    {
        return DB::getInstance()->raw('SELECT g.id, g.nome as name FROM grupos as g 
                                        LEFT JOIN projetos as p ON p.grupo_id=g.id 
                                        WHERE p.grupo_id IS NULL');

    }

    
     /**
     * Retorna o nome da tabela
     * @return string
     */
    public static function getTable()
    {
        return 'grupos';
    }
}