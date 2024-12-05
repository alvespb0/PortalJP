<?php
require_once('../DAO/DAOempresaImportacao.php');
use DAO\DAOEmpresaImportacao;

$testDAO = new DAOEmpresaImportacao();

/**teste de inclusão */
/* $testDAO->incluirEmpresaImportacao(4,3); */ /* Inclusão funcionando, testado excessões */

/**teste de edição */
/* $testDAO->atualizarEmpresaImportacao(4,3,9); */ /* Edição funcionando, testado excessões */

/**teste de listagem */
/* $resultado = $testDAO->buscarEmpresaImportacao(4); /* Listagem funcionando, retornando array de objetos */
/* var_dump($resultado); */ 

/**teste de exclusão */
/* $testDAO->excluirEmpresaImportacao(4); */ /* Exclusão funcionando */

?>