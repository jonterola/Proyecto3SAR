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

    <?php
    include 'DbConfig.php';
    if (isset($_SESSION['email']))
        die('Ya estas logeado');
    if (!isset($_GET['key'])) {
        die('<h2 style="text-align: center;">Faltan parametros</h2><br> <img src="https://media.giphy.com/media/3faT4z5qdm19t86ebI/giphy.gif" style="display: block;margin-left: auto;margin-right: auto;">');
    }
    $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
    if (!$mysqli) {
        echo ('MAL');
        die('Fallo al conectar a MySQL: ' . mysqli_connect_error());
    }
    $codigo = mysqli_real_escape_string($mysqli, $_GET['key']);
    $query = $mysqli->query("SELECT email FROM users WHERE reset='" . $codigo . "'");
    if ($query->num_rows === 0)
        die('<h2 style="text-align: center;">Codigo invalido</h2><br> <img src="https://media.giphy.com/media/3faT4z5qdm19t86ebI/giphy.gif" style="display: block;margin-left: auto;margin-right: auto;">');
    else
        $email = mysqli_fetch_array($query)['email'];
    ?>
    <form id='login' name='flogin' method="POST" action='ResetearPassword.php?key=<?php echo $_GET['key']; ?>'>
        <div>
            <table id="tform" style="margin: auto; height: 20%">
                <tr>
                    <td align="left"><label id="lpassword">Nueva contraseña*: </label></td>
                    <td><input type="password" id="password" name="password"></td>
                    <td><label id="PASS" name="PASS"></label>
                </tr>
                <tr>
                    <td align="left"><label id="lpassword2">Repetir la nueva contraseña*: </label></td>
                    <td><input type="password" id="password2" name="password2"></td>
                </tr>
                </tr>
            </table>
        </div>
        <input type="submit" id='Registrarse' value="Recuperar contraseña"><br><br>
    </form>
    <?php
    include 'DbConfig.php';
    if (isset($_POST['password']) && isset($_POST['password2'])) {
        if (empty($_POST['password']) && empty($_POST['password2'])) {
            echo 'Rellena todos los campos';
        } else if ($_POST['password'] != $_POST['password2']) {
            echo 'Las contraseñas no coinciden';
        } else {
            $salt = $email . "#Vadillo007STONKS";
            $contraseñasegura = crypt($_POST['password'], $salt);
            $query = mysqli_query($mysqli, "UPDATE users SET password = '" . $contraseñasegura . "', reset = NULL WHERE email = '" . $email . "'");
            mysqli_close($mysqli);
            echo '<script>alert("Contraseña cambiada con exito");window.location.href = "LogIn.php";</script>';
        }
    }
    ?>
</section>
<?php include '../html/Footer.html' ?>
</body>

</html>