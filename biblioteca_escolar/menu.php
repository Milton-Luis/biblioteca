<?php
session_start();
if(!isset($_SESSION['usuario'])){
  header('Location: index.php');
  exit;
}
else{
  //echo "conectado"
}
?>
<?php
include('visual.html');
$pagina = 'inicio';

if(isset($_GET['pg'])){
    $pagina = $_GET['pg'];
}
?>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
    </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class="<?= ($pagina == 'inicio')?'active':'' ?>"><a href="?pg=inicio">Home</a></li>
           <li class="<?= ($pagina == 'cadastro')?'active':'' ?>"><a href="?pg=cadastro">Gerenciar  indivíduos</a></li>
          <li class="<?= ($pagina == 'acervo')?'active':'' ?>"><a href="?pg=acervo">Gerenciar Acervo</a></li>
          <li class="<?= ($pagina == 'listar_emprestimo')?'active':'' ?>"><a href="?pg=listar_emprestimo">Gerenciar Empréstimo</a></li>
          <li><a href="logout.php" style="position: absolute; margin: 0 200px 0 470px">Sair</a></li>
        </ul>
      </div><!--/.nav-collapse -->
  </div>
</nav>

<?php
  include("paginas/".$pagina.".php"); 
?>





