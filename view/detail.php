<?php
include_once('navbar.php');
require_once('../controllers/controllerEmpresa.php');
require_once('../controllers/controllerEmpresaImportacao.php');
require_once('../controllers/controllerEmpresaRecebimento.php');

use controllers\ControllerEmpresa;
use controllers\ControllerEmpresaImportacao;
use controllers\ControllerEmpresaRecebimento;

$controllerEmpresa = new ControllerEmpresa;
$controllerEmpresaRecebmento = new ControllerEmpresaRecebimento;
$controllerEmpresaImportacao = new ControllerEmpresaImportacao;

$ID_Empresa = $_GET['id'];

$empresa = $controllerEmpresa->listaEmpresaById($ID_Empresa); #array 
$formasImportacao = $controllerEmpresaImportacao->listaImportacoes($ID_Empresa); #array
$subFormasRecebimento = $controllerEmpresaRecebmento->listaSubformasRecebimento($ID_Empresa); #array

$resultado = $controllerEmpresaRecebmento->listaEmpresaRecebimento($ID_Empresa);
foreach($resultado as $r){
    $ID_SubForma = $r->ID_SubFormaRecebimento;
}
$formaRecebimento = $controllerEmpresaRecebmento->listaFormasRecebimento($ID_SubForma); #string
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Empresa</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 30px;
            max-width: 900px; /* Limita a largura total da página */
        }
        h1, h3 {
            color: #003366;
        }
        .card {
            margin-bottom: 20px;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
        }
        .card h3 {
            border-bottom: 2px solid #c8102e;
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-size: 1.5rem;
        }
        .card p {
            font-size: 1rem;
            color: #555555;
        }
        ul {
            list-style-type: none; /* Remove os pontos da lista */
            padding-left: 0;
        }
        ul li {
            margin-bottom: 5px; /* Espaço entre os itens */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-5">Detalhes da Empresa</h1>
        
        <!-- Informações da Empresa -->
        <div class="card">
            <div class="card-body">
                <h3><?php foreach($empresa as $e){ echo $e->nome_Empresa;?></h3>
                <p><strong>CNPJ:</strong> <?php echo  $e->CNPJ_Empresa; ?></p>
                <p><strong>Endereço:</strong> <?php echo  $e->endereco_Empresa; }?></p>
            </div>
        </div>

        <!-- Formas de Importação -->
        <div class="card">
            <div class="card-body">
                <h3>Formas de Importação</h3>
                <ul>
                    <?php foreach($formasImportacao as $fi) {
                        foreach($fi as $formasImp) {
                            echo "<li>" . $formasImp->Tipo_FormaImportacao . "</li>";
                        }
                    } ?>
                </ul>
            </div>
        </div>

        <!-- Links -->
        <div class="card">
            <div class="card-body">
                <h3>Links</h3>
                <p><?php foreach($empresa as $e){ echo $e->links_Empresa;}?></p>
            </div>
        </div>

        <!-- Forma de Recebimento -->
        <div class="card">
            <div class="card-body">
                <h3>Forma de Recebimento</h3>
                <p><?php echo $formaRecebimento; ?></p>
                <h4 class="mt-4">Subformas de Recebimento</h4>
                <ul>
                    <?php foreach($subFormasRecebimento as $sub) {
                        echo "<li>" . $sub . "</li>";
                    } ?>
                </ul>
            </div>
        </div>

        <!-- Particularidades -->
        <div class="card">
            <div class="card-body">
                <h3>Particularidades</h3>
                <p><?php foreach($empresa as $e){ echo $e->particularidades;}?></p>
            </div>
        </div>
        
        <!-- Observações -->
        <div class="card">
            <div class="card-body">
                <h3>Observações</h3>
                <p><?php foreach($empresa as $e){ echo $e->observacoes;}?></p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

