
<?php
class Pessoa {
    private $nome;
    private $Data_Nascimento;
    private $telefone;
    private $email;

    // Getters
    public function getNome() {
        return $this->nome;
    }

    public function getData_Nascimento() {
        return $this->Data_Nascimento;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getEmail() {
        return $this->email;
    }

    // Setters
    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setData_Nascimento($Data_Nascimento) {
        $this->Data_Nascimento = $Data_Nascimento;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    // Método toString
    public function __toString() {
        return "{parent::__toString()}Nome Completo:  {$this->nome}
               Data de Nascimento: {$this->Data_Nascimento}
               Telefone: {$this->telefone} Email {$this->email}";
    }
}

?>


