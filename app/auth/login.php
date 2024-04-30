<?php
session_start();

if(isset($_SESSION["role"])){
  if($_SESSION["role"] == 'admin') header('location: ../admin/home.php');
  else header('location: ../game/home.php');
}

session_destroy();

@include '../../components/navbar.php';
@include '../../class/acceso.php';

$acceso = new Acceso();

$cap = $acceso->generarCaptcha('cap_login');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-sm-12">
                
                <form action="../../class/acceso.php" method="post">

                    <input class="form-control" type="hidden" name='action' value='login'>

                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>                      
                        <input class="form-control" type="text" name="mail" placeholder="mail@mail.com" />
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Contraseña</label>
                        <input class="form-control" type="password" name="password" placeholder="Contraseña" />
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Captcha</label>
                        <input type="text" name="captcha" class="form-control" placeholder="Cuanto es <?=$cap;?>">
                    </div>

                    <?php
                    if (isset($_GET['e'])) {
                        if ($_GET['e'] == 1) {
                            echo "Error en las credenciales";
                        } else if ($_GET['e'] == 2) {
                            echo "Los datos no han sido enviados";
                        }
                    }
                    ?>
                    <input class="btn btn-primary" type="submit" value="Ingresar" />
                </form>
            
            </div>
        </div>
    </div>

  
</body>
</html>