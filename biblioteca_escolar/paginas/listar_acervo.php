<?php 
include('acervo.php');
echo "<br>";

require_once('config/conexao_bd.php');
$conexao = Conecta_bd();

if(isset($_GET['id'])){	
	$idAcervo = $_GET['id'];
	$sql = "DELETE FROM acervo WHERE id = " . $idAcervo;
	if($conexao->query($sql) === TRUE){
		echo "item excluído com sucesso!";
	}
}
?>
<br>

<div class="container">
	<form action="?pg=listar_acervo" class="form-group" method="POST" onsubmit="return carregaConteudoTabela(this);">
      	<input type="search" style="color: black;" name="buscar" id="buscar" list="acervo_list" placeholder="buscar..">
    	<button type="submit" name="enviar" class="btn-topbar-primary js-search-submit">
    	<svg aria-hidden="true" class="svg-icon iconSearch" width="18" height="18" viewBox="0 0 18 18"><path d="M12.86 11.32L18 16.5 16.5 18l-5.18-5.14v-.35a7 7 0 1 1 1.19-1.19h.35zM7 12A5 5 0 1 0 7 2a5 5 0 0 0 0 10z"/></svg></button>
    
  	<form action="?pg=listar_acervo" class="form-group" method="POST" onsubmit="return carregaConteudoTabela(this);">
		<select id="buscaCategoria" name="buscaCategoria" style="color: black; margin: 0 0 0 95px;">
			<option value="12345">Escolha</option>
			<option value="1">Livro</option>
			<option value="2">Revista</option>
			<option value="3">Dicionário</option>
			<option value="4">Enciclopédia</option>
			<option value="5">CD/DVD</option>
		</select>
		<button type="submit" name="enviar" class="btn-topbar-primary js-search-submit">
    	<svg aria-hidden="true" class="svg-icon iconSearch" width="18" height="18" viewBox="0 0 18 18"><path d="M12.86 11.32L18 16.5 16.5 18l-5.18-5.14v-.35a7 7 0 1 1 1.19-1.19h.35zM7 12A5 5 0 1 0 7 2a5 5 0 0 0 0 10z"/></svg></button>
    </form>
    </form>
</div>
<br>

<div class="container" style="width: 85%">
	<table class="table" style="color: white; border-style: double; border-color: white;" >
		<div class="select" style="background: rgba(0, 0, 0, 0.7); color: white; font-size: 20px; border-style: double; margin: 0 0 5px 0;">
			<h1>Listagem de pessoas</h1>
			<?php 
			$sql = "SELECT id FROM acervo";
			if ($result=mysqli_query($conexao,$sql)) {
			 	$rowcount=mysqli_num_rows($result);
				if ($rowcount <= 1) {
			 		printf("Total de item cadastrado no acervo:  %d item",$rowcount);
			 	}
			 	else{
			 		printf("Total de itens cadastrados no acervo:  %d itens",$rowcount);
			 	}	  
				mysqli_free_result($result);
			}
			?>
		</div>
		<tr>
			<td><center>Tipo de item</center></td>
			<td><center>Código</center></td>
			<td><center>Titulo</center></td>
			<td><center>Autor</center></td>
			<td><center>Editora</center></td>
			<td><center>Nº de Volume</center></td>
			<td><center>Quantidade</center></td>
			<td><center>Ano de Edição</center></td>
			<td><center>Gênero</center></td>
			<td><center>Descrição</center></td>
			<td><center>Alterar item</center></td>
			<td><center>Remover item</center></td>
			<td><center>Fazer emprestimo</center></td>
		</tr>
		<tbody id="acervoAjax">
		<?php
			$sql = "SELECT a.id, c.nome, a.codigo, a.titulo, a.autor, a.editora, a.nVolume, a.qtd_item, a.anoEdicao, a.genero, a.descricao FROM categoria c 
	                INNER JOIN acervo a ON c.id = a.categoria_id";

			if (isset($_POST['enviar'])) {
				$pesquisar = $_POST['buscar'];
				$pesquisarCategoria = ['buscaCategoria'];
				
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
		</tbody>
	</table>	
</div>

<datalist id="acervo_list">
</datalist>
<script type="text/javascript">
  
function carregaConteudoTabela(obj){
	var buscarValue = $("#buscar").val();
	var categoriaValue = $("#buscaCategoria").val();	
	$.ajax({
	  method: "POST",
	  url: "paginas/acervoAjax.php",
	  data: {buscar: buscarValue, categoria: categoriaValue}
	 }).done(function(conteudo){  
	    $("#acervoAjax").html(conteudo);
	 }).fail(function(jqXHR, textStatus, msg){
	    alert(msg);
	 }); 

	 return false;

	}
</script>