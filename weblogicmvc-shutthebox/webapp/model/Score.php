<?php

use ActiveRecord\Model;

class Score extends Model{
    static $table_name = 'scores';
    
    static $belongs_to = array(
        array('user', 'class_name'=>'User')
    );

    
    // public static function registarScore($id){
    //     $score = new Score();
    //     $score->pontuacao = "preencher com a pontuacao";
    //     $score->dataJogo = date('d-m-Y H:i:s');
    //     $score->userid = $id;
    //     $pontuacao->save();
    // }
};