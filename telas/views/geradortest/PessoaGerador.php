<?php
 require_once 'pessoa';
 class PessoaGerador{
    private $pessoa;
    private $admLiberacao;
    private $exameLaboratorial;
    
    public function __construct($pessoa,$admLiberacao,$exameLaboratorial){
        $this->pessoa = $pessoa;
        $this->admLiberacao = $admLiberacao;
        $this->exameLaboratorial = $exameLaboratorial;
    }
    public function getPessoa(){
        return $this->pessoa;
    }
    public function setPessoa(){

        return $this->pessoa= $pessoa;
    }
    public function getExameLaboratorial(){
        return $this->exameLaboratorial;
    }
    public function setExameLaboratorial($exameLaboratorial){

        return $this->exameLaboratorial= $exameLaboratorial;
    }
    public function setAdmLiberacao($dmLiberacao){
        return $this->admLiberacao=$admLiberacao;
    }
    public function getAdmLiberacao(){
        return $this->admLiberacao;
    }
    public function __toString(){
        return "pessoa:{$this->pessoa->__toString()} adm:{$this->admLiberacao->__toString()}";
    }
 }
?>