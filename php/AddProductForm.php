<?php if (!isset($_SESSION))
	session_start(); ?>
<!DOCTYPE html>
<html>


<?php
include '../html/Header.html';
include '../php/Menu.php';
?>
<section id="s1">
	<div>

		<form id='fproduct' name='fproduct' method="POST" enctype='multipart/form-data' onsubmit="return validarProducto()" action=''>
			<h2>Añadir producto</h2><br />
			<table>

				<tr>
					<td>Categoría:</td>
					<td> <input type="text" style="width:200px" size="50" id="categoria" name="categoria" required></td>
				</tr>
				<tr>
					<td>Género:</td>
					<td> <input type="text" style="width:200px" size="50" id="genero" name="genero" required></td>
				</tr>
				<tr>
					<td>Nombre del producto:</td>
					<td> <input type="text" style="width:200px" size="50" id="nombreProducto" name="nombreProducto" required></td>
				</tr>
				<tr>
					<td>Precio:</td>
					<td> <input type="text" style="width:200px" size="75" id="precio" name="precio" required></td>
				</tr>
				<tr>
					<td>Oferta:</td>
					<td> <input type="text" style="width:100px" size="5" id="oferta" name="oferta" required>%</td>
				</tr>
				<tr>
					<td>Stock:</td>
					<td> <input type="text" style="width:100px" size="75" id="stock" name="stock" required></td>
				</tr>
				<tr>
					<td>Imagen:</td>
					<td> <input type="file" size="75" id="imagen" name="imagen"></td>
				</tr>
				<tr>
					<td><input type="submit" id="submit" class="boton" value="Añadir"> <input type="reset" id="reset" class="boton" value="Limpiar"></td>
				</tr>
			</table>
		</form>
		<span id="error" name="error" style="margin:auto; display:table; color:red;"></span><br><br>

	</div>

	<?php
	if (isset($_REQUEST['categoria'])) {
		$categoria = $_REQUEST['categoria'];
		$genero = $_REQUEST['genero'];
		$nombre = $_REQUEST['nombreProducto'];
		$precio = $_REQUEST['precio'];
		$oferta = $_REQUEST['oferta'];
		$stock = $_REQUEST['stock'];

		$imagen = "";
		if ($_FILES != null) {
			$imagen = $_FILES['imagen']['tmp_name'];
		}
		if ($imagen != "") {
			$imagen_b64 = base64_encode(file_get_contents($imagen));
		}

		$xml = simplexml_load_file("../xml/productos.xml");

		$lastID = $xml['lastid'] + 1;
		$xml['lastid'] = $lastID;
		$producto = $xml->addChild('producto');
		$producto->addAttribute('id', $lastID);
		$producto->addChild('categoria', $categoria);
		$producto->addChild('genero', $genero);
		$producto->addChild('nombre', $nombre);
		$producto->addChild('precio', $precio);
		$producto->addChild('stock', $stock);
		$producto->addChild('fecha', date('Y-m-d'));
		$producto->addChild('oferta', $oferta);

		if ($imagen != "") {
			$producto->addChild('imagen', $imagen_b64);
		}
		echo "<span style='margin:auto; display:table;'>Producto añadido correctamente.</span>";
		$xml->asXML('../xml/productos.xml');
	}
	?>
</section>
<?php include '../html/Footer.html'; ?>


</html>