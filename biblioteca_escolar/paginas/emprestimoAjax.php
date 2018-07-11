<?php
	require_once('../config/conexao_bd.php');
	$conexao = Conecta_bd();
	$sql = "SELECT e.id, a.titulo, p.nome, p.funcao, e.dtEmprestimo, e.dtDevolucao, e.qtdEmprestado FROM 
			emprestimo e
			INNER jOIN pessoa p ON e.pessoa_id = p.id
			INNER JOIN acervo a ON e.acervo_id = a.id";
		if (isset($_POST['buscar'])) {
			$pesquisar = $_POST['buscar'];
			
			$sql .= " WHERE (p.nome LIKE '%$pesquisar%')";
		}
		$result = $conexao->query($sql);
		if ($result->num_rows > 0) {	
	    	while ($row = $result->fetch_object()) {   		
	?>
	<tr>
	   	<td><center><?= $row->nome ?></td></center>
	    <td><center><?= $row->titulo ?></td></center>
	    <td><center><?= $row->funcao ?></td></center>
	    <td><center><?= $row->dtEmprestimo ?></td></center>
	    <td><center><?= $row->dtDevolucao ?></td></center>
	    <td><center><?= $row->qtdEmprestado ?></td></center>
	    <td><center><a href="?pg=AtualizarEmprestimo&id=<?= $row->id ?>" class="btn btn-default" onclick="return confirm('Desejar alterar dados deste item?');">Alterar</a></center>
	    </td>
	    <td><center><a href="?pg=listar_emprestimo&id=<?= $row->id ?>" class="btn btn-danger" onclick="return confirm('Desejar mesmo remover?');">Excluir</a></center>
	    </td>
	    <td><center><a href="?pg=listar_emprestimo&id=<?= $row->id ?>" class="btn btn-warning">Devolução</a></center>
	    </td> 
</tr>		        
<?php
	}
}
?>