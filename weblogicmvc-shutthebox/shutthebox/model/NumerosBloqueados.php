<?php

class NumerosBloqueados
{
    public $numBlock; // array - atributo PRIVATE
    public $numerosSelecionados; // array


    public function __construct()
    {
        $this->numerosSelecionados = array();
        $this->numBlock = array(1 => false, 2 => false, 3 => false, 4 => false, 5 => false, 6 => false, 7 => false, 8 => false, 9 => false);
    }


    public function bloquearNumero($numeroSelecionado, $somaDados)
    {
        // Se número estiver desbloqueado
        if ($this->numBlock[$numeroSelecionado] == false) {
            // bloqueia
            array_push($this->numerosSelecionados, $numeroSelecionado);
            $this->numBlock[$numeroSelecionado] = true;
        } else {
            // desbloqueia
            $this->numBlock[$numeroSelecionado] = false;


            $index = array_search($numeroSelecionado, $this->numerosSelecionados);
            $this->numerosSelecionados[$index] = 0;
        }

        if ($somaDados == array_sum($this->numerosSelecionados)) {
            $this->numerosSelecionados = array();
            return false;
        }
        return true;
    }


    public function checkFinalJogada(/*array$numerosSelecionados, */$somaDados)
    {
        $numerosDesbloqueados = array();
        $arrayKeys = array_keys($this->numBlock);

        // Obter o valor das chaves = $numerosDesbloqueados
        for ($i = 1; $i <= sizeof($this->numBlock); $i++) {
            if ($this->numBlock[$i] == false) {
                array_push($numerosDesbloqueados, $arrayKeys[$i - 1]);
            }
        }

        // Verifica se algum dos números desbloqueados é igual à soma de dados
        foreach ($numerosDesbloqueados as $desbloqueado) {
            if ($desbloqueado == $somaDados) {
                // Continua a jogar
                return false;
            }
        }


        // Verifica se a soma de dois dos números desbloqueados é igual à soma de dados
        foreach ($numerosDesbloqueados as $desbloqueado) {
            foreach ($numerosDesbloqueados as $desbloqueado2) {
                if ($desbloqueado != $desbloqueado2) {
                    if ($desbloqueado + $desbloqueado2 == $somaDados) {
                        // Continua a jogar
                        return false;
                    }
                }
            }
        }


        // Verifica se a soma de 3 dos números desbloqueados é igual à soma de dados
        foreach ($numerosDesbloqueados as $desbloqueado) {
            foreach ($numerosDesbloqueados as $desbloqueado2) {
                if ($desbloqueado != $desbloqueado2) {
                    foreach ($numerosDesbloqueados as $desbloqueado3) {
                        if ($desbloqueado != $desbloqueado3 && $desbloqueado2 != $desbloqueado3) {
                            if ($desbloqueado + $desbloqueado2 + $desbloqueado3 == $somaDados) {
                                // Continua a jogar
                                return false;
                            }
                        }
                    }
                }
            }
        }

        // 4 é o número máximo de dígitos que podem ser somados para obter o valor máximo da soma de dados:  1+2+3+6 = 12 
        // Verifica se a soma de 4 dos números desbloqueados é igual à soma de dados
        foreach ($numerosDesbloqueados as $desbloqueado) {
            foreach ($numerosDesbloqueados as $desbloqueado2) {
                if ($desbloqueado != $desbloqueado2) {
                    foreach ($numerosDesbloqueados as $desbloqueado3) {
                        if ($desbloqueado != $desbloqueado3 && $desbloqueado2 != $desbloqueado3) {
                            foreach ($numerosDesbloqueados as $desbloqueado4) {
                                if ($desbloqueado != $desbloqueado4 && $desbloqueado2 != $desbloqueado4 && $desbloqueado3 != $desbloqueado4) {
                                    if ($desbloqueado + $desbloqueado2 + $desbloqueado3 + $desbloqueado4 == $somaDados) {
                                        // Continua a jogar
                                        return false;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        // Acabou a jogada
        return true;
    }


    public function getNumerosDesbloqueados(){
        $numerosDesbloqueados = array();
        $arrayKeys = array_keys($this->numBlock);

        // Obter o valor das chaves = $numerosDesbloqueados
        for ($i = 1; $i <= sizeof($this->numBlock); $i++) {
            if ($this->numBlock[$i] == false) {
                array_push($numerosDesbloqueados, $arrayKeys[$i - 1]);
            }
        }

        return $numerosDesbloqueados;
    }


    public function getPontuacao()
    {
        $numerosDesbloqueados = array();
        $arrayKeys = array_keys($this->numBlock);

        // Obter o valor das chaves = $numerosDesbloqueados
        for ($i = 1; $i <= sizeof($this->numBlock); $i++) {
            if ($this->numBlock[$i] == false) {
                array_push($numerosDesbloqueados, $arrayKeys[$i - 1]);
            }
        }
        
        return array_sum($numerosDesbloqueados);
    }
}
