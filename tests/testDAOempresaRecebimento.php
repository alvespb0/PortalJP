<?php
require_once('../DAO/DAOempresaRecebimento.php');
use DAO\DAOEmpresaRecebimento;

$testDAO = new DAOEmpresaRecebimento();

/* Teste de inclusão */
/* $testDAO->incluirEmpresaRecebimento(4, 6); */ /* Inclusão funcionando */

/* Teste de listagem */
/* $empresaR = $testDAO->buscarEmpresaRecebimento(4); */ /* teste de busca funcionando */

/* Teste de Atualização */
/* $testDAO->atualizarEmpresaRecebimento(4,2,1); */ /* teste de update funcionando */

/* Teste de exclusão */
/* $testDAO->excluirEmpresaRecebimento(4); */ /* Teste de exclusão funcionando */

/* Teste busca subformas de recebimento */
$sub = $testDAO->buscarSubformasRecebimento(4); /* Busca de Subformas funcionando */
var_dump($sub);
 
/* Teste busca formas recebimento */
/* echo $testDAO->buscarFormasRecebimento(5); */ /* Busca de formas de recebimento funcionando */

?>