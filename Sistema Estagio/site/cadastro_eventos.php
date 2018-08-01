<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type="text/javascript">
    //script para checar a resolução da imagem de fundo
      var _URL = window.URL || window.webkitURL;

      $("#imagem").change(function(e)
      {
        var image, file;
        if ((file = this.files[0]))
        {
            image = new Image();
            image.onload = function()
            {
              if(this.width < 1121 || this.height < 794)
              {
                alert("A imagem selecionada possui um tamanho incorreto, o tamanho minimo necessario é de 1121x794!");
                $("#imagem").val('');//limpa o campo de seleção de imagem
              }
            };
          image.src = _URL.createObjectURL(file);
        }
      });

      //adiciona caixa de texto
      var valor_inicial=0; // variavel q armazena o numero de lementos ja criados
      function add_caixadeTexto()
      {
        var nova_area = add_novoElemento();
        var conteudo_html = "<input id='textboxnova' type='search' autocomplete='off' list = 'sug_comissao' name='comissao[]' required>";
        document.getElementById(nova_area).innerHTML = conteudo_html;
      }
      function add_novoElemento()
      {
        valor_inicial=valor_inicial+1;  // incrementa o numero do elemtno
        var ni = document.getElementById('area_comissao');
        var nova_div = document.createElement('div'); // Cria o elemento
        var nome_ID = 'my'+valor_inicial+'Div';
        nova_div.setAttribute('id',nome_ID);
        ni.appendChild(nova_div);
        return nome_ID;
      }

    </script>

    <link rel="stylesheet" href="css/estilos.css">

    <title>Cadastrar Eventos</title>
    <?php

      require_once("../conecta.php");

      /*dados para sugestao dos comissao */
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

      $usuario = $_SESSION['usuario'];
    ?>
    </script>
  </head>
  <body>
    <!--Lista de sugestoes para os tutores -->
    <datalist id = "sug_comissao">
      <?php
        while ($row = mysqli_fetch_array($resultado2))
        {?>
           <option value="<?php echo $row['nomepessoa']; ?>">
            <?php echo $row['nomepessoa']; ?>
        <?php } ?>
    </datalist>

    <form action="../add_evento.php" method="post" enctype="multipart/form-data">
      <div class="responsive-table">
        <table class="table table-hover">
          <tr>
            <th>Nome do Evento</th>
            <td><input type="text" name="nome_evento" required class="form-control"></td>
          </tr>
          <tr>
            <th>Descricao do evento</th>
            <td><input type="text" name="desc_evento" required class="form-control"></td>
          </tr>
          <tr>
            <th>Data de Início</th>
            <td><input type="text" name="data_ini" placeholder="AAAA-MM-DD" required class="form-control"></td>
          </tr>
          <tr>
            <th>Data de Encerramento</th>
            <td><input type="text" name="data_fim" placeholder="AAAA-MM-DD" required class="form-control"></td>
          </tr>
          <tr>
            <th>Nome do Organizador(a) do Evento</th>
            <td>
              <input type="search" list="sug_comissao" autocomplete="off" name="nome_org" required class="form-control" maxlength="54">
            </td>
          </tr>
          <tr>
            <th>Coordenador(a) Do Curso de Computação: </th>
            <td>
              <input type="text" name="nome_comp" required class="form-control" maxlength="54">
            </td>
          </tr>
          <tr>
            <th>Coordenador(a) Da FALECT: </th>
            <td>
              <input type="text" name="nome_falect" required class="form-control" maxlength="54">
            </td>
          </tr>

          <tr>
            <th>Numero de Protocolo para Certificados:</th>
            <td>
              <input type="text" name="num_protocolo" required class="form-control" maxlength="39">
            </td>
          </tr>
          <tr>
            <th>Carga Horaria da Comissão</th>
            <td>
              <input type="text" name="horas_comissao" required class="form-control" maxlength="3">
            </td>
          </tr>
          <tr>
            <th>Carga Horaria do Evento</th>
            <td>
              <input type="text" name="horas_total" required class="form-control" maxlength="3">
            </td>
          </tr>
          <tr>
            <th>Carga Horaria Palestrantes/Tutores</th>
            <td>
              <input type="text" name="horas_tutor" required class="form-control" maxlength="3">
            </td>
          </tr>
          <tr>
            <th>Imagem de fundo do Certificado</th>
            <td>
              <input id="imagem" type="file" accept="image/*" name="img" required>
            </td>
          </tr>
		      <tr>
            <th>Membros da Comissão Organizadora</th>
            <td id='area_comissao'></td>
          </tr>
          <tr>
            <td colspan="2">
              <input type="button" value="Adicionar mais Organizadores" onclick="add_caixadeTexto();" class="btn btn-default">
              <input type="submit" value="Adicionar" class="btn btn-primary" >
            </td>
          </tr>
        </table>
      </div>
    </form>
  </body>
</html>
