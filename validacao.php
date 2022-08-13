<?php

  // Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
  if (!empty($_POST) AND (empty($_POST['usuario']) OR empty($_POST['senha']))) {
    header("Location: index.php"); exit;
}

// Tenta se conectar ao servidor MySQL
$conect = mysqli_connect('localhost', 'suporte', 'sup0rt32022', 'novosistema') or trigger_error(mysql_error());
// Tenta se conectar a um banco de dados MySQL

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

// Validação do usuário/senha digitados
$sql = "SELECT `id`, `nome`, `nivel` FROM `usuarios` WHERE (`usuario` = '".$usuario ."') AND (`senha` = '". sha1($senha) ."') AND (`ativo` = 1) LIMIT 1";
$query = mysqli_query($conect, $sql);
if (mysqli_num_rows($query) != 1) {
    // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
    echo "Login inválido!"; exit;
} else {
    // Salva os dados encontados na variável $resultado
    $resultado = mysqli_fetch_assoc($query);
    // Se a sessão não existir, inicia uma
      if (!isset($_SESSION)) session_start();

      // Salva os dados encontrados na sessão
      $_SESSION['UsuarioID'] = $resultado['id'];
      $_SESSION['UsuarioNome'] = $resultado['nome'];
      $_SESSION['UsuarioNivel'] = $resultado['nivel'];

      // Redireciona o visitante
      header("Location: sistem/index.php"); exit;
}

  ?>
