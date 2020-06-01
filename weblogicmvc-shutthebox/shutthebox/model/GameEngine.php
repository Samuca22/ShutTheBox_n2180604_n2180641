<?php

class GameEngine
{
    public $tabuleiro; // TABULEIRO
    private $estadoJogo; // 1 - bloquear números; 2 - lançar os dados; 3 - final jogada.

    public function __construct()
    {
        $this->tabuleiro = new Tabuleiro();
        $this->estadoJogo = 2;
        $this->iniciarJogo();
    }

    public function iniciarJogo()
    {
        $this->pontuacaoP1 = 45;
        $this->pontuacaoP2 = 45;
    }

    public function getEstadoJogo()
    {
        return $this->estadoJogo;
    }

    public function updateEstadoJogo($estado)
    {
        $this->estadoJogo = $estado;
    }



    public function computadorJoga()
    {
        $this->tabuleiro->lancarDado();
        $somaDados = $this->tabuleiro->resultadoDado1 + $this->tabuleiro->resultadoDado2;
        $numerosDesbloqueados = $this->tabuleiro->numerosBloqueadosP2->getNumerosDesbloqueados();

        do {
            $combinacao = false;

            // Verifica se a soma de dois dos números desbloqueados é igual à soma de dados
            if (!$combinacao) {
                foreach ($numerosDesbloqueados as $desbloqueado) {
                    foreach ($numerosDesbloqueados as $desbloqueado2) {
                        if ($desbloqueado != $desbloqueado2) {
                            if ($desbloqueado + $desbloqueado2 == $somaDados) {
                                // Continua a jogar

                                $this->tabuleiro->numerosBloqueadosP2->bloquearNumero($desbloqueado, $somaDados);
                                $this->tabuleiro->numerosBloqueadosP2->bloquearNumero($desbloqueado2, $somaDados);
                                $this->tabuleiro->lancarDado();
                                $somaDados = $this->tabuleiro->resultadoDado1 + $this->tabuleiro->resultadoDado2;
                                $numerosDesbloqueados = $this->tabuleiro->numerosBloqueadosP2->getNumerosDesbloqueados();
                                $combinacao = true;
                            }
                        }
                    }
                }
            }


            // 4 é o número máximo de dígitos que podem ser somados para obter o valor máximo da soma de dados:  1+2+3+6 = 12 
            // Verifica se a soma de 4 dos números desbloqueados é igual à soma de dados
            if (!$combinacao) {
                foreach ($numerosDesbloqueados as $desbloqueado) {
                    foreach ($numerosDesbloqueados as $desbloqueado2) {
                        if ($desbloqueado != $desbloqueado2) {
                            foreach ($numerosDesbloqueados as $desbloqueado3) {
                                if ($desbloqueado != $desbloqueado3 && $desbloqueado2 != $desbloqueado3) {
                                    foreach ($numerosDesbloqueados as $desbloqueado4) {
                                        if ($desbloqueado != $desbloqueado4 && $desbloqueado2 != $desbloqueado4 && $desbloqueado3 != $desbloqueado4) {
                                            if ($desbloqueado + $desbloqueado2 + $desbloqueado3 + $desbloqueado4 == $somaDados) {
                                                // Continua a jogar

                                                $this->tabuleiro->numerosBloqueadosP2->bloquearNumero($desbloqueado, $somaDados);
                                                $this->tabuleiro->numerosBloqueadosP2->bloquearNumero($desbloqueado2, $somaDados);
                                                $this->tabuleiro->numerosBloqueadosP2->bloquearNumero($desbloqueado3, $somaDados);
                                                $this->tabuleiro->numerosBloqueadosP2->bloquearNumero($desbloqueado4, $somaDados);
                                                $this->tabuleiro->lancarDado();
                                                $somaDados = $this->tabuleiro->resultadoDado1 + $this->tabuleiro->resultadoDado2;
                                                $numerosDesbloqueados = $this->tabuleiro->numerosBloqueadosP2->getNumerosDesbloqueados();
                                                $combinacao = true;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            // Verifica se a soma de 3 dos números desbloqueados é igual à soma de dados
            if (!$combinacao) {
                foreach ($numerosDesbloqueados as $desbloqueado) {
                    foreach ($numerosDesbloqueados as $desbloqueado2) {
                        if ($desbloqueado != $desbloqueado2) {
                            foreach ($numerosDesbloqueados as $desbloqueado3) {
                                if ($desbloqueado != $desbloqueado3 && $desbloqueado2 != $desbloqueado3) {
                                    if ($desbloqueado + $desbloqueado2 + $desbloqueado3 == $somaDados) {
                                        // Continua a jogar

                                        $this->tabuleiro->numerosBloqueadosP2->bloquearNumero($desbloqueado, $somaDados);
                                        $this->tabuleiro->numerosBloqueadosP2->bloquearNumero($desbloqueado2, $somaDados);
                                        $this->tabuleiro->numerosBloqueadosP2->bloquearNumero($desbloqueado3, $somaDados);
                                        $this->tabuleiro->lancarDado();
                                        $somaDados = $this->tabuleiro->resultadoDado1 + $this->tabuleiro->resultadoDado2;
                                        $numerosDesbloqueados = $this->tabuleiro->numerosBloqueadosP2->getNumerosDesbloqueados();
                                        $combinacao = true;
                                    }
                                }
                            }
                        }
                    }
                }
            }


            // Verifica se algum dos números desbloqueados é igual à soma de dados
            if (!$combinacao) {
                foreach ($numerosDesbloqueados as $desbloqueado) {
                    if ($desbloqueado == $somaDados) {
                        // Continua a jogar

                        $this->tabuleiro->numerosBloqueadosP2->bloquearNumero($desbloqueado, $somaDados);
                        $this->tabuleiro->lancarDado();
                        $somaDados = $this->tabuleiro->resultadoDado1 + $this->tabuleiro->resultadoDado2;
                        $numerosDesbloqueados = $this->tabuleiro->numerosBloqueadosP2->getNumerosDesbloqueados();
                        $combinacao = true;
                    }
                }
            }
        } while ($this->tabuleiro->checkFinalJogadaP2($somaDados) == false && $combinacao == true);

        // Acabou a jogada
        return true;
    }
}
