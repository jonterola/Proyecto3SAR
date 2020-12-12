<?php
if(isset($_REQUEST['categoria'])){
    $categoria = $_REQUEST['categoria'];
    $genero = $_REQUEST['genero'];
    $nombre = $_REQUEST['nombreProducto'];
    $precio = $_REQUEST['precio'];
    $stock = $_REQUEST['stock'];

    $imagen = "";
    if($_FILES!=null){
        echo "<script>alert('hola');</script>";
        $imagen = $_FILES['imagen']['tmp_name'];
    }
    if ($imagen != "" ) { 
        $imagen_b64 = base64_encode(file_get_contents($imagen)); 
    }       

    $xml = simplexml_load_file("../xml/productos.xml");

    $lastID = $xml['lastid'] + 1;
    $xml['lastid'] = $lastID;
    $producto = $xml->addChild('producto');
    $producto->addAttribute('id', $lastID);
    $producto->addChild('categoria',$categoria);
    $producto->addChild('genero',$genero);
    $producto->addChild('nombre',$nombre);
    $producto->addChild('precio',$precio);
    $producto->addChild('stock',$stock);
    $producto->addChild('fecha',date('Y-m-d'));
    if($imagen != ""){
        $producto->addChild('imagen',$imagen_b64);
    }

    $xml->asXML('../xml/productos.xml');
    }
?>