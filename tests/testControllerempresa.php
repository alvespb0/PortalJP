<?php
require_once('../models/empresa.php');
require_once('../controllers/controllerEmpresa.php');

use models\Empresa;
use controllers\ControllerEmpresa;

$empresa = new Empresa();
/* $empresa->ID_Empresa = 5; */
$empresa->CNPJ_Empresa = '987654321';
$empresa->endereco_Empresa = 'do arthur';
$empresa->links_Empresa = '.net';
$empresa->nome_Empresa = 'arthur marcondes';
$empresa->particularidades = 'paaraersdfadfs';

$empresaController = new ControllerEmpresa();

/**teste de inclusão */
/* $empresaController->salvarEmpresa($empresa); */ /** Inclusão funcionando */

/**Teste de busca */
$empresas = $empresaController->listaEmpresa($empresa->CNPJ_Empresa); /** Busca funcionando normal, NÃO DEIXADO COMENTADO devido a necessitar do ID para o editar*/

foreach($empresas as $indice => $e){
    $id = $e->ID_Empresa;
}
$empresa->ID_Empresa = $id;

/**teste de edição*/
/* $empresaController->editarEmpresa($empresa); */ /**Edição funcionando */

/**teste de exclusão */
/* $empresaController->deleteEmpresa('987654321'); */ /**Exclusão funcionando */
?>