<?php
include('acervo.php');
?>
<br>
<div class="box" style="width: 75%; height: 10%; border-style: double;" >
	<div class="section">
		<h1><center>Formulário de Cadastro de livros</center></h1>
		<form action="?pg=processar_acervo&acao=salvar" class="form-group" method="POST" enctype="multipart/form-data">
			<div class="form-row">
				<div class="form-group col-md-6">
					<p>Código do Item <input type="text" name="codigo" id="codigo" class="form-control" placeholder="Ex: 1364" required=""></p>
				</div>
				<div class="form-group col-md-6">
					<p>Nome do Item <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Ex: Iracema" required="Insira o nome"></p>
				</div>
				<div class="form-group col-md-6">
					<p>Autor <input type="text" name="autor" id="autor" class="form-control" placeholder="Ex: José de Alencar" required=""></p>
				</div>
				<div class="form-group col-md-6">
					<p>Editora <input type="text" name="editora" id="editora" class="form-control" placeholder="Ex: RECORD" required=""></p>
				</div>
				<div class="form-group col-md-6">
					<p>Nº do volume <input type="number" name="nVolume" id="nVolume" class="form-control" placeholder="Ex: 3" required="" min="1"></p>
				</div>
				<div class="form-group col-md-6">
					<p>Quantidade de livros <input type="number" name="qtd_item" id="qtd_item" class="form-control" max="1000" placeholder="Ex: 3" required="" min="1"></p>
				</div>
				<div class="form-group col-md-6">
					<p>Ano de Edição <input type="text" name="anoEdicao" id="anoEdicao" class="form-control" placeholder="Ex: 1995" required=""></p>
				</div>
				<div class="form-group col-md-6">
					<p>Gênero <input type="text" name="genero" id="genero" class="form-control" placeholder="Ex: Romance" required=""></p>
				</div>
				<div class="form-group col-md-6">
					<p>Descrição <input type="text" name="descricao" id="descricao" class="form-control" placeholder="Insira uma descrição para o item"></p>
				</div>
				<br>
				
				<div class="select" style="margin: 0 5px 0 15px">
					<p>Cadastrar em: <select name="categoria_id" class="form-control" style="width: 130px; color: black; font-size: 15px" tabindex="(-1)" required="">
						<option value="1">Livro</option>
						<option value="2">Revista</option>
						<option value="3">Dicionário</option>
						<option value="4">Enciclopédia</option>
						<option value="5">CD/DVD</option>
					</select>
					</p>
				</div>
			</div>	
			<br>
			<p><input type="submit" name="enviar" class="btn btn-primary" value="Enviar" style="width: 15%; margin: 0 5px 0 15px "> <input type="reset" name="resetar" class="btn btn-danger" value="Resetar" style="width: 15%; "></p>
		</form>
	</div>
</div>
