<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Form</title>
    <style>
        body{
            background-image: url("img/ecorp.jpg");
            position: fixed;
            background-repeat: no-repeat;
            background-size: auto;
        }

    </style>

</head>
<body>

<form action="login.php" method="POST">
    <div>
        <label for="login">Login:</label>
        <input type="text" id="login" name="login"/>
    </div>
    <div>
        <label for="pass">Password:</label>
        <input type="password" id="pass" name="pass"/>
    </div>
    <button>Enviar</button>
</form>


</body>
</html>