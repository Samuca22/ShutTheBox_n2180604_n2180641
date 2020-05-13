<?php

use ActiveRecord\Model;

class Pontuacao extends Model{
    static $table_name = 'pontuacaos';
    
    static $belongs_to = array(
        array('user', 'class_name'=>'User')
    );

    public static function registarPontuacao($id){
        $pontuacao = new Pontuacao();
        $pontuacao->vitorias = 0;
        $pontuacao->derrotas = 0;
        $pontuacao->njogos = 0;
        $pontuacao->userid = $id;
        $pontuacao->save();
    }
};