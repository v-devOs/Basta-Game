<?php
session_start();

include 'baseDeDatos.php';
class Acceso extends BaseDeDatos
{
    function action($cual)
    {
        $result = '';
        switch ($cual) {
            case 'formLogin':
                break;

            case 'login':
                $result = $this->login();
                break;

            case 'register':
                $result = $this->register();

            case 'record':
                break;

            case 'formPwd':
                break;

            case 'retrievePwd':
                break;

            default:
        }

        return $result;
    }

    function login()
    {
       
        if ($_POST['captcha'] > "" && is_numeric($_POST['captcha']) && $_POST['captcha'] == $_SESSION['cap_login']){

            if (isset($_POST['mail']) && isset($_POST['password'])) {
    
    
                // Obtenemos el correo y lo guardamos en una variable
                $correo = $_POST['mail'];
                // Obtenemos la contraseña y la guardamos en una variable
                // Encriptamos contraseña para evitar inyección de código SQL
                $pass = $_POST['password'];
                // Conectamos a la base de datos
                // El uso de la base de datos está dividido en tres pasos
                // Paso 1: Abrir la conexión
                // Paso 2: Procesar la consulta
                // 2.1 Realizar la consulta
    
                $query = "SELECT u.nombre, u.apellidos, u.id_usuario, u.foto, tu.nombre AS role FROM usuario u JOIN tipo_usuario tu ON tu.id_tipo_usuario = u.tipo_usuario WHERE u.email = '$correo' AND u.clave = PASSWORD('$pass');";
                $registro = $this->getRecord($query);
                // 2.2 Procesar el resultado
                if ($this->num_registros == 1) {
                    // Si es un usuario registrado
                    $_SESSION['correo'] = $correo;
                    $_SESSION['nombre'] = $registro->nombre . ' ' . $registro->apellidos;
                    $_SESSION['id'] = $registro->id_usuario;
                    $_SESSION['foto'] = $registro->foto;
                    $_SESSION['role'] = $registro->role;
                    
                    if ($registro->role == 'admin')
                        header('location: ../app/admin/home.php');
                    else
                        header('location: ../app/game/home.php');
                } else
                    // Error en las credenciales reenviar localidad del usuario
                    header('location: ../index.php?e=1');
        }        
        } else {
            // header('location: ../index.php?e=5');
        };
    }

    function register()
    {
        $cadena = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789123456789";
        $numeC = strlen($cadena);
        $nuevPWD = "";

        // Generate random password
        for ($i = 0; $i < 8; $i++)
            $nuevPWD .= $cadena[rand() % $numeC];

        // $cad = "insert into usuario set nombre='" . $_POST['nombre'] . "', apellidos='" . $_POST['apellidos'] . "', email='" . $_POST['correo'] . "', clave=password('" . $nuevPWD . "'), fechaUltiAcceso=n" . date('Y-m-d') . ", tipo_usuario=2";
        $cad = "insert into usuario(nombre, apellidos, email, clave, fechaUltiAcceso) values('" . $_POST['nombre'] . "', '" . $_POST['apellidos'] . "', '" . $_POST['correo'] . "', password('" . $nuevPWD . "'), '" . date('Y-m-d') . "');";

        include("../resources/class.phpmailer.php");
        include("../resources/class.smtp.php");

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = "smtp.gmail.com"; //mail.google
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
        $mail->Port = 465;     // set the SMTP port for the GMAIL server
        $mail->SMTPDebug  = 1;  // enables SMTP debug information (for testing)
        // 1 = errors and messages
        // 2 = messages only
        $mail->SMTPAuth = true;   //enable SMTP authentication

        $mail->Username =   "21030060@itcelaya.edu.mx"; // SMTP account username

        // TODO: Get gmail password for app not secure
        $mail->Password = "";  // SMTP account password

        $mail->From = "";
        $mail->FromName = "";
        $mail->Subject = "Registro completo";
        $mail->MsgHTML("<h1>BIENVENIDO " . $_POST['nombre'] . " " . $_POST['apellidos'] . "</h1><h2> tu clave de acceso es : " . $nuevPWD . "</h2>");
        $mail->AddAddress($_POST['correo']);
        //$mail->AddAddress("admin@admin.com");
        if (!$mail->Send())
            echo  "Error: " . $mail->ErrorInfo;
        else {
            $this->query($cad);
            header("location: ../game/home.php?e=7");
        }
    }

    function generarCaptcha($loct){

        $resuCap = 0;
        $cap = $this->captcha($resuCap);

        $_SESSION[$loct] = $resuCap;

        return $cap;
    }


    private function captcha(&$resu){
   
        // 3 Digitios y dos operadores
        $opers = "+-*";
        $ope1 = $opers[rand()%3]; 
        $ope2 = $opers[rand()%3];
     
        $digi1 = rand()%9+1;
        $digi2 = rand()%9+1;
        $digi3 = rand()%9+1;
     
        $resu = $this->resuelve($digi1, $digi2, $ope1);
        $resu = $this->resuelve($resu, $digi3, $ope2);
        $cap1 = $digi1.$ope1.$digi2.$ope2.$digi3;
        
     
        return $cap1;
    }

    private function resuelve($dig1,$dig2,$ope){
        if($ope=="+") return $dig1+$dig2;
        else if($ope=='-') return $dig1-$dig2;
        else return $dig1*$dig2;
    }

    
}

// Funciones de php para imprimir elementos compuestos
// var_dump($_POST);
// print_r($_POST);

$oAcceso = new Acceso();
if (isset($_REQUEST['action'])) echo $oAcceso->action($_REQUEST['action']);

?>