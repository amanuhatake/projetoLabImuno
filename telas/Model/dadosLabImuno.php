<?php
class DadosImuno extends paciente{
    private $nome;
    private $registro;
    private $lote;
    private $validade;

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getRegistro(){
        return $this->registro;
    }

    public function setRegistro($registro){
        $this->registro = $registro;
    }

    public function getLote(){
        return $this->lote;
    }

    public function setLote($lote){
        $this->lote = $lote;
    }

    public function getValidade(){
        return $this->validade;
    }

    public function setValidade($validade){
        $this->validade = $validade;
    }

    //toString
    public function __toString(){
        return "Nome: {$this->nome}, Registro: {$this->registro}, Lote: {$this->lote}, Validade: {$this->validade}";
    }

}


?>