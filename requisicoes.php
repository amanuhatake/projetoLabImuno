<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($_POST['nome'])){
      echo"<p> Nome da mãe: <br> ". $_POST['mae']."!!";
    }
}elseif($_SERVER["REQUEST_METHOD"] == "GET"){
    echo "Solicitação inválida! <br>";
}

if (preg_match('/[0-9]', $nome)){
    echo "Erro, o nome não pode conter números";
}else{
    echo "Nome válido";
    
}

function validarTelefone($telefone){
    $padrao = '/^z(?\d{2}\)?\s?\d{4,5}-\d{4}$/ ';

    return preg_match($padrao, $telefone);
}




?>

