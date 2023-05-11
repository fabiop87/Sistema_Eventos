<?php

class conexao
{
    protected $_host = 'localhost';
    protected $_bd = 'eventosfaculdade';
    protected $_user = 'Josney';
    protected $_pass = 'sapatosalsicha';

    protected $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host={$this->_host};dbname={$this->_bd}", $this->_user, $this->_pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Calma que deu merda" . $e->getMessage();
        }
    }

    public function getPDO()
    {
        return $this->pdo;
    }
}

// tirar o getMessage depois 
