<?php
$xml = simplexml_load_file("../xml/visitas.xml");
if (!$xml) die('Error al cargar el XML');
$json = new stdClass;

$json->text = htmlspecialchars($xml->visita[$_POST['id'] - 1]->children()->comentario);

header('Content-Type: application/json');
echo json_encode($json);
