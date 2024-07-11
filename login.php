<!DOCTYPE html>
<html lang="en">

<head>
    <title>GIS CIX</title>
    <meta charset="UTF-8">
    <link rel="icon" href="Views/Resources/dist/img/logo.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/util.css">
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/main.css">
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/sweetalert.css">
    <script src="vendor/bootstrap/js/sweetalert.js" type="text/javascript"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            background: url('Views/Resources/dist/img/fondo.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .login-container {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .g-recaptcha-container {
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="form-container">
            <form class="login100-form validate-form p-5" method="POST" action="login.php">
                <span class="login100-form-title p-b-26">
                    <b>Inicio de sesión</b>
                </span>
                <div class="d-flex justify-content-center">
                    <img class="p-2 rounded-circle" height="85px" width="85px" src="Views/Resources/dist/img/logo.png" style="background: none;">
                </div>
                <br>
                <div class="wrap-input100 validate-input">
                    <input class="input100" type="text" required autofocus name="usuario" autocomplete="off">
                    <small class="focus-input100" data-placeholder="Usuario"></small>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <span class="btn-show-pass">
                        <i class="icofont-eye"></i>
                    </span>
                    <input class="input100" type="password" name="pass" required>
                    <small class="focus-input100" data-placeholder="Password"></small>
                </div>
                <div class="mb-3 g-recaptcha-container">
                    <div class="g-recaptcha" data-sitekey="6LeiocwpAAAAALaqoSoSOKtXWJx3jS7LXo8PLBuB"></div>
                </div>
                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn" name="acceder">
                            Acceder
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php
    require_once("Conexion/conexionBD.php");
    $pdo = obtenerConexion();
    session_start();

    if (isset($_POST['acceder'])) {
        $usuario = $_POST['usuario'];
        $pass = $_POST['pass'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $captcha = $_POST['g-recaptcha-response'];
        $secretkey = "6LeiocwpAAAAAG19zQbZBSCF15jEQr_-mwehVsvy";

        // Verificar reCAPTCHA
        $respuesta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$captcha&remoteip=$ip");
        $atributos = json_decode($respuesta, TRUE);

        if (!$atributos['success']) {
            echo '<script>
                swal({
                title: "Intento Fallido",
                text: "Verificar Captcha",
                type: "error",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Aceptar",
              });
              </script>';
        } else {
            if (!empty($usuario) && !empty($pass)) {
                $pdo = obtenerConexion();
                $stmt = $pdo->query("SELECT * FROM usuarios WHERE nombre_usuario = '$usuario' and password = '$pass' and estado='true'");
                $fila = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($fila) {
                    $_SESSION['id_usuario'] = $fila['id_usuario'];
                    $_SESSION['nombre_usuario'] = $fila['nombre_usuario'];
                    $_SESSION['telefono'] = $fila['telefono'];
                    $_SESSION['password'] = $fila['password'];

                    $nombreCompleto = explode(' ', $fila['nombre']);
                    $primerNombre = $nombreCompleto[0];

                    $apellidoCompleto = explode(' ', $fila['apellido']);
                    $primerApellido = $apellidoCompleto[0];

                    $_SESSION['nombre'] = $primerNombre;
                    $_SESSION['apellido'] = $primerApellido;

                    header("Location: index.php");
                    exit();
                } else {
                    echo '<script>
                    swal({
                    title: "Intento Fallido",
                    text: "Datos incorrectos, intente nuevamente!",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Aceptar",
                  });
                  </script>';
                }
            }
        }
    }
    ?>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="vendor/jquery/main.js"></script>
</body>

</html>
