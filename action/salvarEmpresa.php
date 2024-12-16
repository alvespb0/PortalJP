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

var_dump($_POST['particularidades']);

if(isset($_POST['cadastrar'])){
    $empresa = new Empresa();
    $empresa->nome_Empresa = $_POST['nome_empresa'];
    $empresa->CNPJ_Empresa = $_POST['cnpj_empresa'];
    $empresa->endereco_Empresa = $_POST['endereco_empresa'];
    $empresa->links_Empresa = $_POST['links_empresa'];
    $empresa->observacoes = $_POST['OBS'];

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $arquivoTmp = $_FILES['imagem']['tmp_name'];
        $arquivoNome = $_FILES['imagem']['name'];
        $arquivoTipo = $_FILES['imagem']['type'];
        $arquivoConteudo = file_get_contents($arquivoTmp); 
        $empresa->imagem = $arquivoConteudo;
    } else {
        $empresa->imagem = null;
    }

    $controllerEmpresa->salvarEmpresa($empresa);
    $infEmpresas = $controllerEmpresa->listaEmpresa($empresa->CNPJ_Empresa);

    foreach($infEmpresas as $inf){
        $empresa->ID_Empresa = $inf->ID_Empresa;
    }

    /* parte das particularidades */
    $part = $_POST['particularidades'];
    foreach($part as $p){
        $particularidade = new Particularidades();
        $particularidade->ID_Empresa = $empresa->ID_Empresa;
        $particularidade->particularidades = $p;
        $controllerParticularidade->salvarParticularidades($particularidade);
    }
    /* fim da parte das particularidades */

    $importacoes = array();
    $importacoes = $_POST['importacao'];
    foreach($importacoes as $i){
        $empresaImp = new empresaImportacao();
        $empresaImp->ID_Empresa = $empresa->ID_Empresa;
        $empresaImp->ID_Importacao = $i;
        $controllerEmpresaImportacao->salvarEmpresaImportacao($empresaImp);
    }

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
}else{
    echo 'você não deveria estar aqui!';
    header("Location: ../view/form.php"); 
    exit;
}
?>