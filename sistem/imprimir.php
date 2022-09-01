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
    $ano = date( 'Y', strtotime( $data['entrada'] ) );
    $mes = date( 'm', strtotime( $data['entrada'] ) );
    $dia = date( 'd', strtotime( $data['entrada'] ) );
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <title>Imprimir</title>
    <style>
      .tdcont{
        width: 100%;
    height: 100%;
    overflow:hidden;
      }
    </style>
</head>

<body>
<div class="container">
    <div class="container">
        <div class="">
            <div class="card-header">
                <h3 class="well text-center">PROTOCOLO DE RECEBIMENTO E ENTREGUA DE EQUIPAMENTOS</h3>
            </div>
            <div class="container">
    <table class="table table-sm table-bordered" border="1">


      <tbody>
      <tr>
          <th scope="" style="width:300px">Protocolo & ID </th>
          <td scope="" colspan="3" > <?php echo $ano, ' / ', $data['chamado']; ?> - <?php echo $data['id']; ?> </td>
      <!--    <td scope="" > <?php echo $data['id']; ?> </td>    -->
        </tr>
        <tr>
            <th> Descrição do Problema </th>
            <td colspan="3"> <?php echo $data['problema']; ?> </td>
        </tr>
        <tr>
            <th> Tecnico responsavel pela avaliação </th>
            <td > <?php echo $data['tecnico']; ?> </td>
            <th style="width:100px"> Status</th>
	    <td style="width:200px"> </td>
        </tr>        
      </tbody>
    </table>

    <div class="card-header">
        <h3 class="well text-center">DADOS DO COMPUTADOR</h3>
    </div>


    <table class="table table-sm table-bordered" border="1">


      <tbody>
      <tr>
          <th scope="">Tipo de Equipamento</th>
          <td scope="" > <?php echo $data['equip']; ?> </td>
          <th scope="">Chapa</th>
          <td scope="" > <?php echo $data['chapa']; ?> </td>
        </tr>
        <tr>
            <th> Local e Setor </th>
            <td colspan="3"> <?php echo $data['setor'], ' de ', $data['local'] ; ?> </td>
        </tr>
        <?php if ($data['equip'] == "Desktop" || $data['equip'] == "Notebook") {
            ?>
            <tr>
            <th> Sistema Operacional colocado </th>
            <td colspan="3">  </td>
        </tr> 
        <?php
        }
        ?>
               
      </tbody>
    </table>
    <div class="card-header">
        <h3 class="well text-center">DADOS PESSOAIS</h3>
    </div>

<!--
    <table class="table table-sm table-bordered" border="1">


      <tbody>
      <tr>
          <th scope="">Tecnico que Recebeu</th>
          <td scope="" > <?php echo $data['recebe']; ?> </td>
          <th scope="">Usuario quem trouxe</th>
          <td scope="" > <?php echo $data['nome']; ?> </td>
        </tr>
        <tr>
          <th scope="">Tecnico que Entregou</th>
          <td scope="" >  </td>
          <th scope="">Usuario que Retirou</th>
          <td scope="" >  </td>
        </tr>
        <tr>
          <th scope="">Data de Entrada</th>
          <td scope="" > <?php echo $dia, '/', $mes, '/', $ano  ; ?> </td>
          <th scope="">Data de Saida</th>
          <td scope="" >  </td>
        </tr>      
      </tbody>
    </table>
-->
    



   <table class="table table-sm table-bordered" border="1">


      <tbody>
      <tr>
          <th scope="">Usuario quem trouxe</th>
          <td scope="" colspan=3> <?php echo $data['nome']; ?> </td>
	</tr>
        <tr>
          <th scope="">Telefone</th>
          <td scope="" >  <?php echo $data['telefone']; ?> </td>
          <th scope="">Email</th>
          <td scope="" >  <?php echo $data['email']; ?> </td>
        </tr>
        <tr>
          <th scope="">Data de Entrada</th>
          <td scope=""  colspan=3> <?php echo $dia, '/', $mes, '/', $ano  ; ?> </td>
        </tr>
	<tr>
          <th scope="">Tecnico que Recebeu</th>
          <td scope=""  colspan=3 > <?php echo $data['recebe']; ?> </td>
	</tr>
      </tbody>
    </table>

    <br>




<br>

	<div class="container">
&emsp;&emsp;Ass.:______________________________&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Ass.:______________________________
<br>&emsp;&emsp;<strong> Usuario que recebeu</strong>
&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
<strong> Tecnico que entregou</strong>
</div>

<br>
<br>
<br>
&emsp;&emsp;______ / ______ / <strong> <?php echo $ano; ?> </strong>
<br>
&emsp;&emsp;<strong>Data de saida</strong>
<br>
<br>
    ✄<hr size="1" style="border:1px dashed green;">✄
<br>

    
    <table class="table table-bordered" border="1">


<tbody>
    <tr>
        <th scope="" colspan="6"><h3 class="well text-center">Protocolo de Recebimento e entrega de equipamentos</h3></th>
</tr>
<tr>
    <th scope="">Numero de Protocolo</th>
    <td scope="" colspan='3'> <?php echo $ano, ' / ', $data['chamado'], ' - ', $data['id']; ?> </td>
  </tr>
  <tr>
        <th scope="" colspan="6"><h4 class="well">DADOS DO COMPUTADOR</h4></th>
</tr>
  <tr>
    <th scope="">Tipo de Equipamento</th>
    <td scope="" >  <?php echo $data['equip']; ?> </td>
    <th scope="">Chapa</th>
    <td scope="" > <?php echo $data['chapa']; ?> </td>
  </tr>
  <tr>
      <th>Origem</th>
        <td scope="" colspan="5"><?php echo $data['setor'], ' de ', $data['local'] ; ?></td>
</tr>
<tr>
    <th scope="">Data de Entrada</th>
    <td scope="" colspan="1"> <?php echo $dia, '/', $mes, '/', $ano  ; ?> </td>
    <th scope="">Data de Saida</th>
    <th scope=""></td>
  </tr> 
<tr>
      <th>Tecnico que Recebeu</th>
        <td scope="" colspan="1"><?php echo $data['recebe']; ?></td>
          <th scope="" style="width:200px">Tecnico que Entregou</th>
          <td scope="" style="width:300px">  </td>
</tr>
     
</tbody>
</table>
</div>
</div>



<br>
            
<div class="row">

    </div>
                
                    <br/>
                </div>
            </div>
        </div>
    </div>
</div>
<footer>
<div class=container>
<div class=container>
<div class=container>
<div class=container>
<div class=container>
<form>
<input type="button" value="Print this page" onClick="window.print()"/>
<a href="index.php" type="btn" class="btn btn-default">Voltar</a>
</form>
</div>
</div>
</div>
</div>
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
