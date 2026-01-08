<?php


namespace App\Controllers;
use App\Models\Dash as Model;
use \Core\Auth;

class Dash extends \Core\Controller
{
    public function indexAction()
    {
       $this->beforeExecute();
       if(!Auth::user()['admin'])
       {
            $projetos = Model::projetos(Auth::user()['id']);
            $atividades = Model::atividades(Auth::user()['id']);
            $done = Model::done(Auth::user()['id']);
       }
       else
       {
            $projetos = Model::projetos(null);
            $atividades = Model::atividades(null);
            $done = Model::done(null);
       }
       $dash = ['projetos'=> $projetos, 'atividades'=> $atividades, 'done'=> $done];
       \Core\View::renderTemplate('dash',@$dash, null);
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
