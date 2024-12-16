<?php
namespace action;

require_once('../controllers/controllerEmpresa.php');
require_once('../controllers/controllerEmpresaImportacao.php');
require_once('../controllers/controllerEmpresaRecebimento.php');
require_once('../controllers/controllerParticularidades.php');

use controllers\ControllerEmpresa;
use controllers\ControllerEmpresaImportacao;
use controllers\ControllerEmpresaRecebimento;
use controllers\ControllerParticularidades;

$controllerParticularidade = new ControllerParticularidades;
$controllerEmpresa = new ControllerEmpresa;
$controllerEmpresaRecebimento = new ControllerEmpresaRecebimento;
$controllerEmpresaImportacao = new ControllerEmpresaImportacao;

$ID_Empresa = $_GET['delete_id'];

$delEmpresaImp = $controllerEmpresaImportacao->deleteEmpresaImportacao($ID_Empresa);
$delParticularidades = $controllerParticularidade->deleteParticularidades($ID_Empresa);
$delEmpresaRec = $controllerEmpresaRecebimento->deleteEmpresaRecebimento($ID_Empresa);
$delEmpresa = $controllerEmpresa->deleteEmpresa($ID_Empresa);

if($delEmpresa && $delEmpresaImp && $delEmpresaRec && $delParticularidades){
    header("Location: ../view/list.php"); 
    exit;
}else{
    echo "falha ao excluir, contate Arthur";
}
?>