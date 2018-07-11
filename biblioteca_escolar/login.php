
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

?>

<div class="container" style="width: 40%; background: rgba(0, 0, 0, 0.7); color: white; border-style: double">
	<h1>Bem vindo!!!</h1>
	<form action="autenticar_login.php" name="loginForm" class="form-group" method="POST" >
	 	<p>Usuário: <input type="text" name="usuario" id="usuario" class="form-control" style="margin: 0 15px 0 15px; width: 93%;" ></p>
	 	<p>Senha: <input type="password" name="senha" class="form-control" id="senha" maxlength="50" style="margin: 0 15px 0 15px; width: 93%;"></p>      
	 	<p><input type="submit" name="entrar" class="btn btn-primary" value="Entrar" style="width: 30%; margin: 0 100px 0 150px;"> </p>
	</form>
</div>
