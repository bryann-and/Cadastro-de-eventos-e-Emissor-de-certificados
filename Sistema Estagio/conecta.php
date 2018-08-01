<?php
  $nome_servidor = "localhost";
  $usuario = "root";
  $senha = "";
  $nome_BD = "Estagio";

  // Criar conexão
  $conexao = mysqli_connect($nome_servidor, $usuario, $senha, $nome_BD);
  // Checa a conexao
  if (!$conexao) {
      die("Falha na Conexão: " . mysqli_connect_error());
  }
?>
