<?php

require 'banco.php';

$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: index.php");
}

if (!empty($_POST)) {

    $nomeErro = null;
    $usuarioErro = null;
    $senhaErro = null;
    $emailErro = null;
    $nivelErro = null;
    $ativoErro = null;
    $saidaErro = null;
    $cadastroErro = null;


    $nome = $_POST['nome'];
    $senha = $_POST['senha'];



    //Validação
    $validacao = true;
    if (empty($nome)) {
        $nomeErro = 'Por favor digite o nome!';
        $validacao = false;
    }

    if (empty($senha)) {
        $senhaErro = 'Por favor digita nova senha ou a atual!';
        $validacao = false;
    }



    // update data
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE usuarios  set nome = ?, senha = SHA1(?) WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $senha, $id));
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
    $nome = $data['nome'];
    $usuario = $data['usuario'];
    $email = $data['email'];
    $senha = $data['senha'];
    $nivel = $data['nivel'];
    $ativo = $data['ativo'];
    $cadastro = $data['cadastro'];
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

    <title>Atualizar Contato</title>
</head>

<body>
    <div class="container">

        <div class="span10 offset1">
            <div class="card">
                <div class="card-header">
                    <h3 class="well"> Atualizar Contato </h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="updatenivel1.php?id=<?php echo $id ?>" method="post">
                        <div class="row">
                            <div class="form-group col-md-5">
                                <div class="control-group  <?php echo !empty($nomeErro) ? 'error ' : ''; ?>">
                                    <label class="control-label">Nome</label>
                                    <div class="controls">
                                        <input size="50" class="form-control" name="nome" type="text"
                                            value="<?php echo !empty($nome) ? $nome : ''; ?>">
                                        <?php if (!empty($nomeErro)) : ?>
                                        <span class="text-danger"><?php echo $nomeErro; ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-2">
                                <div class="control-goup <?php !empty($usuarioErro) ? '$usuarioErro ' : ''; ?>">
                                    <label class="control-label">Usuario</label>
                                    <div class="controls">
                                        <input disabled size="40" class="form-control" name="usuario" type="text"
                                            value="<?php echo !empty($usuario) ? $usuario : ''; ?>">
                                        <?php if (!empty($usuarioErro)) : ?>
                                        <span class="text-danger"><?php echo $usuarioErro; ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-5">
                                <div class="control-goup <?php !empty($emailErro) ? '$emailErro ' : ''; ?>">
                                    <label class="control-label">Email</label>
                                    <div class="controls">
                                        <input disabled size="40" class="form-control" name="email" type="text"
                                            value="<?php echo !empty($email) ? $email : ''; ?>">
                                        <?php if (!empty($emailErro)) : ?>
                                        <span class="text-danger"><?php echo $emailErro; ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-5">
                                <div class="control-goup <?php !empty($senhaErro) ? '$senhaErro ' : ''; ?>">
                                    <label class="control-label">senha</label>
                                    <div class="controls">
                                        <input size="40" class="form-control" name="senha" type="text"
                                            value="" placeholder="Insira sua senha">
                                        <?php if (!empty($senhaErro)) : ?>
                                        <span class="text-danger"><?php echo $senhaErro; ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-1">
                                <div class="control-goup <?php !empty($nivelErro) ? '$nivelErro ' : ''; ?>">
                                    <label class="control-label">Nivel</label>
                                    <div class="controls">
                                        <input disabled size="40" class="form-control" name="nivel" type="text"
                                            value="<?php echo !empty($nivel) ? $nivel : ''; ?>">
                                        <?php if (!empty($nivelErro)) : ?>
                                        <span class="text-danger"><?php echo $nivelErro; ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="form-group col-md-2">
            <label for="campo3">CEP</label>
            <input type="text" class="form-control" name="maquina['zip_code']">
        </div> -->

                            <div class="form-group col-md-3">
                                <div class="control-goup <?php !empty($cadastroErro) ? '$cadastroErro ' : ''; ?>">
                                    <label class="control-label">Cadastro</label>
                                    <div class="controls">
                                        <input disabled size="40" class="form-control" name="cadastro" type="text"
                                            value="<?php echo !empty($cadastro) ? $cadastro : ''; ?>">
                                        <?php if (!empty($cadastroErro)) : ?>
                                        <span class="text-danger"><?php echo $cadastroErro; ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <br>



                        <div class="form-actions">
                            <button type="submit" class="btn btn-warning">Atualizar</button>
                            <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
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