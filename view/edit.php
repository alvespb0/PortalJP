<?php
include_once('navbar.php');
require_once('../controllers/controllerEmpresa.php');
require_once('../controllers/controllerEmpresaImportacao.php');
require_once('../controllers/controllerEmpresaRecebimento.php');
require_once('../controllers/controllerParticularidades.php');

use controllers\ControllerEmpresa;
use controllers\ControllerEmpresaImportacao;
use controllers\ControllerEmpresaRecebimento;
use controllers\ControllerParticularidades;

$controllerEmpresa = new ControllerEmpresa;
$controllerEmpresaRecebmento = new ControllerEmpresaRecebimento;
$controllerEmpresaImportacao = new ControllerEmpresaImportacao;
$controllerParticularidades = new ControllerParticularidades;

$ID_Empresa = $_GET['ID_empresa'];

/* para as informações da empresa */
$empresa = $controllerEmpresa->listaEmpresaById($ID_Empresa); #array 

/* parte para as particularidades */
$particularidades = $controllerParticularidades->listaParticularidades($ID_Empresa); #array

/* para as formas de importacao */
$formasImportacao = $controllerEmpresaImportacao->listaImportacoes($ID_Empresa); #array

/* para as subformas de recebimento */
$subFormasRecebimento = $controllerEmpresaRecebmento->listaSubformasRecebimento($ID_Empresa); #array

/* Para a forma de recebimento */
$resultado = $controllerEmpresaRecebmento->listaEmpresaRecebimento($ID_Empresa);
foreach($resultado as $r){
    $ID_SubForma = $r->ID_SubFormaRecebimento;
}
$formaRecebimento = $controllerEmpresaRecebmento->listaFormasRecebimento($ID_SubForma); #string

/* parte presente somente para verificação das boxes checked DE IMPOPRTACAO, isso só é presente na página de edit */
$empresaImportacao = $controllerEmpresaImportacao->listaEmpresaImportacao($ID_Empresa);
$tiposSelecionados = array();
foreach($empresaImportacao as $ei){
    $tiposSelecionados[] = $ei->ID_Importacao;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Edição de Empresa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/cadastro.css">
</head>
<body>
    <div class="container">
        <h1>Formulário de Edição de Empresa</h1>
        <form action="../action/editarEmpresa.php" id = "formEdit" method="post">
            <input type="hidden" name="ID_Empresa" value = "<?php echo $ID_Empresa; ?>">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome da Empresa</label>
                <input type="text" id="nome" name="nome_empresa" class="form-control" placeholder="Nome da Empresa" value ="<?php foreach($empresa as $e){ echo $e->nome_Empresa;} ?>" required>
            </div>
            <div class="mb-3">
                <label for="cnpj" class="form-label">CNPJ</label>
                <input type="text" id="cnpj" name="cnpj_empresa" class="form-control" placeholder="CNPJ" value ="<?php foreach($empresa as $e){ echo $e->CNPJ_Empresa;}?>" required>
            </div>
            <div class="mb-3">
                <label for="endereco" class="form-label">Endereço</label>
                <input type="text" id="endereco" name="endereco_empresa" class="form-control" placeholder="Endereço" value ="<?php foreach($empresa as $e){ echo $e->endereco_Empresa;}?>" required>
            </div>
            <div class="mb-3">
                <label for="links" class="form-label">Links da Empresa</label>
                <input type="text" id="links" name="links_empresa" class="form-control" placeholder="Links" value ="<?php foreach($empresa as $e){ echo $e->links_Empresa;}?>" required>
            </div>
            <div id="fields-container">
                <div class="mb-3">
                    <?php
                        foreach($particularidades as $p){
                            echo "<label for='particularidades' class='form-label'>Particularidades</label>";
                            echo "<textarea name = 'particularidades[]' class='form-control' id='particularidades'>";
                            echo nl2br(htmlspecialchars($p, ENT_QUOTES, 'UTF-8'));
                            echo "</textarea>";
                            echo "<br>";
                        }
                    ?>
                </div>    
            </div>
            <button type="button" class="btn btn-primary" onclick="addField()">+ Adicionar</button>
            <h3>Formas de Importação</h3>
            <label class="form-label">Selecione as Formas de Importação:</label>
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="importacao[]" value= "1" id="importacao1" <?php if(in_array(1, $tiposSelecionados)){echo 'checked';}?>>
                        <label class="form-check-label" for="importacao1">Entrada por SPED</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="importacao[]" value="2" id="importacao2" <?php if(in_array(2, $tiposSelecionados)){echo 'checked';}?>>
                        <label class="form-check-label" for="importacao2">Saída por SPED</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="importacao[]" value="4" id="importacao3" <?php if(in_array(4, $tiposSelecionados)){echo 'checked';}?>>
                        <label class="form-check-label" for="importacao3">Entradas por XML</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="importacao[]" value="5" id="importacao4" <?php if(in_array(5, $tiposSelecionados)){echo 'checked';}?>>
                        <label class="form-check-label" for="importacao4">Saída por XML</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="importacao[]" value="7" id="importacao5" <?php if(in_array(7, $tiposSelecionados)){echo 'checked';}?>>
                        <label class="form-check-label" for="importacao5">Entradas pelo SAT</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="importacao[]" value="10" id="importacao10" <?php if(in_array(10, $tiposSelecionados)){echo 'checked';}?>>
                        <label class="form-check-label" for="importacao10">Entrada pelo Sieg</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="importacao[]" value="8" id="importacao6" <?php if(in_array(8, $tiposSelecionados)){echo 'checked';}?>>
                        <label class="form-check-label" for="importacao6">Saída pelo Sieg</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="importacao[]" value="3" id="importacao7" <?php if(in_array(3, $tiposSelecionados)){echo 'checked';}?>>
                        <label class="form-check-label" for="importacao7">NFCe por Sped</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="importacao[]" value="6" id="importacao8" <?php if(in_array(6, $tiposSelecionados)){echo 'checked';}?>>
                        <label class="form-check-label" for="importacao8">NFCe por XML - Sieg</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="importacao[]" value="9" id="importacao9" <?php if(in_array(9, $tiposSelecionados)){echo 'checked';}?>>
                        <label class="form-check-label" for="importacao9">NFCe por XML - Copiado do Cliente</label>
                    </div>
                </div>
            </div>

            <h3 class="mt-4">Formas de Recebimento</h3>
            <label class="form-label">Selecione as Formas de Recebimento:</label>
            <select class="form-select mb-3" name="forma_recebimento">
                <option value="1" <?php if($formaRecebimento == 'Digital'){echo 'selected';}?>>Digital</option>
                <option value="2" <?php if($formaRecebimento == 'Físico'){echo 'selected';}?>>Físico</option>
                <option value="3" <?php if($formaRecebimento == 'Digital e Física'){echo 'selected';}?>>Digital e Físico</option>
            </select>

            <label class="form-label">Selecione as Subformas de Recebimento:</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="subformas_recebimento[]" value="1" id="subforma1" <?php if(in_array('email', $subFormasRecebimento)){echo 'checked';}?>>
                <label class="form-check-label" for="subforma1">Email</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="subformas_recebimento[]" value="2" id="subforma2" <?php if(in_array('whatsapp', $subFormasRecebimento)){echo 'checked';}?>>
                <label class="form-check-label" for="subforma2">WhatsApp</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="subformas_recebimento[]" value="3" id="subforma3" <?php if(in_array('skype', $subFormasRecebimento)){echo 'checked';}?>>
                <label class="form-check-label" for="subforma3">Skype</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="subformas_recebimento[]" value="4" id="subforma4" <?php if(in_array('acessorias', $subFormasRecebimento)){echo 'checked';}?>>
                <label class="form-check-label" for="subforma4">Assessorias</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="subformas_recebimento[]" value="5" id="subforma5" <?php if(in_array('malote', $subFormasRecebimento)){echo 'checked';}?>>
                <label class="form-check-label" for="subforma5">Malote</label>
            </div>

            <div class="mb-3">
                <label for="OBS" class="form-label">Observações</label>
                <textarea id="OBS" name="OBS" class="form-control" ><?php echo nl2br(htmlspecialchars($e->observacoes, ENT_QUOTES, 'UTF-8')); ?></textarea>
            </div>

            <button type="submit" name = "editar" class="btn btn-primary">Editar Empresa</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Função para validar se pelo menos uma forma de importação foi selecionada
        function validarImportacoes() {
            const importacoes = document.querySelectorAll('input[name="importacao[]"]'); // Seleciona todos os checkboxes
            let selecionado = false;

            // Verifica se algum checkbox foi marcado
            importacoes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    selecionado = true;
                }
            });

            // Se nenhum checkbox estiver marcado, exibe um alerta e retorna false
            if (!selecionado) {
                alert("Por favor, selecione pelo menos uma forma de importação.");
                return false; // Impede o envio do formulário
            }

            // Se pelo menos um checkbox foi marcado, permite o envio do formulário
            return true;
        }
                // Função para validar as formas de recebimento
        function validarRecebimento() {
            const subformasRecebimento = document.querySelectorAll('input[name="subformas_recebimento[]"]');
            
            // Verifica se pelo menos uma subforma foi selecionada
            let subformSelecionada = Array.from(subformasRecebimento).some(checkbox => checkbox.checked);

            // Valida se pelo menos uma subforma de recebimento foi selecionada
            if (!subformSelecionada) {
                alert("Por favor, selecione pelo menos uma subforma de recebimento.");
                return false;
            }

            // Se a subforma foi selecionada, permite o envio
            return true;
        }


        // Adiciona o evento de validação ao formulário
        document.getElementById("formEdit").addEventListener("submit", function(event) {
            if (!validarImportacoes() || !validarRecebimento()) {
                event.preventDefault(); // Impede o envio se alguma validação falhar
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function addField() {
            const container = document.getElementById('fields-container');

            const div = document.createElement('div');
            div.classList.add('mb-3');

            div.innerHTML = `
                <label for="particularidades" class="form-label">Particularidades</label>
                <textarea name="particularidades[]" class="form-control" id="particularidades"></textarea>
            `;

            // Adiciona o novo campo ao contêiner
            container.appendChild(div);
        }
    </script>
</body>
</html>