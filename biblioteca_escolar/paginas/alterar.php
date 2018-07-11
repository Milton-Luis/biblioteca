<?php
	require_once('config/conexao_bd.php');
	$conexao = Conecta_bd();

	$idAcervo = $_GET['id'];
	if (isset($_POST['enviar'])) {
		// $titulo = $_POST['titulo'];
		// $autor = $_POST['autor'];
		// $editora = $_POST['editora'];
		$nVolume = $_POST['nVolume'];
		// $anoEdicao = $_POST['anoEdicao'];
		$genero = $_POST['genero'];
		$qtd_item = $_POST['qtd_item'];
		$descricao = $_POST['descricao'];

		$sql = "UPDATE acervo SET nVolume = '$nVolume', qtd_item = '$qtd_item', genero = '$genero', descricao = '$descricao'";
		$sql .= " WHERE id = " . $idAcervo;	

		if ($conexao->query($sql) === TRUE) {
		    echo "<script language='javascript' type='text/javascript'>alert('Atualizado com sucesso, aguarde');window.location.href='?pg=listar_acervo'</script>";
		} else {
		    echo "Error updating record: " . $conexao->error;
		}
	}

	$sql = "SELECT * FROM acervo WHERE id = " . $idAcervo;
	$result = executar_sql($conexao, $sql);

	$Acervo = null;

	if (!($Acervo = $result->fetch_object())) {

		echo "Problema ao buscar Acervo.";

	}

	?>
<div class="container" style="background: rgba(0, 0, 0, 0.7); color: white;">
	<h1>Formulário de Alteração</h1>
	<form action="" class="form-group" method="POST" enctype="multipart/form-data" style="font-size: 20px;">
		<div class="form-row">
			<div class="form-group col-md-6">
				<p>Nº de item: <input type="number" name="nVolume" id="nVolume" value="<?= $Acervo->nVolume ?>" class="form-control" max="1000" placeholder="Ex: 3"></p>
			</div>	
			<div class="form-group col-md-6">
				<p>Quantidade de livro: <input type="number" name="qtd_item" id="qtd_item" value="<?= $Acervo->qtd_item ?>" class="form-control" max="1000" placeholder="Ex: 3"></p>
			</div>	
			<div class="form-group col-md-6">
				<p>Gênero: <input type="text" name="genero" id="genero" class="form-control" placeholder="Ex: Literatura"></p>
			</div>
			<div class="form-group col-md-6">
				<p>Descrição: <input type="text" name="descricao" id="descricao" class="form-control" placeholder="Ex: o item é voltado à ..."></p>
			</div>
			
			<div class="form-group col-md-6">
				<p><input type="submit" name="enviar" class="btn btn-primary" value="Salvar" style="width: 30% "> <!-- <input type="reset" name="resetar" class="btn btn-danger" value="Resetar" style="width: 15% "></p> --></p>
			</div>
		</div>

	</form>
</div>
