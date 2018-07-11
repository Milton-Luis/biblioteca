<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('config/conexao_bd.php');
include('acervo.php');

$acao = isset($_GET['acao'])?$_GET['acao']:'';
//if e else curto, get acao é a variavel deposi do ? é a condição

if ($acao == 'salvar'){
	function salvar(){
		$conexao = Conecta_bd();
		if (isset($_POST['enviar'])) {
			$codigo = $_POST['codigo'];
			$titulo = $_POST['titulo'];
			$autor = $_POST['autor'];
			$editora = $_POST['editora'];
			$nVolume = $_POST['nVolume'];
			$qtd_item = $_POST['qtd_item'];
			$anoEdicao = $_POST['anoEdicao'];
			$genero = $_POST['genero'];
			$descricao = $_POST['descricao'];
			$categoria_id = $_POST['categoria_id'];

			$sql = "INSERT INTO acervo(codigo, titulo, autor, editora, nVolume, qtd_item, anoEdicao, genero, descricao, categoria_id)
					VALUES ('$codigo', '$titulo', '$autor', '$editora', '$nVolume', '$qtd_item', '$anoEdicao', '$genero', '$descricao', '$categoria_id')";

			if($conexao->query($sql) === TRUE){ 
				echo "<br>";
				echo'<div class="alert alert-success" 
					style="color:black; 
					font-size: 24px; 
					font-family:Times New Roman", Times, serif;">
					Salvo com sucesso!!! aguarde...</div>';
					echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=?pg=acervo'>";
			}else{
				echo "<br>";
				echo '<div class="alert alert-danger"
					style="color:black; 
					font-size: 24px; 
					font-family:Times New Roman", Times, serif;">
					Erro ao salvar!!! aguarde...</div>';
					//echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=?pg=acervo'>";
			}
			//var_dump($sql);		
		}
	}
	salvar();
}

//--------------SELECT com INNER--------------//
/*elseif ($acao == 'selecionarInner') {
	function selecionarInner(){
		if (isset($_POST['buscar'])) {
			$buscarNome = $_POST['busca'];
			$buscarCodigo = $_POST['busca'];

			$conexao = Conecta_bd();

			$sql = "SELECT c.nome, a.titulo, a.autor, a.editora, a.nVolume, a.anoEdicao, a.genero, a.observacao, a.descricao FROM categoria c INNER JOIN acervo a
				ON c.id = a.categoria_id
				WHERE (c.nome LIKE '$buscarNome%' OR c.id LIKE '$buscarCodigo%' OR a.titulo LIKE '$buscarNome%')";

			$result = mysqli_query($conexao, $sql);
			if (mysqli_num_rows($result) > 0) {
    			
				while($row = mysqli_fetch_assoc($result)) {
					echo'<div class="box" sytle="padding-left:200px; width="2000%";>';
    				echo "<table>";
    				echo "<tr><td>Categoria do item</td></tr>";
    				echo "<tr><td>" . $row["nome"]. "</td><td>" . $row["titulo"]. "</td><td> " . $row["autor"]. "</td><td> ". $row['editora'] . "</td><td> " . $row['nVolume'] . "</td><td>" . $row['anoEdicao'] . "</td><td>". $row['genero'] . "</td><td>" . $row['observacao'] . "</td><td>" . $row['descricao'] . "</td></tr>";
				}
				echo  '</table>';
				echo'</div>';
			} 
			else {
				echo'<br><div class="alert alert-danger"
					style="color:black; 
					font-size: 24px; 
					font-family:Times New Roman", Times, serif;">
					0 resultados!!!</div>';
			}
		}
		//header('Location:?pg=listar_acervo');
	}
selecionarInner();
}
//----------------UPDATE-------------------//
elseif ($acao == 'atualizar') {
	function atualizar(){
		$id = $_GET['id'];
		if (isset($_POST['enviar'])) {
		 	$titulo = $_POST['titulo'];
			$nVolume = $_POST['nVolume'];
			$genero = $_POST['genero'];
			$observacao = $_POST['observacao'];
			$descricao = $_POST['descricao'];

			$sql = "UPDATE Acervo SET nVolume='$nVolume', genero='$genero', observacao='$observacao', descricao='$descricao'";
			$sql .= " WHERE id = " . $id;	

			executar_sql($conexao, $sql);

		}

		$sql = "SELECT * FROM Acervo WHERE id = " . $id;

		$result = executar_sql($conexao, $sql);

		$Acervo = null;

		if (!($Acervo = $result->fetch_object())) {

			echo "Problema ao buscar Acervo.";

		}

}
else ($acao == 'deletar') {
	function deletar(){	
		if($_GET['acao'] == 'remover'){
			$id = $_GET['id'];

			$sql = "DELETE FROM Acervo WHERE id = " . $id;

			$result = executar_sql($conexao, $sql);

			if($result === TRUE){
				echo "Produto excluído com sucesso!";
			}
		}
	}
}
*/
?>


