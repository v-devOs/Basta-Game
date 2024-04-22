<?php
session_start();
if (isset($_SESSION["role"])) {
   if ($_SESSION["role"] == 'admin') header('location: ../admin/home.php');
   else header('location: ../game/home.php');
}
session_destroy();

function captcha(&$resu){
   
   // 3 Digitios y dos operadores
   $opers = "+-*";
   $ope1 = $opers[rand()%3]; 
   $ope2 = $opers[rand()%3];

   $digi1 = rand()%9+1;
   $digi2 = rand()%9+1;
   $digi3 = rand()%9+1;

   $resu = resuelve($digi1, $digi2, $ope1);
   $resu = resuelve($resu, $digi3, $ope2);
   $cap1 = $digi1.$ope1.$digi2.$ope2.$digi3;
   

   return $cap1;
}

function resuelve($dig1,$dig2,$ope){
   if($ope=="+") return $dig1+$dig2;
   else if($ope=='-') return $dig1-$dig2;
   else return $dig1*$dig2;
}

$resulLogin = $resuRegistro = $resuContra = 0;
$cap1 = captcha($resuRegistro);

$_SESSION["capt_register"] = $resuRegistro;

echo ($resuRegistro);
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Register</title>
</head>

<body>
   <form action="../../class/acceso.php" method="POST">
      <input type="hidden" name='action' value='register'>
      <input type="text" name="nombre" placeholder="Nombre" />
      <input type="text" name="apellidos" placeholder="Apellidos" />
      <input type="text" name="correo" placeholder="mail@mail.com" />

      <input type="text" name="capchat" placeholder="Cuanto es <?=$cap1;?>">

      <input type="password" name="clave" placeholder="Contraseña" />
      <!-- <?php
      if (isset($_GET['e'])) {
         if ($_GET['e'] == 1) {
            echo "Error en las credenciales";
         } else if ($_GET['e'] == 2) {
            echo "Los datos no han sido enviados";
         }
      }
      ?> -->
      <input type="submit" value="Ingresar" />
   </form>
</body>

</html>