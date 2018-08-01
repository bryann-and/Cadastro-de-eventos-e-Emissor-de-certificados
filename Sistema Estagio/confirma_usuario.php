<?php
  require_once('conecta.php');

  session_start();

  $user = $_POST['usuario'];
  $senha = $_POST['senha'];

  $sql = "SELECT * FROM BD_usuario WHERE nome_usuario='$user'";
  $resposta = mysqli_query($conexao, $sql);

  if ($resposta)
  {
    $aux = mysqli_fetch_array($resposta);

    if ($senha == $aux['senha'])
    {
      $_SESSION['usuario'] = $user;
      $_SESSION['senha'] = $senha;
      header('location:site/menu_opcoes_adm.php');
    }
    else
    {
	    header('location:site/index.html');
      exit();
    }
  }
  else
  {
    die('Usuário Não Encontrado!');
  }
?>
