<?php
  require_once('conecta.php');

  $nome_ev = $_POST['nome_evento'];
  $desc_ev = $_POST['desc_evento'];
  $inicio_ev = $_POST['data_ini'];
  $fim_ev = $_POST['data_fim'];
  $nome_org = $_POST['nome_org'];
  $nome_coord_comp = $_POST['nome_comp'];
  $nome_coord_falect = $_POST['nome_falect'];
  $num_protocolo = $_POST['num_protocolo'];
  $hora_comissao = $_POST['horas_comissao'];
  $hora_maxima = $_POST['horas_total'];
  $hora_tutor = $_POST['horas_tutor'];

  $comissao = array();//vetor da comissao
  $comissao = $_POST['comissao'];

  $imagem = $_FILES["img"]["name"];
  $local = "imagens/";
  if (!move_uploaded_file($_FILES["img"]["tmp_name"], "$local".$_FILES["img"]["name"])) {
    echo "Erro ao fazer upload da imagem";
    exit();
  }
  $local = $local . $imagem;//caminho total da imagem
  $sql = "INSERT INTO evento(idevento, nome_evento, descricao_evento, data_inicio,
     data_fim, nome_coord_curso, nome_coor_falect,
     numero_protocolo_certificados,num_participantes,num_comissao,num_tutores,
    horas_comissao, horas_maximas, horas_tutores, img_fundo)
     VALUES(NULL, '$nome_ev', '$desc_ev',
    '$inicio_ev', '$fim_ev', '$nome_coord_comp', '$nome_coord_falect',
    '$num_protocolo', 0, " . count($comissao) . ", 0," . $hora_comissao . ",
    " . $hora_maxima . ", " . $hora_tutor . ", '$local')";

  $resposta = mysqli_query($conexao, $sql);

  if ($resposta)
  {
    //variavel q armazena o id da ultima inserção
    $auxiliar = mysqli_insert_id($conexao);

    //------------------------------------Adiciona o coordenador do evento
    $sql = "SELECT idpessoa FROM pessoa WHERE nomepessoa='$nome_org'";
    $resposta = @mysqli_query($conexao, $sql);
    $aux = @mysqli_fetch_array($resposta);

    //insere na tabela relacional
    $sql = "INSERT INTO comissao_org(id_pessoa,id_evento)
            VALUES(" . $aux['idpessoa'] . ", $auxiliar)";

    $resposta = @mysqli_query($conexao, $sql);
    if (!$resposta)
    {
      echo "erro ao adicionar o Coordenador do Evento";
      echo mysqli_error($conexao);
    }
    //------------------------------------Adiciona o coordenador do evento---------- fim

    /* Adicionar os participantes da comissao*/
    for ($i=0; $i < count($comissao); $i++)
    {
      //encontra o ID da pessoa atravez do nome
      $sql = "SELECT idpessoa FROM pessoa WHERE nomepessoa='" . $comissao[$i] . "'";
      $resposta = @mysqli_query($conexao, $sql);
      $aux = @mysqli_fetch_array($resposta);

      if (mysqli_num_rows($resposta) <= 0)
      {
        echo "erro ao adicionar Organizador $comissao[$i], nome não cadastrado no banco de dados.";
        break;
      }
      else
      {
        //insere na tabela relacional
        $sql = "INSERT INTO comissao_org(id_pessoa,id_evento)
              VALUES(" . $aux['idpessoa'] . ", $auxiliar)";
        $resposta = @mysqli_query($conexao, $sql);
        if (!$resposta)
        {
          echo "erro ao adicionar Organizador $i";
          echo mysqli_error($conexao);
          break;
        }
        else
        {
          session_start();
          $_SESSION['evento_id'] = $auxiliar;
          header('Location:site/menu_opcoes_evento.php');
          exit();
        }
      }
    }
  }
  else
  {
    echo "Erro ao adicionar";
    echo mysqli_error($conexao);
  }
?>
