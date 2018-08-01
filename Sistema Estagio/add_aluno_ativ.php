<?php
  require_once("conecta.php");

  session_start();

  $ativ = $_POST['ativ'];

  //vetor com os alunos
  $alunos=array();
  $alunos=$_POST['aluno'];

  /*Seleciona o id da atividade atravez do nome*/
  $sql = "SELECT idativ FROM atividade WHERE nome_ativ = '$ativ'";
  $resultado_ativ = mysqli_query($conexao, $sql);
  $aux = mysqli_fetch_array($resultado_ativ);
  $id_ativ = $aux['idativ'];
  /***********************************************/

  /*Seleciona o id do aluno atravez do nome*/

  for ($i=0; $i < count($alunos) ; $i++)
  {
    $sql = "SELECT idpessoa FROM pessoa WHERE nomepessoa = '$alunos[$i]'";
    $resultado_aluno = mysqli_query($conexao, $sql);
    $aux = mysqli_fetch_array($resultado_aluno);

    $sql = "INSERT INTO pessoa_atividade(idpessoa, idativ) VALUES(" . $aux['idpessoa'] . "," . $id_ativ . ")";
    $resposta = mysqli_query($conexao, $sql);
  }

  /***********************************************/

  if ($resposta)
  {
    header('location:site/menu_opcoes_adm.php');
  }
  else
  {
    echo mysqli_error($conexao);
    echo "Erro ao adicionar";
  }
?>
