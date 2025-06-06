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