<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/estilos.css">
    <title>Cadastro de Alunos</title>
    <?php
      /*verifica a sessao do usuario*/
      session_start();
      if ((!isset($_SESSION['usuario'])) and (!isset($_SESSION['senha'])))
      {
        header('location:index.html');
        exit();
      }
      /*********************/

      require_once("../conecta.php");
      //sugestoes de nome de alunos
      $sql = "SELECT nomepessoa FROM pessoa";
      $resultado2 = mysqli_query($conexao,$sql);

    ?>
  </head>
  <body>
    <datalist id = "sug_aluno">
      <?php
        while ($row = mysqli_fetch_array($resultado2))
        {?>
           <option value="<?php echo $row['nomepessoa']; ?>">
            <?php echo $row['nomepessoa']; ?>
        <?php } ?>
    </datalist>

    <div class="responsive-table">
      <form action="../add_aluno.php" method="post">
          <table class="table table-hover">
            <tr>
              <th>Nome</th>
              <td>
                <input type="text" name="nome_aluno" required list="sug_aluno" class="form-control" autocomplete="off">
              </td>
            </tr>
            <tr>
              <td colspan="2">
                  <input type="submit" value="Adicionar" name="Adicionar" class="btn btn-primary">
              </td>
            </tr>
          </table>
      </form>
    </div>
  </body>
</html>
