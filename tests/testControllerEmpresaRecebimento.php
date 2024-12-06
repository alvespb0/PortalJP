<?php
namespace controllers;

require_once('../models/empresaRecebimento.php');
require_once('../controllers/controllerEmpresaRecebimento.php');

use models\EmpresaRecebimento;
use controllers\ControllerEmpresaRecebimento;

$empresaRec = new EmpresaRecebimento();
$empresaRec->ID_Empresa = 4;
$empresaRec->ID_SubFormaRecebimento = 8;
$empresaRec->ID_EmpresaFormaRecebimento = 3;

$controllerRec = new ControllerEmpresaRecebimento;

/* Teste de inclusão */
/* $controllerRec->salvarEmpresaRecebimento($empresaRec); */ /* Funcionando, testado Excessões */
/* ----------------------------------------------------------
/* ----------------------------------------------------------

/* ----------------------------------------------------------
/* ----------------------------------------------------------

/* Teste de busca */
/* $empresaRecebimento = $controllerRec->listaEmpresaRecebimento($empresaRec->ID_Empresa); */ /* Funcionando, testado Excessões */
/* var_dump($empresaRecebimento); */

/* foreach($empresaRecebimento as $a){
    echo $a->ID_Empresa.'<br>';
    echo $a->ID_EmpresaFormaRecebimento.'<br>';
    echo $a->ID_SubFormaRecebimento.'<br>';
} */

/* ----------------------------------------------------------
/* ---------------------------------------------------------- */

/* ----------------------------------------------------------
/* ----------------------------------------------------------

/* Teste listagem SubFormas */
/* $sub = $controllerRec->listaSubformasRecebimento($empresaRec->ID_Empresa); */ /* Funcionando */
/* foreach($sub as $s){
    echo $s.'<br>';
} */

/* ----------------------------------------------------------
/* ----------------------------------------------------------

/* ----------------------------------------------------------
/* ----------------------------------------------------------

/* Teste listagem forma recebimentos */
/* echo $controllerRec->listaFormasRecebimento($empresaRec->ID_SubFormaRecebimento); */ /* Funcionando */

/* ----------------------------------------------------------
/* ----------------------------------------------------------

/* ----------------------------------------------------------
/* ----------------------------------------------------------

/* Teste edição empresaRecebimento  */
/* $controllerRec->editarEmpresaRecebimento($empresaRec); */ /* Funcionando */

/* ----------------------------------------------------------
/* ----------------------------------------------------------

/* ----------------------------------------------------------
/* ----------------------------------------------------------

/* Teste de exclusão empresaRecebimento */
/* $controllerRec->deleteEmpresaRecebimento($empresaRec->ID_Empresa); */ /* Funcionando */
?>