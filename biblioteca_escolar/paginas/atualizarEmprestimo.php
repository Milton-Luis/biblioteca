<?php
	require_once('config/conexao_bd.php');
	$conexao = Conecta_bd();

?>
<script src="JavaScript/validacaomask.js"></script>
<div class="container" style="background: rgba(0, 0, 0, 0.7); color: white; border-style: double;">
	<h1><center>Formulário de Alteração</center></h1>
	<form action="" class="form-group" method="POST" enctype="multipart/form-data" style="font-size: 20px;">
		<div class="form-row">
			<!-- <div class="form-group col-md-6">
				<p>Data do ultimo emprestimo</p>
			</div> -->
			<div class="form-group col-md-6">
				<p>Data do novo empréstimo: <input type="text" name="dtEmprestimo" id="dtEmprestimo" class="data form-control" max="1000" placeholder="Informe a nova data de emprstimo"></p>
			</div>	
			<div class="form-group col-md-6">
				<p>Nova Data de devolução: <input type="text" name="dtDevolucao" id="dtDevolucao" class="data form-control" max="1000" placeholder="Informe a nova data de Devolução"></p>
			</div>	
	
			<div class="form-group col-md-6">
				<p><input type="submit" name="enviar" class="btn btn-primary" value="Salvar" style="width: 30% "> <!-- <input type="reset" name="resetar" class="btn btn-danger" value="Resetar" style="width: 15% "></p> --></p>
			</div>
		</div>
	</form>
</div>
<?php
	$idEmprestimo = $_GET['id'];
	if (isset($_POST['enviar'])) {
		$dtEmprestimo = $_POST['dtEmprestimo'];
		$dtDevolucao = $_POST['dtDevolucao'];

		$sql = "UPDATE emprestimo SET dtEmprestimo = '$dtEmprestimo', dtDevolucao = '$dtDevolucao'";
		$sql .= " WHERE id = " . $idEmprestimo;	

		if($conexao->query($sql) === TRUE){ 
			echo "<br>";
			echo'<div class="alert alert-success" 
				style="color:black; 
				font-size: 24px; 
				font-family:Times New Roman", Times, serif;">
				Salvo com sucesso!!! aguarde...</div>';
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=?pg=listar_emprestimo'>" ;
		}else{
			echo "<br>";
			echo '<div class="alert alert-danger"
				style="color:black; 
				font-size: 24px; 
				font-family:Times New Roman", Times, serif;">
				Erro ao salvar!!! aguarde...</div>';
				echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=?pg=listar_emprestimo'>";
		}
	}
	$sql = "SELECT * FROM emprestimo WHERE id = " . $idEmprestimo;
	$result = executar_sql($conexao, $sql);

	$emprestimo = null;

	if (!($emprestimo = $result->fetch_object())) {

		//echo "Problema ao buscar emprestimo.";

	}

	?>
?>
