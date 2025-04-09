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



?>

