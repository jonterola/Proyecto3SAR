<?php if (!isset($_SESSION))
    session_start(); ?>
<html>

<?php
include '../html/Header.html';
include '../php/Menu.php';
?>
<script src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/ShowImageInForm.js"></script>


<section>
    <div id="formDiv" style="text-align: center;">
        <?php if (isset($_SESSION['email']))
            die('Ya estas logeado'); ?>
        <form id='register' name='fregister' enctype="multipart/form-data" action='Register.php' method="POST">
            <table class="tform">
                <tr>
                    <td><label id="lemail">Email*: </label></td>
                    <td><input type="text" id="email" name="email" required></td>
                </tr>
                <tr>
                    <td><label id="lname">Nombre y Apellidos*: </label></td>
                    <td><input type="text" id="name" name="name" required></td>
                </tr>
                <tr>
                    <td><label id="lpassword">Contraseña*: </label></td>
                    <td><input type="password" id="password" name="password" minlength="6" required></td>
                </tr>
                <tr>
                    <td><label id="lpassword2">Repetir Contraseña*: </label></td>
                    <td><input type="password" id="password2" name="password2" minlength="6" required></td>
                </tr>
                <tr>
                    <td><label id="lfile">Avatar: </label></td>
                    <td><input type="file" id="archivosubido" name="archivosubido" accept="image/*"></td>
                </tr>
            </table>

            <br>
            <input type="reset" class="boton" value="Limpiar">
            <input type="submit" class="boton"><br><br>
            <label>* Campo obligatorio </label>
        </form>
        <?php
        include 'DbConfig.php';
        include 'SubirImagen.php';

        //error_reporting(E_ALL ^ E_NOTICE);
        if (isset($_POST['email'])) {
            if (empty($_POST['email']) || empty($_POST['password']) || empty($_POST['name']) || empty($_POST['password2'])) {
                echo ('Error: Faltan parametros');
            } else if (!(preg_match("/[A-Za-z]+[ ][A-Za-z]+/", $_POST["name"]))) {
                echo ('Error: Nombre Incorrecto. ha de contener un nombre y un apellido');
            } else if (strlen($_POST['password']) < 6) {
                echo ('Error: La contraseña ha de ser de minimo 6 caracteres');
            } else if ($_POST['password'] != $_POST['password2']) {
                echo ('Error: Las contraseñas no coinciden');
            } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                echo ('Error: Email incorrecto');
            } else {
                $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
                if (!$mysqli) {
                    die('Fallo al conectar a MySQL');
                }
                $extension = "-";
                if (!$_FILES["archivosubido"]["error"] != 0) {
                    $extension = strtolower(pathinfo(basename($_FILES["archivosubido"]["name"]), PATHINFO_EXTENSION));
                }
                $salt = $_POST['email'] . "#TeamG4rdf01d";
                $contraseñasegura = crypt($_POST['password'], $salt);
                $dominio = explode("@", $_POST['email'])[1];
                if ($dominio == "teamgardfold.com")
                    $tipo = "A";
                else
                    $tipo = "U";
                $codigo = random_bytes(16);
                $codigo = bin2hex($codigo);
                $query = $mysqli->prepare("INSERT INTO users(tipo,email,nombre,password,foto,regCheck) VALUES (?,?,?,?,?,?)");
                $query->bind_param("ssssss", $tipo, $_POST['email'], $_POST['name'], $contraseñasegura, $extension, $codigo);
                if (!$query->execute())
                    die('Error: No se ha podido añadir a la base de datos' . mysqli_error($mysqli));
                if (!$_FILES["archivosubido"]["error"] != 0) {
                    if (!subir($_FILES, $target_dir, $_POST['email'])) {
                        $email = $_POST['email'];
                        mysqli_query($mysqli, "DELETE FROM users WHERE email = '$email'");
                        die();
                    }
                }
                echo "Usuario registrado con exito. Se ha enviado un email para verificar el correo.<br><br>";
                $mensaje = "TIENDA GARDFOLD<br>Buenas, " . $_POST['name'] . ".<br>Se ha registrado un usuario con este correo, para verificar el correo, entre en el siguiente enlace  <a style='color:blue' href='VerificarCuenta.php?cod=" . $codigo . "'>Verificar</a>";
                $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                //mail($_POST['email'], 'Verificar cuenta tienda.teamgardfold.es', $mensaje, $cabeceras); Con este comando mandariamos el correo
                echo $mensaje; //Al no poder mandar el correo, mostramos por pantalla el mensaje que se tendria que haber enviado
            }
        }
        ?>
        <br><br>
    </div>
</section>

</body>

</html>