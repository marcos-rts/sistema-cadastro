<?php

// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();

// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['UsuarioID'])) {
    // Destrói a sessão por segurança
    session_destroy();
    // Redireciona o visitante de volta pro login
    header("Location: login.php");
    exit;
}

?>
<?php
require 'banco.php';
//Acompanha os erros de validação

// Processar so quando tenha uma chamada post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $local2Erro = null;
    $equipErro = null;
    $chapaErro = null;
    $chamadoErro = null;
    $solucaoErro = null;
    $modeloErro = null;

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
    $local2 = $_POST['local2'];
    $equip = $_POST['equip'];
    $chapa = $_POST['chapa'];
    $chamado = $_POST['chamado'];
    $recebe = $_SESSION['UsuarioNome'];
    $solucao = $_POST['solucao'];
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 119c61a00f75ab206ddcb45b23e6e4c27850d977
    $modelo = $_POST['modelo'];
    $ram = $_POST['ram'];
    $processador = $_POST['processador'];
    $fonte = $_POST['fonte'];
    $bios = $_POST['bios'];
    $hd = $_POST['hd'];
<<<<<<< HEAD
=======
=======
>>>>>>> b7d821aa26fbb4a0b6bd0d80c6f50d769152426b
>>>>>>> 119c61a00f75ab206ddcb45b23e6e4c27850d977

    $validacao = true;

    if (!empty($_POST)) {

        $novoUsuario = False;
        if (!empty($_POST['nome'])) {
            $nome = $_POST['nome'];
        } else {
            $nomeErro = 'Por favor digite o seu nome!';
            $validacao = False;
        }
        if (!empty($_POST['telefone'])) {
            $telefone = $_POST['telefone'];
        } else {
            $telefoneErro = 'Por favor digite o número do telefone!';
            $validacao = False;
        }

        if (!empty($_POST['email'])) {
            $email = $_POST['email'];
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $emailErro = 'Por favor digite um endereço de email válido!';
                $validacao = False;
            }
        } else {
            $emailErro = 'Por favor digite um endereço de email!';
            $validacao = False;
        }

	if (!empty($_POST['tecnico'])){
		$tecnico = $_POST['tecnico'];
	} else {
		$tecnico = "-";
	}
<<<<<<< HEAD
    if (!empty($_POST['local2'])){
		$local2 = $_POST['local2'];
	} else {
		$local2 = "Datacenter";
	}
=======
>>>>>>> 119c61a00f75ab206ddcb45b23e6e4c27850d977
	if (!empty($_POST['saida'])){
		$saida = $_POST['saida'];
	} else {
		$saida = '0000-00-00';
	}

	if (!empty($_POST['chamado'])){
		$chamado = $_POST['chamado'];
	} else {
		$chamado = '0000';
	}

	if (!empty($_POST['chapa'])){
		$chapa = $_POST['chapa'];
	} else {
		$chapaErro = 'Por favor digite o número da chapa!';
		$validacao = False;
	}

	if (!empty($_POST['solucao'])){
	        $solucao = $_POST['solucao'];
        } else {
                $solucao = '-';
        }
    }

    //Inserindo no Banco:
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
<<<<<<< HEAD
        $sql = "INSERT INTO maquina (nome, telefone, email, local, setor, entrada, saida, tecnico, status, equip, chapa, chamado, problema, solucao, recebe, modelo, ram, processador, fonte, bios, hd, local2) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $telefone, $email, $local, $setor, $entrada, $saida, $tecnico, $status, $equip, $chapa, $chamado, $problema, $solucao, $recebe, $modelo, $ram, $processador, $fonte, $bios, $hd, $local2));
=======
        $sql = "INSERT INTO maquina (nome, telefone, email, local, setor, entrada, saida, tecnico, status, equip, chapa, chamado, problema, solucao, recebe, modelo, ram, processador, fonte, bios, hd) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $telefone, $email, $local, $setor, $entrada, $saida, $tecnico, $status, $equip, $chapa, $chamado, $problema, $solucao, $recebe, $modelo, $ram, $processador, $fonte, $bios, $hd));
>>>>>>> 119c61a00f75ab206ddcb45b23e6e4c27850d977
        Banco::desconectar();
        header("Location: index.php");
    }
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <title>Adicionar Maquina</title>
</head>

<body>
<header>
        <div class="container">
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
                </div>
            </nav>
        </div>
    </header>

    <div class="container">
        <div clas="span10 offset1">
            <div class="card">
                <div class="card-header">
                    <h3 class="well"> Adicionar Contato </h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="create.php" method="post">

                        <div class="row">
                            <div class="form-group col-md-5">
                                <div class="control-group  <?php echo !empty($nomeErro) ? 'error ' : ''; ?>">
                                    <label class="control-label">Nome do Requerente</label>
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
                                <div class="control-group <?php echo !empty($telefoneErro) ? 'error ' : ''; ?>">
                                    <label class="control-label">Telefone</label>
                                    <div class="controls">
                                        <input size="35" class="form-control" name="telefone" type="text"
                                            value="<?php echo !empty($telefone) ? $telefone : ''; ?>">
                                        <?php if (!empty($telefoneErro)) : ?>
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
                                        <?php if (!empty($emailErro)) : ?>
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
                                        <select class="form-control" name="local" placeholder="Local"
                                            value="<?php echo !empty($local) ? $local : ''; ?>">
                                            <option value="000"></option>
                                            <option value="Adamantina">Adamantina</option>
                                            <option value="Adolfo">Adolfo</option>
                                            <option value="Aguaí">Aguaí</option>
                                            <option value="Águas da Prata">Águas da Prata</option>
                                            <option value="Águas de Lindóia">Águas de Lindóia</option>
                                            <option value="Águas de Santa Bárbara">Águas de Santa Bárbara</option>
                                            <option value="Águas de São Pedro">Águas de São Pedro</option>
                                            <option value="Agudos">Agudos</option>
                                            <option value="Alambari">Alambari</option>
                                            <option value="Alfredo Marcondes">Alfredo Marcondes</option>
                                            <option value="Altair">Altair</option>
                                            <option value="Altinópolis">Altinópolis</option>
                                            <option value="Alto Alegre">Alto Alegre</option>
                                            <option value="Alumínio">Alumínio</option>
                                            <option value="Álvares Florence">Álvares Florence</option>
                                            <option value="Álvares Machado">Álvares Machado</option>
                                            <option value="Álvaro de Carvalho">Álvaro de Carvalho</option>
                                            <option value="Alvinlândia">Alvinlândia</option>
                                            <option value="Americana">Americana</option>
                                            <option value="Américo Brasiliense">Américo Brasiliense</option>
                                            <option value="Américo de Campos">Américo de Campos</option>
                                            <option value="Amparo">Amparo</option>
                                            <option value="Analândia">Analândia</option>
                                            <option value="Andradina">Andradina</option>
                                            <option value="Angatuba">Angatuba</option>
                                            <option value="Anhembi">Anhembi</option>
                                            <option value="Anhumas">Anhumas</option>
                                            <option value="Aparecida">Aparecida</option>
                                            <option value="Aparecida d'Oeste">Aparecida d'Oeste</option>
                                            <option value="Apiaí">Apiaí</option>
                                            <option value="Araçariguama">Araçariguama</option>
                                            <option value="Araçatuba">Araçatuba</option>
                                            <option value="Araçoiaba da Serra">Araçoiaba da Serra</option>
                                            <option value="Aramina">Aramina</option>
                                            <option value="Arandu">Arandu</option>
                                            <option value="Arapeí">Arapeí</option>
                                            <option value="Araraquara">Araraquara</option>
                                            <option value="Araras">Araras</option>
                                            <option value="Arco-Íris">Arco-Íris</option>
                                            <option value="Arealva">Arealva</option>
                                            <option value="Areias">Areias</option>
                                            <option value="Areiópolis">Areiópolis</option>
                                            <option value="Ariranha">Ariranha</option>
                                            <option value="Artur Nogueira">Artur Nogueira</option>
                                            <option value="Arujá">Arujá</option>
                                            <option value="Aspásia">Aspásia</option>
                                            <option value="Assis">Assis</option>
                                            <option value="Atibaia">Atibaia</option>
                                            <option value="Auriflama">Auriflama</option>
                                            <option value="Avaí">Avaí</option>
                                            <option value="Avanhandava">Avanhandava</option>
                                            <option value="Avaré">Avaré</option>
                                            <option value="Bady Bassitt">Bady Bassitt</option>
                                            <option value="Balbinos">Balbinos</option>
                                            <option value="Bálsamo">Bálsamo</option>
                                            <option value="Bananal">Bananal</option>
                                            <option value="Barão de Antonina">Barão de Antonina</option>
                                            <option value="Barbosa">Barbosa</option>
                                            <option value="Bariri">Bariri</option>
                                            <option value="Barra Bonita">Barra Bonita</option>
                                            <option value="Barra do Chapéu">Barra do Chapéu</option>
                                            <option value="Barra do Turvo">Barra do Turvo</option>
                                            <option value="Barretos">Barretos</option>
                                            <option value="Barrinha">Barrinha</option>
                                            <option value="Barueri">Barueri</option>
                                            <option value="Bastos">Bastos</option>
                                            <option value="Batatais">Batatais</option>
                                            <option value="Bauru">Bauru</option>
                                            <option value="Bebedouro">Bebedouro</option>
                                            <option value="Bento de Abreu">Bento de Abreu</option>
                                            <option value="Bernardino de Campos">Bernardino de Campos</option>
                                            <option value="Bertioga">Bertioga</option>
                                            <option value="Bilac">Bilac</option>
                                            <option value="Birigui">Birigui</option>
                                            <option value="Biritiba-Mirim">Biritiba-Mirim</option>
                                            <option value="Boa Esperança do Sul">Boa Esperança do Sul</option>
                                            <option value="Bocaina">Bocaina</option>
                                            <option value="Bofete">Bofete</option>
                                            <option value="Boituva">Boituva</option>
                                            <option value="Bom Jesus dos Perdões">Bom Jesus dos Perdões</option>
                                            <option value="Bom Sucesso de Itararé">Bom Sucesso de Itararé</option>
                                            <option value="Borá">Borá</option>
                                            <option value="Boracéia">Boracéia</option>
                                            <option value="Borborema">Borborema</option>
                                            <option value="Borebi">Borebi</option>
                                            <option value="Botucatu">Botucatu</option>
                                            <option value="Bragança Paulista">Bragança Paulista</option>
                                            <option value="Braúna">Braúna</option>
                                            <option value="Brejo Alegre">Brejo Alegre</option>
                                            <option value="Brodowski">Brodowski</option>
                                            <option value="Brotas">Brotas</option>
                                            <option value="Buri">Buri</option>
                                            <option value="Buritama">Buritama</option>
                                            <option value="Buritizal">Buritizal</option>
                                            <option value="Cabrália Paulista">Cabrália Paulista</option>
                                            <option value="Cabreúva">Cabreúva</option>
                                            <option value="Caçapava">Caçapava</option>
                                            <option value="Cachoeira Paulista">Cachoeira Paulista</option>
                                            <option value="Caconde">Caconde</option>
                                            <option value="Cafelândia">Cafelândia</option>
                                            <option value="Caiabu">Caiabu</option>
                                            <option value="Caieiras">Caieiras</option>
                                            <option value="Caiuá">Caiuá</option>
                                            <option value="Cajamar">Cajamar</option>
                                            <option value="Cajati">Cajati</option>
                                            <option value="Cajobi">Cajobi</option>
                                            <option value="Cajuru">Cajuru</option>
                                            <option value="Campina do Monte Alegre">Campina do Monte Alegre</option>
                                            <option value="Campinas">Campinas</option>
                                            <option value="Campo Limpo Paulista">Campo Limpo Paulista</option>
                                            <option value="Campos do Jordão">Campos do Jordão</option>
                                            <option value="Campos Novos Paulista">Campos Novos Paulista</option>
                                            <option value="Cananéia">Cananéia</option>
                                            <option value="Canas">Canas</option>
                                            <option value="Cândido Mota">Cândido Mota</option>
                                            <option value="Cândido Rodrigues">Cândido Rodrigues</option>
                                            <option value="Canitar">Canitar</option>
                                            <option value="Capão Bonito">Capão Bonito</option>
                                            <option value="Capela do Alto">Capela do Alto</option>
                                            <option value="Capivari">Capivari</option>
                                            <option value="Caraguatatuba">Caraguatatuba</option>
                                            <option value="Carapicuíba">Carapicuíba</option>
                                            <option value="Cardoso">Cardoso</option>
                                            <option value="Casa Branca">Casa Branca</option>
                                            <option value="Cássia dos Coqueiros">Cássia dos Coqueiros</option>
                                            <option value="Castilho">Castilho</option>
                                            <option value="Catanduva">Catanduva</option>
                                            <option value="Catiguá">Catiguá</option>
                                            <option value="Cedral">Cedral</option>
                                            <option value="Cerqueira César">Cerqueira César</option>
                                            <option value="Cerquilho">Cerquilho</option>
                                            <option value="Cesário Lange">Cesário Lange</option>
                                            <option value="Charqueada">Charqueada</option>
                                            <option value="Chavantes">Chavantes</option>
                                            <option value="Clementina">Clementina</option>
                                            <option value="Colina">Colina</option>
                                            <option value="Colômbia">Colômbia</option>
                                            <option value="Conchal">Conchal</option>
                                            <option value="Conchas">Conchas</option>
                                            <option value="Cordeirópolis">Cordeirópolis</option>
                                            <option value="Coroados">Coroados</option>
                                            <option value="Coronel Macedo">Coronel Macedo</option>
                                            <option value="Corumbataí">Corumbataí</option>
                                            <option value="Cosmópolis">Cosmópolis</option>
                                            <option value="Cosmorama">Cosmorama</option>
                                            <option value="Cotia">Cotia</option>
                                            <option value="Cravinhos">Cravinhos</option>
                                            <option value="Cristais Paulista">Cristais Paulista</option>
                                            <option value="Cruzália">Cruzália</option>
                                            <option value="Cruzeiro">Cruzeiro</option>
                                            <option value="Cubatão">Cubatão</option>
                                            <option value="Cunha">Cunha</option>
                                            <option value="Descalvado">Descalvado</option>
                                            <option value="Diadema">Diadema</option>
                                            <option value="Dirce Reis">Dirce Reis</option>
                                            <option value="Divinolândia">Divinolândia</option>
                                            <option value="Dobrada">Dobrada</option>
                                            <option value="Dois Córregos">Dois Córregos</option>
                                            <option value="Dolcinópolis">Dolcinópolis</option>
                                            <option value="Dourado">Dourado</option>
                                            <option value="Dracena">Dracena</option>
                                            <option value="Duartina">Duartina</option>
                                            <option value="Dumont">Dumont</option>
                                            <option value="Echaporã">Echaporã</option>
                                            <option value="Eldorado">Eldorado</option>
                                            <option value="Elias Fausto">Elias Fausto</option>
                                            <option value="Elisiário">Elisiário</option>
                                            <option value="Embaúba">Embaúba</option>
                                            <option value="Embu">Embu</option>
                                            <option value="Embu-Guaçu">Embu-Guaçu</option>
                                            <option value="Emilianópolis">Emilianópolis</option>
                                            <option value="Engenheiro Coelho">Engenheiro Coelho</option>
                                            <option value="Espírito Santo do Pinhal">Espírito Santo do Pinhal</option>
                                            <option value="Espírito Santo do Turvo">Espírito Santo do Turvo</option>
                                            <option value="Estiva Gerbi">Estiva Gerbi</option>
                                            <option value="Estrela d'Oeste">Estrela d'Oeste</option>
                                            <option value="Estrela do Norte">Estrela do Norte</option>
                                            <option value="Euclides da Cunha Paulista">Euclides da Cunha Paulista</option>
                                            <option value="Fartura">Fartura</option>
                                            <option value="Fernando Prestes">Fernando Prestes</option>
                                            <option value="Fernandópolis">Fernandópolis</option>
                                            <option value="Fernão">Fernão</option>
                                            <option value="Ferraz de Vasconcelos">Ferraz de Vasconcelos</option>
                                            <option value="Flora Rica">Flora Rica</option>
                                            <option value="Floreal">Floreal</option>
                                            <option value="Flórida Paulista">Flórida Paulista</option>
                                            <option value="Florínea">Florínea</option>
                                            <option value="Franca">Franca</option>
                                            <option value="Francisco Morato">Francisco Morato</option>
                                            <option value="Franco da Rocha">Franco da Rocha</option>
                                            <option value="Gabriel Monteiro">Gabriel Monteiro</option>
                                            <option value="Gália">Gália</option>
                                            <option value="Garça">Garça</option>
                                            <option value="Gastão Vidigal">Gastão Vidigal</option>
                                            <option value="Gavião Peixoto">Gavião Peixoto</option>
                                            <option value="General Salgado">General Salgado</option>
                                            <option value="Getulina">Getulina</option>
                                            <option value="Glicério">Glicério</option>
                                            <option value="Guaiçara">Guaiçara</option>
                                            <option value="Guaimbê">Guaimbê</option>
                                            <option value="Guaíra">Guaíra</option>
                                            <option value="Guapiaçu">Guapiaçu</option>
                                            <option value="Guapiara">Guapiara</option>
                                            <option value="Guará">Guará</option>
                                            <option value="Guaraçaí">Guaraçaí</option>
                                            <option value="Guaraci">Guaraci</option>
                                            <option value="Guarani d'Oeste">Guarani d'Oeste</option>
                                            <option value="Guarantã">Guarantã</option>
                                            <option value="Guararapes">Guararapes</option>
                                            <option value="Guararema">Guararema</option>
                                            <option value="Guaratinguetá">Guaratinguetá</option>
                                            <option value="Guareí">Guareí</option>
                                            <option value="Guariba">Guariba</option>
                                            <option value="Guarujá">Guarujá</option>
                                            <option value="Guarulhos">Guarulhos</option>
                                            <option value="Guatapará">Guatapará</option>
                                            <option value="Guzolândia">Guzolândia</option>
                                            <option value="Herculândia">Herculândia</option>
                                            <option value="Holambra">Holambra</option>
                                            <option value="Hortolândia">Hortolândia</option>
                                            <option value="Iacanga">Iacanga</option>
                                            <option value="Iacri">Iacri</option>
                                            <option value="Iaras">Iaras</option>
                                            <option value="Ibaté">Ibaté</option>
                                            <option value="Ibirá">Ibirá</option>
                                            <option value="Ibirarema">Ibirarema</option>
                                            <option value="Ibitinga">Ibitinga</option>
                                            <option value="Ibiúna">Ibiúna</option>
                                            <option value="Icém">Icém</option>
                                            <option value="Iepê">Iepê</option>
                                            <option value="Igaraçu do Tietê">Igaraçu do Tietê</option>
                                            <option value="Igarapava">Igarapava</option>
                                            <option value="Igaratá">Igaratá</option>
                                            <option value="Iguape">Iguape</option>
                                            <option value="Ilha Comprida">Ilha Comprida</option>
                                            <option value="Ilha Solteira">Ilha Solteira</option>
                                            <option value="Ilhabela">Ilhabela</option>
                                            <option value="Indaiatuba">Indaiatuba</option>
                                            <option value="Indiana">Indiana</option>
                                            <option value="Indiaporã">Indiaporã</option>
                                            <option value="Inúbia Paulista">Inúbia Paulista</option>
                                            <option value="Ipaussu">Ipaussu</option>
                                            <option value="Iperó">Iperó</option>
                                            <option value="Ipeúna">Ipeúna</option>
                                            <option value="Ipiguá">Ipiguá</option>
                                            <option value="Iporanga">Iporanga</option>
                                            <option value="Ipuã">Ipuã</option>
                                            <option value="Iracemápolis">Iracemápolis</option>
                                            <option value="Irapuã">Irapuã</option>
                                            <option value="Irapuru">Irapuru</option>
                                            <option value="Itaberá">Itaberá</option>
                                            <option value="Itaí">Itaí</option>
                                            <option value="Itajobi">Itajobi</option>
                                            <option value="Itaju">Itaju</option>
                                            <option value="Itanhaém">Itanhaém</option>
                                            <option value="Itaóca">Itaóca</option>
                                            <option value="Itapecerica da Serra">Itapecerica da Serra</option>
                                            <option value="Itapetininga">Itapetininga</option>
                                            <option value="Itapeva">Itapeva</option>
                                            <option value="Itapevi">Itapevi</option>
                                            <option value="Itapira">Itapira</option>
                                            <option value="Itapirapuã Paulista">Itapirapuã Paulista</option>
                                            <option value="Itápolis">Itápolis</option>
                                            <option value="Itaporanga">Itaporanga</option>
                                            <option value="Itapuí">Itapuí</option>
                                            <option value="Itapura">Itapura</option>
                                            <option value="Itaquaquecetuba">Itaquaquecetuba</option>
                                            <option value="Itararé">Itararé</option>
                                            <option value="Itariri">Itariri</option>
                                            <option value="Itatiba">Itatiba</option>
                                            <option value="Itatinga">Itatinga</option>
                                            <option value="Itirapina">Itirapina</option>
                                            <option value="Itirapuã">Itirapuã</option>
                                            <option value="Itobi">Itobi</option>
                                            <option value="Itú">Itú</option>
                                            <option value="Itupeva">Itupeva</option>
                                            <option value="Ituverava">Ituverava</option>
                                            <option value="Jaborandi">Jaborandi</option>
                                            <option value="Jaboticabal">Jaboticabal</option>
                                            <option value="Jacareí">Jacareí</option>
                                            <option value="Jaci">Jaci</option>
                                            <option value="Jacupiranga">Jacupiranga</option>
                                            <option value="Jaguariúna">Jaguariúna</option>
                                            <option value="Jales">Jales</option>
                                            <option value="Jambeiro">Jambeiro</option>
                                            <option value="Jandira">Jandira</option>
                                            <option value="Jardinópolis">Jardinópolis</option>
                                            <option value="Jarinu">Jarinu</option>
                                            <option value="Jaú">Jaú</option>
                                            <option value="Jeriquara">Jeriquara</option>
                                            <option value="Joanópolis">Joanópolis</option>
                                            <option value="João Ramalho">João Ramalho</option>
                                            <option value="José Bonifácio">José Bonifácio</option>
                                            <option value="Júlio Mesquita">Júlio Mesquita</option>
                                            <option value="Jumirim">Jumirim</option>
                                            <option value="Jundiaí">Jundiaí</option>
                                            <option value="Junqueirópolis">Junqueirópolis</option>
                                            <option value="Juquiá">Juquiá</option>
                                            <option value="Juquitiba">Juquitiba</option>
                                            <option value="Lagoinha">Lagoinha</option>
                                            <option value="Laranjal Paulista">Laranjal Paulista</option>
                                            <option value="Lavínia">Lavínia</option>
                                            <option value="Lavrinhas">Lavrinhas</option>
                                            <option value="Leme">Leme</option>
                                            <option value="Lençóis Paulista">Lençóis Paulista</option>
                                            <option value="Limeira">Limeira</option>
                                            <option value="Lindóia">Lindóia</option>
                                            <option value="Lins">Lins</option>
                                            <option value="Lorena">Lorena</option>
                                            <option value="Lourdes">Lourdes</option>
                                            <option value="Louveira">Louveira</option>
                                            <option value="Lucélia">Lucélia</option>
                                            <option value="Lucianópolis">Lucianópolis</option>
                                            <option value="Luis Antônio">Luis Antônio</option>
                                            <option value="Luiziânia">Luiziânia</option>
                                            <option value="Lupércio">Lupércio</option>
                                            <option value="Lutécia">Lutécia</option>
                                            <option value="Macatuba">Macatuba</option>
                                            <option value="Macaubal">Macaubal</option>
                                            <option value="Macedônia">Macedônia</option>
                                            <option value="Magda">Magda</option>
                                            <option value="Mairinque">Mairinque</option>
                                            <option value="Mairiporã">Mairiporã</option>
                                            <option value="Manduri">Manduri</option>
                                            <option value="Marabá Paulista">Marabá Paulista</option>
                                            <option value="Maracaí">Maracaí</option>
                                            <option value="Marapoama">Marapoama</option>
                                            <option value="Mariápolis">Mariápolis</option>
                                            <option value="Marília">Marília</option>
                                            <option value="Marinópolis">Marinópolis</option>
                                            <option value="Martinópolis">Martinópolis</option>
                                            <option value="Matão">Matão</option>
                                            <option value="Mauá">Mauá</option>
                                            <option value="Mendonça">Mendonça</option>
                                            <option value="Meridiano">Meridiano</option>
                                            <option value="Mesópolis">Mesópolis</option>
                                            <option value="Miguelópolis">Miguelópolis</option>
                                            <option value="Mineiros do Tietê">Mineiros do Tietê</option>
                                            <option value="Mira Estrela">Mira Estrela</option>
                                            <option value="Miracatu">Miracatu</option>
                                            <option value="Mirandópolis">Mirandópolis</option>
                                            <option value="Mirante do Paranapanema">Mirante do Paranapanema</option>
                                            <option value="Mirassol">Mirassol</option>
                                            <option value="Mirassolândia">Mirassolândia</option>
                                            <option value="Mococa">Mococa</option>
                                            <option value="Mogi das Cruzes">Mogi das Cruzes</option>
                                            <option value="Mogi Guaçu">Mogi Guaçu</option>
                                            <option value="Mogi Mirim">Mogi Mirim</option>
                                            <option value="Mombuca">Mombuca</option>
                                            <option value="Monções">Monções</option>
                                            <option value="Mongaguá">Mongaguá</option>
                                            <option value="Monte Alegre do Sul">Monte Alegre do Sul</option>
                                            <option value="Monte Alto">Monte Alto</option>
                                            <option value="Monte Aprazível">Monte Aprazível</option>
                                            <option value="Monte Azul Paulista">Monte Azul Paulista</option>
                                            <option value="Monte Castelo">Monte Castelo</option>
                                            <option value="Monte Mor">Monte Mor</option>
                                            <option value="Monteiro Lobato">Monteiro Lobato</option>
                                            <option value="Morro Agudo">Morro Agudo</option>
                                            <option value="Morungaba">Morungaba</option>
                                            <option value="Motuca">Motuca</option>
                                            <option value="Murutinga do Sul">Murutinga do Sul</option>
                                            <option value="Nantes">Nantes</option>
                                            <option value="Narandiba">Narandiba</option>
                                            <option value="Natividade da Serra">Natividade da Serra</option>
                                            <option value="Nazaré Paulista">Nazaré Paulista</option>
                                            <option value="Neves Paulista">Neves Paulista</option>
                                            <option value="Nhandeara">Nhandeara</option>
                                            <option value="Nipoã">Nipoã</option>
                                            <option value="Nova Aliança">Nova Aliança</option>
                                            <option value="Nova Campina">Nova Campina</option>
                                            <option value="Nova Canaã Paulista">Nova Canaã Paulista</option>
                                            <option value="Nova Castilho">Nova Castilho</option>
                                            <option value="Nova Europa">Nova Europa</option>
                                            <option value="Nova Granada">Nova Granada</option>
                                            <option value="Nova Guataporanga">Nova Guataporanga</option>
                                            <option value="Nova Independência">Nova Independência</option>
                                            <option value="Nova Luzitânia">Nova Luzitânia</option>
                                            <option value="Nova Odessa">Nova Odessa</option>
                                            <option value="Novais">Novais</option>
                                            <option value="Novo Horizonte">Novo Horizonte</option>
                                            <option value="Nuporanga">Nuporanga</option>
                                            <option value="Ocauçu">Ocauçu</option>
                                            <option value="Óleo">Óleo</option>
                                            <option value="Olímpia">Olímpia</option>
                                            <option value="Onda Verde">Onda Verde</option>
                                            <option value="Oriente">Oriente</option>
                                            <option value="Orindiúva">Orindiúva</option>
                                            <option value="Orlândia">Orlândia</option>
                                            <option value="Osasco">Osasco</option>
                                            <option value="Oscar Bressane">Oscar Bressane</option>
                                            <option value="Osvaldo Cruz">Osvaldo Cruz</option>
                                            <option value="Ourinhos">Ourinhos</option>
                                            <option value="Ouro Verde">Ouro Verde</option>
                                            <option value="Ouroeste">Ouroeste</option>
                                            <option value="Pacaembu">Pacaembu</option>
                                            <option value="Palestina">Palestina</option>
                                            <option value="Palmares Paulista">Palmares Paulista</option>
                                            <option value="Palmeira d'Oeste">Palmeira d'Oeste</option>
                                            <option value="Palmital">Palmital</option>
                                            <option value="Panorama">Panorama</option>
                                            <option value="Paraguaçu Paulista">Paraguaçu Paulista</option>
                                            <option value="Paraibuna">Paraibuna</option>
                                            <option value="Paraíso">Paraíso</option>
                                            <option value="Paranapanema">Paranapanema</option>
                                            <option value="Paranapuã">Paranapuã</option>
                                            <option value="Parapuã">Parapuã</option>
                                            <option value="Pardinho">Pardinho</option>
                                            <option value="Pariquera-Açu">Pariquera-Açu</option>
                                            <option value="Parisi">Parisi</option>
                                            <option value="Patrocínio Paulista">Patrocínio Paulista</option>
                                            <option value="Paulicéia">Paulicéia</option>
                                            <option value="Paulínia">Paulínia</option>
                                            <option value="Paulistânia">Paulistânia</option>
                                            <option value="Paulo de Faria">Paulo de Faria</option>
                                            <option value="Pederneiras">Pederneiras</option>
                                            <option value="Pedra Bela">Pedra Bela</option>
                                            <option value="Pedranópolis">Pedranópolis</option>
                                            <option value="Pedregulho">Pedregulho</option>
                                            <option value="Pedreira">Pedreira</option>
                                            <option value="Pedrinhas Paulista">Pedrinhas Paulista</option>
                                            <option value="Pedro de Toledo">Pedro de Toledo</option>
                                            <option value="Penápolis">Penápolis</option>
                                            <option value="Pereira Barreto">Pereira Barreto</option>
                                            <option value="Pereiras">Pereiras</option>
                                            <option value="Peruíbe">Peruíbe</option>
                                            <option value="Piacatu">Piacatu</option>
                                            <option value="Piedade">Piedade</option>
                                            <option value="Pilar do Sul">Pilar do Sul</option>
                                            <option value="Pindamonhangaba">Pindamonhangaba</option>
                                            <option value="Pindorama">Pindorama</option>
                                            <option value="Pinhalzinho">Pinhalzinho</option>
                                            <option value="Piquerobi">Piquerobi</option>
                                            <option value="Piquete">Piquete</option>
                                            <option value="Piracaia">Piracaia</option>
                                            <option value="Piracicaba">Piracicaba</option>
                                            <option value="Piraju">Piraju</option>
                                            <option value="Pirajuí">Pirajuí</option>
                                            <option value="Pirangi">Pirangi</option>
                                            <option value="Pirapora do Bom Jesus">Pirapora do Bom Jesus</option>
                                            <option value="Pirapozinho">Pirapozinho</option>
                                            <option value="Pirassununga">Pirassununga</option>
                                            <option value="Piratininga">Piratininga</option>
                                            <option value="Pitangueiras">Pitangueiras</option>
                                            <option value="Planalto">Planalto</option>
                                            <option value="Platina">Platina</option>
                                            <option value="Poá">Poá</option>
                                            <option value="Poloni">Poloni</option>
                                            <option value="Pompéia">Pompéia</option>
                                            <option value="Pongaí">Pongaí</option>
                                            <option value="Pontal">Pontal</option>
                                            <option value="Pontalinda">Pontalinda</option>
                                            <option value="Pontes Gestal">Pontes Gestal</option>
                                            <option value="Populina">Populina</option>
                                            <option value="Porangaba">Porangaba</option>
                                            <option value="Porto Feliz">Porto Feliz</option>
                                            <option value="Porto Ferreira">Porto Ferreira</option>
                                            <option value="Potim">Potim</option>
                                            <option value="Potirendaba">Potirendaba</option>
                                            <option value="Pracinha">Pracinha</option>
                                            <option value="Pradópolis">Pradópolis</option>
                                            <option value="Praia Grande">Praia Grande</option>
                                            <option value="Pratânia">Pratânia</option>
                                            <option value="Presidente Alves">Presidente Alves</option>
                                            <option value="Presidente Bernardes">Presidente Bernardes</option>
                                            <option value="Presidente Epitácio">Presidente Epitácio</option>
                                            <option value="Presidente Prudente">Presidente Prudente</option>
                                            <option value="Presidente Venceslau">Presidente Venceslau</option>
                                            <option value="Promissão">Promissão</option>
                                            <option value="Quadra">Quadra</option>
                                            <option value="Quatá">Quatá</option>
                                            <option value="Queiroz">Queiroz</option>
                                            <option value="Queluz">Queluz</option>
                                            <option value="Quintana">Quintana</option>
                                            <option value="Rafard">Rafard</option>
                                            <option value="Rancharia">Rancharia</option>
                                            <option value="Redenção da Serra">Redenção da Serra</option>
                                            <option value="Regente Feijó">Regente Feijó</option>
                                            <option value="Reginópolis">Reginópolis</option>
                                            <option value="Registro">Registro</option>
                                            <option value="Restinga">Restinga</option>
                                            <option value="Ribeira">Ribeira</option>
                                            <option value="Ribeirão Bonito">Ribeirão Bonito</option>
                                            <option value="Ribeirão Branco">Ribeirão Branco</option>
                                            <option value="Ribeirão Corrente">Ribeirão Corrente</option>
                                            <option value="Ribeirão do Sul">Ribeirão do Sul</option>
                                            <option value="Ribeirão dos Índios">Ribeirão dos Índios</option>
                                            <option value="Ribeirão Grande">Ribeirão Grande</option>
                                            <option value="Ribeirão Pires">Ribeirão Pires</option>
                                            <option value="Ribeirão Preto">Ribeirão Preto</option>
                                            <option value="Rifaina">Rifaina</option>
                                            <option value="Rincão">Rincão</option>
                                            <option value="Rinópolis">Rinópolis</option>
                                            <option value="Rio Claro">Rio Claro</option>
                                            <option value="Rio das Pedras">Rio das Pedras</option>
                                            <option value="Rio Grande da Serra">Rio Grande da Serra</option>
                                            <option value="Riolândia">Riolândia</option>
                                            <option value="Riversul">Riversul</option>
                                            <option value="Rosana">Rosana</option>
                                            <option value="Roseira">Roseira</option>
                                            <option value="Rubiácea">Rubiácea</option>
                                            <option value="Rubinéia">Rubinéia</option>
                                            <option value="Sabino">Sabino</option>
                                            <option value="Sagres">Sagres</option>
                                            <option value="Sales">Sales</option>
                                            <option value="Sales Oliveira">Sales Oliveira</option>
                                            <option value="Salesópolis">Salesópolis</option>
                                            <option value="Salmourão">Salmourão</option>
                                            <option value="Saltinho">Saltinho</option>
                                            <option value="Salto">Salto</option>
                                            <option value="Salto de Pirapora">Salto de Pirapora</option>
                                            <option value="Salto Grande">Salto Grande</option>
                                            <option value="Sandovalina">Sandovalina</option>
                                            <option value="Santa Adélia">Santa Adélia</option>
                                            <option value="Santa Albertina">Santa Albertina</option>
                                            <option value="Santa Bárbara d'Oeste">Santa Bárbara d'Oeste</option>
                                            <option value="Santa Branca">Santa Branca</option>
                                            <option value="Santa Clara d'Oeste">Santa Clara d'Oeste</option>
                                            <option value="Santa Cruz da Conceição">Santa Cruz da Conceição</option>
                                            <option value="Santa Cruz da Esperança">Santa Cruz da Esperança</option>
                                            <option value="Santa Cruz das Palmeiras">Santa Cruz das Palmeiras</option>
                                            <option value="Santa Cruz do Rio Pardo">Santa Cruz do Rio Pardo</option>
                                            <option value="Santa Ernestina">Santa Ernestina</option>
                                            <option value="Santa Fé do Sul">Santa Fé do Sul</option>
                                            <option value="Santa Gertrudes">Santa Gertrudes</option>
                                            <option value="Santa Isabel">Santa Isabel</option>
                                            <option value="Santa Lúcia">Santa Lúcia</option>
                                            <option value="Santa Maria da Serra">Santa Maria da Serra</option>
                                            <option value="Santa Mercedes">Santa Mercedes</option>
                                            <option value="Santa Rita d'Oeste">Santa Rita d'Oeste</option>
                                            <option value="Santa Rita do Passa Quatro">Santa Rita do Passa Quatro</option>
                                            <option value="Santa Rosa de Viterbo">Santa Rosa de Viterbo</option>
                                            <option value="Santa Salete">Santa Salete</option>
                                            <option value="Santana da Ponte Pensa">Santana da Ponte Pensa</option>
                                            <option value="Santana de Parnaíba">Santana de Parnaíba</option>
                                            <option value="Santo Anastácio">Santo Anastácio</option>
                                            <option value="Santo André">Santo André</option>
                                            <option value="Santo Antônio da Alegria">Santo Antônio da Alegria</option>
                                            <option value="Santo Antônio de Posse">Santo Antônio de Posse</option>
                                            <option value="Santo Antônio do Aracanguá">Santo Antônio do Aracanguá</option>
                                            <option value="Santo Antônio do Jardim">Santo Antônio do Jardim</option>
                                            <option value="Santo Antônio do Pinhal">Santo Antônio do Pinhal</option>
                                            <option value="Santo Expedito">Santo Expedito</option>
                                            <option value="Santópolis do Aguapeí">Santópolis do Aguapeí</option>
                                            <option value="Santos">Santos</option>
                                            <option value="São Bento do Sapucaí">São Bento do Sapucaí</option>
                                            <option value="São Bernardo do Campo">São Bernardo do Campo</option>
                                            <option value="São Caetano do Sul">São Caetano do Sul</option>
                                            <option value="São Carlos">São Carlos</option>
                                            <option value="São Francisco">São Francisco</option>
                                            <option value="São João da Boa Vista">São João da Boa Vista</option>
                                            <option value="São João das Duas Pontes">São João das Duas Pontes</option>
                                            <option value="São João de Iracema">São João de Iracema</option>
                                            <option value="São João do Pau d'Alho">São João do Pau d'Alho</option>
                                            <option value="São Joaquim da Barra">São Joaquim da Barra</option>
                                            <option value="São José da Bela Vista">São José da Bela Vista</option>
                                            <option value="São José do Barreiro">São José do Barreiro</option>
                                            <option value="São José do Rio Pardo">São José do Rio Pardo</option>
                                            <option value="São José do Rio Preto">São José do Rio Preto</option>
                                            <option value="São José dos Campos">São José dos Campos</option>
                                            <option value="São Lourenço da Serra">São Lourenço da Serra</option>
                                            <option value="São Luiz do Paraitinga">São Luiz do Paraitinga</option>
                                            <option value="São Manuel">São Manuel</option>
                                            <option value="São Miguel Arcanjo">São Miguel Arcanjo</option>
                                            <option value="São Paulo">São Paulo</option>
                                            <option value="São Pedro">São Pedro</option>
                                            <option value="São Pedro do Turvo">São Pedro do Turvo</option>
                                            <option value="São Roque">São Roque</option>
                                            <option value="São Sebastião">São Sebastião</option>
                                            <option value="São Sebastião da Grama">São Sebastião da Grama</option>
                                            <option value="São Simão">São Simão</option>
                                            <option value="São Vicente">São Vicente</option>
                                            <option value="Sarapuí">Sarapuí</option>
                                            <option value="Sarutaiá">Sarutaiá</option>
                                            <option value="Sebastianópolis do Sul">Sebastianópolis do Sul</option>
                                            <option value="Serra Azul">Serra Azul</option>
                                            <option value="Serra Negra">Serra Negra</option>
                                            <option value="Serrana">Serrana</option>
                                            <option value="Sertãozinho">Sertãozinho</option>
                                            <option value="Sete Barras">Sete Barras</option>
                                            <option value="Severínia">Severínia</option>
                                            <option value="Silveiras">Silveiras</option>
                                            <option value="Socorro">Socorro</option>
                                            <option value="Sorocaba">Sorocaba</option>
                                            <option value="Sud Mennucci">Sud Mennucci</option>
                                            <option value="Sumaré">Sumaré</option>
                                            <option value="Suzanápolis">Suzanápolis</option>
                                            <option value="Suzano">Suzano</option>
                                            <option value="Tabapuã">Tabapuã</option>
                                            <option value="Tabatinga">Tabatinga</option>
                                            <option value="Taboão da Serra">Taboão da Serra</option>
                                            <option value="Taciba">Taciba</option>
                                            <option value="Taguaí">Taguaí</option>
                                            <option value="Taiaçu">Taiaçu</option>
                                            <option value="Taiúva">Taiúva</option>
                                            <option value="Tambaú">Tambaú</option>
                                            <option value="Tanabi">Tanabi</option>
                                            <option value="Tapiraí">Tapiraí</option>
                                            <option value="Tapiratiba">Tapiratiba</option>
                                            <option value="Taquaral">Taquaral</option>
                                            <option value="Taquaritinga">Taquaritinga</option>
                                            <option value="Taquarituba">Taquarituba</option>
                                            <option value="Taquarivaí">Taquarivaí</option>
                                            <option value="Tarabaí">Tarabaí</option>
                                            <option value="Tarumã">Tarumã</option>
                                            <option value="Tatuí">Tatuí</option>
                                            <option value="Taubaté">Taubaté</option>
                                            <option value="Tejupá">Tejupá</option>
                                            <option value="Teodoro Sampaio">Teodoro Sampaio</option>
                                            <option value="Terra Roxa">Terra Roxa</option>
                                            <option value="Tietê">Tietê</option>
                                            <option value="Timburi">Timburi</option>
                                            <option value="Torre de Pedra">Torre de Pedra</option>
                                            <option value="Torrinha">Torrinha</option>
                                            <option value="Trabiju">Trabiju</option>
                                            <option value="Tremembé">Tremembé</option>
                                            <option value="Três Fronteiras">Três Fronteiras</option>
                                            <option value="Tuiuti">Tuiuti</option>
                                            <option value="Tupã">Tupã</option>
                                            <option value="Tupi Paulista">Tupi Paulista</option>
                                            <option value="Turiúba">Turiúba</option>
                                            <option value="Turmalina">Turmalina</option>
                                            <option value="Ubarana">Ubarana</option>
                                            <option value="Ubatuba">Ubatuba</option>
                                            <option value="Ubirajara">Ubirajara</option>
                                            <option value="Uchoa">Uchoa</option>
                                            <option value="União Paulista">União Paulista</option>
                                            <option value="Urânia">Urânia</option>
                                            <option value="Uru">Uru</option>
                                            <option value="Urupês">Urupês</option>
                                            <option value="Valentim Gentil">Valentim Gentil</option>
                                            <option value="Valinhos">Valinhos</option>
                                            <option value="Valparaíso">Valparaíso</option>
                                            <option value="Vargem">Vargem</option>
                                            <option value="Vargem Grande do Sul">Vargem Grande do Sul</option>
                                            <option value="Vargem Grande Paulista">Vargem Grande Paulista</option>
                                            <option value="Várzea Paulista">Várzea Paulista</option>
                                            <option value="Vera Cruz">Vera Cruz</option>
                                            <option value="Vinhedo">Vinhedo</option>
                                            <option value="Viradouro">Viradouro</option>
                                            <option value="Vista Alegre do Alto">Vista Alegre do Alto</option>
                                            <option value="Vitória Brasil">Vitória Brasil</option>
                                            <option value="Votorantim">Votorantim</option>
                                            <option value="Votuporanga">Votuporanga</option>
                                            <option value="Zacarias">Zacarias</option>
                                        </select>
                                        <?php if (!empty($localErro)) : ?>
                                        <span class="text-danger"><?php echo $localErro; ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <div class="control-goup <?php !empty($setorErro) ? '$setorErro ' : ''; ?>">
                                    <label class="control-label">Setor</label>
                                    <div class="controls">
                                        <select class="form-control" name="setor" placeholder="setor"
                                            value="<?php echo !empty($setor) ? $setor : ''; ?>">
                                            <option value="000"></option>
                                            <option value="DSMM - Dep de Sementes, Mudas e Matrizes">DSMM - Dep de Sementes, Mudas e Matrizes</option>
                                            <option value="EDR - Escritorio dev. Rural">EDR - Escritorio dev. Rural</option>
                                            <option value="CA - Casa de Agricultura">CA - Casa de Agricultura</option>
                                            <option value="NPM - Nucle de Prod. de Mudas">NPM - Nucle de Prod. de Mudas</option>
                                            <option value="APTA - Agência Paulista de Tec. dos Agronegocios">APTA - Agência Paulista de Tec. dos Agronegocios
                                            </option>
                                            <option value="CDA - Coordenadoria de Def. Agropecuaria">CDA - Corrdenadoria de Def. Agropecuaria</option>
                                            <option value="CATI - Coordenadoria de Desenvolvimento Rural Sustentável">CATI - Coordenadoria de Desenvolvimento Rural
                                                Sustentável</option>
					   <option value="CTIC - Centro de Tecnologia Informação e Comunicação">CTIC - Centro de Tecnologia Informação e Comunicação</option>

                                        </select>
                                        <?php if (!empty($localErro)) : ?>
                                        <span class="text-danger"><?php echo $localErro; ?></span>
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
                                        <?php if (!empty($entradaErro)) : ?>
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
                                        <?php if (!empty($saidaErro)) : ?>
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
                                    <label class="control-label">Tecnico que Arrumou</label>
                                    <div class="controls">
                                        <input size="50" class="form-control" name="tecnico" type="text"
                                            value="<?php echo !empty($tecnico) ? $tecnico : ''; ?>">
                                        <?php if (!empty($tecnicoErro)) : ?>
                                        <span class="text-danger"><?php echo $tecnicoErro; ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-2">
                                <div class="control-goup <?php !empty($statusErro) ? '$statusErro ' : ''; ?>">
                                    <label class="control-label">Status</label>
                                    <div class="controls">
                                        <select class="form-control" name="status" placeholder="status"
                                            value="<?php echo !empty($status) ? $status : ''; ?>">
                                            <option value="000"></option>
                                            <option value="Em Aberto"> Em Aberto </option>
                                            <option value="Em Manutenção"> Em Manutenção </option>
                                            <option value="Pronta"> Pronta </option>
                                            <option value="Entregue"> Entregue </option>
                                            <option value="Baixa"> Baixa </option>
                                       <!-- <option value="Transferencia"> Transferencia </option> -->
                                            <option value="Emprestado"> Emprestado </option>
<<<<<<< HEAD
					    <option value="CTI"> CTI </option>
=======
					    <option value="Livre"> Livre </option>
>>>>>>> 119c61a00f75ab206ddcb45b23e6e4c27850d977
                                        </select>
                                        <?php if (!empty($statusErro)) : ?>
                                        <span class="text-danger"><?php echo $statusErro; ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-2">
                                <div class="control-goup <?php !empty($equipErro) ? '$equipErro ' : ''; ?>">
                                    <label class="control-label">Equipamento</label>
                                    <div class="controls">
                                        <select class="form-control" name="equip" placeholder="equipamento"
                                            value="<?php echo !empty($equip) ? $equip : ''; ?>">
                                            <option value="000"></option>
                                            <option value="Impressora">Impressora</option>
                                            <option value="Desktop">Desktop</option>
                                            <option value="Notebook">Notebook</option>
                                            <option value="Roteador">Roteador</option>
                                            <option value="Monitor">Monitor</option>
                                        </select>
                                        <?php if (!empty($equipErro)) : ?>
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
                                        <?php if (!empty($chapaErro)) : ?>
                                        <span class="text-danger"><?php echo $chapaErro; ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="form-group col-md-2">
                                <div class="control-group  <?php echo !empty($chamadoErro) ? 'error ' : ''; ?>">
                                    <label class="control-label">Chamado</label>
                                    <div class="controls">
                                        <input size="50" class="form-control" name="chamado" type="text"
                                            value="<?php echo !empty($chamado) ? $chamado : ''; ?>">
                                        <?php if (!empty($chamadoErro)) : ?>
                                        <span class="text-danger"><?php echo $chamadoErro; ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div> -->

                            <div class="form-group col-md-2">
                                <div class="control-goup <?php !empty($local2Erro) ? '$local2Erro ' : ''; ?>">
                                    <label class="control-label">Armazenamento</label>
                                    <div class="controls">
                                        <select class="form-control" name="local2" placeholder="Local armazenado"
                                            value="<?php echo !empty($local2) ? $local2 : ''; ?>">
                                            <option value="000"></option>
                                            <option value="Datacenter">Datacenter</option>
                                            <option value="Arquivo">Arquivo</option>
                                            <option value="Almoxarifado">Almoxarifado</option>
                                        </select>
                                        <?php if (!empty($local2Erro)) : ?>
                                        <span class="text-danger"><?php echo $local2Erro; ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="control-group  <?php echo !empty($modeloErro) ? 'error ' : ''; ?>">
                                    <label class="control-label">Modelo</label>
                                    <div class="controls">
                                        <input size="50" class="form-control" name="modelo" type="text"
                                            value="<?php echo !empty($modelo) ? $modelo : ''; ?>">
                                        <?php if (!empty($modeloErro)) : ?>
                                        <span class="text-danger"><?php echo $modeloErro; ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
				<div class="form-check form-check-inline">
  					<input class="form-check-input" type="checkbox" name="ram" id="ram" value="1">
  					<label class="form-check-label" for="ram">Memoria RAM</label>
				</div>
				<div class="form-check form-check-inline">
  					<input class="form-check-input" type="checkbox" name="processador" id="processador" value="1">
  					<label class="form-check-label" for="processador">Processador</label>
				</div>
				<div class="form-check form-check-inline">
  					<input class="form-check-input" type="checkbox" name="fonte" id="fonte" value="1">
  					<label class="form-check-label" for="fonte">Fonte</label>
				</div>
				<div class="form-check form-check-inline">
  					<input class="form-check-input" type="checkbox" name="bios" id="bios" value="1">
  					<label class="form-check-label" for="bios">Bateria BIOS</label>
				</div>
				<div class="form-check form-check-inline">
  					<input class="form-check-input" type="checkbox" name="hd" id="hd" value="1">
  					<label class="form-check-label" for="hd">HD</label>
				</div>
                       </div>


                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="control-group  <?php echo !empty($problemaErro) ? 'error ' : ''; ?>">
                                    <label class="control-label">Problema</label>
                                    <div class="controls">
                                        <input size="50" class="form-control" name="problema" type="text"
                                            value="<?php echo !empty($problema) ? $problema : ''; ?>">
                                        <?php if (!empty($problemaErro)) : ?>
                                        <span class="text-danger"><?php echo $problemaErro; ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="control-group  <?php echo !empty($solucaoErro) ? 'error ' : ''; ?>">
                                    <label class="control-label">Solução</label>
                                    <div class="controls">
                                        <input size="50" class="form-control" name="solucao" type="text"
                                            value="<?php echo !empty($solucao) ? $solucao : ''; ?>">
                                        <?php if (!empty($solucaoErro)) : ?>
                                        <span class="text-danger"><?php echo $solucaoErro; ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>



                        <div class="form-actions">
                            <br />
                            <button type="submit" class="btn btn-success">Adicionar</button>
                            <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                        </div>
                </div>
                </form>


            </div>
        </div>
    </div>
    </div>
    </div>
    <footer>
        <div class="container">
            <span class="badge badge-secondary">v 1.2.0 &copy; 2021 - Marcos A. R. T. dos Santos </span>
            <p</p>


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
