<?php
 class Paciente extends Pessoa{
    private $registro;
    private $data;
    private $periodo;

    private $nomeMae;
    private $examesSolicitados;


    
    public function getRegistro(){
        return $this->registro;
    }
    public function setRegistro($registro){
        $this->registro = $registro;
    }
    public function getData(){
        return $this->data;
    }
    public function setData($data){
        $this->data = $data;
    }
    public function getPeriodo(){
        return $this->periodo;
    }
    public function setPeriodo($periodo){
        $this->periodo = $periodo;
    }
       public function getnomeMae(){
        return $this->nomeMae;
    }
    public function setnomeMae($nomeMae){
        $this->nomeMae = $nomeMae;
    }
    public function getExamesSolicitados(){
        return $this->examesSolicitados;
    }
    public function setExamesSolicitados($examesSolicitados){
        $this->examesSolicitados = $examesSolicitados;
    }
 //toString
 public function __toString(){
    return "{parent::__toString()}Pacientes - Registro: {$this->registro} Data: {$this->data} Periodo: {$this->periodo} Nome da mãe: {$this->nomeMae} Exames Solicitados: {$this->examesSolicitados}  ";
   }

 }
?>