<?php
class Adm extends Pessoa{
   private $loguin;
   private $senha;

   public function getLoguin(){
    return $this->loguin;
}
public function setLoguin($loguin){
    $this->loguin = $loguin;
}

public function getSenha(){
    return $this->senha;
}
public function setSenha($senha){
    $this->senha = $senha;
}
public function __toString(){
    return "{parent::__toString()} Loguin: {$this->loguin} Senha {$this->senha}";
}
}
?>