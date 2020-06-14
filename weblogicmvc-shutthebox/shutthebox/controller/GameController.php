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
        // Se um utilizador estiver logado
        if (Session::has('user')) {
            $user = Session::get('user');
            // Se for admin -> Backoffice
            if ($user->administrador) {
                return Redirect::toRoute('home/backoffice');
            } else {
                // Se nenhum jogo estiver adicionado, iniciar jogo.
                if (!Session::has('game')) {

                    $game = new GameEngine();
                    Session::set('game', $game);
                }
            }
            return View::make('game.game');
        }

        // Se não estiver logado, redirecionar para o login
        return Redirect::toRoute('home/login');
    }

    public function lancarDados()
    {
        // Se o estado do jogo for 2 -> lançarDados, pode lançar dados.
        $game = Session::get('game');
        if ($game->getEstadoJogo() == 2) {
            $game->tabuleiro->lancarDado();

            // Após lançar dados alterar estado para 1 -> bloquear Números
            $game->updateEstadoJogo(1);

            // Verificar se há combinações com os números desbloqueados para a soma de dados (verificar fim de jogo)
            $somaDados = $game->tabuleiro->resultadoDado1 + $game->tabuleiro->resultadoDado2;
            if ($game->tabuleiro->checkFinalJogadaP1($somaDados)) {
                
                // Atualizar para estado 3 -> computador a jogar. 
                $game->updateEstadoJogo(3);

                $game->computadorJoga();
                $game->tabuleiro->setPontuacaoP2();

                $this->registarScore();
                return Redirect::toRoute('game/resultado');
            }
        }

        return Redirect::toRoute('game/game');
    }


    public function bloquearNumero($numero)
    {
        $game = Session::get('game');

        // Se o estado do jogo for 1 -> bloquear numeros
        if ($game->getEstadoJogo() == 1) {
            $somaDados = $game->tabuleiro->resultadoDado1 +  $game->tabuleiro->resultadoDado2;

            // Verificar se os números bloqueados já coincidem com a soma dos dados
            if ($game->tabuleiro->numerosBloqueadosP1->bloquearNumero($numero, $somaDados)) {
                // Se não
                $game->updateEstadoJogo(1);
            } else {
                // Se sim
                $game->updateEstadoJogo(2);
                $game->tabuleiro->setPontuacaoP1();
            }
        }

        return Redirect::toRoute('game/game');
    }
   
    public function resultado()
    {
        return View::Make('game/resultado');
    }

    public function novoJogo(){
        if(Session::has('game')){
            unset($_SESSION['game']);
            return Redirect::toRoute('game/game');
        }
    }

    public function sairJogo(){
        if(Session::has('game')){
            unset($_SESSION['game']);
            return Redirect::toRoute('home/index');
        }
    }

    // Registar pontuações na base de dados
    public function registarScore(){
        $game = Session::get('game');
        $user = Session::get('user');

        $score = new Score();
        $score->userid = $user->id;
        $score->datajogo = date("Y-m-d h:i:sa");
        if($game->tabuleiro->getVencedor())
        {
            $score->pontuacao = $game->tabuleiro->getPontuacaoVencedor();
            $score->resultado = 1;
        } else {
            $score->pontuacao = 0;
            $score->resultado = 0;
        }

        $score->save();
    }
}
