<?php 

class Dado{
    
    // Método que devolve um número aleatório de 1 a 6 -> valores de um dado
    public function lancarDado(){
        $numRand = rand(1, 6);
        return $numRand;
    } 
}


?>