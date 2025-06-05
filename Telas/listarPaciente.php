<?php 
if (isset($_GET['editar'])) {
    require_once 'controller/pacienteController.php';
}
?>

<div class="row">
    <div class="col">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Registro</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Data de Nascimento</th>
                    <th scope="col">Período</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                    require_once 'controller/pacienteController.php';
                    lista();
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
