<?php
include_once('navbar.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro de Empresa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/cadastro.css">
</head>
<body>
    <div class="container">
        <h1>Formulário de Cadastro de Empresa</h1>
        <form action="../action/salvarEmpresa.php" method="post" id="formCadastro" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome da Empresa</label>
                <input type="text" id="nome" name="nome_empresa" class="form-control" placeholder="Nome da Empresa" required>
            </div>
            <div class="mb-3">
                <label for="cnpj" class="form-label">CNPJ</label>
                <input type="text" id="cnpj" name="cnpj_empresa" class="form-control" placeholder="CNPJ" required>
            </div>
            <div class="mb-3">
                <label for="endereco" class="form-label">Endereço</label>
                <input type="text" id="endereco" name="endereco_empresa" class="form-control" placeholder="Endereço">
            </div>
            <div class="mb-3">
                <label for="links" class="form-label">Links da Empresa</label>
                <input type="text" id="links" name="links_empresa" class="form-control" placeholder="Links">
            </div>

        <div id="fields-container">
            <div class="mb-3">
                <label for="particularidades" class="form-label">Particularidades</label>
                <textarea name="particularidades[]" class="form-control" id="particularidades"></textarea>
            </div>
        </div>
            <button type="button" class="btn btn-primary" onclick="addField()">+ Adicionar</button>
            <h3>Formas de Importação</h3>
            <label class="form-label">Selecione as Formas de Importação:</label>
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="importacao[]" value= "1" id="importacao1">
                        <label class="form-check-label" for="importacao1">Entrada por SPED</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="importacao[]" value="2" id="importacao2">
                        <label class="form-check-label" for="importacao2">Saída por SPED</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="importacao[]" value="4" id="importacao3">
                        <label class="form-check-label" for="importacao3">Entradas por XML</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="importacao[]" value="5" id="importacao4">
                        <label class="form-check-label" for="importacao4">Saída por XML</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="importacao[]" value="7" id="importacao5">
                        <label class="form-check-label" for="importacao5">Entradas pelo SAT</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="importacao[]" value="10" id="importacao10">
                        <label class="form-check-label" for="importacao10">Entrada pelo Sieg</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="importacao[]" value="8" id="importacao6">
                        <label class="form-check-label" for="importacao6">Saída pelo Sieg</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="importacao[]" value="3" id="importacao7">
                        <label class="form-check-label" for="importacao7">NFCe por Sped</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="importacao[]" value="6" id="importacao8">
                        <label class="form-check-label" for="importacao8">NFCe por XML - Sieg</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="importacao[]" value="9" id="importacao9">
                        <label class="form-check-label" for="importacao9">NFCe por XML - Copiado do Cliente</label>
                    </div>
                </div>
            </div>

            <h3 class="mt-4">Formas de Recebimento</h3>
            <label class="form-label">Selecione as Formas de Recebimento:</label>
            <select class="form-select mb-3" name="forma_recebimento">
                <option value="1">Digital</option>
                <option value="2">Físico</option>
                <option value="3">Digital e Físico</option>
            </select>

            <label class="form-label">Selecione as Subformas de Recebimento:</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="subformas_recebimento[]" value="1" id="subforma1">
                <label class="form-check-label" for="subforma1">Email</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="subformas_recebimento[]" value="2" id="subforma2">
                <label class="form-check-label" for="subforma2">WhatsApp</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="subformas_recebimento[]" value="3" id="subforma3">
                <label class="form-check-label" for="subforma3">Skype</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="subformas_recebimento[]" value="4" id="subforma4">
                <label class="form-check-label" for="subforma4">Assessorias</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="subformas_recebimento[]" value="5" id="subforma5">
                <label class="form-check-label" for="subforma5">Malote</label>
            </div>
            <div class="mb-3">
                <label for="OBS" class="form-label">Observações</label>
                <textarea id="OBS" name="OBS" class="form-control" ></textarea>
                <!-- <input type="text" id="OBS" name="OBS" class="form-control" placeholder="Observações"> -->
            </div>
            <div class="mb-3">
                <label for="imagens" class="form-label">Imagens</label>
                <input type="file" id="imagem" name="imagem" class="form-control" accept =".pdf, .jpg, .xml, .doc, .rar, .png">
            </div>
            <button type="submit" name = "cadastrar" class="btn btn-primary">Criar Empresa</button>
        </form>
    </div>
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
        document.getElementById("formCadastro").addEventListener("submit", function(event) {
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