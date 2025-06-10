<<<<<<< HEAD
<?php
class Pessoa {
    private $nome;
    private $dataNascimento;
    private $telefone;
    private $email;

    // Getters
    public function getNome() {
        return $this->nomeCompleto;
    }

    public function getDataNascimento() {
        return $this->dataNascimento;
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

    public function setDataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
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
               Data de Nascimento: {$this->dataNascimento}
               Telefone: {$this->telefone} Email {$this->email}";
    }
}

?>
=======
    <?php
    class Pessoa {
        private $nomeCompleto;
        private $dataNascimento;
        private $telefone;
        private $email;

        // Getters
        public function getNomeCompleto() {
            return $this->nomeCompleto;
        }

        public function getDataNascimento() {
            return $this->dataNascimento;
        }

        public function getTelefone() {
            return $this->telefone;
        }

        public function getEmail() {
            return $this->email;
        }

        // Setters
        public function setNomeCompleto($nomeCompleto) {
            $this->nomeCompleto = $nomeCompleto;
        }

        public function setDataNascimento($dataNascimento) {
            $this->dataNascimento = $dataNascimento;
        }

        public function setTelefone($telefone) {
            $this->telefone = $telefone;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        // Método toString
        public function __toString() {
            return "{parent::__toString()}Nome Completo:  {$this->nomeCompleto}
                Data de Nascimento: {$this->dataNascimento}
                Telefone: {$this->telefone} Email {$this->email}";
        }
    }

    ?>
>>>>>>> 5f07110e631c1273ed3bafe74297a1b092bea77d
