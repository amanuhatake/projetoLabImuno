<?
require_once 'Paciente.php';
require_once 'Pessoa.php';
require_once 'Adm.php';

$opcao;

do{
    echo("Escolha uma opção");
    echo("1 - Cadastro Pessoa");
    echo("2 - Cadastro Paciente");
    echo("3 - Logar ADM");
    echo("4 - Sair");
    scanf("%d", $numero);
    switch(opcao){
        case 1:
            $p = new Pessoa;
            $p->setNomeCompleto("Joana");
            $p->setDataNascimento("21/06/2004");
            $p->setTelefone("998703517");
            $p->setEmail("ana@gmail.com");
            echo("Pessoa cadastrada com sucessop");
            break;

        case 2:
            $paciente = new Paciente; 
            $p->setRegistro("251JQK121");
            $p->setData("25/04/2025");
            $p->setPeriodo("Noturno");
            $p->setNomeMae("Lucia");
            $p->setExamesSOlicitados("Covid");
            break;
        
        case 3:
            $Adm - new Adm;
            $p->seLoguin("Preceptora@gmail.com");
            $p->setSenha("123");
            break;
        
        case 4:
            echo("Você saiu do menu!");
            break;
        
        default:
          echo("Erro! Tente novamente...");    
    }

}while(opcao !=0){
  echo("FIM");
}

?>