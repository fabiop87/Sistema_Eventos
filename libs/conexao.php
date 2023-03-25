<?php

class conexao
{
    protected $_host = 'localhost';
    protected $_bd = 'eventosfaculdade';
    protected $_user = 'fabio';
    protected $_pass = 'sapato';
    public $pdo;
    public function __construct()
    {
        try{
            $this->pdo = new PDO("mysql:host=$this->_host;dbname=$this->_bd", $this->_user, $this->_pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "deu ruim" . $e->getMessage();
        }
    }
}
