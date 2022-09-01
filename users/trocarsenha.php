<?php

$id = null;

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
require 'banco.php';

$id = $_SESSION['UsuarioID'];

if (!empty($_POST)) {

    $senhaErro = null;
    $senha = $_POST['senha'];



    //Validação
    $validacao = true;
    if (empty($senha)) {
        $senhaErro = 'Por favor digita nova senha ou a atual!';
        $validacao = false;
    }



    // update data
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE usuarios set senha = SHA1(?) WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($senha, $id));
        Banco::desconectar();
        header("Location: ../logout.php");
    }
} else {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM usuarios where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $senha = $data['senha'];
    Banco::desconectar();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- using new bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Atualizar Senha</title>
</head>

<body>
    <div class="container">

        <div class="span10 offset1">
            <div class="card">
                <div class="card-header">
                    <h3 class="well">Atualizar Senha</h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="trocarsenha.php?id=<?php echo $id ?>" method="post">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="control-goup <?php !empty($senhaErro) ? '$senhaErro ' : ''; ?>">
                                    <div class="controls">
                                        <input size="40" class="form-control" name="senha" type="text" value=""
                                            placeholder="Insira sua senha">
                                        <?php if (!empty($senhaErro)) : ?>
                                        <span class="text-danger"><?php echo $senhaErro; ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-warning">Atualizar</button>
                            <a href="../sistem/index.php" type="btn" class="btn btn-default">Voltar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="container">
            <span class="badge badge-secondary">v 1.0.0</span>
            <p>&copy; 2021 - Marcos A. R. T. dos Santos</p>


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