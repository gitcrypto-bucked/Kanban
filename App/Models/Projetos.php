<?php


namespace App\Models;
use \Facades\DB;
use \Facades\ObjectArray;


class Projetos  extends \Core\Model
{
    public static function find($id)
    {
        return DB::getInstance()->table(self::getTable())->where('id', '=', $id)->get();
    }

    public static function allPaginated($limit, $page =0)
    {
         return DB::getInstance()->table(self::getTable())->order('id', 'ASC')->paginate($limit, $page);
    }

    public static function save($data)
    {
        return DB::getInstance()->table(self::getTable())->insert($data);
    }


    public static function rawPaginated(int $limit, $page = 0)
    {
        $reg =  DB::getInstance()->raw(' SELECT p.*, g.nome as grupo FROM projetos as p 
                                         JOIN grupos as g ON g.id = p.grupo_id
                                      ');
        if(!empty($reg) && !in_array(null, $reg))
        {
             $pages = intval(intval(sizeof($reg)) / intval($limit));
        }
        else
        {
            $pages = 1;
        }

        $sql = 'SELECT p.*, g.nome FROM projetos as p 
                 JOIN grupos as g ON g.id = p.grupo_id
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

     static function getTable()
    {
        return 'projetos';
    }
}