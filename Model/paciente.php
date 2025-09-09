<?php
include_once 'Pessoa.php';

class Paciente extends Pessoa {
    private $registro;
    private $data;
    private $periodo;
    private $nomeMae;
   

    public function getRegistro() {
        return $this->registro;
    }

    public function setRegistro($registro) {
        $this->registro = $registro;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getPeriodo() {
        return $this->periodo;
    }

    public function setPeriodo($periodo) {
        $this->periodo = $periodo;
    }

    public function getNomeMae() {
        return $this->nomeMae;
    }

    public function setNomeMae($nomeMae) {
        $this->nomeMae = $nomeMae;
    }


    public function __toString() {
        return parent::__toString() . ", Registro: {$this->registro}, Data: {$this->data}, Período: {$this->periodo}, Nome da Mãe: {$this->nomeMae}";
    }
}
?>
