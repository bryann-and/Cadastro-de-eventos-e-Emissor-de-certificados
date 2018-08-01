<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Editar Evento</title>

    <script type="text/javascript">
      $.ajaxSetup ({
        cache: false
      });


        $('#btn').click(function()
        {
            //var nome = document.getElementById('nome_evento').value;
            var nome = $('#nome_evento').val();//jquery
            $("#conteudo").hide().load("../edit_evento.php",{evento: nome}).fadeIn('slow');
        });

    </script>

    <?php
      require_once("../conecta.php");

      /*dados para sugestao do evento */
      $sql = "SELECT nome_evento FROM evento";
      $resultado = mysqli_query($conexao,$sql);
      ?>

    <datalist id = "sug_evento">
      <?php
        while ($row = mysqli_fetch_array($resultado))
        {?>
           <option value="<?php echo $row['nome_evento']; ?>">
            <?php echo $row['nome_evento']; ?>
        <?php } ?>
    </datalist>

  </head>
  <body>
    <form action="menu_opcoes_evento.php" method="GET">
      <div class="responsive-table">
        <table class="table table-hover">
          <tr>
            <th>Selecione o evento</th>
            <tr>
              <td><input type="search" name="nome_evento" list="sug_evento" autocomplete="off" required class="form-control"></td>
            </tr>
          </tr>
          <tr>
            <td><input type="submit" value="Editar" class="btn btn-primary"></td>
          </tr>
        </table>
      </div>
    </form>
  </body>
</html>
