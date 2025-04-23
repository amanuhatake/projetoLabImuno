<?php
class Pessoa{
private $nomeCompleto;
    private $dataNascimento;
    private $telefone;
    private $email;

    public function getNome(){
        return $this->nomeCompleto;
    }
    public function setNome($nomeCompleto){
        $this->nomeCompleto = $nomeCompleto;
    }
    public function getDataNascimento(){
        return $this->dataNascimento;
    }
    public function setDataNascimento($dataNascimento){
        $this->dataNascimento = $dataNascimento;
    }
    public function getTelefone(){
        return $this->telefone;
    }
    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
    }

    //toString
    public function __toString(){
    return "Pessoa: Nome Completo: {$this->nomeCompleto} Data de nascimento: {$this->dataNascimento}  Telefone para contato: {$this->telefone} Email: {$this->email} ";
    }
}
?>