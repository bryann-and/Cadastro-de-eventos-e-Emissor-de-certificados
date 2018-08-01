<?php
  require_once("conecta.php");

  session_start();

  $nome = $_POST['nome_aluno'];

  session_start();
  $id_evento = $_SESSION['evento_id'];

  $sql = "SELECT idpessoa FROM pessoa WHERE nomepessoa = '$nome'";
  $resposta = mysqli_query($conexao, $sql);

  if ($resposta)
  {
    $idpessoa = mysqli_fetch_array($resposta);

    $sql = "INSERT INTO participantes(id_pessoa,id_evento) VALUES ("
      . $idpessoa['idpessoa'] . "," . $id_evento . ")";

    $resposta = mysqli_query($conexao, $sql);

    if ($resposta)
    {
      $sql = "UPDATE evento SET num_participantes = num_participantes + 1
        WHERE idevento = " . $id_evento;
        $resposta = mysqli_query($conexao, $sql);

      if ($resposta)
        header('location:site/menu_opcoes_evento.php');
      else
        echo mysqli_error($conexao);
    }
    else
      echo mysqli_error($conexao);
  }
?>
