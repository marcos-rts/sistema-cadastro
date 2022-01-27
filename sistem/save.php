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
                if ($row['status'] != 'Entregue') {
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
if ($_SESSION['UsuarioNivel'] == '5') {
?>

<?php
}
?>