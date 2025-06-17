<?php

// --- CREATE / UPDATE ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $micro = $_POST['RadioMicro'];
    $parasi = $_POST['RadioParasi'];
    $hemato = $_POST['RadioHemato'];
    $urina = $_POST['RadioUrina'];
    $bio = $_POST['RadioBioquimica'];
    $jejum = $_POST['RadioJejum'];

    if (isset($_POST['id']) && $_POST['id'] != '') {
        // UPDATE
        $id = $_POST['id'];
        $conn->query("UPDATE exames SET 
            microbiologia='$micro', 
            parasitologia='$parasi', 
            hematologia='$hemato', 
            urina='$urina', 
            bioquimica='$bio', 
            jejum='$jejum' 
            WHERE id=$id");
    } else {
        // CREATE
        $conn->query("INSERT INTO exames (microbiologia, parasitologia, hematologia, urina, bioquimica, jejum)
            VALUES ('$micro', '$parasi', '$hemato', '$urina', '$bio', '$jejum')");
    }

    header("Location: index.php");
    exit();
}

// --- DELETE ---
if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    $conn->query("DELETE FROM exames WHERE id = $id");
    header("Location: index.php");
    exit();
}

// --- EDITAR ---
$edicao = false;
$registro = [
    'id' => '',
    'microbiologia' => '',
    'parasitologia' => '',
    'hematologia' => '',
    'urina' => '',
    'bioquimica' => '',
    'jejum' => ''
];

if (isset($_GET['editar'])) {
    $id = $_GET['editar'];
    $res = $conn->query("SELECT * FROM exames WHERE id = $id");
    $registro = $res->fetch_assoc();
    $edicao = true;
}

// --- READ (listar todos) ---
$registros = $conn->query("SELECT * FROM exames");
?>


