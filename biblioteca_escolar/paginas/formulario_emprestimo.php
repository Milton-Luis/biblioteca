<?php
	require_once('config/conexao_bd.php');
	$conexao = Conecta_bd();
?>

<script src="JavaScript/validacoes.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


<div class="container" style="background: rgba(0, 0, 0, 0.7); width: 85%; border-style: double; color: white">
	<h1><center>Formulário de emprestimo</center> </h1>
	<form action="" method="POST" class="form-group" onsubmit="return valida_formulario(this);" enctype="multipart/form-group">
		<div class="form-row">
			<div class="form-group col-md-6">
				<p>pessoa:<select class="form-control select-autocomplete" name="pessoa_id" id="pessoa_id" class="form-control" required="">
				<?php
				$sql = "SELECT p.id, p.nome, p.email FROM pessoa p
				ORDER BY p.nome";
				$result = $conexao->query($sql);

				if ($result->num_rows > 0) {	
					while ($row = $result->fetch_object()) {   		
				?>
				<option value="<?= $row->id ?>"><?= $row->nome ?></option>
				<?php 
					}
				}
				?> 
				</select></p>
			</div>

			<div class="form-group col-md-6">
				<p>Quantidade a ser emprestada:<input type="number" name="qtdEmprestado" id="qtdEmprestado" class="form-control" min="1" required="">

				</p>
			</div>

			<div class="form-group col-md-6">
				<p>Data de empréstimo:<input type="text" class="data form-control" name="dtEmprestimo" id="dtEmprestimo" required="">
				</p>
			</div>

			<div class="form-group col-md-6">
				<p>Data de devolução: <input type="text" class="data form-control" name="dtDevolucao" id="dtDevolucao" required="">
				</p>
			</div>
			
			<div class="form-group col-md-6">
				<input type="hidden" name="acervo_id" id="acervo_id" value="<?= $_GET['id'] ?>" required="">	
			</div>
		</div>	
		<p><input type="submit" name="salvar" class="btn btn-primary" value="Salvar" style="width: 15%;"><input type="reset" name="resetar" class="btn btn-danger" value="Resetar" style="width: 15%; ">
		</p>
		
	</form>
</div>
<script type="text/javascript">
	$(document).ready(function() {
	    $('.select-autocomplete').select2();
	});
</script>

<?php
if (isset($_POST['salvar'])) {
	$dtEmprestimo = $_POST['dtEmprestimo'];
	$dtDevolucao = $_POST['dtDevolucao'];
	$qtdEmprestado = $_POST['qtdEmprestado'];
	$idPessoa = $_POST['pessoa_id'];
	$idAcervo = $_POST['acervo_id'];

	$consulta = "SELECT qtd_item FROM acervo WHERE id = '$idAcervo'";
	$result = $conexao->query($consulta);
		
	if ($row = $result->fetch_object()){
		if($qtdEmprestado > $row->qtd_item){
			echo "<br>";
			echo'<div class="alert alert-danger" 
				style="color:black; 
				font-size: 24px; 
				font-family:Times New Roman", Times, serif;">
				Impossível de efetuar empréstimo!!! aguarde...</div>';
			echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=?pg=acervo'>";
			exit;
		}

	}


	
	
	$sql = "INSERT INTO emprestimo (dtEmprestimo, dtDevolucao, qtdEmprestado, pessoa_id, acervo_id) 
			VALUES ('$dtEmprestimo', '$dtDevolucao', '$qtdEmprestado', '$idPessoa', '$idAcervo')";

	$atualizar = "UPDATE acervo SET qtd_item = qtd_item - $qtdEmprestado 
					WHERE id = '$idAcervo'"; 

	if($conexao->query($sql) === TRUE && $conexao->query($atualizar) === TRUE){ 
		$sql = "SELECT p.nome, p.email FROM pessoa p WHERE p.id = $idPessoa";
		$result = $conexao->query($sql);

		$assunto = "Emprestimo";
		$msg = "Emprestimo realizado com sucesso!";
		$email = "";
		$nomePessoa = "";

		echo "<br>";
		echo'<div class="alert alert-success" 
			style="color:black; 
			font-size: 24px; 
			font-family:Times New Roman", Times, serif;">
			Emprestado com sucesso!!! aguarde...</div>';
		echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=?pg=acervo'>";


		if ($row = $result->fetch_object()){
			$email = $row->email;
			$nomePessoa = $row->nome;

			//include("enviarEmail.php");
		} 
	}else{
			echo "<br>";
			echo '<div class="alert alert-danger"
				style="color:black; 
				font-size: 24px; 
				font-family:Times New Roman", Times, serif;">
				Erro ao salvar!!! aguarde...</div>';
				//echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=?pg=acervo'>";
		} 

	}
	

?>