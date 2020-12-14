<nav>

    <?php
    if (!isset($_SESSION['email'])) {
        echo '        <span class = "nav__spanright"><a href="LogIn.php">Iniciar sesión</a></span>
        <span class = "nav__spanright"> <a href="Register.php">Registrarse</a></span>';
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
        echo "<span class='nomspan' >Bienvenido " . $_SESSION['name'] . " </span> ";
        echo ' <img src="';
        echo $foto;
        echo '" style="float:left;max-width:60px;width:100%;max-height:60px; height:100%"></img> ';

        echo "<a href='Cesta.php'><img  style= 'width:70px;float:right;padding-top:3px'  src ='../uploads/vercarrito.png' /></a>";

        echo '<span  class = "nav__spanright style = "float:right"><a href="logout.php">Logout</a></span>';
        if ($_SESSION['tipo'] == 'A') {
            echo '<span class = "nav__spanleft style ="float:center"><a href="AddProductForm.php">Añadir Producto</a></span>';
            echo '<span class = "nav__spanleft"><a href="anadiroferta.php">Añadir Oferta</a></span>';
            echo '<span class = "nav__spanleft"><a href="DeleteProductForm.php">Eliminar Producto</a></span>';
        }
    }
    ?>

</nav>

<aside>
    <h4 class='menu'><a href="showStock.php">Todos los productos</a></h4>
    <h4 class='menu'><a href="showStock.php?novedad=si">Novedades</a></h4>
    <h4 class='menu'><a href="ShowStock.php?genero=hombre">Hombre</a></h4>
    <h4 class='menu'><a href="ShowStock.php?genero=mujer">Mujer</a></h4>
    <h4 class='menu'><a href="ShowStock.php?oferta=si">Ofertas</a></h4>

</aside>