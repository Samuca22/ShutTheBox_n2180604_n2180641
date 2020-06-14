<?php 

class Tabuleiro{
    private $dado; // tipo Dado
    public $resultadoDado1; // int
    public $resultadoDado2; // int
    public $numerosBloqueadosP1; // NumerosBloqueados Player1
    public $numerosBloqueadosP2; // NumerosBloqueados Player2
    public $pontuacaoP1; // Pontuação Player1
    public $pontuacaoP2; // Pontuação Player2

    // Inicia o jogo com pontuações a 45
    public function __construct() {
        $this->pontuacaoP1 = 45;
        $this->pontuacaoP2 = 45;
        $this->numerosBloqueadosP1 = new NumerosBloqueados();
        $this->numerosBloqueadosP2 = new NumerosBloqueados();
    }

    // Lança os dois dados e "dá" reset no array de numerosSelecionados do modelo NumerosBloqueados.
    public function lancarDado(){
        $this->dado = new Dado();
        $this->resultadoDado1 = $this->dado->lancarDado();
        $this->resultadoDado2 = $this->dado->lancarDado();
        $this->numerosBloqueadosP1->numerosSelecionados = array();
        $this->numerosBloqueadosP2->numerosSelecionados = array();
    }

    // Verifica se o player1 após lançar os dados pode continuar a jogar
    public function checkFinalJogadaP1($somaDados){
        if($this->numerosBloqueadosP1->checkFinalJogada($somaDados)){
            return true;
        }
        return false;
    }

    // Verifica se o player2 após lançar os dados pode continuar a jogar
    public function checkFinalJogadaP2($somaDados){
        if($this->numerosBloqueadosP2->checkFinalJogada($somaDados)){
            return true;
        }  
        return false;
    }

    // Atualiza a pontuação do player1
    public function setPontuacaoP1(){
        $this->pontuacaoP1 = $this->numerosBloqueadosP1->getPontuacao();
    }

    // Atualiza a pontuação do player2
    public function setPontuacaoP2(){
        $this->pontuacaoP2 = $this->numerosBloqueadosP2->getPontuacao();
    }

    // Devolve o vencedor
    public function getVencedor(){
        if($this->pontuacaoP1 < $this->pontuacaoP2)
        {
            // Utilizador Vence
            return true;
        } else {
            // Computador Vence
            return false;
        }
    }

    // Devolve a pontuação do vencedor.
    public function getPontuacaoVencedor(){
        $pontuacao = $this->pontuacaoP2 - $this->pontuacaoP1;
        return $pontuacao;
    }
}

?>