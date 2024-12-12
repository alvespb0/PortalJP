<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jp</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Isolando a navbar para que não afete outras páginas */
        .navbar-wrapper {
            position: relative;
            z-index: 999;
        }

        .navbar-custom {
            background-color: #002f47; /* Azul escuro com um toque de sofisticação */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombras para destacar a navbar */
        }

        .navbar-custom .navbar-brand {
            color: #ffffff !important;
            font-weight: bold;
            font-size: 1.5rem;
            letter-spacing: 1px;
            transition: transform 0.3s ease;
        }

        .navbar-custom .navbar-brand:hover {
            color: #ff9900 !important;
            transform: scale(1.05); /* Efeito de zoom suave no hover */
        }

        .navbar-custom .navbar-nav .nav-link {
            color: #ffffff;
            font-size: 1.1rem;
            font-weight: 500;
            padding: 0.75rem 1.25rem;
            position: relative;
            text-transform: uppercase; /* Texto maiúsculo para um toque mais moderno */
            transition: all 0.3s ease-in-out;
        }

        .navbar-custom .navbar-nav .nav-link:hover {
            color: #ff9900;
            border-bottom: 3px solid #ff9900;
            padding-bottom: 0.5rem;
        }

        .navbar-custom .navbar-nav .nav-item:not(:last-child) {
            margin-right: 15px; /* Espaçamento entre os itens */
        }

        /* Estilo do menu hamburguer */
        .navbar-custom .navbar-toggler {
            border: none;
            background-color: transparent;
        }

        .navbar-custom .navbar-toggler-icon {
            background-color: #ffffff;
        }

        /* Efeitos de transição suave ao clicar no menu */
        .navbar-custom .collapse {
            transition: max-height 0.4s ease;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .navbar-custom .navbar-nav {
                margin-top: 15px;
                text-align: center;
            }

            .navbar-custom .navbar-nav .nav-link {
                padding: 1rem;
                font-size: 1.25rem;
            }
        }
    </style>
</head>
<body>

    <!-- Wrapper para isolar a navbar -->
    <div class="navbar-wrapper">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-custom">
            <a class="navbar-brand" href="index.php">
                <img src="logo_header.png" alt="Logo" width="150px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="form.php">Cadastro de Empresa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="list.php">Listar Empresas</a>
                    </li>
<!--                     <li class="nav-item">
                        <a class="nav-link" href="pagina_usuario.php">Página de Usuário</a>
                    </li> -->
                </ul>
            </div>
        </nav>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
