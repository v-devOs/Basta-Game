<?php
session_start();
if (isset($_SESSION["role"])) {
   if ($_SESSION["role"] == 'admin') header('location: ../admin/home.php');
   else header('location: ../game/home.php');
}
session_destroy();

@include '../../components/navbar.php';
@include '../../class/acceso.php';

$acceso = new Acceso();

$cap = $acceso->generarCaptcha('cap_register');


?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Register</title>
   <link rel="stylesheet" href="../css/styles.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  
</head>

<body>

   <div class="container mt-5">
      <div class="justify-content-center row">
         <div class="col-lg-6 col-sm-12">
            
            <h2 class="mb-4">Ingresa tus datos</h2>

            <form class="row g-3" action="../../class/acceso.php" method="post">

               <input type="hidden" name='action' value='register'>

               <div class="col-6">
                  <label for="" class="form-label">Nombre/s</label>
                  <input class="form-control" type="text" name="nombre" placeholder="Nombre" />
               </div>
               <div class="col-6">
                  <label for="" class="form-label">Apellidos</label>
                  <input class="form-control" type="text" name="apellidos" placeholder="Apellidos" />
               </div>

               <div class="col-12">
                  <label for="" class="form-label">Correo</label>
                  <input class="form-control" type="text" name="correo" placeholder="mail@mail.com" />
               </div>

               <div class="col-12 mb-4">
                  <h4 >Selecciona tu genero</h4>

                  <select class="form-select ">
                     <option value="Otro">Otro</option>
                     <option value="Hombre">Hombre</option>
                     <option value="Mujer">Mujer</option>
                  </select>
               </div>

               <div class="col-12 mb-4">
                  <h4>Capchat</h4>
                  <input class="form-control" type="text" name="capchat" placeholder="Cuanto es <?=$cap;?>">
               </div>
         
               <!-- <?php
               if (isset($_GET['e'])) {
                  if ($_GET['e'] == 1) {
                     echo "Error en las credenciales";
                  } else if ($_GET['e'] == 2) {
                     echo "Los datos no han sido enviados";
                  }
               }
               ?> -->

               <div class="col-4">
                  <input class="btn btn-primary" type="submit" value="Ingresar" />
               </div>
            </form>

         </div>
      </div>
   </div>

</body>

</html>