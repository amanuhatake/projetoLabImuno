<?php
include_once 'Pessoa.php';

class Usuario extends Pessoa {
    private $id;
    private $nomeSocial;
    private $cpf;
    private $tipoUsuario;
    private $registroProfissional;
    private $senha;
    private $status;
    private $permissaoAdmin;
    private $ultimoLogin;
    private $dataCadastro;

    public function __construct() {
        $this->status = 'ativo';
        $this->permissaoAdmin = false;
        $this->dataCadastro = date('Y-m-d H:i:s');
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNomeSocial() {
        return $this->nomeSocial;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getTipoUsuario() {
        return $this->tipoUsuario;
    }

    public function getRegistroProfissional() {
        return $this->registroProfissional;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getPermissaoAdmin() {
        return $this->permissaoAdmin;
    }

    public function getUltimoLogin() {
        return $this->ultimoLogin;
    }

    public function getDataCadastro() {
        return $this->dataCadastro;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setNomeSocial($nomeSocial) {
        $this->nomeSocial = $nomeSocial;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function setTipoUsuario($tipoUsuario) {
        $this->tipoUsuario = $tipoUsuario;
    }

    public function setRegistroProfissional($registroProfissional) {
        $this->registroProfissional = $registroProfissional;
    }

    public function setSenha($senha) {
        $this->senha = password_hash($senha, PASSWORD_DEFAULT);
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setPermissaoAdmin($permissaoAdmin) {
        $this->permissaoAdmin = $permissaoAdmin;
    }

    public function setUltimoLogin($ultimoLogin) {
        $this->ultimoLogin = $ultimoLogin;
    }

    public function setDataCadastro($dataCadastro) {
        $this->dataCadastro = $dataCadastro;
    }

    // Método para verificar senha
    public function verificarSenha($senha) {
        return password_verify($senha, $this->senha);
    }

    // Método para atualizar último login
    public function atualizarUltimoLogin() {
        $this->ultimoLogin = date('Y-m-d H:i:s');
    }

    public function __toString() {
        return parent::__toString() . 
            "\nID: {$this->id}" .
            "\nNome Social: {$this->nomeSocial}" .
            "\nCPF: {$this->cpf}" .
            "\nTipo de Usuário: {$this->tipoUsuario}" .
            "\nRegistro Profissional: {$this->registroProfissional}" .
            "\nStatus: {$this->status}" .
            "\nPermissão Admin: " . ($this->permissaoAdmin ? 'Sim' : 'Não') .
            "\nÚltimo Login: {$this->ultimoLogin}" .
            "\nData de Cadastro: {$this->dataCadastro}";
    }
}
?>