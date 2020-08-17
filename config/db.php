<?php
class Database{
//////==========> SESSÃO DE ACESSO AO BANCO DE DADOS
    private $host = "localhost";
    private $db_name = "api_db";
    private $username = "tf";
    private $password = "Sys7f@intrA";
    public $pdo;
  
//////==========> CONEXÃO COM A BASE DE DADOS VIA PDO
    public function getConnection(){
  
        $this->pdo = null;
  
        try{
            $this->pdo = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->pdo->exec("set names utf8");
        }
    
     catch(PDOException $exception){
     	echo "Connection error: " . $exception->getMessage();
     }
  
          return $this->pdo;
    }
}
?>
