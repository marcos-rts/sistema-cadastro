<?php

// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();

// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['UsuarioID'])) {
    // Destrói a sessão por segurança
    session_destroy();
    // Redireciona o visitante de volta pro login
    header("Location: ../index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <title>Página Inicial</title>
    <style>
    .sim {
        color: green;
    }

    .nao {
        color: red;
    }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg ftco_navbar ftco-navbar-dark" id="ftco-navbar">
                <div class="container">
                    <a class="navbar-brand" href="../index.php">Sistema de Controle de Maquinas</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                        aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="fa fa-bars"></span>
                        Menu
                    </button>
                    <div class="collapse navbar-collapse" id="ftco-nav">
                        <ul class="navbar-nav ml-auto mr-md-3">
                            <li class="nav-item active">
                                <a href="../sistem/index.php" class="nav-link">Pendentes</a>
                            </li>
                            <li class="nav-item">
                                <a href="../sistem/entregues.php" class="nav-link">Entregues</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php" class="nav-link">Usuario</a>
                            </li>
                            <li class="nav-item">
                                <a href="../logout.php" class="nav-link">Logout</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Configurações gerais</a>
                            </li>
                        </ul>
                    </div>
                </div>

            </nav>
            <!-- END nav -->
        </div>
    </header>
    <div class="container">
        <p>Conectado como <?php echo $_SESSION['UsuarioNome']; ?> </p>

        <!-- <div class="jumbotron">
            <p>Conectado como <?php echo $_SESSION['UsuarioNome']; ?> </p>

            <div class="row">
                <h2>SAA - Controle de Maquinas</h2>
            </div>

        </div> -->
        </br>
        <div class="row">

            <br>
            <div class="table-responsive">

                <table class="table table-bordered table-hover table-dark">
                    <thead>
                        <tr>
                            <th scope="col" colspan="6">Pagina Pendentes</th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Info</th>
                            <th scope="col">Adicionar</th>
                            <th scope="col">Atualizar</th>
                            <th scope="col">Excluir</th>
                            <th scope="col">Imprimir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="col">Nivel 1</th>
                            <td class="sim">✓</td>
                            <td class="nao">X</td>
                            <td class="nao">X</td>
                            <td class="nao">X</td>
                            <td class="sim">✓</td>
                        </tr>
                        <tr>
                            <th scope="col">Nivel 2</th>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="nao">X</td>
                            <td class="sim">✓</td>
                        </tr>
                        <tr>
                            <th scope="col">Nivel 3</th>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="nao">X</td>
                            <td class="sim">✓</td>
                        </tr>
                        <tr>
                            <th scope="col">Nivel 4</th>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="nao">X</td>
                            <td class="sim">✓</td>
                        </tr>
                        <tr>
                            <th scope="col">Nivel 5</th>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <div class="table-responsive">

                <table class="table table-bordered table-hover table-dark">
                    <thead>
                        <tr>
                            <th scope="col" colspan="5">Pagina Entregues</th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Info</th>
                            <th scope="col">Atualizar</th>
                            <th scope="col">Excluir</th>
                            <th scope="col">Imprimir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="col">Nivel 1</th>
                            <td class="sim">✓</td>
                            <td class="nao">X</td>
                            <td class="nao">X</td>
                            <td class="nao">X</td>
                        </tr>
                        <tr>
                            <th scope="col">Nivel 2</th>
                            <td class="sim">✓</td>
                            <td class="nao">X</td>
                            <td class="nao">X</td>
                            <td class="sim">✓</td>
                        </tr>
                        <tr>
                            <th scope="col">Nivel 3</th>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="nao">X</td>
                            <td class="sim">✓</td>
                        </tr>
                        <tr>
                            <th scope="col">Nivel 4</th>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="nao">X</td>
                            <td class="sim">✓</td>
                        </tr>
                        <tr>
                            <th scope="col">Nivel 5</th>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <div class="table-responsive">

                <table class="table table-bordered table-hover table-dark">
                    <thead>
                        <tr>
                            <th scope="col" colspan="5">Pagina Usuario</th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th scope="col"></th>

                            <th scope="col">Visu. Todos Usuarios</th>
                            <th scope="col">Adicionar</th>
                            <th scope="col">Excluir</th>
                            <th scope="col">Atualizar</th>
                            <th scope="col">Alt. Propria senha</th>
                            <th scope="col">Alt. senhas geral</th>
                            <th scope="col">Mod. Niveis</th>
                            <th scope="col">Ativ/Desat</th>
                            <th scope="col">Alt. Usuario</th>
                            <th scope="col">Alt. Email</th>
                            <th scope="col">Alt. Nome</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="col">Nivel 1</th>
                            <td class="nao">X</td>
                            <td class="nao">X</td>
                            <td class="nao">X</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="nao">X</td>
                            <td class="nao">X</td>
                            <td class="nao">X</td>
                            <td class="nao">X</td>
                            <td class="nao">X</td>
                            <td class="sim">✓</td>
                        </tr>
                        <tr>
                            <th scope="col">Nivel 2</th>
                            <td class="nao">X</td>
                            <td class="nao">X</td>
                            <td class="nao">X</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="nao">X</td>
                            <td class="nao">X</td>
                            <td class="nao">X</td>
                            <td class="nao">X</td>
                            <td class="nao">X</td>
                            <td class="sim">✓</td>
                        </tr>
                        <tr>
                            <th scope="col">Nivel 3</th>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="nao">X</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="nao">X</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                        </tr>
                        <tr>
                            <th scope="col">Nivel 4</th>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="nao">X</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                        </tr>
                        <tr>
                            <th scope="col">Nivel 5</th>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                            <td class="sim">✓</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
    </div>

    <footer>
        <div class="container">
            <span class="badge badge-secondary">v 1.0.0 &copy; 2021 - Marcos A. R. T. dos Santos</span>


        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="../assets/js/bootstrap.min.js"></script>
</body>

</html>