<?php

use ActiveRecord\Model;

class User extends Model
{
    static $before_create = array('applyHASH');

    public function applyHASH()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    
    // VALIDAÇÕES ** NOTA: Atualmente as validações são feitas para que o site nao se ""PARTA"", faltam mostrar as mesnagens de erro na página => echo $user->errors->on('nome do campo') **
        static $validates_presence_of = array(
            array('primeironome', 'message' => 'Preenchimento obrigatório.'),
            array('apelido', 'message' => 'Preenchimento obrigatório.'),
            array('username', 'message' => 'Preenchimento obrigatório.'),
            array('password', 'message' => 'Preenchimento obrigatório.'),
            array('datanascimento', 'message' => 'Preenchimento obrigatório.')
        );

        static $validates_length_of= array(
            array('password', 'minimum' => 4, 'too_short' => 'A password tem que conter no mínimo 6 caracteres.'),   // Verifica se a password contém no mínimo 6 caracteres
            array('username', 'within' => array(4, 16), 'message' => 'O username tem que conter entre 4 a 16 caracteres.'),   // Verifica se o username contém no mínimo 4 caracteres
            array('primeironome', 'maximum' => 60, 'too_long' => 'Número de caracteres máximo excedido.'),          // Verifica se o primeiroNome tem menos que 100 caracteres (maximo determinado no Script SQL)
            array('apelido', 'maximum' => 60, 'too_long' => 'Número de caracteres máximo excedido.')                // Verifica se o apelido tem menos que 100 caracteres (maximo determinado no Script SQL)
        );

        
        // static $validates_uniqueness_of = array(
        //     array('username', 'message' => 'O username inserido já existe.'),  // Valida se o username já existe
        //     array('email', 'message' => 'O email inserido já existe.')      // Valida se o email já existe
        // );
        
        // Utiliza REGEX -> preg_match() para comparar strings
        static $validates_format_of = array(
            array('email', 'with' => '/^[^0-9][a-z0-9_]+([.][a-z0-9_]+)*[@][a-z0-9_]+([.][a-z0-9_]+)*[.][a-z]{2,4}$/', 'message' => 'Inválido. Preencher campo com um email válido.'),  // Verifica se o campo é preenchido com um email
            array('password', 'with' => '/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/', 'message' => 'Password fraca. Por favor escolha uma password com pelo menos 6 caracteres, incluindo letras maiúsculas, minúsculas, números e caracteres especiais.')
        );
    
    
};

/* EMAIL REGEX antigo:

 /^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/ --> aceita letras maiusculas (REGEX antigo)

 EAMIL REGEX atualizado:
 /^[^0-9][a-z0-9_]+([.][a-z0-9_]+)*[@][a-z0-9_]+([.][a-z0-9_]+)*[.][a-z]{2,4}$/ --> não aceita quaisquer letras maiusculas (REGEX NOVO)

 // TESTAR REGEX no site => https://regex101.com/
 */