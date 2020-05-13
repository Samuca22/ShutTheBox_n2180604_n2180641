<?php

use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\View;


class UserController extends BaseController implements \ArmoredCore\Interfaces\ResourceControllerInterface
{


    /**
     * index (default route)
     * Responds to HTTP: GET
     * Responds to REST: GET
     *
     * Returns a view with a list of the models
     *
     * @return Returns a view with a list of the models
     */
    public function index()
    {
        //$users = User::all();
        //return view::make('home.jogadores',compact('users'));
    }

    public function top10()
    {

        //$users = User::find('all', array('order' => 'vitorias desc'));
        //return view::make('home.top10',compact('users'));
    }
    /**
     * create
     * Responds to HTTP: GET
     * Responds to REST: GET
     *
     * Returns a view with a form to create a new model
     *
     * @return Returns a view with a form to create a new model
     */
    public function create()
    {
        // return View::make('home.index');
    }

    /**
     * store
     * Responds to HTTP: POST
     * Responds to REST: POST
     * Validate post data
     * if valid:
     * Save data from new model form
     * @return Returns a view with a list of the models
     *
     * if not valid:
     * Return form to client with data and validation errors
     */

    public function store()
    {
        $dados = Post::getAll();
        $dados['estado'] = 1;
        $dados['administrador'] = 0;
        $user = new User($dados);
        $pontuacao = new Pontuacao();
        // $pontuacao->vitorias = 0;
        // $pontuacao->derrotas = 0;
        // $pontuacao->nJogos = 0;

        if($user->is_valid() && $pontuacao->is_valid())
        {
            $user->save();
            $pontuacao->save();

            return View::make('home.login');
        }
        else
        {
            return View::make('home.registo');
        }
        


        //Tracy\debugger::barDump($dados);
        //$userfind = User::find('all',array('conditions' => array('username=?',$username)));
        /*
       Tracy\debugger::barDump(count($user));
       if (count($userfind) != 0)
        {

            return View::make('home.register', ['error' => 'O username já existe']);
        }

        $userfind = User::find('all',array('conditions' => array('email=?',$email)));
        if (count($userfind) != 0)
        {

            return View::make('home.register', ['error' => 'O email já existe']);
        }


        $user ->save();
*/
    }

    public function show($id)
    {

        //return View::make('home.jogadores', compact('users'));
    }

    public function edit($id)
    {
        /*
        $user = User::find($id);
        return View::make('home.edit', ['user' => $user]);
*/
    }

    public function update($id)
    {
        /*

        $dados = Post::getAll();
        $user = User::find($id);

        $user->update_attributes(array('nome' => $dados['nome']));
        $user->update_attributes(array('passsword' => password_hash($dados['passsword'], PASSWORD_DEFAULT)));
        $user->update_attributes(array('email' => $dados['email']));
        $user->update_attributes(array('dtanasc' => $dados['dtanasc']));





        return View::make('home.index');*/
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}
