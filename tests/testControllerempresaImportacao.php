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
$eImportacao = $controllerImportacao->listaEmpresaImportacao(4);  /* Funcionando, testado e retornando array */
$id = [];
 foreach($eImportacao as $indice => $e){
     $id [] = $e->ID_EmpresaImportacao; 
 } 
 var_dump($id);

 $empresaImportacao->ID_EmpresaImportacao = $id[0]; 
 /* ---------------------------------------------------- */
 /* ---------------------------------------------------- */
 # A EDIÇÃO ESTÁ FUNCIONANDO, APENAS FICAR ATENTO, POR CAUSA QUE A FUNÇÃO UTILIZADA PARA CONSEGUIRMOS O ID da EMPRESA IMPORTAÇÃO (UTILIZADA COMO PARAMETRO)
 # RETORNA ARRAY, POR PODER HAVER MAIS DE UMA EMPRESA IMPORTAÇÃO POR EMPRESA, SENDO NECESSÁRIO FAZER UM FOREACH PARA ATUALIZAR ADEQUADAMENTE.
 /* ---------------------------------------------------- */
 /* ---------------------------------------------------- */

/* teste de edição */
$controllerImportacao->editarEmpresaImportacao($empresaImportacao); /* Edição Fumcionando, ler mensagem acima qualquer dúvida */

/* teste Exclusão */
/* $controllerImportacao->deleteEmpresaImportacao($empresaImportacao->ID_Empresa); */ /* Exclusão funcionando */ 

?>