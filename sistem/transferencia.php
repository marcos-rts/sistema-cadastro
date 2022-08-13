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
<header>
<div class="container">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="../index.php">Sistema de Controle de Maquinas</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
    <ul class="navbar-nav ml-auto mr-md-3">
      <li class="nav-item active">
        <a class="nav-link" href="../index.php">Home <span class="sr-only">(página atual)</span></a>
      </li>
      <li class="nav-item">
       <!--  <a class="nav-link" href="#">Link</a> -->
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Maquinas
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="../index.php">Pendentes</a>
          <a class="dropdown-item" href="../sistem/transferencia.php">Trasnferencia</a>
          <a class="dropdown-item" href="../sistem/entregues.php">Entregues</a>
          <a class="dropdown-item" href="../sistem/maquinas_livres.php">Livres</a>
          <a class="dropdown-item" href="#"></a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item disabled" href="#">Em Breve</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <?php echo $_SESSION['UsuarioNome'] ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
           <a class="dropdown-item" href="../users/index.php">Informação</a>
          <a class="dropdown-item" href="../users/trocarsenha.php">Trocar Senha</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="../logout.php">Logout</a>
          <?php
	  if ($_SESSION['UsuarioNivel'] == '5' || $_SESSION['UsuarioID'] == '7') {
          ?>
          <a href="./private/config.php" class="dropdown-item">Configurações gerais</a>
          <?php
          }
          ?>
        </div>
      </li>
      <li class="nav-item">
       <!--  <a class="nav-link disabled" href="#">Desativado</a> -->
      </li>
    </ul>
  </div>
</nav>
</div>
</header>
<body>
    <div class="container">

        <!-- <div class="jumbotron">
            <p>Conectado como <?php echo $_SESSION['UsuarioNome']; ?> </p>

            <div class="row">
                <h2>SAA - Controle de Maquinas</h2>
            </div>

        </div> -->
        </br>
        <!-- config de nivel 1 -->
        <?php
        if ($_SESSION['UsuarioNivel'] == '1') {
        ?>
        <div class="row">
            <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <!-- <th scope="col">Nome</th> -->
                        <th scope="col">Local</th>
                        <th scope="col">Setor</th>
                        <th scope="col">Entrada</th>
                        <th scope="col">Status</th>
                        <th scope="col">Chapa</th>
                        <th scope="col">Chamado</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include 'banco.php';
                        $pdo = Banco::conectar();
                        $sql = 'SELECT * FROM maquina ORDER BY id DESC';

                        foreach ($pdo->query($sql) as $row) {
                            if ($row['status'] == 'Transferencia') {
                                echo '<tr>';
                                echo '<th scope="row">' . $row['id'] . '</th>';
                                echo '<td>' . $row['local'] . '</td>';
                                echo '<td>' . $row['setor'] . '</td>';
                                echo '<td>' . $row['entrada'] . '</td>';
                                echo '<td>' . $row['status'] . '</td>';
                                echo '<td>' . $row['chapa'] . '</td>';
                                echo '<td>' . $row['chamado'] . '</td>';
                                echo '<td width=200>';
                                echo '<a class="btn btn-primary" href="read.php?id=' . $row['id'] . '">Info</a>';
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
        <!-- fim config de nivel 1 -->

        <!-- config de nivel 2 -->
        <?php
        if ($_SESSION['UsuarioNivel'] == '2') {
        ?>
        <div class="row">
            <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Tipo</th>
                        <!-- <th scope="col">Nome</th> -->
                        <th scope="col">Local</th>
                        <th scope="col">Setor</th>
                        <th scope="col">Entrada</th>
                        <th scope="col">Status</th>
                        <th scope="col">Chapa</th>
                       
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include 'banco.php';
                        $pdo = Banco::conectar();
                        $sql = 'SELECT * FROM maquina ORDER BY id DESC';

                        foreach ($pdo->query($sql) as $row) {
                            if ($row['status'] == 'Transferencia') {
                                echo '<tr>';
                                echo '<th scope="row">' . $row['equip'] . '</th>';
                                echo '<td>' . $row['local'] . '</td>';
                                echo '<td>' . $row['setor'] . '</td>';
                                echo '<td>' . $row['entrada'] . '</td>';
                                echo '<td>' . $row['status'] . '</td>';
                                echo '<td>' . $row['chapa'] . '</td>';
                                echo '<td width=300>';
                                echo '<a class="btn btn-primary" href="read.php?id=' . $row['id'] . '">Info</a>';
                                echo ' ';
				echo '<a class="btn btn-warning" href="update.php?id=' . $row['id'] . '">Atualizar</a>';
                                echo ' ';
                                echo '<a class="btn btn-dark" href="imprimir.php?id=' . $row['id'] . '">Imprimir</a>';
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
        <!-- fim config de nivel 2 -->

        <!-- config de nivel 3 e 4-->
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
                        <th scope="col">Local</th>
                        <th scope="col">Setor</th>
                        <th scope="col">Entrada</th>
                        <th scope="col">Status</th>
                        <th scope="col">Chapa</th>
                        <th scope="col">Chamado</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include 'banco.php';
                        $pdo = Banco::conectar();
                        $sql = 'SELECT * FROM maquina ORDER BY id DESC';

                        foreach ($pdo->query($sql) as $row) {
                            if ($row['status'] == 'Transferencia') {
                                echo '<tr>';
                                echo '<th scope="row">' . $row['id'] . '</th>';
                                echo '<td>' . $row['local'] . '</td>';
                                echo '<td>' . $row['setor'] . '</td>';
                                echo '<td>' . $row['entrada'] . '</td>';
                                echo '<td>' . $row['status'] . '</td>';
                                echo '<td>' . $row['chapa'] . '</td>';
                                echo '<td>' . $row['chamado'] . '</td>';
                                echo '<td width=300>';
                                echo '<a class="btn btn-primary" href="read.php?id=' . $row['id'] . '">Info</a>';
                                echo ' ';
                                echo '<a class="btn btn-warning" href="update.php?id=' . $row['id'] . '">Atualizar</a>';
                                echo ' ';
                                echo '<a class="btn btn-dark" href="imprimir.php?id=' . $row['id'] . '">Imprimir</a>';
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
        <!-- fim config de nivel 3 e 4-->

        <!-- config de nivel 5-->
        <?php
        if ($_SESSION['UsuarioNivel'] == '5') {
        ?>
        <div class="row">
            <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <!-- <th scope="col">Nome</th> -->
                        <th scope="col">Local</th>
                        <th scope="col">Setor</th>
                        <th scope="col">Entrada</th>
                        <th scope="col">Status</th>
                        <th scope="col">Chapa</th>
                        <th scope="col">Chamado</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include 'banco.php';
                        $pdo = Banco::conectar();
                        $sql = 'SELECT * FROM maquina ORDER BY id DESC';

                        foreach ($pdo->query($sql) as $row) {
                            if ($row['status'] == 'Transferencia') {
                                echo '<tr>';
                                echo '<th scope="row">' . $row['id'] . '</th>';
                                echo '<td>' . $row['local'] . '</td>';
                                echo '<td>' . $row['setor'] . '</td>';
                                echo '<td>' . $row['entrada'] . '</td>';
                                echo '<td>' . $row['status'] . '</td>';
                                echo '<td>' . $row['chapa'] . '</td>';
                                echo '<td>' . $row['chamado'] . '</td>';
                                echo '<td width=350>';
                                echo '<a class="btn btn-primary" href="read.php?id=' . $row['id'] . '">Info</a>';
                                echo ' ';
                                echo '<a class="btn btn-warning" href="update.php?id=' . $row['id'] . '">Atualizar</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="delete.php?id=' . $row['id'] . '">Excluir</a>';
                                echo ' ';
                                echo '<a class="btn btn-dark" href="imprimir.php?id=' . $row['id'] . '">Imprimir</a>';
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
        <!-- fim config de nivel 5-->

        <hr>

    </div>

    <footer>
        <div class="container">
            <span class="badge badge-secondary">v 1.0.2 &copy; 2021 - Marcos A. R. T. dos Santos</span>


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
