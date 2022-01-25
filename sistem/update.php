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
    $telefoneErro = null;
    $emailErro = null;
    $problemaErro = null;
    $localErro = null;
    $setorErro = null;
    $saidaErro = null;
    $entradaErro = null;
    $tecnicoErro = null;
    $statusErro = null;
    $equipErro = null;
    $chapaErro = null;
    $chamadoErro = null;

    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $problema = $_POST['problema'];
    $local = $_POST['local'];
    $setor = $_POST['setor'];
    $saida = $_POST['saida'];
    $entrada = $_POST['entrada'];
    $tecnico = $_POST['tecnico'];
    $status = $_POST['status'];
    $equip = $_POST['equip'];
    $chapa = $_POST['chapa'];
    $chamado = $_POST['chamado'];

    //Validação
    $validacao = true;
    if (empty($nome)) {
        $nomeErro = 'Por favor digite o nome!';
        $validacao = false;
    }

    if (empty($email)) {
        $emailErro = 'Por favor digite o email!';
        $validacao = false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErro = 'Por favor digite um email válido!';
        $validacao = false;
    }


    if (empty($telefone)) {
        $telefoneErro = 'Por favor digite o telefone!';
        $validacao = false;
    }

    if ($status == 000) {
        $statusErro = 'Por favor Escolhe um Status!';
        $validacao = false;
    }



    // update data
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE maquina  set nome = ?, telefone = ?, email = ?, local = ?, setor = ?, entrada = ?, saida = ?, tecnico = ?, status = ?, equip = ?, chapa = ?, chamado = ?, problema = ? WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $telefone, $email, $local, $setor, $entrada, $saida, $tecnico, $status, $equip, $chapa, $chamado, $problema, $id));
        Banco::desconectar();
        header("Location: index.php");
    }
} else {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM maquina where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $nome = $data['nome'];
    $telefone = $data['telefone'];
    $email = $data['email'];
    $problema = $data['problema'];
    $local = $data['local'];
    $setor = $data['setor'];
    $saida = $data['saida'];
    $entrada = $data['entrada'];
    $tecnico = $data['tecnico'];
    $status = $data['status'];
    $equip = $data['equip'];
    $chapa = $data['chapa'];
    $chamado = $data['chamado'];
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
                <form class="form-horizontal" action="update.php?id=<?php echo $id ?>" method="post">
                <div class="row">
        <div class="form-group col-md-5">
            <div class="control-group  <?php echo !empty($nomeErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Nome do Requerente</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="nome" type="text" 
                                   value="<?php echo !empty($nome) ? $nome : ''; ?>">
                            <?php if (!empty($nomeErro)): ?>
                                <span class="text-danger"><?php echo $nomeErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
        </div>

        <div class="form-group col-md-2">
            <div class="control-group <?php echo !empty($telefoneErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Telefone</label>
                        <div class="controls">
                            <input size="35" class="form-control" name="telefone" type="text" 
                                   value="<?php echo !empty($telefone) ? $telefone : ''; ?>">
                            <?php if (!empty($telefoneErro)): ?>
                                <span class="text-danger"><?php echo $telefoneErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
        </div>
        <div class="form-group col-md-5">
        <div class="control-group <?php !empty($emailErro) ? '$emailErro ' : ''; ?>">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <input size="40" class="form-control" name="email" type="text" 
                                   value="<?php echo !empty($email) ? $email : ''; ?>">
                            <?php if (!empty($emailErro)): ?>
                                <span class="text-danger"><?php echo $emailErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
        </div>
    </div>
<br>
    <div class="row">
        <div class="form-group col-md-3">
            <div class="control-goup <?php !empty($localErro) ? '$localErro ' : ''; ?>">
        <label class="control-label">Localidade</label>
        <div class="controls">
        <input size="40" class="form-control" name="local" type="text" 
                                   value="<?php echo !empty($local) ? $local : ''; ?>">
                            <?php if (!empty($localErro)): ?>
                                <span class="text-danger"><?php echo $localErro; ?></span>
                            <?php endif; ?>
                    </div>
                    </div>
        </div>

        <div class="form-group col-md-3">
        <div class="control-goup <?php !empty($setorErro) ? '$setorErro ' : ''; ?>">
        <label class="control-label">Setor</label>
        <div class="controls">
                    <select class="form-control" name="setor" placeholder="setor" value="<?php echo !empty($setor) ? $setor : ''; ?>">
                    <option value="000"></option>
                    <?php 
                        if ($setor == "DSMM") {
                            ?>
                        <option selected value="DSMM">DSMM - Dep de Sementes, Mudas e Matrizes</option>
                        <option value="EDR">EDR - Escritorio dev. Rural</option>
                        <option value="CA">CA - Casa de Agricultura</option>
                        <option value="NPM">NPM - Nucle de Prod. de Mudas</option>
                        <option value="APTA">APTA - Agência Paulista de Tec. dos Agronegocios</option>
                        <option value="CDA">CDA - Corrdenadoria de Def. Agropecuaria</option>
                        <option value="CATI">CATI - Coordenadoria de Desenvolvimento Rural Sustentável</option>

                            <?php
                        }
                    ?>
                    <?php 
                        if ($setor == "EDR") {
                            ?>
                        <option value="DSMM">DSMM - Dep de Sementes, Mudas e Matrizes</option>
                        <option selected value="EDR">EDR - Escritorio dev. Rural</option>
                        <option value="CA">CA - Casa de Agricultura</option>
                        <option value="NPM">NPM - Nucle de Prod. de Mudas</option>
                        <option value="APTA">APTA - Agência Paulista de Tec. dos Agronegocios</option>
                        <option value="CDA">CDA - Corrdenadoria de Def. Agropecuaria</option>
                        <option value="CATI">CATI - Coordenadoria de Desenvolvimento Rural Sustentável</option>

                            <?php
                        }
                    ?>
                                        <?php 
                        if ($setor == "CA") {
                            ?>
                        <option value="DSMM">DSMM - Dep de Sementes, Mudas e Matrizes</option>
                        <option value="EDR">EDR - Escritorio dev. Rural</option>
                        <option selected value="CA">CA - Casa de Agricultura</option>
                        <option value="NPM">NPM - Nucle de Prod. de Mudas</option>
                        <option value="APTA">APTA - Agência Paulista de Tec. dos Agronegocios</option>
                        <option value="CDA">CDA - Corrdenadoria de Def. Agropecuaria</option>
                        <option value="CATI">CATI - Coordenadoria de Desenvolvimento Rural Sustentável</option>

                            <?php
                        }
                    ?>
                    <?php 
                        if ($setor == "NPM") {
                            ?>
                        <option value="DSMM">DSMM - Dep de Sementes, Mudas e Matrizes</option>
                        <option value="EDR">EDR - Escritorio dev. Rural</option>
                        <option value="CA">CA - Casa de Agricultura</option>
                        <option selected value="NPM">NPM - Nucle de Prod. de Mudas</option>
                        <option value="APTA">APTA - Agência Paulista de Tec. dos Agronegocios</option>
                        <option value="CDA">CDA - Corrdenadoria de Def. Agropecuaria</option>
                        <option value="CATI">CATI - Coordenadoria de Desenvolvimento Rural Sustentável</option>

                            <?php
                        }
                    ?>
                    <?php 
                        if ($setor == "APTA") {
                            ?>
                        <option value="DSMM">DSMM - Dep de Sementes, Mudas e Matrizes</option>
                        <option value="EDR">EDR - Escritorio dev. Rural</option>
                        <option value="CA">CA - Casa de Agricultura</option>
                        <option value="NPM">NPM - Nucle de Prod. de Mudas</option>
                        <option selected value="APTA">APTA - Agência Paulista de Tec. dos Agronegocios</option>
                        <option value="CDA">CDA - Corrdenadoria de Def. Agropecuaria</option>
                        <option value="CATI">CATI - Coordenadoria de Desenvolvimento Rural Sustentável</option>

                            <?php
                        }
                    ?>
                                        <?php 
                        if ($setor == "CDA") {
                            ?>
                        <option value="DSMM">DSMM - Dep de Sementes, Mudas e Matrizes</option>
                        <option value="EDR">EDR - Escritorio dev. Rural</option>
                        <option value="CA">CA - Casa de Agricultura</option>
                        <option value="NPM">NPM - Nucle de Prod. de Mudas</option>
                        <option value="APTA">APTA - Agência Paulista de Tec. dos Agronegocios</option>
                        <option selected value="CDA">CDA - Corrdenadoria de Def. Agropecuaria</option>
                        <option value="CATI">CATI - Coordenadoria de Desenvolvimento Rural Sustentável</option>

                            <?php
                        }
                    ?>
                                                            <?php 
                        if ($setor == "CATI") {
                            ?>
                        <option value="DSMM">DSMM - Dep de Sementes, Mudas e Matrizes</option>
                        <option value="EDR">EDR - Escritorio dev. Rural</option>
                        <option value="CA">CA - Casa de Agricultura</option>
                        <option value="NPM">NPM - Nucle de Prod. de Mudas</option>
                        <option value="APTA">APTA - Agência Paulista de Tec. dos Agronegocios</option>
                        <option value="CDA">CDA - Corrdenadoria de Def. Agropecuaria</option>
                        <option selected value="CATI">CATI - Coordenadoria de Desenvolvimento Rural Sustentável</option>
                            <?php
                        }
                    ?>
                    </select>
                    <?php if (!empty($setorErro)): ?>
                        <span class="text-danger"><?php echo $setorErro; ?></span>
                        <?php endif; ?>
                    </div>
                    </div>
        </div>

        <!-- <div class="form-group col-md-2">
            <label for="campo3">CEP</label>
            <input type="text" class="form-control" name="maquina['zip_code']">
        </div> -->

        <div class="form-group col-md-3">
            <div class="control-group  <?php echo !empty($entradaErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Data de Entrada</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="entrada" type="date" 
                                   value="<?php echo !empty($entrada) ? $entrada : ''; ?>">
                            <?php if (!empty($entradaErro)): ?>
                                <span class="text-danger"><?php echo $entradaErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
        </div>

        <div class="form-group col-md-3">
        <div class="control-group  <?php echo !empty($saidaErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Data de Saida</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="saida" type="date" 
                                   value="<?php echo !empty($saida) ? $saida : ''; ?>">
                            <?php if (!empty($saidaErro)): ?>
                                <span class="text-danger"><?php echo $saidaErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="form-group col-md-4">
        <div class="control-group  <?php echo !empty($tecnicoErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Tecnico quem Arrumou</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="tecnico" type="text" 
                                   value="<?php echo !empty($tecnico) ? $tecnico : ''; ?>">
                            <?php if (!empty($tecnicoErro)): ?>
                                <span class="text-danger"><?php echo $tecnicoErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
        </div>

        <div class="form-group col-md-2">
        <div class="control-goup <?php !empty($statusErro) ? '$statusErro ' : ''; ?>">
        <label class="control-label">Status</label>
        <div class="controls">
                    <select class="form-control" name="status" placeholder="status" value="<?php echo !empty($status) ? $status : ''; ?>">
                    <option value="000"></option>
                    <?php 
                        if ($status == "Não mexido") {
                            ?>
                            <option selected value="Não mexido"> Não mexido </option>
                            <option value="Sendo Mexido"> Sendo Mexido </option>
                            <option value="Pronta"> Pronta </option>
                            <option value="Entregue"> Entregue </option>
                            <option value="Baixa"> Baixa </option>
                            <option value="Transferencia"> Transferencia </option>
                            <option value="Emprestado"> Emprestado </option>

                            <?php
                        }
                    ?>
                    <?php 
                        if ($status == "Sendo Mexido") {
                            ?>
                            <option value="Não mexido"> Não mexido </option>
                            <option selected value="Sendo Mexido"> Sendo Mexido </option>
                            <option value="Pronta"> Pronta </option>
                            <option value="Entregue"> Entregue </option>
                            <option value="Baixa"> Baixa </option>
                            <option value="Transferencia"> Transferencia </option>
                            <option value="Emprestado"> Emprestado </option>

                            <?php
                        }
                    ?>
                                        <?php 
                        if ($status == "Pronta") {
                            ?>
                            <option value="Não mexido"> Não mexido </option>
                            <option value="Sendo Mexido"> Sendo Mexido </option>
                            <option selected value="Pronta"> Pronta </option>
                            <option value="Entregue"> Entregue </option>
                            <option value="Baixa"> Baixa </option>
                            <option value="Transferencia"> Transferencia </option>
                            <option value="Emprestado"> Emprestado </option>

                            <?php
                        }
                    ?>
                    <?php 
                        if ($status == "Entregue") {
                            ?>
                            <option value="Não mexido"> Não mexido </option>
                            <option value="Sendo Mexido"> Sendo Mexido </option>
                            <option value="Pronta"> Pronta </option>
                            <option selected value="Entregue"> Entregue </option>
                            <option value="Baixa"> Baixa </option>
                            <option value="Transferencia"> Transferencia </option>
                            <option value="Emprestado"> Emprestado </option>

                            <?php
                        }
                    ?>
                    <?php 
                        if ($status == "Baixa") {
                            ?>
                            <option value="Não mexido"> Não mexido </option>
                            <option value="Sendo Mexido"> Sendo Mexido </option>
                            <option value="Pronta"> Pronta </option>
                            <option value="Entregue"> Entregue </option>
                            <option selected value="Baixa"> Baixa </option>
                            <option value="Transferencia"> Transferencia </option>
                            <option value="Emprestado"> Emprestado </option>

                            <?php
                        }
                    ?>
                    <?php 
                        if ($status == "Transferencia") {
                            ?>
                            <option value="Não mexido"> Não mexido </option>
                            <option value="Sendo Mexido"> Sendo Mexido </option>
                            <option value="Pronta"> Pronta </option>
                            <option value="Entregue"> Entregue </option>
                            <option value="Baixa"> Baixa </option>
                            <option selected value="Transferencia"> Transferencia </option>
                            <option value="Emprestado"> Emprestado </option>

                            <?php
                        }
                    ?>
                                        <?php 
                        if ($status == "Emprestado") {
                            ?>
                            <option value="Não mexido"> Não mexido </option>
                            <option value="Sendo Mexido"> Sendo Mexido </option>
                            <option value="Pronta"> Pronta </option>
                            <option value="Entregue"> Entregue </option>
                            <option value="Baixa"> Baixa </option>
                            <option  value="Transferencia"> Transferencia </option>
                            <option selected value="Emprestado"> Emprestado </option>

                            <?php
                        }
                    ?>
                        <!-- <option value="Não mexido"> Não mexido </option>
                        <option value="Sendo Mexido"> Sendo Mexido </option>
                        <option value="Pronta"> Pronta </option>
                        <option value="Entregue"> Entregue </option>
                        <option value="Baixa"> Baixa </option>
                        <option value="Transferencia"> Transferencia </option> -->
                    </select>
                    <?php if (!empty($statusErro)): ?>
                        <span class="text-danger"><?php echo $statusErro; ?></span>
                        <?php endif; ?>
                    </div>
                    </div>
        </div>

        <div class="form-group col-md-2">
        <div class="control-goup <?php !empty($equipErro) ? '$equipErro ' : ''; ?>">
        <label class="control-label">Equipamento</label>
        <div class="controls">
                    <select class="form-control" name="equip" placeholder="equip" value="<?php echo !empty($equip) ? $equip : ''; ?>">
                    <option value="000"></option>
                    <?php 
                        if ($equip == "Impressora") {
                            ?>
                        <option selected value="Impressora">Impressora</option>
                        <option value="Desktop">Desktop</option>
                        <option value="Notebook">Notebook</option>
                        <option value="Roteador">Roteador</option>
                        <option value="Monitor">Monitor</option>
                            <?php
                        }
                    ?>
                    <?php 
                        if ($equip == "Desktop") {
                            ?>
                        <option value="Impressora">Impressora</option>
                        <option selected value="Desktop">Desktop</option>
                        <option value="Notebook">Notebook</option>
                        <option value="Roteador">Roteador</option>
                        <option value="Monitor">Monitor</option>
                            <?php
                        }
                    ?>
                                        <?php 
                        if ($equip == "Notebook") {
                            ?>
                        <option value="Impressora">Impressora</option>
                        <option value="Desktop">Desktop</option>
                        <option selected value="Notebook">Notebook</option>
                        <option value="Roteador">Roteador</option>
                        <option value="Monitor">Monitor</option>
                            <?php
                        }
                    ?>
                    <?php 
                        if ($equip == "Roteador") {
                            ?>
                        <option value="Impressora">Impressora</option>
                        <option value="Desktop">Desktop</option>
                        <option value="Notebook">Notebook</option>
                        <option selected value="Roteador">Roteador</option>
                        <option value="Monitor">Monitor</option>
                            <?php
                        }
                    ?>
                    <?php 
                        if ($equip == "Monitor") {
                            ?>
                        <option value="Impressora">Impressora</option>
                        <option value="Desktop">Desktop</option>
                        <option value="Notebook">Notebook</option>
                        <option value="Roteador">Roteador</option>
                        <option selected value="Monitor">Monitor</option>
                            <?php
                        }
                    ?>
                    </select>
                    <?php if (!empty($equipErro)): ?>
                        <span class="text-danger"><?php echo $equipErro; ?></span>
                        <?php endif; ?>
                    </div>
                    </div>
        </div>

        <div class="form-group col-md-2">
        <div class="control-group  <?php echo !empty($chapaErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Chapa</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="chapa" type="text" 
                                   value="<?php echo !empty($chapa) ? $chapa : ''; ?>">
                            <?php if (!empty($chapaErro)): ?>
                                <span class="text-danger"><?php echo $chapaErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
        </div>

        <div class="form-group col-md-2">
        <div class="control-group  <?php echo !empty($chamadoErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Chamado</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="chamado" type="text" 
                                   value="<?php echo !empty($chamado) ? $chamado : ''; ?>">
                            <?php if (!empty($chamadoErro)): ?>
                                <span class="text-danger"><?php echo $chamadoErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
        </div>
    
    </div>
    
    <div class="row">
    <div class="form-group col-md-12">
    <div class="control-group  <?php echo !empty($problemaErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Problema</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="problema" type="text" 
                                   value="<?php echo !empty($problema) ? $problema : ''; ?>">
                            <?php if (!empty($problemaErro)): ?>
                                <span class="text-danger"><?php echo $problemaErro; ?></span>
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
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="../assets/js/bootstrap.min.js"></script>
</body>

</html>
