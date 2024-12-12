<?php
include_once('navbar.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Corpo da página */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5; /* Fundo claro e suave */
            margin: 0;
            padding: 0;
        }

        /* Centralização do conteúdo */
        .main-content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh; /* Centraliza verticalmente, ajustado para mais acima */
            text-align: center;
            flex-direction: column;
        }

        /* Logo */
        .main-content img {
            max-width: 300px; /* Limita o tamanho máximo da logo */
            margin-bottom: 30px; /* Espaço abaixo da logo */
            transition: transform 0.3s ease-in-out;
        }

        /* Efeito hover para o logo */
        .main-content img:hover {
            transform: scale(1.1); /* Zoom suave ao passar o mouse */
        }

        /* Estilo da mensagem */
        .main-content h1 {
            font-size: 2.5rem;
            color: #003366; /* Azul escuro para o texto */
            font-weight: bold;
            margin-top: 20px;
            letter-spacing: 1px;
        }

        /* Botões ou links (se houver) */
        .btn-custom {
            background-color: #ff9900;
            color: white;
            font-size: 1rem;
            padding: 10px 20px;
            border-radius: 5px;
            text-transform: uppercase;
            text-decoration: none;
            font-weight: bold;
            margin-top: 20px;
            transition: background-color 0.3s ease;
            display: inline-block; /* Garantir que o link seja tratado como bloco de botão */
        }

        .btn-custom:hover {
            background-color: #ff6600; /* Efeito de hover para o botão */
            text-decoration: none; /* Remove a linha de sublinhado */
        }

    </style>
</head>
<body>

    <div class="main-content">
        <!-- Logo -->
        <img src="logo_body.png" alt="Logo">

        <!-- Título ou mensagem -->
        <h1>Bem-vindo ao Sistema!</h1>

        <!-- Botão ou link, se necessário -->
        <a href="Sobre.php" class="btn-custom">Sobre o Sistema</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
