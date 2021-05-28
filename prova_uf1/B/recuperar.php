<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    include "funcions.php";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_REQUEST["numero1"] + $_REQUEST["numero2"] == $_REQUEST["resultado"]) {
            if (isset($_REQUEST["enviar"]) && comprovar_email_db($_REQUEST["mail"])) {
                $pass = generar_string();
                $username = $_REQUEST["mail"];
                nueva_password(md5($pass), $username);
    
                $mail = new PHPMailer(true);
    
                try {
                    //Server settings
                    //$mail->SMTPDebug = 2;
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'nozydm@gmail.com';
                    $mail->Password   = 'cvsishohlmqqdopl';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port       = 587;
    
                    //Recipients
                    $mail->setFrom('nozydm@gmail.com', 'Mailer');
                    $mail->addAddress($username, 'Usuario');
    
                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Recuperacion de password';
                    $mail->Body    = 'Tu nueva password: '.$pass.'<br>Para iniciar session usa tu nueva password: <a href="https://dawjavi.insjoaquimmir.cat/acustodio/prova_uf1/B/">Entrar</a>';
                    $mail->AltBody = 'Codigo: ';
    
                    $mail->send();
                    echo 'El correo se ha enviado.';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                echo "Ese correo no esta registrado!";
            }
        } else {
            echo "Escribe el resultado de la suma correctamente!";
        }

        if (isset($_REQUEST["volver"])) {
            header("Location: index.php");
        }
    }
?>
        <form method="post">
            <p>Escribe tu correo!</p>
            <label>Correo: </label><input type="text" name="mail">
<?php
    $numero1 = rand(1, 9);
    $numero2 = rand(1, 9);
    echo '<input type="hidden" name="numero1" value="'.$numero1.'">';
    echo '<input type="hidden" name="numero2" value="'.$numero2.'">';
    echo '<tr><td>'.$numero1." + ".$numero2." = </td>";
?>
            <input type="text" name="resultado"></td>
            <p><button type="submit" name="enviar" value="si">Regenerar</button></p>
        </form>
    <br>
    <form method="post">
        <label>Volver </label><button type="submit" name="volver" value="si">Volver</button>
    </form>
</body>
</html>