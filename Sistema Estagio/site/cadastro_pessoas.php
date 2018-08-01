<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/estilos.css">

    <title>Cadastro de Alunos</title>
  </head>
  <body>
    <div class="responsive-table">
      <form action="../add_pessoa.php" method="post">
          <table class="table table-hover">
            <tr>
              <th>Nome</th>
              <td>
                <input type="text" name="nome_pessoa" required class="form-control">
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
