<?php
require 'banco.php';
$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: index.php");
} else {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM maquina where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Banco::desconectar();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <title>Informações do Contato</title>
</head>

<body>
<div class="container">
    <div class="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well">Informações do Contato</h3>
            </div>
            <div class="container">
<br>
            <div class="row">
        <div class="form-group col-md-5">
            <label for="name">Nome do Requerente</label>
            <div class="controls form-control disabled">
            <label class="carousel-inner">
                <?php echo $data['nome']; ?>
            </label>
            </div>
        </div>

        <div class="form-group col-md-2">
            <label for="telefone">Telefone</label>
            <div class="controls form-control disabled">
            <label class="carousel-inner">
                <?php echo $data['telefone']; ?>
            </label>
            </div>
        </div>
        <div class="form-group col-md-5">
            <label for="email">Email</label>
            <div class="controls form-control disabled">
            <label class="carousel-inner">
                <?php echo $data['email']; ?>
            </label>
            </div>
        </div>
    </div>
<br>
    <div class="row">
        <div class="form-group col-md-5">
        <label for="local">Localidade</label>
        <div class="controls form-control disabled">
            <label class="carousel-inner">
                <?php echo $data['local']; ?>
            </label>
            </div>
        </div>

        <div class="form-group col-md-3">
        <label for="setor">Setor</label>
        <div class="controls form-control disabled">
            <label class="carousel-inner">
                <?php echo $data['setor']; ?>
            </label>
            </div>
        </div>

        <div class="form-group col-md-2">
            <label for="entrada">Data de entrada</label>
            <div class="controls form-control disabled">
            <label class="carousel-inner">
                <?php echo $data['entrada']; ?>
            </label>
            </div>
        </div>

        <div class="form-group col-md-2">
            <label for="saida">Data de saida</label>
            <div class="controls form-control disabled">
            <label class="carousel-inner">
                <?php echo $data['saida']; ?>
            </label>
            </div>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="form-group col-md-4">
            <label for="tecnico">Tecnico</label>
            <div class="controls form-control disabled">
            <label class="carousel-inner">
                <?php echo $data['tecnico']; ?>
            </label>
            </div>
        </div>

        <div class="form-group col-md-2">
        <label for="status">Status</label>
        <div class="controls form-control disabled">
            <label class="carousel-inner">
                <?php echo $data['status']; ?>
            </label>
            </div>
        </div>

        <div class="form-group col-md-2">
        <label for="equip">Equipamento</label>
        <div class="controls form-control disabled">
            <label class="carousel-inner">
                <?php echo $data['equip']; ?>
            </label>
            </div>
        </div>

        <div class="form-group col-md-2">
            <label for="chapa">Chapa</label>
            <div class="controls form-control disabled">
            <label class="carousel-inner">
                <?php echo $data['chapa']; ?>
            </label>
            </div>
        </div>

        <div class="form-group col-md-2">
            <label for="chamado">Chamado</label>
            <div class="controls form-control disabled">
            <label class="carousel-inner">
                <?php echo $data['chamado']; ?>
            </label>
            </div>
        </div>
</div>
<br>
<div class="row">
        <div class="form-group col-md-12">
            <label for="problema">Problema</label>
            <div class="controls form-control disabled">
            <label class="carousel-inner">
                <?php echo $data['problema']; ?>
            </label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12">
            <label for="problema">Quem recebeu</label>
            <div class="controls form-control disabled">
            <label class="carousel-inner">
                <?php echo $data['recebe']; ?>
            </label>
            </div>
        </div>
    </div>
                
                    <br/>
                    <div class="form-actions">
                        <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                    <a href="imprimir.php" type="btn" class="btn btn-default">Imprimir</a>
                </div>
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
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="../assets/js/bootstrap.min.js"></script>
</body>

</html>
