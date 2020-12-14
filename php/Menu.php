<nav>
    <ul>
        <?php
        if (!isset($_SESSION['email'])) {
            echo '        <li><a href="LogIn.php">Iniciar sesión</a></li>
        <li><a href="Register.php">Registrarse</a></li>';
        } else {
            include 'DbConfig.php';
            $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
            if (!$mysqli) {
                echo ('MAL');
                die('Fallo al conectar a MySQL: ' . mysqli_connect_error());
            }
            $foto = "../uploads/nophoto.jpg";
            if (isset($_SESSION['foto']))
                $foto = "../uploads/" . $_SESSION['foto'];
            echo "<label style='color:white;text-align:left'>Bienvenido " . $_SESSION['name'] . " </label> ";
            echo ' <img src="';
            echo $foto;
            echo '" style="max-width:60px;width:100%;max-height:60px;height:100%"></img> <span> </span> ';
            if ($_SESSION['tipo'] == 'A') {
                echo '<li><a href="AddProductForm.php">Añadir Producto</a></li>';
                echo '<li><a href="DeleteProductForm.php">Eliminar Producto</a></li>';
            }
            echo '<li><a href="logout.php">Logout</a></li>';
        }
        ?>
    </ul>
</nav>

<aside>
    <h4 class='menu'><a href="showStock.php">Todos los productos</a></h4>
    <h4 class='menu'><a href="showStock.php?novedad=si">Novedades</a></h4>
    <h4 class='menu'><a href="ShowStock.php?genero=hombre">Hombre</a></h4>
    <h4 class='menu'><a href="ShowStock.php?genero=mujer">Mujer</a></h4>
    <h4 class='menu'><a href="ShowStock.php?oferta=si">Ofertas</a></h4>

</aside>