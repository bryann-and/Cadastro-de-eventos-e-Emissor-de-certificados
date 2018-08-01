<?php
  require_once("conecta.php");

  session_start();

  $nome = $_POST['nome_user'];
  $senha = $_POST['senhaa'];

  $sql = "INSERT INTO bd_usuario(idusuario, nome_usuario, senha)
          VALUES(NULL,'$nome', '$senha')";

  $resposta = mysqli_query($conexao, $sql);
  if ($resposta)
  {
    header('location:site/menu_opcoes_adm.php');
  }
  else
  {
    echo mysqli_error($conexao);
  }
?>
