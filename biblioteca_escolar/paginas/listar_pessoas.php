<?php
require_once('config/conexao_bd.php');
$conexao = Conecta_bd();

if(isset($_GET['id'])){	
	$idPessoa = $_GET['id'];
	$sql = "DELETE FROM pessoa WHERE id = " . $idPessoa;
	if($conexao->query($sql) === TRUE){
		echo "Produto excluído com sucesso!";
	}
}
include('cadastro.php')
?>

<br>
<script src="JavaScript/validacoes.js" "></script>
<div class="container">
	<form action="?pg=listar_pessoas" method="POST" class="searchbar" role="search" onsubmit="return carregaConteudoTabela(this);"">
	    <input type="search" style="color: black;" name="buscar" id="buscar" list="pessoa_list" placeholder="Buscar...">

	    <button type="submit" name="enviar" class="btn-topbar-primary js-search-submit">
	    	<svg aria-hidden="true" class="svg-icon iconSearch" width="18" height="18" viewBox="0 0 18 18"><path d="M12.86 11.32L18 16.5 16.5 18l-5.18-5.14v-.35a7 7 0 1 1 1.19-1.19h.35zM7 12A5 5 0 1 0 7 2a5 5 0 0 0 0 10z"/></svg></button>
	</form>
</div>
<br>
<div class="container" style="width: 85%">
	<table class="table" style="color: white; border-style: double; border-color: white;" >
		<div class="select" style="background: rgba(0, 0, 0, 0.7); color: white; font-size: 20px; border-style: double; margin: 0 0 5px 0; table-layout: fixed;">
			<h1>Listagem de pessoas</h1>
			<?php 
				$sql = "SELECT matricula FROM pessoa";
				if ($result=mysqli_query($conexao,$sql)) {
				 	$rowcount=mysqli_num_rows($result);
					if ($rowcount <= 1) {
				 		printf("Total de pessoa cadastrado:  %d pessoa",$rowcount);
				 	}
				 	else{
				 		printf("Total de pessoas cadastrados:  %d pessoas",$rowcount);
				 	}	  
					mysqli_free_result($result);
				}
			?>
		</div>
		<tr>
			<td><center>Matricula/ Registro</center></td>
			<td><center>Nome</center></td>
			<td><center>Telefone</center></td>
			<td><center>E-mail</center></td>
			<td><center>Função</center></td>
			<td><center>Período</center></td>
			<td><center>Deletar</center></td>
		</tr>
		<tbody id="pessoaAjax">
			<?php 
			//------------- busca com filtragem de pessoas ----------------// 
			$sql = "SELECT p.id, p.matricula, p.nome, p.tel, p.email, p.funcao, p.periodo FROM pessoa p";
			if (isset($_POST['enviar'])) {
				$pesquisar = $_POST['buscar'];
				$sql .= " WHERE p.nome LIKE '%$pesquisar%'";
			}
			$result = $conexao->query($sql);
			if ($result->num_rows > 0) {	
		    	while ($row = $result->fetch_object()) {   		
			    ?>
			<tr>
				<td><center><?= $row->matricula ?></center></td>
		       	<td><center><?= $row->nome ?></center></td>
		        <td><center><?= $row->tel ?></center></td>
		        <td><center><?= $row->email ?></center></td>
		        <td><center><?= $row->funcao ?></center></td>
		        <td><center><?= $row->periodo ?></center></td>
		        <td><center><a href="?pg=listar_pessoas&id=<?= $row->id ?>" class="btn btn-danger" onclick="return confirm('Desejar mesmo remover?');">Excluir</a></center></td>
		    </tr>		
				<?php
	   			}
		    	$result->close();
			}
			?>
		</tbody>
	</table>
</div>
<script type="text/javascript">
  
function carregaConteudoTabela(obj){
	var buscarValue = $("#buscar").val();	
	$.ajax({
	  method: "POST",
	  url: "paginas/pessoaAjax.php",
	  data: {buscar: buscarValue}
	 }).done(function(conteudo){  
	    $("#pessoaAjax").html(conteudo);
	 }).fail(function(jqXHR, textStatus, msg){
	    alert(msg);
	 }); 

	 return false;

	}
</script>