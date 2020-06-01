<?php

use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\URL;
use ArmoredCore\WebObjects\View;

class GameController extends BaseController
{
    public function game()
    {
        if (Session::has('user')) {
            $user = Session::get('user');
            if ($user->administrador) {
                return Redirect::toRoute('home/backoffice');
            } else {
                if (!Session::has('game')) {

                    $game = new GameEngine();
                    Session::set('game', $game);
                }
            }
            return View::make('game.game');
        }
        return Redirect::toRoute('home/login');
    }

    public function lancarDados()
    {
        $game = Session::get('game');
        if ($game->getEstadoJogo() == 2) {
            $game->tabuleiro->lancarDado();
            $game->updateEstadoJogo(1);

            $somaDados = $game->tabuleiro->resultadoDado1 +  $game->tabuleiro->resultadoDado2;
            //$ultimaCombinacao1 = $game->tabuleiro->resultadoDado1;
            //$ultimaCombinacao2 = $game->tabuleiro->resultadoDado2;
            if ($game->tabuleiro->checkFinalJogadaP1($somaDados)) {
                $game->updateEstadoJogo(3);

                $game->computadorJoga();
                $game->tabuleiro->setPontuacaoP2();
                $game->tabuleiro->resultadoDado1 = $game->tabuleiro->resultadoDado1;
                $game->tabuleiro->resultadoDado2 = $game->tabuleiro->resultadoDado2;
            }
        }

        return Redirect::toRoute('game/game');
    }


    public function bloquearNumero($numero)
    {
        $game = Session::get('game');

        if ($game->getEstadoJogo() == 1) {
            $somaDados = $game->tabuleiro->resultadoDado1 +  $game->tabuleiro->resultadoDado2;

            if ($game->tabuleiro->numerosBloqueadosP1->bloquearNumero($numero, $somaDados)) {
                $game->updateEstadoJogo(1);
            } else {
                $game->updateEstadoJogo(2);
                $game->tabuleiro->setPontuacaoP1();
            }
        }

        return Redirect::toRoute('game/game');
    }
   
}
