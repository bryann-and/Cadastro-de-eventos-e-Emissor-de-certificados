<?php
  require_once("conecta.php");

  $nome = $_POST['nome_pessoa'];

  $sql = "REPLACE INTO pessoa(idpessoa, nomepessoa) VALUES(NULL,'$nome')";

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
