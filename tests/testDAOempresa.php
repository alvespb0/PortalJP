<?php
require_once('../DAO/DAOempresa.php');
use DAO\DAOempresa;

$testDAO = new DAOempresa();
/**teste de inclusão de empresa inicialmente */
#$testDAO->incluirEmpresa("Teste", "123456", "das bananas", ".br", "empresa de familia"); /* Inclusão funcionando */

/**teste de edição da empresa */
#$testDAO->atualizarEmpresa("tteste2","1234567","da maçã", ".net", "empresa vendida"); /* Edit funcionando, porém não sei como conseguir o ID*/

/**teste de busca a empresa */
#$empresa = $testDAO->buscarEmpresa("1234567"); /* Busca funcionando, modelo de como manipular a array de objetos abaixo */
#var_dump($empresa);
#foreach($empresa as $indice => $e){
#    echo $e->nome_Empresa;
#}

/**teste de exclusão da empresa */
#$testDAO->excluirEmpresa(123456); /** Exclusão funcionando adequadamente */


?>