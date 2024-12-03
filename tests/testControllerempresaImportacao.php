<?php
namespace controllers;

require_once('../models/empresaImportacao.php');
require_once('../controllers/controllerEmpresaImportacao.php');

use models\empresaImportacao;
use controllers\ControllerEmpresaImportacao;

$empresaImportacao = new empresaImportacao();
$empresaImportacao->ID_Empresa = 4;
$empresaImportacao->ID_Importacao = 6;

$controllerImportacao = new ControllerEmpresaImportacao();

/* teste de inclusão */
/* $controllerImportacao->salvarEmpresaImportacao($empresaImportacao); */ /* Inclusão funcionando */

/* teste de busca */
/* $eImportacao = $controllerImportacao->listaEmpresaImportacao(4); */ /* Funcionando AINDA não testado se retornar mais de um valor */
/* foreach($eImportacao as $indice => $e){ */
/*     $id = $e->ID_Empresa; */
/* } */
/* $empresaImportacao->ID_Empresa = $id; */

/* teste de edição */
/* $controllerImportacao->editarEmpresaImportacao($empresaImportacao); */ /* Edição testar mais tarde */

/* teste Exclusão */
/* $controllerImportacao->deleteEmpresaImportacao($empresaImportacao->ID_Empresa); */ /* Exclusão funcionando */ 

$controllerImportacao->listaImportacoes(4);
?>