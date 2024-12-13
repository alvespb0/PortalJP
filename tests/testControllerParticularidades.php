<?php
namespace controllers;

require_once('../models/particularidades.php');
require_once('../controllers/controllerParticularidades.php');

use models\Particularidades;
use controllers\ControllerParticularidades;

$particularidade = new Particularidades();
$particularidade->ID_Empresa = 61;
$particularidade->particularidades = 'teste';

$controllerParticularidade = new ControllerParticularidades;

/* teste de inserção */
/* $controllerParticularidade->salvarParticularidades($particularidade); */ /* Funcionando */

/* teste de busca */
/* $resultado = $controllerParticularidade->listaParticularidades(61); */ /* Funcionando */
/* var_dump($resultado); */

/* teste de exclusão */
$controllerParticularidade->deleteParticularidades(61);
?>