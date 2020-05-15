<?php

use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;

/**
 * Created by PhpStorm.
 * User: smendes
 * Date: 09-05-2016
 * Time: 11:30
 */
class HomeController extends BaseController
{

    public function index()
    {
        if(Session::has('user')){
            $user = Session::get('user');

            if($user->administrador == 1){
                return Redirect::toRoute('home/backoffice');
            }
        }
        return View::make('home.index');
    }

    public function login()
    {
        if (!Session::has('user')) {
            return View::make('home.login');
        }
        return Redirect::toRoute('home/index');
    }

    public function registo()
    {
        if (!Session::has('user')) {
            return View::make('home.registo');
        }
        return Redirect::toRoute('home/index');
    }

    public function topten()
    {
        if(Session::has('user'))
        {
            $user = Session::get('user');
            if($user->administrador == 1){
                return Redirect::toRoute('home/backoffice');
            }
        }
        return View::make('home.top-ten');
    }

    public function game()
    {
        if(Session::has('user')){
            $user = Session::get('user');
            if($user->administrador){
                return Redirect::toRoute('home/backoffice');
            }
            return View::make('home.game');
        } 
        return Redirect::toRoute('home/login');
    }

    public function backoffice()
    {
        // Verificar existência de utilizador logado
        if (Session::has('user')) {
            $user = Session::get('user');

            // Verificar se utilizador logado é admin
            if ($user->administrador == 1) {
                return View::make('home.backoffice');
            } else {
                return Redirect::toRoute('home/index');
            }
        } else {
            return Redirect::toRoute('home/index');
        }
    }
}
