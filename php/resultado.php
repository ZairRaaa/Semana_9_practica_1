<?php
require __DIR__ . '/config.php';
$inscripcion = $_SESSION['inscripcion'] ?? null;
if (!$inscripcion) { header('Location: index.html', true, 302); exit; }
?>
<!doctype html><html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Ya estás dentro · Patio</title><link rel="stylesheet" href="estilos.css"></head><body><main class="resultado"><section class="tarjeta"><p class="etiqueta">PATIO / INSCRIPCIÓN COMPLETADA</p><h1 style="font-size:44px">¡A crear!</h1><p>Tu inscripción de demostración está registrada en esta sesión.</p><dl><?php foreach (['nombre' => 'Participante', 'correo' => 'Correo', 'taller' => 'Taller'] as $clave => $etiqueta): ?><dt><?= $etiqueta ?></dt><dd><?= escapar($inscripcion[$clave]) ?></dd><?php endforeach; ?></dl><a class="boton" href="index.html">Explorar otro taller</a></section></main></body></html>
