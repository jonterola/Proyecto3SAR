<?php
$xml = simplexml_load_file("../xml/visitas.xml");
$xml->attributes()->ult_id = $xml->attributes()->ult_id + 1;

$visita = $xml->addChild('visita');

$visita->addAttribute('id', $xml->attributes()->ult_id);

$visita->addChild('fecha', date('jS \of F Y'));
$visita->addChild('nombre', $_POST['fname']);
$visita->addChild('comentario', $_POST['ltext']);

if (strlen($_POST['lmail']) == 0) {
    $mail = $visita->addChild('email');
    $mail->addAttribute('mostrar', 'no');
} else {
    $mail = $visita->addChild('email', $_POST['lmail']);
    if (isset($_POST['lcheckbox'])) $mail->addAttribute('mostrar', 'si');
    else $mail->addAttribute('mostrar', 'no');
}

$xmlDocument = new DOMDocument('1.0');
$xmlDocument->preserveWhiteSpace = false;
$xmlDocument->formatOutput = true;
$xmlDocument->loadXML($xml->asXML());

if (!$xmlDocument->save('../xml/visitas.xml'))
    die('Esto es embarazoso, pero no se ha podido guardar el XML');
echo '<script>location.href = "visualizar.php"</script>';




