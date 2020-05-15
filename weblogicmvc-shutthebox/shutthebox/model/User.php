<?php

use ActiveRecord\Model;

class User extends Model
{
    static $before_create = array('applyHASH');

    public function applyHASH()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    // VALIDAÇÕES
    // static $validates_presence_of = array(
    //     array('primeironome', 'message' => 'Preenchimento Obrigatório')
    // );
};
