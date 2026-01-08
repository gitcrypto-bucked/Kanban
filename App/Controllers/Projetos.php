<?php


namespace App\Controllers;
use App\Models\Projetos as Model;
use \Core\Auth;
use \Facades\Redirect;

class Projetos extends \Core\Controller
{
    public function indexAction()
    {
       $this->beforeExecute();
       $projetos = Model::rawPaginated(8, @$request['page']);
       \Core\View::renderTemplate('projetos',['projetos'=>$projetos], null);
    }


    function addProjeto($request)
    {
        $this->beforeExecute();
        $grupos = \App\Models\Grupos::gruposNonProjet(); //group without project
        $status = \App\Models\Status::all();
        \Core\View::renderTemplate('add_projetos',['grupos'=> $grupos,'status'=>$status], null);
    }

    function newProjeto($request)
    {
        $insert = [
            'titulo' => $request['name'],
            'descricao' => $request['descricao'],
            'ativo' => '1',
            'grupo_id' => $request['grupos'],
            'status_id'=> $request['status'],
            'data_inicio' =>date('Y-m-d H:i:s')
        ];

        Model::save($insert);
        echo json_encode(['status'=>202,'msg'=>'Projeto criado com sucesso']);

    }

    function Action($request)
    {
        $fn  =$request['fn'];
        $id = base64_decode($request['id']);

        switch($fn)
        {
            case 'view':
                
            break;
             
            case 'edit':
                $projeto = Model::find($id); //find group per id
                $idGrupo = $projeto[0]['grupo_id']; 
                $grupo = \App\Models\Grupos::find($idGrupo); //users in group
                $free = \App\Models\Grupos::gruposNonProjet(); //group without project
                $status = \App\Models\Status::all();
                \Core\View::renderTemplate('projetos.edit', ['projeto'=>$projeto[0],'grupo'=>$grupo,'free'=>$free,'status'=>$status],null);  
            break;

            case 'delete':
            break;    
        }
    }


    function Update($request)
    {
        var_dump($request);
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