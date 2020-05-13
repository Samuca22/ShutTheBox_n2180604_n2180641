<?php

use ActiveRecord\Model;

class Pontuacao extends Model{
    static $table_name = 'pontuacaos';
    
    static $belongs_to = array(
        array('user', 'class_name'=>'User')
    );
};