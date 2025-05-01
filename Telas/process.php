<?php

if($_SERVER['REQUEST_METHOD']== 'POST'){
    
    $opcaoMicro = $_POST['RadioMicro'];
    $opcaoParasi = $_POST['RadioParasi'];
    $opcaoHemato = $_POST['RadioHemato'];
    $opcaoUrina = $_POST['RadioUrina'];
    $opcaoBio = $_POST['RadioBioquimica'];
    $opcaoJejum = $_POST['RadioJejum'];


    echo "Opção escolhida: $opcaoMicro</br>";
    echo "Opção parasitologia: $opcaoParasi</br>";
    echo "Opção Hematologia: $opcaoHemato</br>";
    echo "Opção Urina: $opcaoUrina</br>";
    echo "Opção Bioquimica: $opcaoBio</br>";
    echo "Opção Jejum: $opcaoJejum</br>";

}


?>



