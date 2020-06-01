<?php 

class Tabuleiro{
    private $dado; // tipo Dado
    public $resultadoDado1; // int
    public $resultadoDado2; // int
    public $numerosBloqueadosP1; // NumerosBloqueados Player1
    public $numerosBloqueadosP2; // NumerosBloqueados Player2
    public $pontuacaoP1; // Pontuação Player1
    public $pontuacaoP2; // Pontuação Player2

    public function __construct() {
        $this->pontuacaoP1 = 45;
        $this->pontuacaoP2 = 45;
        $this->numerosBloqueadosP1 = new NumerosBloqueados();
        $this->numerosBloqueadosP2 = new NumerosBloqueados();
    }

    public function lancarDado(){
        // return void
        $this->dado = new Dado();
        $this->resultadoDado1 = $this->dado->lancarDado();
        $this->resultadoDado2 = $this->dado->lancarDado();
        $this->numerosBloqueadosP1->numerosSelecionados = array();
        $this->numerosBloqueadosP2->numerosSelecionados = array();
    }

    public function checkFinalJogadaP1($somaDados){
        if($this->numerosBloqueadosP1->checkFinalJogada($somaDados)){
            return true;
        }
        return false;
        // return booleano;
    }

    public function checkFinalJogadaP2($somaDados){
        if($this->numerosBloqueadosP2->checkFinalJogada($somaDados)){
            return true;
        }  
        return false;
        // return booleano;
    }

    public function setPontuacaoP1(){
        $this->pontuacaoP1 = $this->numerosBloqueadosP1->getPontuacao();
    }

    public function setPontuacaoP2(){
        $this->pontuacaoP2 = $this->numerosBloqueadosP2->getPontuacao();
    }

    public function getVencedor(){
        // return int;
    }
}

?>