<?php

class GameEngine
{
    public $tabuleiro; // TABULEIRO
    private $estadoJogo; // 1 - bloquear números; 2 - lançar os dados; 3 - final jogada.

    public function __construct()
    {
        $this->tabuleiro = new Tabuleiro();
        // inicia o estado de jogo a 2 (lançar dados)
        $this->estadoJogo = 2;
    }

    // Devolve o estado do jogo -> 1, 2, 3
    public function getEstadoJogo()
    {
        return $this->estadoJogo;
    }

    // Atualiza o estado do jogo
    public function updateEstadoJogo($estado)
    {
        $this->estadoJogo = $estado;
    }


    // Lógia de jogo para computador
    public function computadorJoga()
    {
        $this->tabuleiro->lancarDado();
        $somaDados = $this->tabuleiro->resultadoDado1 + $this->tabuleiro->resultadoDado2;
        $numerosDesbloqueados = $this->tabuleiro->numerosBloqueadosP2->getNumerosDesbloqueados();
        do {
            // Variável que verifica se alguma combinação já foi encontrada.
            $combinacao = false;


            // Verifica a possibilidade de combinação entre 2 números
            if (!$combinacao) {
                foreach ($numerosDesbloqueados as $desbloqueado) {
                    foreach ($numerosDesbloqueados as $desbloqueado2) {
                        if ($desbloqueado != $desbloqueado2) {
                            if ($desbloqueado + $desbloqueado2 == $somaDados) {

                                $this->tabuleiro->numerosBloqueadosP2->bloquearNumero($desbloqueado, $somaDados);
                                $this->tabuleiro->numerosBloqueadosP2->bloquearNumero($desbloqueado2, $somaDados);
                                $this->tabuleiro->lancarDado();
                                $somaDados = $this->tabuleiro->resultadoDado1 + $this->tabuleiro->resultadoDado2;
                                $numerosDesbloqueados = $this->tabuleiro->numerosBloqueadosP2->getNumerosDesbloqueados();
                                $combinacao = true;
                                // Continua a jogar
                            }
                        }
                    }
                }
            }


            // 4 é o número máximo de dígitos que podem ser somados para obter o valor máximo da soma de dados:  1+2+3+6 = 12 
            // Verifica a possibilidade de combinação entre 4 números
            if (!$combinacao) {
                foreach ($numerosDesbloqueados as $desbloqueado) {
                    foreach ($numerosDesbloqueados as $desbloqueado2) {
                        if ($desbloqueado != $desbloqueado2) {
                            foreach ($numerosDesbloqueados as $desbloqueado3) {
                                if ($desbloqueado != $desbloqueado3 && $desbloqueado2 != $desbloqueado3) {
                                    foreach ($numerosDesbloqueados as $desbloqueado4) {
                                        if ($desbloqueado != $desbloqueado4 && $desbloqueado2 != $desbloqueado4 && $desbloqueado3 != $desbloqueado4) {
                                            if ($desbloqueado + $desbloqueado2 + $desbloqueado3 + $desbloqueado4 == $somaDados) {

                                                $this->tabuleiro->numerosBloqueadosP2->bloquearNumero($desbloqueado, $somaDados);
                                                $this->tabuleiro->numerosBloqueadosP2->bloquearNumero($desbloqueado2, $somaDados);
                                                $this->tabuleiro->numerosBloqueadosP2->bloquearNumero($desbloqueado3, $somaDados);
                                                $this->tabuleiro->numerosBloqueadosP2->bloquearNumero($desbloqueado4, $somaDados);
                                                $this->tabuleiro->lancarDado();
                                                $somaDados = $this->tabuleiro->resultadoDado1 + $this->tabuleiro->resultadoDado2;
                                                $numerosDesbloqueados = $this->tabuleiro->numerosBloqueadosP2->getNumerosDesbloqueados();
                                                $combinacao = true;
                                                // Continua a jogar
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            // Verifica a possibilidade de combinação entre 3 números
            if (!$combinacao) {
                foreach ($numerosDesbloqueados as $desbloqueado) {
                    foreach ($numerosDesbloqueados as $desbloqueado2) {
                        if ($desbloqueado != $desbloqueado2) {
                            foreach ($numerosDesbloqueados as $desbloqueado3) {
                                if ($desbloqueado != $desbloqueado3 && $desbloqueado2 != $desbloqueado3) {
                                    if ($desbloqueado + $desbloqueado2 + $desbloqueado3 == $somaDados) {

                                        $this->tabuleiro->numerosBloqueadosP2->bloquearNumero($desbloqueado, $somaDados);
                                        $this->tabuleiro->numerosBloqueadosP2->bloquearNumero($desbloqueado2, $somaDados);
                                        $this->tabuleiro->numerosBloqueadosP2->bloquearNumero($desbloqueado3, $somaDados);
                                        $this->tabuleiro->lancarDado();
                                        $somaDados = $this->tabuleiro->resultadoDado1 + $this->tabuleiro->resultadoDado2;
                                        $numerosDesbloqueados = $this->tabuleiro->numerosBloqueadosP2->getNumerosDesbloqueados();
                                        $combinacao = true;
                                        // Continua a jogar
                                    }
                                }
                            }
                        }
                    }
                }
            }


            // Verifica a possibilidade de combinação com um número
            if (!$combinacao) {
                foreach ($numerosDesbloqueados as $desbloqueado) {
                    if ($desbloqueado == $somaDados) {

                        $this->tabuleiro->numerosBloqueadosP2->bloquearNumero($desbloqueado, $somaDados);
                        $this->tabuleiro->lancarDado();
                        $somaDados = $this->tabuleiro->resultadoDado1 + $this->tabuleiro->resultadoDado2;
                        $numerosDesbloqueados = $this->tabuleiro->numerosBloqueadosP2->getNumerosDesbloqueados();
                        $combinacao = true;
                        // Continua a jogar
                    }
                }
            }

            // Computador acaba de jogar após se verificar final de jogada no modelo tabuleiro e se não obteve nenhuma combinação na última iteração
        } while ($this->tabuleiro->checkFinalJogadaP2($somaDados) == false && $combinacao == true);

        // Acabou a jogada
        return true;
    }
}
