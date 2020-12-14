<?php if (!isset($_SESSION))
    session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<?php
include '../html/Header.html';
include '../php/Menu.php';
?>

<section>
    <?php
    include 'DbConfig.php';
    if (isset($_GET['cod'])) {
        $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
        if (!$mysqli) {
            echo ('MAL');
            die('Fallo al conectar a MySQL: ' . mysqli_connect_error());
        }
        $codigo = mysqli_real_escape_string($mysqli, $_GET['cod']);
        $query = $mysqli->query("SELECT email FROM users WHERE regCheck='" . $codigo . "'");
        if ($query->num_rows === 0)
            die('<h2 style="text-align: center;">Codigo invalido</h2><br> <img src="https://media.giphy.com/media/3faT4z5qdm19t86ebI/giphy.gif" style="display: block;margin-left: auto;margin-right: auto;">');
        else {
            $email = mysqli_fetch_array($query)['email'];
            $query = mysqli_query($mysqli, "UPDATE users SET estado = 'A', regCheck = NULL WHERE email = '" . $email . "'");
            mysqli_close($mysqli);
            echo "<h2 style='text-align: center;'>El email " . $email . " ha sido verificado correctamente.</h2><br>";
            echo "<img src='https://media.giphy.com/media/m2Q7FEc0bEr4I/giphy.gif' style='display: block;margin-left: auto;margin-right: auto;'>";
        }
    } else
        die("<h2 style='text-align: center;'>Falta el codigo</h2><br><img src='https://media.giphy.com/media/3faT4z5qdm19t86ebI/giphy.gif' style='display: block;margin-left: auto;margin-right: auto;'>");

    ?>
</section>

<?php include '../html/Footer.html'; ?>

</html>