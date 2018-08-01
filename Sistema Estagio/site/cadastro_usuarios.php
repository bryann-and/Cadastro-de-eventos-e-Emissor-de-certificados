<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cadastro de Alunos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/estilos.css">
    <?php
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
  </head>
  <body>
    <div class="responsive-table">
      <form action="../add_usuario.php" method="post">
        <table class="table table-hover">
          <tr>
            <th>Nome do Usuario: </th>
            <td>
              <input type="text" name="nome_user" required class="form-control">
            </td>
          </tr>
          <tr>
            <th>Senha: </th>
            <td>
              <input type="password" name="senhaa" required class="form-control">
            </td>
          </tr>
          <tr>
            <td colspan="2">
                <input type="submit" value="Adicionar" name="Adicionar" class="btn btn-primary">
            </td>
          </tr>
        </table>

    </div>
    </form>
  </body>
</html>
