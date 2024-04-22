<?php

// session_start();

// if(!isset($_SESSION["nombre"])) header('location: auth.php?m=5');
// if(!$_SESSION["role"] == 'admin') header('location: ../auth/login.php?error=401');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../styles.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-primary ">

<div class="">
  <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
    <li class="nav-item">
      <a href="./index.html" class="nav-link text-light">
        <i class="bi bi-house-fill"></i>
        Palabras</a>
    </li>
    <li class="nav-item">
      <a href="./login.html" class="nav-link text-light">
        <i class="bi bi-door-open-fill"></i>
        Categorias</a>
    </li>
        <li class="nav-item">
          <a href="./register.html" class="nav-link text-light">
            <i class="bi bi-envelope-paper-fill"></i>
            Torneos</a>
        </li>
        <li class="nav-item">
          <a href="./forward_password.html" class="nav-link text-light">
            <i class="bi bi-send-fill"></i>
            Usuarios</a>
        </li>
        <li class="nav-item">
          <a href="./forward_password.html" class="nav-link text-light">
            <i class="bi bi-send-fill"></i>
            Sesion</a>
        </li>
       
      </ul>
    </div>
  </nav>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>  

</body>
</html>