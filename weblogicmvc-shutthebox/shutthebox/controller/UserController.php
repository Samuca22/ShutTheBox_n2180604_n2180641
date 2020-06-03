<?php

use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
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
        return View::make('user.registo');
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
        $username = Post::get('username');
        $email = Post::get('email');

        // Definir campos padrão (user)
        $dados['estado'] = 1;
        $dados['administrador'] = 0;

        // Criar novo user
        $user = new User($dados);
        
        // $findUsername = User::find_by_username($username);
        // if(count($findUsername) != 0)
        // {
        //     return Redirect::flashToRoute('user/create', ['user' => $user]);
        // }

        // $findEmail = User::find_by_email($email);
        // if(count($findEmail) != 0)
        // {
        //     return Redirect::flashToRoute('user/create', ['user' => $user]);
        // }

        if($user->is_valid())
        {
            // Salvar user na bd
            $user->save();

            Session::set('user', $user);

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
        $user = User::find($id);
        return View::make('user.definicoes', ['user' => $user]);
    }

    // public function definicoes()
    // {
    //     return View::make('user.definicoes');
    // }

    public function update($id)
    {
        $user = User::find($id);
        $dados = Post::getAll();

        $user->update_attributes(Post::getAll());
        $user->update_attributes(array('password' => password_hash($dados['password'], PASSWORD_DEFAULT)));

        if($user->is_valid())
        {
            $user->save();

            Session::set('user', $user);

            Redirect::toRoute('home/index');
        }
        else
        {
            Redirect::flashToRoute('user/edit', ['user' => $user], $id);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function block($id)
    {
        $user = User::find($id);

        if($user != Session::get('user')){
            if($user->estado == 0){
                $user->estado = 1;
            } else {
                $user->estado = 0;
            }
    
            $user->save();
        }
        
        return Redirect::toRoute('home/backoffice');
    }

    public function destroy($id){

    }
}
