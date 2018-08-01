<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
      var valor_inicial=0; // variavel q armazena o numero de lementos ja criados

      // função que adiciona a caixa de texto
      function add_caixadeTexto()
      {
        var nova_area = add_novoElemento();
        var conteudo_html = "<input id='textboxnova' type='search' autocomplete='off' list = 'sug_tutor' name='tutores[]' required>";
        document.getElementById(nova_area).innerHTML = conteudo_html;
      }

      function add_novoElemento()
      {
        valor_inicial=valor_inicial+1;  // incrementa o numero do elemtno
        var ni = document.getElementById('area_tutores');
        var nova_div = document.createElement('div'); // Cria o elemento
        var nome_ID = 'my'+valor_inicial+'Div';
        nova_div.setAttribute('id',nome_ID);
        ni.appendChild(nova_div);
        return nome_ID;
      }
    </script>

    <link rel="stylesheet" href="css/estilos.css">
    <title>Cadastro de Atividades</title>
    <?php
      require_once("../conecta.php");

      /*dados para sugestao dos tutores */
      $sql = "SELECT nomepessoa FROM pessoa";
      $resultado2 = mysqli_query($conexao,$sql);

      /*verifica a sessao do usuario*/
      session_start();

      if ((!isset($_SESSION['usuario'])) and (!isset($_SESSION['senha'])))
      {
        header('location:index.html');
        exit();
      }
      /*********************/
    ?>
  </head>
  <body>
    <!--Lista de sugestoes para os tutores -->
    <datalist id = "sug_tutor">
      <?php
        while ($row = mysqli_fetch_array($resultado2))
        {?>
           <option value="<?php echo $row['nomepessoa']; ?>">
            <?php echo $row['nomepessoa']; ?>
        <?php } ?>
    </datalist>

    <div class="responsive-table">
      <form action="../add_atividade.php" method="post">
        <table class="table table-hover">
          <tr>
            <th>Nome da Atividade</th>
            <td>
              <input type="text" name="nome_ativ" autocomplete="off" required class="form-control">
            </td>
          </tr>
          <tr>
            <th>Descriçao da Atividade</th>
            <td>
              <input type="text" name="desc_ativ" autocomplete="off" required class='form-control'>
            </td>
          </tr>
          <tr>
            <th>Carga  Horária (em Horas)</th>
            <td>
              <input type="text" name="carga_horaria" autocomplete="off" required class="form-control">
            </td>
          </tr>
          <tr>
            <th>Tutores</th>
            <td id='area_tutores'></td>
          </tr>
          <tr>
            <td colspan="2">
              <input type="button" value="Adicionar mais Tutores" onclick="add_caixadeTexto();" class="btn btn-default">
              <input type="submit" value="Adicionar" name="Adicionar" class="btn btn-primary">
            </td>
          </tr>
        </table>
      </form>
    </div>
  </body>
</html>
