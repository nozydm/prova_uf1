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
        if (isset($_REQUEST["logout"])) {
            cerrar_session();
        }

        if (isset($_REQUEST["cambiar"])) {
            cambiar_password(comprovar_campo($_REQUEST["password"]), $_SESSION["user"]);
        }
    }

    if (isset($_SESSION["user"]) && isset($_SESSION["password"])) {
        mostrar_nom($_SESSION["user"]);
    
        if (comprovar_regenerada($_SESSION["user"])) {
            vaciar_password($_SESSION["user"]);
?>
        <p>Tienes que cambiar tu contraseña!</p>
        <form method="post">
            <label>Contraseña: </label><input type="password" name="password"><button type="submit" name="cambiar" value="si">Cambiar</button>
        </form>
        <p>Si no la cambias, tendras que recuperarla de nuevo!</p><br>
<?php
        }
?>
    <form method="post">
        <label>Cerrar sesion: </label><button type="submit" name="logout" value="si">Log out</button>
    </form>
<?php
    } else {
        header("Location: index.php");
    }
?>
</body>
</html>