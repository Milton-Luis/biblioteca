<?php 
	require_once('config/conexao_bd.php');
	$conexao = Conecta_bd();
?>

<div class="container">
	<form action="?pg=listar_emprestimo" class="form-group" method="POST" onsubmit=" return carregaConteudoTabela(this);">
		<input type="search" name="buscar" id="buscar" placeholder="Buscar..." style="color: black;">
			
		<button type="submit" name="enviar" aria-label="Pesquisar..." class="btn-topbar-primary js-search-submit"><svg aria-hidden="true" class="svg-icon iconSearch" width="18" height="18" viewBox="0 0 18 18"><path d="M12.86 11.32L18 16.5 16.5 18l-5.18-5.14v-.35a7 7 0 1 1 1.19-1.19h.35zM7 12A5 5 0 1 0 7 2a5 5 0 0 0 0 10z"/></svg></button>  
	</form>
</div>
<div class="container" style="width: 85%">
	<table class="table" style="border-style: double; border-color: white; width: 110%">
		<tr>
			<td><center>Titulo do livro</center></td>
			<td><center>Nome do locatario</center></td>
			<td><center>Função escolar</center></td>
			<td><center>Data do Emprestimo</center> </td>
			<td><center>Data da  Devolução</center></td>
			<td><center>Quantidade de item(ns) pego(s)</center></td>
			<td><center>Atualizar Emprestimo</center></td>
			<td><center>Realizar Devolução</center></td>
		</tr>
		<tbody id="emprestimoAjax">
			<?php
				$sql = "SELECT e.id, a.titulo, p.nome, p.funcao, e.dtEmprestimo, e.dtDevolucao, e.qtdEmprestado FROM emprestimo e
						INNER jOIN pessoa p ON e.pessoa_id = p.id
						INNER JOIN acervo a ON e.acervo_id = a.id";
				if (isset($_POST['enviar'])) {
					$pesquisar = $_POST['buscar'];
					$sql .= " WHERE (p.nome LIKE '%$pesquisar%')";
				}
				$result = $conexao->query($sql);
				if ($result->num_rows > 0) {	
			    	while ($row = $result->fetch_object()) {   		
			?>
			<tr>
		       	<td><center><?= $row->nome ?></center></td>
		        <td><center><?= $row->titulo ?></center></td>
		        <td><center><?= $row->funcao ?></center></td>
		        <td><center><?= $row->dtEmprestimo ?></center></td>
		        <td><center><?= $row->dtDevolucao ?></center></td>
		        <td><center><?= $row->qtdEmprestado ?></center></td>
			    <td><center><a href="?pg=atualizarEmprestimo&id=<?= $row->id ?>" class="btn btn-default">Atualizar</a></center>
			    </td>
			    <td><center><a href="?pg=listar_emprestimo&id=<?= $row->id ?>" class="btn btn-warning">Devolução</a></center>
			    </td> 
			</tr>		        
		   <?php
		    	}
			}
			?>
		</tbody>
	</table>
</div>
<?php
	if(isset($_GET['id'])){	
		$idEmprestimo = $_GET['id'];

		$sql = "SELECT qtdEmprestado, acervo_id FROM emprestimo WHERE id = '$idEmprestimo'";

		$result = $conexao->query($sql);
		if ($row = $result->fetch_object()){
			$qtdEmprestado = $row->qtdEmprestado;
			$idAcervo = $row->acervo_id;

			$devolucao = "UPDATE acervo SET qtd_item = qtd_item + $qtdEmprestado 
						WHERE id = '$idAcervo'"; 
			//var_dump($devolucao);

			if($conexao->query($devolucao) === TRUE){ 
				echo "<br>";
				echo'<div class="alert alert-success" 
					style="color:black; 
					font-size: 24px; 
					font-family:Times New Roman", Times, serif;">
					Devolução do feita com sucesso!!! aguarde...</div>';
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=?pg=listar_emprestimo'>";
			}
		}

		$sql = "DELETE FROM emprestimo WHERE id = " . $idEmprestimo;
		if($conexao->query($sql) === TRUE){
			//echo "Emprestimo deletado com sucesso";
		}

	}
?>
<script type="text/javascript">
function carregaConteudoTabela(obj){
	var buscarValue = $("#buscar").val();	
	$.ajax({
	  method: "POST",
	  url: "paginas/emprestimoAjax.php",
	  data: {buscar: buscarValue}
	 }).done(function(conteudo){  
	    $("#emprestimoAjax").html(conteudo);
	 }).fail(function(jqXHR, textStatus, msg){
	    alert(msg);
	 }); 

	 return false;

	}
</script>
