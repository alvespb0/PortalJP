<?php
include_once('navbar.php');
require_once('../controllers/controllerEmpresa.php');

use controllers\ControllerEmpresa;

$empresaController = new ControllerEmpresa();

$empresas = $empresaController->listaTodasEmpresas();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empresas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Cor de fundo leve */
        }
        .container {
            margin-top: 30px;
        }
        .table thead th {
            background-color: #003366; /* Azul escuro */
            color: #fff;
        }
        .table tbody tr:hover {
            background-color: #f0f0f0; /* Cor de fundo do hover */
        }
        .table td a {
            color: #003366; /* Azul escuro para links */
            text-decoration: none;
        }
        .table td a:hover {
            text-decoration: underline;
        }
        .input-group input[type="text"] {
            border-radius: 0;
        }
        .input-group-append .btn {
            border-radius: 0;
            background-color: #c8102e; /* Vermelho */
            color: #fff;
        }
        .input-group-append .btn:hover {
            background-color: #a00d1e; /* Vermelho escuro no hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mb-4 text-center" style="color: #003366;">Empresas Cadastradas</h2>
        
        <!-- Barra de Pesquisa -->
        <form action="" method="POST" class="mb-4">
            <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Pesquisar Empresa...">
                <div class="input-group-append">
                    <button class="btn" type="submit">Pesquisar</button>
                </div>
            </div>
        </form>

        <!-- Tabela de Empresas -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome da Empresa</th>
                    <th>CNPJ</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($empresas as $e){
                    echo "<tr>";
                    echo "<td><a href='details.php'?id=".urlencode($e->ID_Empresa)."'>".htmlspecialchars($e->nome_Empresa)."</a></td>";
                    echo "<td>".htmlspecialchars($e->CNPJ_Empresa)."</td>";
                    echo "<td>
                            <div class='row'>
                                <div class='col-md-6'>
                                    <form method='POST' action='' class='m-0'>
                                        <input type='hidden' name='delete_id' value='" . htmlspecialchars($e->ID_Empresa) . "'>
                                            <button type='submit' name='delete' class='btn btn-danger btn-sm w-100' style='background-color: #a40c1c; color: white; onclick='return confirm(\"Tem certeza que deseja excluir esta empresa?\");'>
                                            Excluir
                                        </button>
                                    </form>
                                </div>
                                <div class='col-md-6'>
                                    <form method='GET' action='edit.php' class='m-0'>
                                        <input type='hidden' name='ID_empresa' value='" . htmlspecialchars($e->ID_Empresa) . "'>
                                            <button type='submit' name='delete' class='btn btn-danger btn-sm w-100' style='background-color: #043464; color: white;);'>
                                            Editar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>";
                    echo "</tr>";
                } 
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>