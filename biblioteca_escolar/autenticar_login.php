<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['entrar'])) {

	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];

	if ($usuario == 'escola' && $senha == 'emdwb&*') {
		//$vDataNascimento = array('01/02/2010');
		$vUsuario = array('login'=>$usuario,'nome'=>'Bibliotecário');
		//$vUsuario['teste'] = 1;
		//echo "Login realizado com sucesso!";
		$_SESSION['usuario'] = $vUsuario;
		setcookie('usuario',$usuario);
		//setcookie('bgColor','#000',time()+3600);
		header('Location: menu.php');
	}

	else{
		echo"<script language='javascript' type='text/javascript'>alert('Nome e/ou senha incorretos');window.location.href='index.php'</script>";
	}

}

?>
