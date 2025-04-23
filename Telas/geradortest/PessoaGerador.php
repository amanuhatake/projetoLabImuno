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
 }
?>