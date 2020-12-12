<!DOCTYPE html>
<html>

<head>
</head>

<body>
	<section id="s1">
		<div>
			
			<form id='fproduct' name='fproduct' method="POST" enctype='multipart/form-data' action='AddProduct.php'>
			<h2>Añadir producto</h2><br />
				<table>
					
					<tr>
						<td>Categoria<sup>*</sup></td><td> <input type="text" size="50" id="categoria" name="categoria"></td>
					</tr>
					<tr>
						<td>Genero<sup>*</sup></td><td> <input type="text" size="50" id="genero" name="genero"></td>
					</tr>
					<tr>
						<td>Nombre del producto<sup>*</sup></td><td> <input type="text" size="50" id="nombreProducto" name="nombreProducto"></td>
					</tr>
					<tr>
						<td>Precio<sup>*</sup></td><td> <input type="text" size="75" id="precio" name="precio"></td>
					</tr>
					<tr>
						<td>Stock<sup>*</sup></td><td> <input type="text" size="75" id="stock" name="stock"></td>
					</tr>
					<tr>
						<td>Imagen<sup>*</sup></td><td> <input type="file" size="75" id="imagen" name="imagen"></td>
					</tr>
					<tr>
						<td><input type="submit" id="submit" value="Añadir"> <input type="reset" id="reset" value="Limpiar"></td>
					</tr>
				</table>
			</form>

		</div>
	</section>
</body>

</html>