<?php
include_once("Config.php");
include_once("Model.php");
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Origin: *');
$model = new Model();


init();


function init() {

    switch($_SERVER['REQUEST_METHOD'])
    {
        case 'POST':
            if(!empty($_POST))
            {
                if(isset($_POST['fn']) & $_POST['fn']=='new')
                {
                    global $model;
                    if($model->insert(' projetos ', '(titulo, tarefa, dataHoraCadastro, todo, ongoing, done, gone)',
                                  '( ? , ? , ? , ? , ? , ? , ? )' , 
                                  [$_POST['titulo'], $_POST['tarefa'] ,date("H:i d-M-Y") , $_POST['todo'], $_POST['ongoing'],$_POST['done'],$_POST['gone']  ] ))
                    {
                        echo 202; exit;
                    }

                }
            }
            if(empty($_POST))
            {
                $_POST =  json_decode(file_get_contents('php://input'), true);
                if(isset($_POST['fn']) & $_POST['fn']=='update')
                {
                    switch($_POST['status'])
                    {
                        case 'todo':
                             $_POST['todo'] ='1';
                             $_POST['ongoing'] ='0';
                             $_POST['done'] ='0';
                             $_POST['gone'] ='0';
                        break;
                        case 'ongoing':
                             $_POST['todo'] ='0';
                             $_POST['ongoing'] ='1';
                             $_POST['done'] ='0';
                             $_POST['gone'] ='0';
                        break;
                        case 'done':
                             $_POST['todo'] ='0';
                             $_POST['ongoing'] ='0';
                             $_POST['done'] ='1';
                             $_POST['gone'] ='0';
                        break;
                        case 'gone':
                             $_POST['todo'] ='0';
                             $_POST['ongoing'] ='0';
                             $_POST['done'] ='0';
                             $_POST['gone'] ='1';
                        break;
                    }
                     global $model;
                    if($model->update(' projetos ', 'todo=?, ongoing=? , done=? ,gone=?', ' uid=? ', 
                                      [$_POST['todo'] , $_POST['ongoing'], $_POST['done'] , $_POST['gone'], $_POST['uid'] ]))
                    {
                        echo 202; exit;
                    }
                }
            
            }
          
        break;
        case 'GET':
            global $model;
        break;
    }
}



?>