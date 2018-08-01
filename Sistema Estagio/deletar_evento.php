<?php
  require_once("conecta.php");

  session_start();
  $idevento = $_SESSION['evento_id'];
  //deletar comissao
  $sql="DELETE from comissao_org WHERE id_evento = $idevento";
  $resultado = mysqli_query($conexao, $sql);
  if (!$resultado)
    echo mysqli_error($conexao);

  //deletar atividade atividade e tutores
  $sqlativ="SELECT idativ FROM atividade WHERE id_evento = $idevento";
  $resultadoativ = mysqli_query($conexao, $sqlativ);
  if (!$resultadoativ)
    echo mysqli_error($conexao);
  else
  {
    //tutores
    while($row = mysqli_fetch_array($resultadoativ))
    {
      $id = $row['idativ'];
      $sql = "DELETE FROM tutores_ativ WHERE idatividade = $id";
      $resultado = mysqli_query($conexao, $sql);
      if (!$resultado)
      {
        echo mysqli_error($conexao);
        exit();
      }
    }
    //atividade
    $sql = "DELETE FROM atividade WHERE id_evento = $idevento";
    $resultadoativ = mysqli_query($conexao, $sql);
    if (!$resultadoativ)
    {
      echo mysqli_error($conexao);
      exit();
    }
  }
  //deletando os participantes
  $sql = "DELETE from participantes WHERE id_evento = $idevento";
  $resultado = mysqli_query($conexao, $sql);
  if(!$resultado)
  {
    echo mysqli_error($conexao);
    exit();
  }
  //deletando o evento
  $sql = "DELETE from evento WHERE idevento = $idevento";
  $resultado = mysqli_query($conexao, $sql);
  if(!$resultado)
  {
    echo mysqli_error($conexao);
    exit();
  }
  else
    header("location:site/menu_opcoes_adm.php");
?>
