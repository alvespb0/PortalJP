<?php
require_once('../DAO/DAOempresa.php');
use DAO\DAOempresa;

$testDAO = new DAOempresa();
/**teste de inclusão de empresa inicialmente */
/* $testDAO->incluirEmpresa("Teste2", "1234568", "das maças", ".br", "empresa do Arthur", "essa é uma observação qualquer, só para verificar se a inclusão está funcionando"); */ /* Inclusão funcionando */

/**teste de edição da empresa */
/* $testDAO->atualizarEmpresa("tteste2","1234567","da maçã", ".net", "empresa vendida", "diminuindo os bag", 7); */ /* Edit funcionando, porém não sei como conseguir o ID*/

/**teste de busca a empresa */
/* $empresa = $testDAO->buscarEmpresa("1234567"); */ /* Busca funcionando, modelo de como manipular a array de objetos abaixo */
/* var_dump($empresa); */
/* foreach($empresa as $indice => $e){ */
/*     echo $e->observacoes; */
/* } */

/**teste de exclusão da empresa */
#$testDAO->excluirEmpresa(123456); /** Exclusão funcionando adequadamente */

/* teste de consulta blob */
$imagem = $testDAO->buscaImagemById(50);
var_dump($imagem);
?>