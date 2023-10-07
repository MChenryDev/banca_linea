<?php 
    session_start();
    include 'config/db_connection.php';
    require 'vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $numeroCuenta = $_POST["numero_cuenta"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $contrasena = $_POST["contrasena"];
    $confirma_contrasena = $_POST['confirmar_contrasena'];

    // Validar que las contraseñas coincidan
    if ($contrasena !== $confirma_contrasena) {
        echo "Las contraseñas no coinciden.";
        exit(); // Detener la ejecución si las contraseñas no coinciden
    }

    // Hashear la contraseña 
    $hashedClave = md5($contrasena);

    // Preparar la consulta para la inserción
    $query = "INSERT INTO usuarios_banca (no_cuenta, correo_electronico, telefono, password, confirmado, token)
              VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $confirmado = 0; // El 0 corresponde a no confirmado, el 1 corresponde a confirmado
    $token = md5(uniqid(rand(), true)); // Generar un token

    // Vincular los parámetros
    $stmt->bind_param('isssis', $numeroCuenta, $correo, $telefono, $hashedClave, $confirmado, $token);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Registro insertado correctamente.";

        // Envío de correo electrónico para activación
        $activationLink = 'http://banca_linea.test/activar_cuenta.php?token=' . $token;

        // Inicializa la clase de PHPMailer
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'bancoxyz98@gmail.com';  // Tu nombre de usuario de Mailtrap
        $mail->Password = 'ebby lleo tiip sytj';  // Tu contraseña de Mailtrap
        $mail->SMTPSecure = 'tls'; // Puedes usar 'tls' o 'ssl'
        $mail->Port = 587;  // El puerto que prefieras (25, 465, 587, o 2525)

        // Configura el remitente y destinatario
        $mail->setFrom('bancoxyz98@gmail.com', 'BANCO XYZ');
        $mail->addAddress($correo);

        // Configura el contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Activacion de cuenta';
        $mail->Body = 'Haz clic en el siguiente enlace para activar tu cuenta: <a href="' . $activationLink . '">' . $activationLink . '</a><br>
                        <br>
                        Tus Credenciales Son:<br>
                        Usuario/Correo: '. $correo . ' <br>
                        Password: ' . $contrasena . '';

        // Envía el correo
        if ($mail->send()) {
            echo 'Correo de activación enviado.';
        } else {
            echo 'Error al enviar el correo: ' . $mail->ErrorInfo;
        }
    } else {
        echo "Error al insertar el registro: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    // Redireccionar después de procesar el formulario
    header("Location: registro.php");
    exit(); // Asegurar que el código posterior no se siga ejecutando
?>
