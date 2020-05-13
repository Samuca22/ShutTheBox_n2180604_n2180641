<?php

use ActiveRecord\Model;

class User extends Model {

    static $before_create = array('applyHASH');

    public function applyHASH() {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }
};
