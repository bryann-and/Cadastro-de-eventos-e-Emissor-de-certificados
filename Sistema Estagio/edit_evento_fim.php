<?php
  require_once('conecta.php');

  $nome_ev = $_POST['nome_evento'];
  $desc_ev = $_POST['desc_evento'];
  $inicio_ev = $_POST['data_ini'];
  $fim_ev = $_POST['data_fim'];
  $nome_coord_comp = $_POST['nome_comp'];
  $nome_coord_falect = $_POST['nome_falect'];
  $num_protocolo = $_POST['num_protocolo'];
  $hora_comissao = $_POST['horas_comissao'];
  $hora_maxima = $_POST['horas_total'];
  $hora_tutor = $_POST['horas_tutor'];

  session_start();
  $id = $_SESSION['evento_id'];

  $sql = "UPDATE evento SET nome_evento = '$nome_ev', descricao_evento = '$desc_ev',
   data_inicio = '$inicio_ev', data_fim = '$fim_ev', nome_coord_curso = '$nome_coord_comp',
   nome_coor_falect = '$nome_coord_falect', numero_protocolo_certificados = '$num_protocolo',
   horas_comissao = $hora_comissao, horas_maximas = $hora_maxima,
   horas_tutores = $hora_tutor WHERE idevento = $id";

  $resposta = mysqli_query($conexao, $sql);

  if ($resposta)
  {
    header('Location:site/menu_opcoes_evento.php');
  }
  else
  {
    echo "Erro ao editar";
    echo mysqli_error($conexao);
  }
?>
