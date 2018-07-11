<?php
include('cadastro.php'); 
?>

<script src="JavaScript./validacaomask.js"></script>
<br>
<div class="container" style="background: rgba(0, 0, 0, 0.7); width: 75%; border-style: double; color: white">
	<h1><center>Formulário de Cadastro de indivíduos</center></h1>
	<form action="?pg=processar_pessoas&acao=cadastrar" method="POST" class="form-group" onsubmit="return valida_formulario(this);" enctype="multipart/form-data">
		<div class="form-row">
			<div class="form-group col-md-6">
				<p>Matricula/ Registro:<input type="text" class="form-control" name="matricula" id="matricula"></p>
			</div>
			<div class="form-group col-md-6">
				<p>Nome: <input type="text" class="form-control" name="nome" id="nome" class="form-control"></p>
			</div>
			<div class="form-group col-md-6">
				<p>Telefone: <input type="tel" name="tel" id="tel" class="tel form-control"></p>
			</div>
			<div class="form-group col-md-6">
				<p>E-mail: <input type="email" name="email" id="email" class="form-control"></p>
			</div>
			<div class="form-group col-md-6">
				<div class="select">
					<p>Função <select name="funcao" class="form-control" style="width: 130px; color: black; font-size: 15px" tabindex="(-1)" required="">
						<option value="Aluno">Aluno</option>
						<option value="Professor">Professor</option>
						<option value="Bibliotecário">Bibliotecário</option>
					</select>
					</p>
				</div>
			</div>
			<div class="form-group col-md-6">
				<div class="select">
					<p>Período <select name="periodo" class="form-control" style="width: 130px; color: black; font-size: 15px" tabindex="(-1)" required="">
						<option value="Manhã">Manhã</option>
						<option value="Tarde">Tarde</option>
						<option value="Noite">Noite</option>
					</select>
					</p>
				</div>
			</div>
		</div>
		<br>
		<p><input type="submit" name="entrar" class="btn btn-primary" value="Enviar" style="width: 15%;"> <input type="reset" name="resetar" class="btn btn-danger" value="Resetar" style="width: 15%; ">
		</p>
	</form>
</div>