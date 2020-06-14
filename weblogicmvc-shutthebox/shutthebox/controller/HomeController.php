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
        // Se um admin estiver logado -> Backoffice
        if (Session::has('user')) {
            $user = Session::get('user');

            if ($user->administrador == 1) {
                return Redirect::toRoute('home/backoffice');
            }
        }

        // Homepage
        return View::make('home.index');
    }

    public function login()
    {
        // Se um utilizador estiver logado, redirecionar para a home page
        if (!Session::has('user')) {
            return View::make('home.login');
        }
        return Redirect::toRoute('home/index');
    }

    public function registo()
    {
        // Se um utilizador estiver logado, redirecionar para a home page
        if (!Session::has('user')) {
            return View::make('user.create');
        }
        return Redirect::toRoute('home/index');
    }

    public function topten()
    {
        // Se um utilizador estiver logado e for admin -> Backoffice
        if (Session::has('user')) {
            $user = Session::get('user');
            if ($user->administrador == 1) {
                return Redirect::toRoute('home/backoffice');
            }
        }

        // Select à bd que devolve os 10 users com mais pontuação ordenados por ordem decrescente
        $scores = Score::find_by_sql('SELECT userID,SUM(pontuacao) AS pontuacao FROM `scores` GROUP BY userID ORDER BY pontuacao DESC LIMIT 10');

        // Subsitui o userID pelo username do utilizador
        foreach ($scores as $score){
            $user = User::find_by_id($score->userid);
            $score->userid = $user->username;
        }

        return View::make('home.top-ten', ['scores' => $scores]);
    }

    public function backoffice()
    {
        // Verificar existência de utilizador logado
        if (Session::has('user')) {
            $user = Session::get('user');

            // Verificar se utilizador logado é admin
            if ($user->administrador == 1) {
                $users = User::all();
                return View::make('home.backoffice', ['users' => $users]);
            } else {
                return Redirect::toRoute('home/index');
            }
        } else {
            return Redirect::toRoute('home/index');
        }
    }
}
