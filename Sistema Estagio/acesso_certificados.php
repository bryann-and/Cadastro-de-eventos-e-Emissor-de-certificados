<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="site/css/estilos.css">
    <title>Certificados</title>

    <?php
      require_once("conecta.php");
      session_start();
      $evento_ = $_SESSION['nome_evento'];

      $tipo = $_GET['tipo'];

      if ($tipo == 'aluno')
      {
        $sql="SELECT pessoa.idpessoa ,pessoa.nomepessoa
              from evento
                JOIN participantes on participantes.id_evento = evento.idevento
                JOIN pessoa on participantes.id_pessoa = pessoa.idpessoa
                WHERE evento.nome_evento = '" . $evento_ . "';";
      }
      elseif ($tipo == 'tutor')
      {
        $sql="SELECT DISTINCT A.idpessoa,A.nomepessoa
            from evento
                JOIN atividade on evento.idevento = atividade.id_evento
                JOIN tutores_ativ on atividade.idativ = tutores_ativ.idatividade
                JOIN pessoa A on tutores_ativ.idtutor = A.idpessoa
                WHERE evento.nome_evento = '" . $evento_ . "';";
      }
      elseif ($tipo == 'comissao')
      {
        $sql="SELECT A.idpessoa,A.nomepessoa
            from evento
                JOIN comissao_org on evento.idevento = comissao_org.id_evento
                JOIN pessoa A on comissao_org.id_pessoa = A.idpessoa
                WHERE evento.nome_evento = '" . $evento_ . "';";
      }

      $resultado_pessoa = mysqli_query($conexao,$sql);


    ?>
  </head>
  <body>
    <datalist id = "sug_nomes">
      <?php
        while ($row = mysqli_fetch_array($resultado_pessoa))
        {?>
           <option value="<?php echo $row['nomepessoa']; ?>">
            <?php echo $row['nomepessoa']; ?>
        <?php } ?>
    </datalist>

    <p class="bg-primary" align="center"><strong><?php echo "Evento: " . $evento_?></strong></p>

    <div class="alert alert-warning">
        <p align="center"><strong >Aviso! </strong>Selecione seu Nome de acordo com as Sugestões</p>
    </div>

    <div class="responsive-table">
        <form action="visualizar.php?tipo=<?php echo $tipo ?>" method="post">
          <table class="table table-hover">
            <tr>
              <th>Digite seu Nome</th>
              <td><input type='search' autocomplete='off' list = 'sug_nomes' name='aluno' required class="form-control"></td>
            </tr>
            <tr>
              <td colspan="2">
                <input type="submit" Value="Buscar" class="btn btn-primary">
              </td>
            </tr>
          </table>
        </form>
    </div>
  </body>
</html>
