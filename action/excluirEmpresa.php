<?php
namespace action;

require_once('../controllers/controllerEmpresa.php');
require_once('../controllers/controllerEmpresaImportacao.php');
require_once('../controllers/controllerEmpresaRecebimento.php');

use controllers\ControllerEmpresa;
use controllers\ControllerEmpresaImportacao;
use controllers\ControllerEmpresaRecebimento;

$controllerEmpresa = new ControllerEmpresa;
$controllerEmpresaRecebimento = new ControllerEmpresaRecebimento;
$controllerEmpresaImportacao = new ControllerEmpresaImportacao;

$ID_Empresa = $_GET['delete_id'];

$delEmpresaImp = $controllerEmpresaImportacao->deleteEmpresaImportacao($ID_Empresa);
$delEmpresaRec = $controllerEmpresaRecebimento->deleteEmpresaRecebimento($ID_Empresa);
$delEmpresa = $controllerEmpresa->deleteEmpresa($ID_Empresa);

if($delEmpresa && $delEmpresaImp && $delEmpresaRec){
    header("Location: ../view/list.php"); 
    exit;
}else{
    echo "falha ao excluir, contate Arthur";
}
?>