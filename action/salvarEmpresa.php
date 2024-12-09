<?php
namespace action;

require_once('../controllers/controllerEmpresa.php');
require_once('../controllers/controllerEmpresaImportacao.php');
require_once('../controllers/controllerEmpresaRecebimento.php');
require_once('../models/empresa.php');
require_once('../models/empresaImportacao.php');
require_once('../models/empresaRecebimento.php');

use controllers\ControllerEmpresa;
use controllers\ControllerEmpresaImportacao;
use controllers\ControllerEmpresaRecebimento;
use models\Empresa;
use models\empresaImportacao;
use models\EmpresaRecebimento;

$controllerEmpresa = new ControllerEmpresa;
$controllerEmpresaRecebmento = new ControllerEmpresaRecebimento;
$controllerEmpresaImportacao = new ControllerEmpresaImportacao;

if(!isset($_POST['ControllerEmpresaImportacao'])){
    $empresa = new Empresa();
    $empresa->nome_Empresa = $_POST['nome_empresa'];
    $empresa->CNPJ_Empresa = $_POST['cnpj_empresa'];
    $empresa->endereco_Empresa = $_POST['endereco_empresa'];
    $empresa->links_Empresa = $_POST['links_empresa'];
    $empresa->particularidades = $_POST['particularidades'];
    $empresa->observacoes = $_POST['OBS'];

    $controllerEmpresa->salvarEmpresa($empresa);
    $infEmpresas = $controllerEmpresa->listaEmpresa($empresa->CNPJ_Empresa);

    foreach($infEmpresas as $inf){
        $empresa->ID_Empresa = $inf->ID_Empresa;
    }

    $importacoes = array();
    $importacoes = $_POST['importacao'];
    foreach($importacoes as $i){
        $empresaImp = new empresaImportacao();
        $empresaImp->ID_Empresa = $empresa->ID_Empresa;
        $empresaImp->ID_Importacao = $i;
        $controllerEmpresaImportacao->salvarEmpresaImportacao($empresaImp);
    }

    $formaRecebimeto = intval($_POST['forma_recebimento']);
    $subRecebimentos = array();
    $subRecebimentos = $_POST['subformas_recebimento'];
    foreach($subRecebimentos as $sub){
        $sub = intval($sub);
        $empresaRec = new EmpresaRecebimento();
        $empresaRec->ID_Empresa = $empresa->ID_Empresa;
        if($formaRecebimeto == 1 && $sub == 1){
            $empresaRec->ID_SubFormaRecebimento = 1;
        }else if($formaRecebimeto == 1 && $sub == 2){
            $empresaRec->ID_SubFormaRecebimento = 2;
        }else if($formaRecebimeto == 1 && $sub == 3){
            $empresaRec->ID_SubFormaRecebimento = 3;
        }else if($formaRecebimeto == 1 && $sub == 4){
            $empresaRec->ID_SubFormaRecebimento = 4;
        }else if($formaRecebimeto == 1 && $sub == 5){
            $formaRecebimeto = 3;
            $empresaRec->ID_SubFormaRecebimento = 10;
        }else if($formaRecebimeto == 2 && $sub == 5){
            $empresaRec->ID_SubFormaRecebimento = 5;
        }else if($formaRecebimeto == 3 && $sub == 1){
            $empresaRec->ID_SubFormaRecebimento = 6;
        }else if($formaRecebimeto == 3 && $sub == 2){
            $empresaRec->ID_SubFormaRecebimento = 7;
        }else if($formaRecebimeto == 3 && $sub == 3){
            $empresaRec->ID_SubFormaRecebimento = 8;
        }else if($formaRecebimeto == 3 && $sub == 4){
            $empresaRec->ID_SubFormaRecebimento = 9;
        }else if($formaRecebimeto == 3 && $sub == 5){
            $empresaRec->ID_SubFormaRecebimento = 10;
        }else{
            echo "entrou aqui";
        }
        echo $empresaRec->ID_SubFormaRecebimento;
        $controllerEmpresaRecebmento->salvarEmpresaRecebimento($empresaRec);
    }
}else{
    echo 'você não deveria estar aqui!';
    header("Location: ../view/form.php"); 
    exit;
}
?>