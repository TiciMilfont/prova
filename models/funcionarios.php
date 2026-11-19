<?php

    class Funcionario {
        public $nome;
        public $e_mail;
        public $salario;

        public function

        __construct($nome, $e_mail, $salario){

            $this-> nome = $nome ;
            $this -> e_mail = $e_mail;
               $this -> salario = $salario;

        }

        public function exibirStatus(){
            return[
                "nome" => $this -> nome ,
                "e_mail" => $this -> e_mail ,
                "salario" => $this -> salario 
            ];

        }
        
    }