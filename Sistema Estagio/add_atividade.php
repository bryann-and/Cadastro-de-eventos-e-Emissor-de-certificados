<?php
  require_once("conecta.php");

  $nome = $_POST['nome_ativ'];
  $desc = $_POST['desc_ativ'];
  $carga = $_POST['carga_horaria'];

    //vetor com os tutores
  $tutores=array();
  $tutores=$_POST['tutores'];

  session_start();
  $id_evento = $_SESSION['evento_id'];
  /********************************************/

  $sql = "INSERT INTO atividade(idativ, nome_ativ, desc_ativ, carga_horaria, id_evento)
        VALUES(NULL, '$nome', '$desc', $carga, $id_evento)";
  $resposta = mysqli_query($conexao, $sql);

  if ($resposta)
  {
    //variavel q armazena o id da ultima inserção
    $auxiliar = mysqli_insert_id($conexao);

    /* Adicionar os tutores*/
    for ($i=0; $i < count($tutores); $i++)
    {
      //encontra o ID do tutor atravez do nome
      $sql = "SELECT idpessoa FROM pessoa WHERE nomepessoa='$tutores[$i]'";
      $resposta = mysqli_query($conexao, $sql);
      $aux = mysqli_fetch_array($resposta);

      //insere na tabela relacional
      $sql = "INSERT INTO tutores_ativ(idtutor,idatividade)
              VALUES(" . $aux['idpessoa'] . ", $auxiliar)";

      $resposta = mysqli_query($conexao, $sql);

      if (!$resposta)
      {
        echo "erro ao adicionar tutor $i";
      }
      else
      {
        $sql = "UPDATE evento SET num_tutores = num_tutores + 1 WHERE
        idevento =" . $id_evento;

        $resposta = mysqli_query($conexao, $sql);

        if (!$resposta)
          echo mysqli_error($conexao);
        else
          header('location:site/menu_opcoes_evento.php');
      }
    }
  }
  else
    echo mysqli_error($conexao);
?>
