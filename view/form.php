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
    <style>
        body {
            background-color: #f8f9fa; /* Cor de fundo leve */
        }
        .container {
            margin-top: 30px;
        }
        h1 {
            color: #003366; /* Azul escuro */
            margin-bottom: 30px;
        }
        .form-control, .form-select {
            border-radius: 0;
        }
        .form-label {
            color: #003366; /* Azul escuro */
        }
        .btn-primary {
            background-color: #c8102e; /* Vermelho */
            border-color: #c8102e;
        }
        .btn-primary:hover {
            background-color: #a00d1e; /* Vermelho escuro no hover */
            border-color: #a00d1e;
        }
        .form-check-input:checked {
            background-color: #c8102e; /* Vermelho */
            border-color: #c8102e;
        }
        .form-check-input:focus {
            box-shadow: 0 0 0 0.2rem rgba(200, 16, 46, 0.25); /* Efeito de foco no vermelho */
        }
        .form-check-label {
            color: #003366; /* Azul escuro */
        }
        .mb-3, .mt-4 {
            margin-bottom: 1.5rem;
        }
        .row {
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Formulário de Cadastro de Empresa</h1>
        <form action="../action/salvarEmpresa.php" method="post">
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
            <div class="mb-3">
                <label for="particularidades" class="form-label">Particularidades</label>
                <input type="text" id="particularidades" name="particularidades" class="form-control" placeholder="Particularidades">
            </div>
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
                <input type="text" id="OBS" name="OBS" class="form-control" placeholder="Observações">
            </div>

            <button type="submit" name = "cadastrar" class="btn btn-primary">Criar Empresa</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>