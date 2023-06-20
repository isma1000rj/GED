<?php

require('adodb/adodb.inc.php'); // biblioteca do adodb
require('funcoes.php');

class conexao {
    public $servidorSql = "mysqli";
    public $servidor = 'localhost';
    public $usuario = 'root';
    public $senha = '';
    public $banco;
    public $baseDados = 'ged';

    public function __construct() {
        $this->banco = NewADOConnection($this->servidorSql);
        $this->banco->dialect = 3;
        $this->banco->debug = false;
        $this->banco->Connect($this->servidor, $this->usuario, $this->senha, $this->baseDados);
    }
}

$conecta = new conexao();




?>