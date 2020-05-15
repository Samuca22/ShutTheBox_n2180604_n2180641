<?php

use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;
use ArmoredCore\WebObjects\Session;


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
        if (!Session::has('user')) {
            return View::make('home.registo');
        }
        return Redirect::toRoute('home/index');
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
        // Receber dados via post
        $dados = Post::getAll();

        // Definir campos padrão (user)
        $dados['estado'] = 1;
        $dados['administrador'] = 0;

        // Criar novo user
        $user = new User($dados);
        
        if($user->is_valid())
        {
            // Salvar user na bd
            $user->save();

            Redirect::toRoute('home/index');
        }
        else
        {
            return Redirect::flashToRoute('user/create', ['user' => $user]);
        }
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
