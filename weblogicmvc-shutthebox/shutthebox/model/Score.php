<?php

use ActiveRecord\Model;

class Score extends Model{
    static $table_name = 'scores';
    
    static $belongs_to = array(
        array('user', 'class_name'=>'User')
    );
};