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
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
</head>

<body>
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
          <a class="dropdown-item" href="../sistem/transferencia.php">Transferencia</a>
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
          <a href="../private/config.php" class="dropdown-item">Configurações gerais</a>
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

<!--
    <header>
        <div class="container">
<<<<<<< HEAD
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="../index.php">Sistema de Controle de Maquinas</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false"
                    aria-label="Alterna navegação">
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
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Maquinas
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="../index.php">Pendentes</a>
                                <a class="dropdown-item" href="../sistem/transferencia.php">Transferencia</a>
                                <a class="dropdown-item" href="../sistem/entregues.php">Entregues</a>
                                <a class="dropdown-item" href="../sistem/maquinas_livres.php">Livres</a>
                                <a class="dropdown-item" href="#"></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item disabled" href="#">Em Breve</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                    <a href="../private/config.php" class="dropdown-item">Configurações gerais</a>
                                    <?php
                                        }
                                    ?>
                            </div>
                        </li>
                        <li class="nav-item">
                            <!--  <a class="nav-link disabled" href="#">Desativado</a> -->
                        </li>
                    </ul>
=======
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
                                <a href="index.php" class="nav-link">Pendentes</a>
                            </li>
                            <li class="nav-item">
                                <a href="entregues.php" class="nav-link">Entregues</a>
                            </li>
			   <li class="nav-item">
				<a href="maquinas_livres.php" class="nav-link">Maq. Livres</a>
			    </li>
                            <li class="nav-item">
                                <a href="../users/index.php" class="nav-link">Usuario</a>
                            </li>
                            <li class="nav-item">
                                <a href="../logout.php" class="nav-link">Logout</a>
                            </li>
                            <li class="nav-item">
                                <a href="../users/trocarsenha.php" class="nav-link">Trocar senha</a>
                            </li>

                            <?php
                            if ($_SESSION['UsuarioNivel'] == '5' || $_SESSION['UsuarioID'] == '7') {
                            ?>
                            <li class="nav-item">
                                <a href="../private/config.php" class="nav-link">Configurações gerais</a>
                            </li>
                            <?php
                            }
                            ?>


                        </ul>
                    </div>
>>>>>>> 119c61a00f75ab206ddcb45b23e6e4c27850d977
                </div>
            </nav>
        </div>
    </header>

<<<<<<< HEAD

    <!-- END nav -->
    <div class="container">
        </br>
=======
    <div class="container">
       </br>
>>>>>>> 119c61a00f75ab206ddcb45b23e6e4c27850d977
        <!-- config de nivel 1 -->
        <?php
        if ($_SESSION['UsuarioNivel'] == '1') {
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
<<<<<<< HEAD
                            if ($row['status'] != 'Entregue' || $row['status'] != 'CTI' || $row['status'] != 'Transferencia' ) {
=======
                            if ($row['status'] != 'Entregue' || $row['status'] != 'Livre' || $row['status'] != 'Transferencia' ) {
>>>>>>> 119c61a00f75ab206ddcb45b23e6e4c27850d977
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
        <!-- fim config de nivel 1 -->

        <!-- config de nivel 2, 3 e 4-->
        <?php
        if ($_SESSION['UsuarioNivel'] == '2' || $_SESSION['UsuarioNivel'] == '3' || $_SESSION['UsuarioNivel'] == '4') {
        ?>
        <div class="row">
            <p>
                <a href="create.php" class="btn btn-success">Adicionar</a>
            </p>
            <br>
            <table class="table table-striped" id="tab2">
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
                            if ($row['status'] != 'Entregue') {
<<<<<<< HEAD
                                if ($row['status'] != 'CTI' ) {
			                        if ($row['status'] != 'Transferencia'){
			                            if ($row['status'] != 'Arquivado'){
                                            echo '<tr>';
                                            echo '<th scope="row">' . $row['id'] . '</th>';
                                            echo '<td>' . $row['local'] . '</td>';
                                            echo '<td>' . $row['setor'] . '</td>';
                                            echo '<td width=150>' . $row['entrada'] . '</td>';
				                            echo '<td>' . $row['status'] . '</td>';
                                            echo '<td>' . $row['chapa'] . '</td>';
                                            echo '<td>' . $row['chamado'] . '-' . $row['id'] .  '</td>';
                                            echo '<td width=265>';
                                            echo '<a class="btn btn-primary" href="read.php?id=' . $row['id'] . '">Info</a>';
                                            echo ' ';
                                            echo '<a class="btn btn-warning" href="update.php?id=' . $row['id'] . '">Atualizar</a>';
                                            echo ' ';
                                            echo '<a class="btn btn-dark" href="imprimir.php?id=' . $row['id'] . '">Imprimir</a>';
                                            echo '</td>';
                                            echo '</tr>';
                                        }
			                        }
			                    }
			                }
=======
                            if ($row['status'] != 'Livre' ) {
			    if ($row['status'] != 'Transferencia'){
			    if ($row['status'] != 'Arquivado'){
                                echo '<tr>';
                                echo '<th scope="row">' . $row['id'] . '</th>';
                                echo '<td>' . $row['local'] . '</td>';
                                echo '<td>' . $row['setor'] . '</td>';
                                echo '<td width=150>' . $row['entrada'] . '</td>';
				echo '<td>' . $row['status'] . '</td>';
                                echo '<td>' . $row['chapa'] . '</td>';
                                echo '<td>' . $row['chamado'] . '-' . $row['id'] .  '</td>';
                                echo '<td width=265>';
                                echo '<a class="btn btn-primary" href="read.php?id=' . $row['id'] . '">Info</a>';
                                echo ' ';
                                echo '<a class="btn btn-warning" href="update.php?id=' . $row['id'] . '">Atualizar</a>';
                                echo ' ';
                                echo '<a class="btn btn-dark" href="imprimir.php?id=' . $row['id'] . '">Imprimir</a>';
                                echo '</td>';
                                echo '</tr>';
                            }
			}
			}
			}
>>>>>>> 119c61a00f75ab206ddcb45b23e6e4c27850d977
                        }
                        Banco::desconectar();
                        ?>
                </tbody>
            </table>
        </div>
        <?php
        }
        ?>
        <!-- fim config de nivel 2, 3 e 4-->

        <!-- config de nivel 5-->
        <?php
        if ($_SESSION['UsuarioNivel'] == '5') {
        ?>
        <div class="row">
            <p>
                <a href="create.php" class="btn btn-success">Adicionar</a>
            </p>
            <br>
            <table class="table table-striped" id="tab">
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
                            if ($row['status'] != 'Entregue') {
<<<<<<< HEAD
                            if ($row['status'] != 'CTI') {
=======
                            if ($row['status'] != 'Livre') {
>>>>>>> 119c61a00f75ab206ddcb45b23e6e4c27850d977
			    if ($row['status'] != 'Transferencia'){
			    if ($row['status'] != 'Arquivado'){
                                echo '<tr>';
                                echo '<th scope="row">' . $row['id'] . '</th>';
                                echo '<td>' . $row['local'] . '</td>';
                                // echo '<td>' . $row['nome'] . '</td>';
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
			}
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
<<<<<<< HEAD
            <span class="badge badge-secondary">v 2.0 &copy; 2021 - Marcos A. R. T. dos Santos</span>
=======
            <span class="badge badge-secondary">v 1.2.0 &copy; 2021 - Marcos A. R. T. dos Santos</span>
>>>>>>> 119c61a00f75ab206ddcb45b23e6e4c27850d977


        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <script>
    function AdicionarFiltro(tabela, coluna) {
        var cols = $("#" + tabela + " thead tr:first-child th").length;
        if ($("#" + tabela + " thead tr").length == 1) {
            var linhaFiltro = "<tr>";
            for (var i = 0; i < cols; i++) {
                linhaFiltro += "<th></th>";
            }
            linhaFiltro += "</tr>";

            $("#" + tabela + " thead").append(linhaFiltro);
        }

        var colFiltrar = $("#" + tabela + " thead tr:nth-child(2) th:nth-child(" + coluna + ")");

        $(colFiltrar).html("<select id='filtroColuna_" + coluna.toString() +
            "'  class='filtroColuna form-control'> </select>");

        var valores = new Array();

        $("#" + tabela + " tbody tr").each(function() {
            var txt = $(this).children("td:nth-child(" + coluna + ")").text();
            if (valores.indexOf(txt) < 0) {
                valores.push(txt);
            }
        });
        $("#filtroColuna_" + coluna.toString()).append("<option>Filtro</option>")
        for (elemento in valores) {
            $("#filtroColuna_" + coluna.toString()).append("<option>" + valores[elemento] + "</option>");
        }

        $("#filtroColuna_" + coluna.toString()).change(function() {
            var filtro = $(this).val();
            $("#" + tabela + " tbody tr").show();
            if (filtro != "Filtro") {
                $("#" + tabela + " tbody tr").each(function() {
                    var txt = $(this).children("td:nth-child(" + coluna + ")").text();
                    if (txt != filtro) {
                        $(this).hide();
                    }
                });
            }
        });

    };
    AdicionarFiltro("tab", 5);
    AdicionarFiltro("tab", 2);
    AdicionarFiltro("tab", 3);
    </script>

    <script>
    function AdicionarFiltro(tabela, coluna) {
        var cols = $("#" + tabela + " thead tr:first-child th").length;
        if ($("#" + tabela + " thead tr").length == 1) {
            var linhaFiltro = "<tr>";
            for (var i = 0; i < cols; i++) {
                linhaFiltro += "<th></th>";
            }
            linhaFiltro += "</tr>";

            $("#" + tabela + " thead").append(linhaFiltro);
        }

        var colFiltrar = $("#" + tabela + " thead tr:nth-child(2) th:nth-child(" + coluna + ")");

        $(colFiltrar).html("<select id='filtroColuna_" + coluna.toString() +
            "'  class='filtroColuna form-control'> </select>");

        var valores = new Array();

        $("#" + tabela + " tbody tr").each(function() {
            var txt = $(this).children("td:nth-child(" + coluna + ")").text();
            if (valores.indexOf(txt) < 0) {
                valores.push(txt);
            }
        });
        $("#filtroColuna_" + coluna.toString()).append("<option>Filtro</option>")
        for (elemento in valores) {
            $("#filtroColuna_" + coluna.toString()).append("<option>" + valores[elemento] + "</option>");
        }

        $("#filtroColuna_" + coluna.toString()).change(function() {
            var filtro = $(this).val();
            $("#" + tabela + " tbody tr").show();
            if (filtro != "Filtro") {
                $("#" + tabela + " tbody tr").each(function() {
                    var txt = $(this).children("td:nth-child(" + coluna + ")").text();
                    if (txt != filtro) {
                        $(this).hide();
                    }
                });
            }
        });

    };
    AdicionarFiltro("tab2", 2);
    AdicionarFiltro("tab2", 3);
    AdicionarFiltro("tab2", 5);
    </script>
<<<<<<< HEAD
    <script src="https://apps.elfsight.com/p/platform.js" defer></script>
    <div class="elfsight-app-0adf68fa-23ad-4b8d-81ce-a072aa689b8a"></div>
=======
<script src="https://apps.elfsight.com/p/platform.js" defer></script>
<div class="elfsight-app-0adf68fa-23ad-4b8d-81ce-a072aa689b8a"></div>
>>>>>>> 119c61a00f75ab206ddcb45b23e6e4c27850d977
</body>

</html>
