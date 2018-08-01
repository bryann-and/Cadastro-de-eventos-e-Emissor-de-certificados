<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Editar Evento</title>
    <?php
    session_start();
    
    if (isset($_SESSION['evento_id']))//true: aberta apos a adição de um evento
      $evento = $_SESSION['evento_id'];
    else
        header('Location:menu_opcoes_adm.php');

    require_once("conecta.php");

    $sql = "SELECT * from evento WHERE idevento = '" . $evento . "'";
    $resultado = mysqli_query($conexao,$sql);
    $dados_evento = mysqli_fetch_array($resultado);

    /*dados para sugestao dos comissao ---------------------------------*/
    $sql = "SELECT nomepessoa FROM pessoa";
    $resultado = mysqli_query($conexao,$sql);
    ?>
    <!--dados para sugestao dos comissao FIM ---------------------------->
  </head>
  <body>
    <datalist id = "sug_comissao">
      <?php
        while ($row = mysqli_fetch_array($resultado))
        {?>
           <option value="<?php echo $row['nomepessoa']; ?>">
            <?php echo $row['nomepessoa']; ?>
        <?php } ?>
    </datalist>
    <form class="" action="../edit_evento_fim.php" method="post">
      <div class="responsive-table">
        <table class="table table-hover">
          <tr>
            <th>Nome do Evento</th>
            <td><input type="text" name="nome_evento" value="<?php echo $dados_evento['nome_evento']?>" required class="form-control"></td>
          </tr>
          <tr>
            <th>Descricao do evento</th>
            <td><input type="text" name="desc_evento" value="<?php echo $dados_evento['descricao_evento']?>" required class="form-control"></td>
          </tr>
          <tr>
            <th>Data de Início</th>
            <td><input type="text" name="data_ini" value="<?php echo $dados_evento['data_inicio']?>" required class="form-control"></td>
          </tr>
          <tr>
            <th>Data de Encerramento</th>
            <td><input type="text" name="data_fim"  value="<?php echo $dados_evento['data_fim']?>" required class="form-control"></td>
          </tr>
          <tr>
            <th>Coordenador(a) Do Curso de Computação: </th>
            <td>
              <input type="text" name="nome_comp" value="<?php echo $dados_evento['nome_coord_curso']?>" required class="form-control" maxlength="54">
            </td>
          </tr>
          <tr>
            <th>Coordenador(a) Da FALECT: </th>
            <td>
              <input type="text" name="nome_falect" value="<?php echo $dados_evento['nome_coor_falect']?>" required class="form-control" maxlength="54">
            </td>
          </tr>
          <tr>
            <th>Numero de Protocolo para Certificados:</th>
            <td>
              <input type="text" name="num_protocolo" value="<?php echo $dados_evento['numero_protocolo_certificados']?>" required class="form-control" maxlength="39">
            </td>
          </tr>
          <tr>
            <th>Carga Horaria da Comissão</th>
            <td>
              <input type="text" name="horas_comissao" value="<?php echo $dados_evento['horas_comissao']?>" required class="form-control" maxlength="3">
            </td>
          </tr>
          <tr>
            <th>Carga Horaria da Máxima do Evento</th>
            <td>
              <input type="text" name="horas_total" value="<?php echo $dados_evento['horas_maximas']?>" required class="form-control" maxlength="3">
            </td>
          </tr>
          <tr>
            <th>Carga Horaria Palestrantes/Tutores</th>
            <td>
              <input type="text" name="horas_tutor" value="<?php echo $dados_evento['horas_tutores']?>" required class="form-control" maxlength="3">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <input type="submit" value="Atualizar" class="btn btn-primary" >
            </td>
          </tr>
        </table>
      </div>
    </form>
  </body>
</html>
