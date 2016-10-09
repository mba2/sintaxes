<?php
  // if(isset($_POST['submit'])) {
  //   $username = $_POST['username'];
  //   $password = $_POST['password'];
  //
  //   echo $username;
  //   echo $password;
  $connection = mysqli_connect();
    // mysqli_connect("localhost","u845380189_eniac","eniac2016","u845380189_sint");
 // }

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>GUIA DE SINTAXES</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/guia-de-sintaxes.css">
  </head>
  <body>

    <main class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <h1>guia de sintaxes</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-md-6">
          <form class="" id="" action="index.php" method="post">
              <div class="form-group">
                <input type="text" id="" class="form-control" name="username">
              </div>

              <div class="form-group">
                <input type="password" id="" class="form-control" name="password">
              </div>

              <div class="form-group">
                <input type="submit" id="" class="btn btn-block btn-primary" name="submit">
              </div>
          </form>
        </div>
      </div>
    </main>
    <!-- <script src="js/jquery..."></script> -->
  </body>
</html>
