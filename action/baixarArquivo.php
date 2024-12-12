<?php
require_once('../controllers/controllerEmpresa.php');
use controllers\ControllerEmpresa;


$controllerEmpresa = new ControllerEmpresa;

if (isset($_GET['id'])) {
    $ID_Empresa = $_GET['id'];
    $controllerEmpresa->baixarImagem($ID_Empresa);
    header("Location: ../view/detail.php?id='$ID_Empresa'"); 
    exit;
} else {
    echo "ID da empresa não informado.";
    header("Location: ../view/detail.php?id='$ID_Empresa'"); 
    exit;
}
?>
