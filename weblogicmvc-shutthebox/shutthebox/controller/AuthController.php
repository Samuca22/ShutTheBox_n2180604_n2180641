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

        $user = User::find('all',array('conditions' => array('username=?', $username)));
        

        if($user != NULL){
            $user = $user[0];

            if($user->estado == 0){
                Redirect::toRoute('home/login');
            } else {

                if(password_verify($password, $user->password)){
                    Session::set('user', $user);

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

    public function logout(){
        session_destroy();
        Redirect::toRoute('home/index');
    }
}


?>