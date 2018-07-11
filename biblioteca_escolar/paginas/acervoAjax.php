<?php

require_once('../config/conexao_bd.php');
$conexao = Conecta_bd();

	$sql = "SELECT a.id, c.nome, a.codigo, a.titulo, a.autor, a.editora, a.nVolume, a.qtd_item, a.anoEdicao, a.genero, a.descricao FROM categoria c 
            INNER JOIN acervo a ON c.id = a.categoria_id";

	if (isset($_POST['buscar'])) {
		$pesquisar = $_POST['buscar'];
		$categoria = $_POST['categoria'];
		

		$sql .= " WHERE (a.titulo LIKE '%$pesquisar%' OR a.codigo LIKE '$pesquisar') AND c.id = $categoria";
	}
	$result = $conexao->query($sql);
	if ($result->num_rows > 0) {
	while($row = $result->fetch_object()) {   
?>
<tr>
   	<td><center><?= $row->nome ?></center></td>
   	<td><center><?= $row->codigo ?></center></td>
    <td><center><?= $row->titulo ?></center></td>
    <td><center><?= $row->autor ?></center></td>
    <td><center><?= $row->editora ?></center></td>
    <td><center><?= $row->nVolume ?></center></td>
    <td><center><?= $row->qtd_item ?></center></td>
    <td><center><?= $row->anoEdicao ?></center></td>
    <td><center><?= $row->genero ?></center></td>
    <td><center><?= $row->descricao ?></center></td>
    <td><center><a href="?pg=alterar&id=<?= $row->id ?>" class="btn btn-default" onclick="return confirm('Desejar alterar dados deste item?');">Alterar</a></center>
	</td>
    <td><center><a href="?pg=listar_acervo&id=<?= $row->id ?>" class="btn btn-danger" onclick="return confirm('Desejar mesmo remover?');">Excluir</a></center>
    </td>
    <td><center><a href="?pg=formulario_emprestimo&id=<?= $row->id ?>" class="btn btn-warning">			Emprestar</a></center>
    </td>
</tr>	
<?php	         
		}
	}
?>