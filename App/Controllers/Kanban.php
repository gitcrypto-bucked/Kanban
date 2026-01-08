<?php


namespace App\Controllers;
use App\Models\Kanban as Model;
use \Core\Auth;

class Kanban extends \Core\Controller
{
    public function indexAction()
    {
       $this->beforeExecute();
       $kanban = Model::all(Auth::user()['id']);
       \Core\View::renderTemplate('kanban',$kanban, null);
    }

    public function toDO($request)
    {
        $request['dataHoraCadastro'] = date('Y-m-d H:i:s');
        Model::save($request);
        http_response_code(202);
        echo 202; 
        exit()  ; 
    }

    protected function beforeExecute(): void
	{
        if(!\Core\Auth::logged())
        {
             header('Location: '.url('login'));
        }
	}

	protected function afterExecute(): void
	{
		
	}
}
