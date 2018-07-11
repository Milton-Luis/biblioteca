<?php
	require_once('../config/conexao_bd.php');
	$conexao = Conecta_bd();

	$sql = "SELECT p.id, p.matricula, p.nome, p.tel, p.email, p.funcao, p.periodo FROM pessoa p";
		if (isset($_POST['buscar'])) {
			$pesquisar = $_POST['buscar'];
			
			$sql .= " WHERE (p.nome LIKE '%$pesquisar%' OR p.matricula LIKE '$pesquisar')";
		}
		$result = $conexao->query($sql);
		if ($result->num_rows > 0) {	
	    	while ($row = $result->fetch_object()) {   		
	?>
	<tr>
		<td><center><?= $row->matricula ?></td></center>
	   	<td><center><?= $row->nome ?></td></center>
	    <td><center><?= $row->tel ?></td></center>
	    <td><center><?= $row->email ?></td></center>
	    <td><center><?= $row->funcao ?></td></center>
	    <td><center><?= $row->periodo ?></td></center>
	    <td><center><a href="?pg=listar_pessoas&id=<?= $row->id ?>" class="btn btn-danger" onclick="return confirm('Desejar mesmo remover?');">Excluir</a></td>
	</tr>		
<?php
	}
}
?>
