<?php
include_once 'Pessoa.php';

class Paciente extends Pessoa {
    private $registro;
    private $data;
    private $periodo;
    private $nomeMae;
    private $examesSolicitados;

    private $medicamento;
    private $medicamentoNome;
    private $patologia;

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

    public function getExamesSolicitados() {
        return $this->examesSolicitados;
    }

    public function setExamesSolicitados($examesSolicitados) {
        $this->examesSolicitados = $examesSolicitados;
    }

    public function getMedicamento() {
        return $this->medicamento;
    }

    public function setMedicamento($medicamento) {
        $this->medicamento = $medicamento;
    }

    public function getMedicamentoNome() {
        return $this->medicamentoNome;
    }

    public function setMedicamentoNome($medicamentoNome) {
        $this->medicamentoNome = $medicamentoNome;
    }

    public function getPatologia() {
        return $this->patologia;
    }

    public function setPatologia($patologia) {
        $this->patologia = $patologia;
    }

    public function __toString() {
        return parent::__toString() . ", Registro: {$this->registro}, Data: {$this->data}, Período: {$this->periodo}, Nome da Mãe: {$this->nomeMae}, Medicamento: {$this->medicamento}, Nome Medicamento: {$this->medicamentoNome}, Exames Solicitados: {$this->examesSolicitados}";
    }
}
?>
