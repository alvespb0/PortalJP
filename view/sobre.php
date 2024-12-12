<?php
include_once('navbar.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre o Sistema</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        /* Contêiner principal com padding adicional para centralizar */
        .content-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh; /* Ocupa toda a altura da tela */
            padding: 20px;
        }

        .container {
            max-width: 800px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        /* Título principal */
        h4 {
            color: #003366;
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Parágrafo principal */
        p {
            font-size: 1.1rem;
            color: #555;
            line-height: 1.6;
        }

        /* Estilo do rodapé */
        footer {
            text-align: center;
            font-size: 1rem;
            color: #aaa;
            margin-top: 40px;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }

        footer a {
            color: #003366;
            text-decoration: none;
            font-weight: bold;
        }

        footer a:hover {
            color: #ff6600;
        }
    </style>
</head>
<body>
    <!-- Wrapper para centralizar o conteúdo -->
    <div class="content-wrapper">
        <div class="container">
            <h4>Informações sobre o Sistema</h4>
            <p>
                Página dedicada ao cadastro de empresas clientes para a empresa JP - Contabilidade, desenvolvido e mantido por Arthur Marcondes Alves.
                A aplicação é exclusiva para o cadastro e leitura dessas informações, facilitando assim como devemos lidar com a empresa cliente!
            </p>

            <footer>
                Desenvolvida por <strong>Arthur Marcondes Alves</strong>
            </footer>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
