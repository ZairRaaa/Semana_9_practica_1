<?php
require __DIR__ . '/config.php';
$errores = [];
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    http_response_code(405);
    $errores[] = 'Envía tus datos desde el formulario.';
} else {
    $nombre = trim((string) filter_input(INPUT_POST, 'nombre', FILTER_UNSAFE_RAW, FILTER_REQUIRE_SCALAR));
    $correo = trim((string) filter_input(INPUT_POST, 'correo', FILTER_UNSAFE_RAW, FILTER_REQUIRE_SCALAR));
    $taller = (string) filter_input(INPUT_POST, 'taller', FILTER_UNSAFE_RAW, FILTER_REQUIRE_SCALAR);
    if (mb_strlen($nombre) < 2 || mb_strlen($nombre) > 80) $errores[] = 'El nombre debe tener entre 2 y 80 caracteres.';
    if (strlen($correo) > 120 || !filter_var($correo, FILTER_VALIDATE_EMAIL)) $errores[] = 'Ingresa un correo válido de hasta 120 caracteres.';
    if (!isset(TALLERES[$taller])) $errores[] = 'Selecciona uno de los talleres disponibles.';
    if (!$errores) {
        session_regenerate_id(true);
        $_SESSION['inscripcion'] = ['nombre' => $nombre, 'correo' => $correo, 'taller' => TALLERES[$taller]];
        header('Location: resultado.php', true, 302);
        exit;
    }
    http_response_code(422);
}
?>
<!doctype html><html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Revisa tus datos · Patio</title><link rel="stylesheet" href="estilos.css"></head><body><main class="resultado"><section class="tarjeta"><p class="etiqueta">PATIO / INSCRIPCIÓN</p><h1 style="font-size:40px">Revisa tus datos</h1><ul class="error"><?php foreach ($errores as $error): ?><li><?= escapar($error) ?></li><?php endforeach; ?></ul><a class="boton" href="index.html">Volver al formulario</a></section></main></body></html>
