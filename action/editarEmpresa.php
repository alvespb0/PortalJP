<?php
namespace action;



require_once('../controllers/controllerEmpresa.php');
require_once('../controllers/controllerEmpresaImportacao.php');
require_once('../controllers/controllerEmpresaRecebimento.php');
require_once('../controllers/controllerParticularidades.php');
require_once('../models/empresa.php');
require_once('../models/empresaImportacao.php');
require_once('../models/empresaRecebimento.php');
require_once('../models/particularidades.php');

use controllers\ControllerEmpresa;
use controllers\ControllerEmpresaImportacao;
use controllers\ControllerEmpresaRecebimento;
use controllers\ControllerParticularidades;
use models\Empresa;
use models\empresaImportacao;
use models\EmpresaRecebimento;
use models\Particularidades;

$controllerEmpresa = new ControllerEmpresa;
$controllerEmpresaRecebmento = new ControllerEmpresaRecebimento;
$controllerEmpresaImportacao = new ControllerEmpresaImportacao;
$controllerParticularidade = new ControllerParticularidades;

if(isset($_POST['editar'])){
    /* Informações da Empresa */
    $empresa = new Empresa();
    $empresa->nome_Empresa = $_POST['nome_empresa'];
    $empresa->CNPJ_Empresa = $_POST['cnpj_empresa'];
    $empresa->endereco_Empresa = $_POST['endereco_empresa'];
    $empresa->links_Empresa = $_POST['links_empresa'];
    $empresa->particularidades = $_POST['particularidades'];
    $empresa->observacoes = $_POST['OBS'];
    $empresa->ID_Empresa = intval($_POST['ID_Empresa']);

    $controllerEmpresa->editarEmpresa($empresa);

    /* Parte das particularidades */
    $controllerParticularidade->deleteParticularidades($empresa->ID_Empresa);

    $part = $_POST['particularidades'];
    foreach($part as $p){
        $particularidade = new Particularidades();
        $particularidade->ID_Empresa = $empresa->ID_Empresa;
        $particularidade->particularidades = $p;
        $controllerParticularidade->salvarParticularidades($particularidade);
    }

    /* Informações das Importações */
    $importacoes = array();
    $importacoes = $_POST['importacao'];

    $controllerEmpresaImportacao->deleteEmpresaImportacao($empresa->ID_Empresa);

    foreach($importacoes as $i){
        $empresaImp = new empresaImportacao();
        $empresaImp->ID_Empresa = $empresa->ID_Empresa;
        $empresaImp->ID_Importacao = $i;
        $controllerEmpresaImportacao->salvarEmpresaImportacao($empresaImp);
    }
    /* Foi gambiarrado isso de deletar e incluir, pelo fato de eu não consegir seguir com a lógica de edição */
    
    /* Informações sobre recebimentos */
    $formaRecebimento = intval($_POST['forma_recebimento']);
    $subRecebimentos = array_map('intval', $_POST['subformas_recebimento']); // Garante que os valores são inteiros

    // Mapeamento direto de SUBFORMA para FORMA
    $mapaSubForma = [
        1 => 1, // Subforma 1 -> Forma 1
        2 => 1, // Subforma 2 -> Forma 1
        3 => 1, // Subforma 3 -> Forma 1
        4 => 1, // Subforma 4 -> Forma 1
        5 => 2, // Subforma 5 -> Forma 2
        6 => 3, // Subforma 6 -> Forma 3
        7 => 3, // Subforma 7 -> Forma 3
        8 => 3, // Subforma 8 -> Forma 3
        9 => 3, // Subforma 9 -> Forma 3
        10 => 3 // Subforma 10 -> Forma 3
    ];

    // Exclui os recebimentos existentes antes de inserir novos
    $controllerEmpresaRecebmento->deleteEmpresaRecebimento($empresa->ID_Empresa);

    foreach ($subRecebimentos as $sub) {
        $empresaRec = new EmpresaRecebimento();
        $empresaRec->ID_Empresa = $empresa->ID_Empresa;

        if (isset($mapaSubForma[$sub])) {
            $empresaRec->ID_SubFormaRecebimento = $sub;
            $formaRecebimentoMapeada = $mapaSubForma[$sub];
        } else {
            echo "Subforma inválida: $sub";
            continue; 
        }

        // Faz a inserção dos novos registros
        $controllerEmpresaRecebmento->salvarEmpresaRecebimento($empresaRec);
    }


    header("Location: ../view/list.php"); 
    exit;
}
?>