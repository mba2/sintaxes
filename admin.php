<?php

$connection = mysqli_connect("localhost","u845380189_eniac","eniac2016","u845380189_sint");
if(mysqli_connect_errno()) {
  die("Não foi possível se conectar ao banco de dados: ". mysqli_connect_error());
}

$query = "SELECT * FROM `u845380189_sint`.`usuario`";
$result = mysqli_query($connection,$query) or die("Erro: " . mysqli_error($connection));

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ÁREA - ADMINISTRADOR</title>
  </head>
  <body>

    <div class="container">
        <div class="row">
          <div class="col-xs-12 col-md-6">
            <h1>usuários cadastrados</h1>
              <table id="" class="">
                <thead>
                  <tr>
                    <th>Nome do Usuário</th>
                    <th>Senha</th>
                  </tr>
                </thead>
                <?php
                  while($linha = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                      <td> <?php echo $linha['usuNome'];?></td>
                      <td> <?php echo $linha['usuSenha'];?></td>
                    </tr>
                <?php
                  }
                ?>
                  </tr>
              </table>

          </div>
        </div>
    </div>
  <body>
</html>
