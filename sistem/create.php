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
    $equipErro = null;
    $chapaErro = null;
    $chamadoErro = null;
    $solucaoErro = null;

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
    $recebe = $_SESSION['UsuarioNome'];
    $solucao = $_SESSION['solucao'];

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
    }

    //Inserindo no Banco:
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO maquina (nome, telefone, email, local, setor, entrada, saida, tecnico, status, equip, chapa, chamado, problema, solucao, recebe) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $telefone, $email, $local, $setor, $entrada, $saida, $tecnico, $status, $equip, $chapa, $chamado, $problema, $solucao, $recebe));
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
                                <a href="../users/index.php" class="nav-link">Usuario</a>
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
                                            <option value="001">Adamantina</option>
                                            <option value="002">Adolfo</option>
                                            <option value="003">Aguaí</option>
                                            <option value="004">Águas da Prata</option>
                                            <option value="005">Águas de Lindóia</option>
                                            <option value="006">Águas de Santa Bárbara</option>
                                            <option value="007">Águas de São Pedro</option>
                                            <option value="008">Agudos</option>
                                            <option value="009">Alambari</option>
                                            <option value="010">Alfredo Marcondes</option>
                                            <option value="011">Altair</option>
                                            <option value="012">Altinópolis</option>
                                            <option value="013">Alto Alegre</option>
                                            <option value="014">Alumínio</option>
                                            <option value="015">Álvares Florence</option>
                                            <option value="016">Álvares Machado</option>
                                            <option value="017">Álvaro de Carvalho</option>
                                            <option value="018">Alvinlândia</option>
                                            <option value="019">Americana</option>
                                            <option value="020">Américo Brasiliense</option>
                                            <option value="021">Américo de Campos</option>
                                            <option value="022">Amparo</option>
                                            <option value="023">Analândia</option>
                                            <option value="024">Andradina</option>
                                            <option value="025">Angatuba</option>
                                            <option value="026">Anhembi</option>
                                            <option value="027">Anhumas</option>
                                            <option value="028">Aparecida</option>
                                            <option value="029">Aparecida d'Oeste</option>
                                            <option value="030">Apiaí</option>
                                            <option value="031">Araçariguama</option>
                                            <option value="032">Araçatuba</option>
                                            <option value="033">Araçoiaba da Serra</option>
                                            <option value="034">Aramina</option>
                                            <option value="035">Arandu</option>
                                            <option value="036">Arapeí</option>
                                            <option value="037">Araraquara</option>
                                            <option value="038">Araras</option>
                                            <option value="039">Arco-Íris</option>
                                            <option value="040">Arealva</option>
                                            <option value="041">Areias</option>
                                            <option value="042">Areiópolis</option>
                                            <option value="043">Ariranha</option>
                                            <option value="044">Artur Nogueira</option>
                                            <option value="045">Arujá</option>
                                            <option value="046">Aspásia</option>
                                            <option value="047">Assis</option>
                                            <option value="048">Atibaia</option>
                                            <option value="049">Auriflama</option>
                                            <option value="050">Avaí</option>
                                            <option value="051">Avanhandava</option>
                                            <option value="052">Avaré</option>
                                            <option value="053">Bady Bassitt</option>
                                            <option value="054">Balbinos</option>
                                            <option value="055">Bálsamo</option>
                                            <option value="056">Bananal</option>
                                            <option value="057">Barão de Antonina</option>
                                            <option value="058">Barbosa</option>
                                            <option value="059">Bariri</option>
                                            <option value="060">Barra Bonita</option>
                                            <option value="061">Barra do Chapéu</option>
                                            <option value="062">Barra do Turvo</option>
                                            <option value="063">Barretos</option>
                                            <option value="064">Barrinha</option>
                                            <option value="065">Barueri</option>
                                            <option value="066">Bastos</option>
                                            <option value="067">Batatais</option>
                                            <option value="068">Bauru</option>
                                            <option value="069">Bebedouro</option>
                                            <option value="070">Bento de Abreu</option>
                                            <option value="071">Bernardino de Campos</option>
                                            <option value="072">Bertioga</option>
                                            <option value="073">Bilac</option>
                                            <option value="074">Birigui</option>
                                            <option value="075">Biritiba-Mirim</option>
                                            <option value="076">Boa Esperança do Sul</option>
                                            <option value="077">Bocaina</option>
                                            <option value="078">Bofete</option>
                                            <option value="079">Boituva</option>
                                            <option value="080">Bom Jesus dos Perdões</option>
                                            <option value="081">Bom Sucesso de Itararé</option>
                                            <option value="082">Borá</option>
                                            <option value="083">Boracéia</option>
                                            <option value="084">Borborema</option>
                                            <option value="085">Borebi</option>
                                            <option value="086">Botucatu</option>
                                            <option value="087">Bragança Paulista</option>
                                            <option value="088">Braúna</option>
                                            <option value="089">Brejo Alegre</option>
                                            <option value="090">Brodowski</option>
                                            <option value="091">Brotas</option>
                                            <option value="092">Buri</option>
                                            <option value="093">Buritama</option>
                                            <option value="094">Buritizal</option>
                                            <option value="095">Cabrália Paulista</option>
                                            <option value="096">Cabreúva</option>
                                            <option value="097">Caçapava</option>
                                            <option value="098">Cachoeira Paulista</option>
                                            <option value="099">Caconde</option>
                                            <option value="100">Cafelândia</option>
                                            <option value="101">Caiabu</option>
                                            <option value="102">Caieiras</option>
                                            <option value="103">Caiuá</option>
                                            <option value="104">Cajamar</option>
                                            <option value="105">Cajati</option>
                                            <option value="106">Cajobi</option>
                                            <option value="107">Cajuru</option>
                                            <option value="108">Campina do Monte Alegre</option>
                                            <option value="Campinas">Campinas</option>
                                            <option value="110">Campo Limpo Paulista</option>
                                            <option value="111">Campos do Jordão</option>
                                            <option value="112">Campos Novos Paulista</option>
                                            <option value="113">Cananéia</option>
                                            <option value="114">Canas</option>
                                            <option value="115">Cândido Mota</option>
                                            <option value="116">Cândido Rodrigues</option>
                                            <option value="117">Canitar</option>
                                            <option value="118">Capão Bonito</option>
                                            <option value="119">Capela do Alto</option>
                                            <option value="120">Capivari</option>
                                            <option value="121">Caraguatatuba</option>
                                            <option value="122">Carapicuíba</option>
                                            <option value="123">Cardoso</option>
                                            <option value="124">Casa Branca</option>
                                            <option value="125">Cássia dos Coqueiros</option>
                                            <option value="126">Castilho</option>
                                            <option value="127">Catanduva</option>
                                            <option value="128">Catiguá</option>
                                            <option value="129">Cedral</option>
                                            <option value="130">Cerqueira César</option>
                                            <option value="131">Cerquilho</option>
                                            <option value="132">Cesário Lange</option>
                                            <option value="133">Charqueada</option>
                                            <option value="635">Chavantes</option>
                                            <option value="134">Clementina</option>
                                            <option value="135">Colina</option>
                                            <option value="136">Colômbia</option>
                                            <option value="137">Conchal</option>
                                            <option value="138">Conchas</option>
                                            <option value="139">Cordeirópolis</option>
                                            <option value="140">Coroados</option>
                                            <option value="141">Coronel Macedo</option>
                                            <option value="142">Corumbataí</option>
                                            <option value="143">Cosmópolis</option>
                                            <option value="144">Cosmorama</option>
                                            <option value="145">Cotia</option>
                                            <option value="146">Cravinhos</option>
                                            <option value="147">Cristais Paulista</option>
                                            <option value="148">Cruzália</option>
                                            <option value="149">Cruzeiro</option>
                                            <option value="150">Cubatão</option>
                                            <option value="151">Cunha</option>
                                            <option value="152">Descalvado</option>
                                            <option value="153">Diadema</option>
                                            <option value="154">Dirce Reis</option>
                                            <option value="155">Divinolândia</option>
                                            <option value="156">Dobrada</option>
                                            <option value="157">Dois Córregos</option>
                                            <option value="158">Dolcinópolis</option>
                                            <option value="159">Dourado</option>
                                            <option value="160">Dracena</option>
                                            <option value="161">Duartina</option>
                                            <option value="162">Dumont</option>
                                            <option value="163">Echaporã</option>
                                            <option value="164">Eldorado</option>
                                            <option value="165">Elias Fausto</option>
                                            <option value="166">Elisiário</option>
                                            <option value="167">Embaúba</option>
                                            <option value="168">Embu</option>
                                            <option value="169">Embu-Guaçu</option>
                                            <option value="170">Emilianópolis</option>
                                            <option value="171">Engenheiro Coelho</option>
                                            <option value="172">Espírito Santo do Pinhal</option>
                                            <option value="173">Espírito Santo do Turvo</option>
                                            <option value="174">Estiva Gerbi</option>
                                            <option value="176">Estrela d'Oeste</option>
                                            <option value="175">Estrela do Norte</option>
                                            <option value="177">Euclides da Cunha Paulista</option>
                                            <option value="178">Fartura</option>
                                            <option value="179">Fernando Prestes</option>
                                            <option value="180">Fernandópolis</option>
                                            <option value="888">Fernão</option>
                                            <option value="181">Ferraz de Vasconcelos</option>
                                            <option value="182">Flora Rica</option>
                                            <option value="183">Floreal</option>
                                            <option value="184">Flórida Paulista</option>
                                            <option value="185">Florínea</option>
                                            <option value="186">Franca</option>
                                            <option value="187">Francisco Morato</option>
                                            <option value="188">Franco da Rocha</option>
                                            <option value="189">Gabriel Monteiro</option>
                                            <option value="190">Gália</option>
                                            <option value="191">Garça</option>
                                            <option value="192">Gastão Vidigal</option>
                                            <option value="640">Gavião Peixoto</option>
                                            <option value="193">General Salgado</option>
                                            <option value="194">Getulina</option>
                                            <option value="195">Glicério</option>
                                            <option value="196">Guaiçara</option>
                                            <option value="197">Guaimbê</option>
                                            <option value="198">Guaíra</option>
                                            <option value="199">Guapiaçu</option>
                                            <option value="200">Guapiara</option>
                                            <option value="201">Guará</option>
                                            <option value="202">Guaraçaí</option>
                                            <option value="203">Guaraci</option>
                                            <option value="204">Guarani d'Oeste</option>
                                            <option value="205">Guarantã</option>
                                            <option value="206">Guararapes</option>
                                            <option value="207">Guararema</option>
                                            <option value="208">Guaratinguetá</option>
                                            <option value="209">Guareí</option>
                                            <option value="210">Guariba</option>
                                            <option value="211">Guarujá</option>
                                            <option value="212">Guarulhos</option>
                                            <option value="213">Guatapará</option>
                                            <option value="214">Guzolândia</option>
                                            <option value="215">Herculândia</option>
                                            <option value="216">Holambra</option>
                                            <option value="217">Hortolândia</option>
                                            <option value="218">Iacanga</option>
                                            <option value="219">Iacri</option>
                                            <option value="220">Iaras</option>
                                            <option value="221">Ibaté</option>
                                            <option value="222">Ibirá</option>
                                            <option value="223">Ibirarema</option>
                                            <option value="224">Ibitinga</option>
                                            <option value="225">Ibiúna</option>
                                            <option value="226">Icém</option>
                                            <option value="227">Iepê</option>
                                            <option value="228">Igaraçu do Tietê</option>
                                            <option value="229">Igarapava</option>
                                            <option value="230">Igaratá</option>
                                            <option value="231">Iguape</option>
                                            <option value="232">Ilha Comprida</option>
                                            <option value="233">Ilha Solteira</option>
                                            <option value="234">Ilhabela</option>
                                            <option value="235">Indaiatuba</option>
                                            <option value="236">Indiana</option>
                                            <option value="237">Indiaporã</option>
                                            <option value="238">Inúbia Paulista</option>
                                            <option value="239">Ipaussu</option>
                                            <option value="240">Iperó</option>
                                            <option value="241">Ipeúna</option>
                                            <option value="242">Ipiguá</option>
                                            <option value="243">Iporanga</option>
                                            <option value="244">Ipuã</option>
                                            <option value="245">Iracemápolis</option>
                                            <option value="246">Irapuã</option>
                                            <option value="247">Irapuru</option>
                                            <option value="248">Itaberá</option>
                                            <option value="249">Itaí</option>
                                            <option value="250">Itajobi</option>
                                            <option value="251">Itaju</option>
                                            <option value="252">Itanhaém</option>
                                            <option value="253">Itaóca</option>
                                            <option value="254">Itapecerica da Serra</option>
                                            <option value="255">Itapetininga</option>
                                            <option value="256">Itapeva</option>
                                            <option value="257">Itapevi</option>
                                            <option value="258">Itapira</option>
                                            <option value="259">Itapirapuã Paulista</option>
                                            <option value="260">Itápolis</option>
                                            <option value="261">Itaporanga</option>
                                            <option value="262">Itapuí</option>
                                            <option value="263">Itapura</option>
                                            <option value="264">Itaquaquecetuba</option>
                                            <option value="265">Itararé</option>
                                            <option value="266">Itariri</option>
                                            <option value="267">Itatiba</option>
                                            <option value="268">Itatinga</option>
                                            <option value="269">Itirapina</option>
                                            <option value="270">Itirapuã</option>
                                            <option value="271">Itobi</option>
                                            <option value="272">Itú</option>
                                            <option value="273">Itupeva</option>
                                            <option value="274">Ituverava</option>
                                            <option value="275">Jaborandi</option>
                                            <option value="Jaboticabal">Jaboticabal</option>
                                            <option value="277">Jacareí</option>
                                            <option value="278">Jaci</option>
                                            <option value="279">Jacupiranga</option>
                                            <option value="280">Jaguariúna</option>
                                            <option value="281">Jales</option>
                                            <option value="282">Jambeiro</option>
                                            <option value="283">Jandira</option>
                                            <option value="284">Jardinópolis</option>
                                            <option value="285">Jarinu</option>
                                            <option value="286">Jaú</option>
                                            <option value="287">Jeriquara</option>
                                            <option value="288">Joanópolis</option>
                                            <option value="289">João Ramalho</option>
                                            <option value="290">José Bonifácio</option>
                                            <option value="291">Júlio Mesquita</option>
                                            <option value="642">Jumirim</option>
                                            <option value="292">Jundiaí</option>
                                            <option value="293">Junqueirópolis</option>
                                            <option value="294">Juquiá</option>
                                            <option value="295">Juquitiba</option>
                                            <option value="296">Lagoinha</option>
                                            <option value="297">Laranjal Paulista</option>
                                            <option value="298">Lavínia</option>
                                            <option value="299">Lavrinhas</option>
                                            <option value="300">Leme</option>
                                            <option value="301">Lençóis Paulista</option>
                                            <option value="302">Limeira</option>
                                            <option value="303">Lindóia</option>
                                            <option value="304">Lins</option>
                                            <option value="305">Lorena</option>
                                            <option value="306">Lourdes</option>
                                            <option value="307">Louveira</option>
                                            <option value="308">Lucélia</option>
                                            <option value="309">Lucianópolis</option>
                                            <option value="311">Luis Antônio</option>
                                            <option value="310">Luiziânia</option>
                                            <option value="312">Lupércio</option>
                                            <option value="313">Lutécia</option>
                                            <option value="314">Macatuba</option>
                                            <option value="315">Macaubal</option>
                                            <option value="316">Macedônia</option>
                                            <option value="317">Magda</option>
                                            <option value="318">Mairinque</option>
                                            <option value="319">Mairiporã</option>
                                            <option value="320">Manduri</option>
                                            <option value="321">Marabá Paulista</option>
                                            <option value="322">Maracaí</option>
                                            <option value="323">Marapoama</option>
                                            <option value="324">Mariápolis</option>
                                            <option value="325">Marília</option>
                                            <option value="326">Marinópolis</option>
                                            <option value="327">Martinópolis</option>
                                            <option value="328">Matão</option>
                                            <option value="329">Mauá</option>
                                            <option value="330">Mendonça</option>
                                            <option value="331">Meridiano</option>
                                            <option value="332">Mesópolis</option>
                                            <option value="333">Miguelópolis</option>
                                            <option value="334">Mineiros do Tietê</option>
                                            <option value="335">Mira Estrela</option>
                                            <option value="336">Miracatu</option>
                                            <option value="337">Mirandópolis</option>
                                            <option value="338">Mirante do Paranapanema</option>
                                            <option value="339">Mirassol</option>
                                            <option value="340">Mirassolândia</option>
                                            <option value="341">Mococa</option>
                                            <option value="344">Mogi das Cruzes</option>
                                            <option value="342">Mogi Guaçu</option>
                                            <option value="343">Mogi Mirim</option>
                                            <option value="345">Mombuca</option>
                                            <option value="346">Monções</option>
                                            <option value="347">Mongaguá</option>
                                            <option value="348">Monte Alegre do Sul</option>
                                            <option value="349">Monte Alto</option>
                                            <option value="350">Monte Aprazível</option>
                                            <option value="351">Monte Azul Paulista</option>
                                            <option value="352">Monte Castelo</option>
                                            <option value="354">Monte Mor</option>
                                            <option value="353">Monteiro Lobato</option>
                                            <option value="355">Morro Agudo</option>
                                            <option value="356">Morungaba</option>
                                            <option value="357">Motuca</option>
                                            <option value="358">Murutinga do Sul</option>
                                            <option value="643">Nantes</option>
                                            <option value="359">Narandiba</option>
                                            <option value="360">Natividade da Serra</option>
                                            <option value="361">Nazaré Paulista</option>
                                            <option value="362">Neves Paulista</option>
                                            <option value="363">Nhandeara</option>
                                            <option value="364">Nipoã</option>
                                            <option value="365">Nova Aliança</option>
                                            <option value="366">Nova Campina</option>
                                            <option value="367">Nova Canaã Paulista</option>
                                            <option value="800">Nova Castilho</option>
                                            <option value="368">Nova Europa</option>
                                            <option value="369">Nova Granada</option>
                                            <option value="370">Nova Guataporanga</option>
                                            <option value="371">Nova Independência</option>
                                            <option value="372">Nova Luzitânia</option>
                                            <option value="373">Nova Odessa</option>
                                            <option value="374">Novais</option>
                                            <option value="375">Novo Horizonte</option>
                                            <option value="376">Nuporanga</option>
                                            <option value="377">Ocauçu</option>
                                            <option value="378">Óleo</option>
                                            <option value="379">Olímpia</option>
                                            <option value="380">Onda Verde</option>
                                            <option value="381">Oriente</option>
                                            <option value="382">Orindiúva</option>
                                            <option value="383">Orlândia</option>
                                            <option value="384">Osasco</option>
                                            <option value="385">Oscar Bressane</option>
                                            <option value="386">Osvaldo Cruz</option>
                                            <option value="387">Ourinhos</option>
                                            <option value="388">Ouro Verde</option>
                                            <option value="637">Ouroeste</option>
                                            <option value="389">Pacaembu</option>
                                            <option value="390">Palestina</option>
                                            <option value="391">Palmares Paulista</option>
                                            <option value="392">Palmeira d'Oeste</option>
                                            <option value="393">Palmital</option>
                                            <option value="394">Panorama</option>
                                            <option value="395">Paraguaçu Paulista</option>
                                            <option value="396">Paraibuna</option>
                                            <option value="397">Paraíso</option>
                                            <option value="398">Paranapanema</option>
                                            <option value="399">Paranapuã</option>
                                            <option value="400">Parapuã</option>
                                            <option value="401">Pardinho</option>
                                            <option value="402">Pariquera-Açu</option>
                                            <option value="403">Parisi</option>
                                            <option value="404">Patrocínio Paulista</option>
                                            <option value="405">Paulicéia</option>
                                            <option value="406">Paulínia</option>
                                            <option value="644">Paulistânia</option>
                                            <option value="407">Paulo de Faria</option>
                                            <option value="408">Pederneiras</option>
                                            <option value="409">Pedra Bela</option>
                                            <option value="410">Pedranópolis</option>
                                            <option value="411">Pedregulho</option>
                                            <option value="412">Pedreira</option>
                                            <option value="413">Pedrinhas Paulista</option>
                                            <option value="414">Pedro de Toledo</option>
                                            <option value="415">Penápolis</option>
                                            <option value="416">Pereira Barreto</option>
                                            <option value="417">Pereiras</option>
                                            <option value="418">Peruíbe</option>
                                            <option value="419">Piacatu</option>
                                            <option value="420">Piedade</option>
                                            <option value="421">Pilar do Sul</option>
                                            <option value="422">Pindamonhangaba</option>
                                            <option value="423">Pindorama</option>
                                            <option value="424">Pinhalzinho</option>
                                            <option value="425">Piquerobi</option>
                                            <option value="426">Piquete</option>
                                            <option value="427">Piracaia</option>
                                            <option value="Piracicaba">Piracicaba</option>
                                            <option value="430">Piraju</option>
                                            <option value="431">Pirajuí</option>
                                            <option value="432">Pirangi</option>
                                            <option value="433">Pirapora do Bom Jesus</option>
                                            <option value="434">Pirapozinho</option>
                                            <option value="429">Pirassununga</option>
                                            <option value="435">Piratininga</option>
                                            <option value="436">Pitangueiras</option>
                                            <option value="437">Planalto</option>
                                            <option value="438">Platina</option>
                                            <option value="439">Poá</option>
                                            <option value="440">Poloni</option>
                                            <option value="441">Pompéia</option>
                                            <option value="442">Pongaí</option>
                                            <option value="443">Pontal</option>
                                            <option value="444">Pontalinda</option>
                                            <option value="445">Pontes Gestal</option>
                                            <option value="446">Populina</option>
                                            <option value="447">Porangaba</option>
                                            <option value="448">Porto Feliz</option>
                                            <option value="449">Porto Ferreira</option>
                                            <option value="450">Potim</option>
                                            <option value="451">Potirendaba</option>
                                            <option value="452">Pracinha</option>
                                            <option value="453">Pradópolis</option>
                                            <option value="454">Praia Grande</option>
                                            <option value="455">Pratânia</option>
                                            <option value="456">Presidente Alves</option>
                                            <option value="457">Presidente Bernardes</option>
                                            <option value="458">Presidente Epitácio</option>
                                            <option value="459">Presidente Prudente</option>
                                            <option value="460">Presidente Venceslau</option>
                                            <option value="461">Promissão</option>
                                            <option value="462">Quadra</option>
                                            <option value="463">Quatá</option>
                                            <option value="464">Queiroz</option>
                                            <option value="465">Queluz</option>
                                            <option value="466">Quintana</option>
                                            <option value="467">Rafard</option>
                                            <option value="468">Rancharia</option>
                                            <option value="469">Redenção da Serra</option>
                                            <option value="470">Regente Feijó</option>
                                            <option value="471">Reginópolis</option>
                                            <option value="472">Registro</option>
                                            <option value="473">Restinga</option>
                                            <option value="474">Ribeira</option>
                                            <option value="475">Ribeirão Bonito</option>
                                            <option value="476">Ribeirão Branco</option>
                                            <option value="477">Ribeirão Corrente</option>
                                            <option value="478">Ribeirão do Sul</option>
                                            <option value="645">Ribeirão dos Índios</option>
                                            <option value="479">Ribeirão Grande</option>
                                            <option value="480">Ribeirão Pires</option>
                                            <option value="481">Ribeirão Preto</option>
                                            <option value="482">Rifaina</option>
                                            <option value="483">Rincão</option>
                                            <option value="484">Rinópolis</option>
                                            <option value="485">Rio Claro</option>
                                            <option value="486">Rio das Pedras</option>
                                            <option value="487">Rio Grande da Serra</option>
                                            <option value="488">Riolândia</option>
                                            <option value="489">Riversul</option>
                                            <option value="490">Rosana</option>
                                            <option value="491">Roseira</option>
                                            <option value="492">Rubiácea</option>
                                            <option value="493">Rubinéia</option>
                                            <option value="494">Sabino</option>
                                            <option value="495">Sagres</option>
                                            <option value="496">Sales</option>
                                            <option value="497">Sales Oliveira</option>
                                            <option value="498">Salesópolis</option>
                                            <option value="499">Salmourão</option>
                                            <option value="500">Saltinho</option>
                                            <option value="501">Salto</option>
                                            <option value="502">Salto de Pirapora</option>
                                            <option value="503">Salto Grande</option>
                                            <option value="504">Sandovalina</option>
                                            <option value="505">Santa Adélia</option>
                                            <option value="506">Santa Albertina</option>
                                            <option value="507">Santa Bárbara d'Oeste</option>
                                            <option value="508">Santa Branca</option>
                                            <option value="509">Santa Clara d'Oeste</option>
                                            <option value="510">Santa Cruz da Conceição</option>
                                            <option value="511">Santa Cruz da Esperança</option>
                                            <option value="512">Santa Cruz das Palmeiras</option>
                                            <option value="513">Santa Cruz do Rio Pardo</option>
                                            <option value="514">Santa Ernestina</option>
                                            <option value="515">Santa Fé do Sul</option>
                                            <option value="516">Santa Gertrudes</option>
                                            <option value="517">Santa Isabel</option>
                                            <option value="518">Santa Lúcia</option>
                                            <option value="519">Santa Maria da Serra</option>
                                            <option value="520">Santa Mercedes</option>
                                            <option value="522">Santa Rita d'Oeste</option>
                                            <option value="521">Santa Rita do Passa Quatro</option>
                                            <option value="Santa Rosa de Viterbo">Santa Rosa de Viterbo</option>
                                            <option value="524">Santa Salete</option>
                                            <option value="525">Santana da Ponte Pensa</option>
                                            <option value="526">Santana de Parnaíba</option>
                                            <option value="527">Santo Anastácio</option>
                                            <option value="528">Santo André</option>
                                            <option value="529">Santo Antônio da Alegria</option>
                                            <option value="530">Santo Antônio de Posse</option>
                                            <option value="531">Santo Antônio do Aracanguá</option>
                                            <option value="532">Santo Antônio do Jardim</option>
                                            <option value="533">Santo Antônio do Pinhal</option>
                                            <option value="534">Santo Expedito</option>
                                            <option value="535">Santópolis do Aguapeí</option>
                                            <option value="536">Santos</option>
                                            <option value="537">São Bento do Sapucaí</option>
                                            <option value="538">São Bernardo do Campo</option>
                                            <option value="539">São Caetano do Sul</option>
                                            <option value="540">São Carlos</option>
                                            <option value="541">São Francisco</option>
                                            <option value="542">São João da Boa Vista</option>
                                            <option value="543">São João das Duas Pontes</option>
                                            <option value="544">São João de Iracema</option>
                                            <option value="545">São João do Pau d'Alho</option>
                                            <option value="546">São Joaquim da Barra</option>
                                            <option value="547">São José da Bela Vista</option>
                                            <option value="548">São José do Barreiro</option>
                                            <option value="549">São José do Rio Pardo</option>
                                            <option value="550">São José do Rio Preto</option>
                                            <option value="551">São José dos Campos</option>
                                            <option value="552">São Lourenço da Serra</option>
                                            <option value="553">São Luiz do Paraitinga</option>
                                            <option value="554">São Manuel</option>
                                            <option value="555">São Miguel Arcanjo</option>
                                            <option value="556">São Paulo</option>
                                            <option value="557">São Pedro</option>
                                            <option value="558">São Pedro do Turvo</option>
                                            <option value="559">São Roque</option>
                                            <option value="560">São Sebastião</option>
                                            <option value="561">São Sebastião da Grama</option>
                                            <option value="562">São Simão</option>
                                            <option value="563">São Vicente</option>
                                            <option value="564">Sarapuí</option>
                                            <option value="565">Sarutaiá</option>
                                            <option value="566">Sebastianópolis do Sul</option>
                                            <option value="567">Serra Azul</option>
                                            <option value="568">Serra Negra</option>
                                            <option value="569">Serrana</option>
                                            <option value="570">Sertãozinho</option>
                                            <option value="571">Sete Barras</option>
                                            <option value="572">Severínia</option>
                                            <option value="573">Silveiras</option>
                                            <option value="574">Socorro</option>
                                            <option value="Sorocaba">Sorocaba</option>
                                            <option value="576">Sud Mennucci</option>
                                            <option value="577">Sumaré</option>
                                            <option value="579">Suzanápolis</option>
                                            <option value="578">Suzano</option>
                                            <option value="580">Tabapuã</option>
                                            <option value="581">Tabatinga</option>
                                            <option value="582">Taboão da Serra</option>
                                            <option value="583">Taciba</option>
                                            <option value="584">Taguaí</option>
                                            <option value="585">Taiaçu</option>
                                            <option value="586">Taiúva</option>
                                            <option value="587">Tambaú</option>
                                            <option value="588">Tanabi</option>
                                            <option value="589">Tapiraí</option>
                                            <option value="590">Tapiratiba</option>
                                            <option value="591">Taquaral</option>
                                            <option value="592">Taquaritinga</option>
                                            <option value="593">Taquarituba</option>
                                            <option value="594">Taquarivaí</option>
                                            <option value="595">Tarabaí</option>
                                            <option value="596">Tarumã</option>
                                            <option value="597">Tatuí</option>
                                            <option value="598">Taubaté</option>
                                            <option value="599">Tejupá</option>
                                            <option value="600">Teodoro Sampaio</option>
                                            <option value="601">Terra Roxa</option>
                                            <option value="602">Tietê</option>
                                            <option value="603">Timburi</option>
                                            <option value="604">Torre de Pedra</option>
                                            <option value="605">Torrinha</option>
                                            <option value="641">Trabiju</option>
                                            <option value="606">Tremembé</option>
                                            <option value="607">Três Fronteiras</option>
                                            <option value="608">Tuiuti</option>
                                            <option value="609">Tupã</option>
                                            <option value="610">Tupi Paulista</option>
                                            <option value="611">Turiúba</option>
                                            <option value="612">Turmalina</option>
                                            <option value="613">Ubarana</option>
                                            <option value="614">Ubatuba</option>
                                            <option value="615">Ubirajara</option>
                                            <option value="616">Uchoa</option>
                                            <option value="617">União Paulista</option>
                                            <option value="618">Urânia</option>
                                            <option value="619">Uru</option>
                                            <option value="620">Urupês</option>
                                            <option value="621">Valentim Gentil</option>
                                            <option value="622">Valinhos</option>
                                            <option value="623">Valparaíso</option>
                                            <option value="624">Vargem</option>
                                            <option value="625">Vargem Grande do Sul</option>
                                            <option value="626">Vargem Grande Paulista</option>
                                            <option value="627">Várzea Paulista</option>
                                            <option value="628">Vera Cruz</option>
                                            <option value="629">Vinhedo</option>
                                            <option value="630">Viradouro</option>
                                            <option value="631">Vista Alegre do Alto</option>
                                            <option value="632">Vitória Brasil</option>
                                            <option value="633">Votorantim</option>
                                            <option value="634">Votuporanga</option>
                                            <option value="636">Zacarias</option>
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
                                            <option value="DSMM">DSMM - Dep de Sementes, Mudas e Matrizes</option>
                                            <option value="EDR">EDR - Escritorio dev. Rural</option>
                                            <option value="CA">CA - Casa de Agricultura</option>
                                            <option value="NPM">NPM - Nucle de Prod. de Mudas</option>
                                            <option value="APTA">APTA - Agência Paulista de Tec. dos Agronegocios
                                            </option>
                                            <option value="CDA">CDA - Corrdenadoria de Def. Agropecuaria</option>
                                            <option value="CATI">CATI - Coordenadoria de Desenvolvimento Rural
                                                Sustentável</option>

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
                                    <label class="control-label">Tecnico quem Arrumou</label>
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
                                            <option value="Não mexido"> Não mexido </option>
                                            <option value="Sendo Mexido"> Sendo Mexido </option>
                                            <option value="Pronta"> Pronta </option>
                                            <option value="Entregue"> Entregue </option>
                                            <option value="Baixa"> Baixa </option>
                                            <option value="Transferencia"> Transferencia </option>
                                            <option value="Emprestado"> Emprestado </option>
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

                            <div class="form-group col-md-2">
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