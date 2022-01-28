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
                            </li>
                            <li class="nav-item">
                                <a href="../users/trocarsenha.php" class="nav-link">Trocar senha</a>
                            </li>
                            <?php
                            if ($_SESSION['UsuarioNivel'] == '5') {
                            ?>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Configurações gerais</a>
                            </li>
                            <?php
                            }
                            ?>

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
        <!-- Nivel 1 &2 -->
        <?php
        if ($_SESSION['UsuarioNivel'] == '1' || $_SESSION['UsuarioNivel'] == '2') {
        ?>
        <div class="row">
            <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <!-- <th scope="col">Nome</th> -->
                        <th scope="col">Nome</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Ativo</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include 'banco.php';
                        $pdo = Banco::conectar();
                        $sql = 'SELECT * FROM usuarios ORDER BY id DESC';

                        foreach ($pdo->query($sql) as $row) {
                            if ($row['nome'] == $_SESSION['UsuarioNome']) {
                                echo '<tr>';
                                echo '<th scope="row">' . $row['id'] . '</th>';
                                echo '<td>' . $row['nome'] . '</td>';
                                echo '<td>' . $row['usuario'] . '</td>';
                                if ($row['ativo'] == '1') {
                                    echo '<td>Sim</td>';
                                } else {
                                    echo '<td> Não </td>';
                                }

                                echo '<td width=200>';
                                echo '<a class="btn " href="read.php?id=' . $row['id'] . '">Info</a>';
                                echo ' ';
                                echo '<a class="btn " href="updatenivel1.php?id=' . $row['id'] . '">Atualizar</a>';
                                echo ' ';
                                echo '</td>';
                                echo '</tr>';
                            }
                        }
                        Banco::desconectar();
                        ?>
                </tbody>
            </table>
        </div>
        <?php
        }
        ?>
        <!-- fim Nivel 1 & 2 -->

        <!-- Nivel 3-->
        <?php
        if ($_SESSION['UsuarioNivel'] == '3' || $_SESSION['UsuarioNivel'] == '4') {
        ?>
        <div class="row">
            <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <!-- <th scope="col">Nome</th> -->
                        <th scope="col">Nome</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Ativo</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include 'banco.php';
                        $pdo = Banco::conectar();
                        $sql = 'SELECT * FROM usuarios ORDER BY id DESC';

                        foreach ($pdo->query($sql) as $row) {
                            if ($row['nome'] == $_SESSION['UsuarioNome']) {
                                echo '<tr>';
                                echo '<th scope="row">' . $row['id'] . '</th>';
                                echo '<td>' . $row['nome'] . '</td>';
                                echo '<td>' . $row['usuario'] . '</td>';
                                if ($row['ativo'] == '1') {
                                    echo '<td>Sim</td>';
                                } else {
                                    echo '<td> Não </td>';
                                }

                                echo '<td width=200>';
                                echo '<a class="btn " href="read.php?id=' . $row['id'] . '">Info</a>';
                                echo ' ';
                                echo '<a class="btn " href="updatenivel1.php?id=' . $row['id'] . '">Atualizar</a>';
                                echo ' ';
                                echo '</td>';
                                echo '</tr>';
                            }
                        }
                        foreach ($pdo->query($sql) as $row) {
                            if ($row['nome'] != $_SESSION['UsuarioNome'] && $row['ativo'] == '1') {
                                echo '<tr>';
                                echo '<th scope="row">' . $row['id'] . '</th>';
                                echo '<td>' . $row['nome'] . '</td>';
                                echo '<td>' . $row['usuario'] . '</td>';
                                if ($row['ativo'] == '1') {
                                    echo '<td>Sim</td>';
                                } else {
                                    echo '<td> Não </td>';
                                }

                                echo '<td width=200>';
                                echo '<a class="btn " href="read.php?id=' . $row['id'] . '">Info</a>';
                                echo ' ';
                                echo '</td>';
                                echo '</tr>';
                            }
                        }
                        Banco::desconectar();
                        ?>
                </tbody>
            </table>
        </div>
        <?php
        }
        ?>
        <!-- fim Nivel 3 -->
        <!-- nivel 5 -->
        <?php
        if ($_SESSION['UsuarioNivel'] == '5'){
        ?>
        <div class="row">
            <p>
                <a href="create.php" class="btn btn-success">Adicionar</a>
            </p>
            <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <!-- <th scope="col">Nome</th> -->
                        <th scope="col">Nome</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Nivel</th>
                        <th scope="col">Ativo</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'banco.php';
                    $pdo = Banco::conectar();
                    $sql = 'SELECT * FROM usuarios ORDER BY id DESC';

                    foreach ($pdo->query($sql) as $row) {
                        echo '<tr>';
                        echo '<th scope="row">' . $row['id'] . '</th>';
                        echo '<td>' . $row['nome'] . '</td>';
                        echo '<td>' . $row['usuario'] . '</td>';
                        echo '<td>' . $row['nivel'] . '</td>';
                        echo '<td>' . $row['ativo'] . '</td>';

                        echo '<td width=300>';
                        echo '<a class="btn " href="read.php?id=' . $row['id'] . '">Info</a>';
                        echo ' ';
                        echo '<a class="btn " href="update.php?id=' . $row['id'] . '">Atualizar</a>';
                        echo ' ';
                        echo '<a class="btn " href="delete.php?id=' . $row['id'] . '">Excluir</a>';
                        echo ' ';
                        echo '</td>';
                        echo '</tr>';
                    }
                    Banco::desconectar();
                    ?>
                </tbody>
            </table>
        </div>
        <hr>
        <a class="btn " href="niveis.php">Niveis de Usuarios</a>
        <?php
        }
        ?>
        <!-- fim nivel 5 -->


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