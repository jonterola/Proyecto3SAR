<?php
$categoria = $_REQUEST['categoria'];
$genero = $_REQUEST['genero'];
$nombre = $_REQUEST['nombreProducto'];
$precio = $_REQUEST['precio'];
$stock = $_REQUEST['stock'];


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

$xml->asXML('../xml/productos.xml');
?>