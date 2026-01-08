<?php


namespace App\Controllers;
use App\Models\Grupos as Model;
use \Core\Auth;
use \Facades\Redirect;

class Grupos extends \Core\Controller
{
    public function indexAction()
    {
       $this->beforeExecute();
       $grupos = Model::allPaginated(8, @$request['page']);
       \Core\View::renderTemplate('grupos',['grupos'=> $grupos], null);
    }


    function addGrupo($request)
    {
        $this->beforeExecute();
        $users = \App\Models\User::usersNonGroup(); //users without group
        \Core\View::renderTemplate('add_group',['users'=> $users], null);
    }

    function newGrupo($request)
    {
        $insert = [
            'nome' => $request['name'],
            'descricao' => $request['descricao'],
            'codigo' => md5(time()),
            'ativo' => '1',
            'created_at' =>date('Y-m-d H:i:s')
        ];

        $id = Model::save($insert);

        $users = explode(',', $request['users']);
        for($i =0 ; $i <sizeof($users); $i++)
        {
           \App\Models\User::save($users[$i],['grupo_id'=>$id]);
        }  
        
        echo json_encode(['status'=>202,'msg'=>'Grupo criado com sucesso']);
    }

    function Action($request)
    {
        $fn  =$request['fn'];
        $id = base64_decode($request['id']);
        switch($fn)
        {
            case 'edit':
                $grupo = Model::find($id); //find group per id
                $users = Model::groupUsers($id); //users in group
                $free = \App\Models\User::freeUsers($id); //users not in group
                \Core\View::renderTemplate('grupos.edit', ['grupo'=>$grupo[0],'users'=>$users,'free'=>$free],null);            
            break;
            case 'delete':
                if(!isset($_GET['status']))
                {
                        \Core\View::renderTemplate('templates/prompt', ['yes'=>\Facades\Redirect::url('/grupos/delete/'.$request['id'].'?status=yes'),
                                                                'no'=>\Facades\Redirect::url('dash'),
                                                                'text'=>'Esta ação não pode ser desfeita. Por favor, confirme para prosseguir.'
                                                            ],null);
                }
                if(isset($_GET['status']) && $_GET['status']=='yes')
                {
                    if(Model::delete($id))
                    {
                        \App\Models\User::removeGroup($id,['grupo_id'=>NULL]);
                        Redirect::with('success', 'Grupo excluido com sucesso');
                        return Redirect::to('/grupos');
                    }
                    else
                    {
                        Redirect::with('error','Erro ao excluir o  usuário');
                        return Redirect::to('/grupos');
                    }
                }  
            break;
        }
    }


    function update($request)
    {
        $id = $request['id'];
        $data = [
            'nome' => $request['name'],
            'descricao' => $request['descricao'],
            'ativo' => '1',
            'created_at' =>date('Y-m-d H:i:s')
        ];

        Model::update($id, $data);
        $users = explode(',', $request['users']);
        for($i =0 ; $i <sizeof($users); $i++)
        {
           \App\Models\User::save($users[$i],['grupo_id'=>$id]);
        }

        $rm = explode(',', $request['remove']);
        for($i =0 ; $i <sizeof($rm); $i++)
        {
           \App\Models\User::save($rm[$i],['grupo_id'=>null]);
        }


        echo json_encode(['status'=>202,'msg'=>'Grupo atualizado com sucesso']);
  
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
