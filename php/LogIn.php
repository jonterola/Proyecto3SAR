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
    <form id='login' name='flogin' method="POST" action='LogIn.php'>
        <div>
            <?php if (isset($_SESSION['email']))
                die('Ya estas logeado'); ?>
            <table id="tform" style="margin: auto; height: 40%">
                <tr>
                    <td align="left"><label id="luser">Email*: </label></td>
                    <td><input type="text" id="user" name="user"></td>
                </tr>
                <tr>
                    <td align="left"><label id="lpassword">Contraseña*: </label></td>
                    <td><input type="password" id="password" name="password"></td>
                </tr>
            </table>

        </div>
        <a href="RecuperarPassword.php">Se me ha olvidado la contraseña</a><br>
        <input type="submit" value="Iniciar Sesion"><br><br>

    </form>
    <div class="g-signin2" data-onsuccess="onSignIn"></div>
    <?php
    include 'DbConfig.php';
    if (isset($_POST['user'])) {
        if (empty($_POST['user']) || empty($_POST['password'])) {
            echo 'Rellena todos los campos';
        } else {
            $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
            if (!$mysqli) {
                echo ('MAL');
                die('Fallo al conectar a MySQL: ' . mysqli_connect_error());
            }
            $query = $mysqli->prepare("SELECT `tipo`,`password`,`foto`,`estado`,`nombre` FROM users WHERE email = ?");
            $query->bind_param("s", $_POST['user']);
            if ($query->execute()) {
                $result = $query->get_result();
                if ($result->num_rows === 0)
                    echo 'Inicio de sesion incorrecto';
                else {
                    $pass = $result->fetch_array();
                    if ($pass[3] == 'B')
                        echo 'Usuario bloqueado o no verificado';
                    else {
                        $salt = $_POST['user'] . "#TeamG4rdf01d";
                        if (hash_equals($pass[1], crypt($_POST['password'], $salt))) {
                            $_SESSION['email'] = $_POST['user'];
                            $_SESSION['tipo'] = $pass[0];
                            $_SESSION['name'] = $pass[4];
                            if ($pass[2] != '-')
                                $_SESSION['foto'] = $_POST['user'] . "." . $pass[2];
                            echo "<script>alert('Inicio de sesion correcto.'); location.href='Layout.php'; </script>";
                            exit;
                        } else
                            echo 'Inicio de sesion incorrecto';
                    }
                }
            }
            mysqli_close($mysqli);
        }
    }
    ?>
</section>


</html>