
        <?php
        class Pessoa {
            private $nome;
            private $Data_Nascimento;
            private $telefone;
            private $email;

            private $Sexo;

            
            public function getNome() {
                return $this->nome;
            }

            public function getSexo() {
                return $this->Sexo;
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

            
            public function setNome($nome) {
                $this->nome = $nome;
            }

            public function setSexo($Sexo) {
                $this->Sexo = $Sexo;
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

            public function __toString() {
            return "Nome Completo: {$this->nome}\n" .
                "Sexo: {$this->Sexo}\n" .
                "Data de Nascimento: {$this->Data_Nascimento}\n" .
                "Telefone: {$this->telefone}\n" .
                "Email: {$this->email}";
        }

        }

        ?>


