<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('config/conexao_bd.php');
include('cadastro.php');

$acao = isset($_GET['acao'])?$_GET['acao']:'';
//if e else curto, get acao é a variavel deposi do ? é a condição

if ($acao == 'cadastrar'){
	function cadastro(){
		$conexao = Conecta_bd();
		if (isset($_POST['entrar'])) {
			$matricula = $_POST['matricula'];
			$nome = $_POST['nome'];
			$tel = $_POST['tel'];
			$email = $_POST['email'];
			$funcao = $_POST['funcao'];
			$periodo = $_POST['periodo'];
			

			$sql = "INSERT INTO pessoa (matricula, nome, tel, email, funcao, periodo) 
					VALUES ('$matricula', '$nome', '$tel', '$email', '$funcao', '$periodo')";
			

			if($conexao->query($sql) === TRUE){ 
				echo "<br>";
				echo'<div class="alert alert-success" 
					style="color:black; 
					font-size: 24px; 
					font-family:Times New Roman", Times, serif;">
					Salvo com sucesso!!! aguarde...</div>';
					echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=?pg=cadastro'>" ;
			}else{
				echo "<br>";
				echo '<div class="alert alert-danger"
					style="color:black; 
					font-size: 24px; 
					font-family:Times New Roman", Times, serif;">
					Erro ao salvar!!! aguarde...</div>';
					echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=?pg=cadastro'>";
			}
			//var_dump($sql);
		}
	}
	cadastro();
}
if ($acao == 'listar') {
	function listar(){
		$conexao = Conecta_bd();


		$sql = "SELECT matricula, nome, tel, email, funcao, periodo FROM pessoas
		ORDER BY matricula" ;
		$result = mysqli_query($conexao, $sql);

		if (mysqli_num_rows($result) > 0) {
	    	while($row = mysqli_fetch_assoc($result)) {
	        echo $row["matricula"], $row["nome"], $row["tel"], $row["email"], $row["funcao"], $row["periodo"];
	    	}
		} else {
    		echo "0 results";
		}
	}
	listar();
}
if($acao == 'remover'){
	function deletar(){
		$conexao = Conecta_bd();
		$id = $_POST['id'];
		
		$sql = "DELETE FROM pessoa WHERE id = " . $id;
		if (mysqli_query($conexao, $sql)) {
   			echo "Produto excluído com sucesso!";
		} else {
    		echo "Error deleting record: " . mysqli_error($conexao);
		}
				
	
	}
	deletar();
}
	


?>


