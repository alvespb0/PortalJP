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
    <link rel="stylesheet" href="css/detail.css">
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
                <a href="../action/baixarArquivo.php?id=<?php echo $ID_Empresa; ?>" class="baixar">Baixar Arquivos</a>
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

