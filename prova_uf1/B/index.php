<?php
    session_start();
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
        if (isset($_REQUEST["login"])) {
            iniciar_sesion(comprovar_campo($_REQUEST["user"]), comprovar_campo($_REQUEST["password"]));
        }

        if (isset($_REQUEST["recuperar"])) {
            header("Location: recuperar.php");
        }
    }
?>
        <form method="post">
            <p>Login</p>
            <p><label>Usuario: </label></td><td><input type="text" name="user"></p>
            <p><label>Password: </label><input type="password" name="password"></p>
            <p><button type="submit" name="login" value="si">Entrar</button></p>
        </form>
    <br>
    <form method="post">
        <label>Recuperar contraseña: </label><button type="submit" name="recuperar" value="si">Recuperar</button>
    </form>
</body>
</html>