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
    <form id='login' name='flogin' method="POST" action='RecuperarPassword.php'>
        <div>
            <?php if (isset($_SESSION['email']))
                die('Ya estas logeado'); ?>
            <table id="tform" style="margin: auto; height: 10%">
                <tr>
                    <td align="left"><label id="luser">Email*: </label></td>
                    <td><input type="text" id="user" name="user"></td>
                </tr>
            </table>

        </div>
        <input type="submit" value="Recuperar contraseña"><br><br>

    </form>
    <?php
    include 'DbConfig.php';
    if (isset($_POST['user'])) {
        if (empty($_POST['user'])) {
            echo 'Rellena todos los campos';
        } else {
            $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
            if (!$mysqli) {
                echo ('MAL');
                die('Fallo al conectar a MySQL: ' . mysqli_connect_error());
            }
            $query = $mysqli->prepare("SELECT * FROM users WHERE email = ?");
            $query->bind_param("s", $_POST['user']);
            if ($query->execute()) {
                $result = $query->get_result();
                if ($result->num_rows === 0)
                    echo 'No hay ningun usuario con ese correo';
                else {
                    $codigo = random_bytes(16);
                    $codigo = bin2hex($codigo);
                    // El mensaje
                    $mensaje = "Hemos recibido una solicitud para restablecer la contraseña.\r\n Si no has sido tú quien ha enviado la solicitud, ignora este mensaje. Si has sido tú, puedes restablecer la contraseña a través de este enlace:\r\n\r\n <a href='ResetearPassword.php?key=" . $codigo . "'>https://tienda.teamgardfold.com/php/ResetearPassword.php?key=" . $codigo . "</a>\r\n";
                    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    // Enviarlo
                    $mail = mysqli_real_escape_string($mysqli, $_POST['user']);
                    $query = mysqli_query($mysqli, "UPDATE users SET reset = '" . $codigo . "' WHERE email = '" . $mail . "'");
                    //mail($mail, 'Restablecer contraseña tienda.teamgardfold.es', $mensaje, $cabeceras); Con este comando mandariamos el correo
                    echo 'Se ha ennviado un correo para restablecer la contraseña.';
                    echo $mensaje; //Al no poder mandar el correo, mostramos por pantalla el mensaje que se tendria que haber enviado
                }
            }
            mysqli_close($mysqli);
        }
    }
    ?>
</section>
<?php include '../html/Footer.html' ?>
</body>

</html>