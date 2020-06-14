<?php

use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;

class AuthController extends BaseController
{
    public function login(){
        $username = Post::get('username');
        $password = Post::get('password');

        // Ir buscar à base de dados o utilizador com o username inserido no login
        $user = User::find('all',array('conditions' => array('username=?', $username)));
        
        // Se esse user existir
        if($user != NULL){
            $user = $user[0];

            if($user->estado == 0){
                Redirect::toRoute('home/login');
            } else {
                // Validar password
                if(password_verify($password, $user->password)){
                    Session::set('user', $user);
                    
                    // Se for administrador -> Backoffice
                    if($user->administrador == 1)
                    {
                        Redirect::toRoute('home/backoffice');
                    } else {
                        Redirect::toRoute('home/index');
                    }
                    
                } else {
                    Redirect::toRoute('home/login');
                }
            }
            
        } else {
            Redirect::toRoute('home/login');
        }
    }

    // Logout -> destruir sessão de user
    public function logout(){
        session_destroy();
        Redirect::toRoute('home/index');
    }
}


?>