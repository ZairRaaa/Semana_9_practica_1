<?php
// Ejecutar: php pruebas/http.php http://127.0.0.1:8090 php
// Para Tomcat: php pruebas/http.php http://localhost:8080/lab09 jsp
$base = rtrim($argv[1] ?? 'http://127.0.0.1:8090', '/');
$extension = $argv[2] ?? 'php';
$cliente = curl_init();
curl_setopt_array($cliente, [CURLOPT_RETURNTRANSFER => true, CURLOPT_FOLLOWLOCATION => false, CURLOPT_COOKIEFILE => '', CURLOPT_TIMEOUT => 15]);
function pedir(string $ruta, ?array $datos = null): array {
    global $base, $cliente;
    curl_setopt($cliente, CURLOPT_URL, $base . '/' . $ruta);
    curl_setopt($cliente, CURLOPT_POST, $datos !== null);
    if ($datos !== null) curl_setopt($cliente, CURLOPT_POSTFIELDS, http_build_query($datos));
    $cuerpo = curl_exec($cliente);
    if ($cuerpo === false) throw new RuntimeException(curl_error($cliente));
    return [curl_getinfo($cliente, CURLINFO_HTTP_CODE), $cuerpo];
}
function verificar(bool $condicion, string $caso): void {
    echo ($condicion ? 'OK ' : 'ERROR ') . $caso . PHP_EOL;
    if (!$condicion) exit(1);
}
[$estado] = pedir($extension === 'php' ? 'index.html' : 'index.jsp');
verificar($estado === 200, 'Formulario disponible');
[$estado] = pedir("resultado.$extension");
verificar($estado === 302, 'Sin inscripción vuelve al formulario');
[$estado] = pedir("procesar.$extension");
verificar($estado === 405, 'Rechaza GET en procesamiento');
[$estado] = pedir("procesar.$extension", ['nombre' => '', 'correo' => 'invalido', 'taller' => 'otro']);
verificar($estado === 422, 'Rechaza campos inválidos');
[$estado] = pedir("procesar.$extension", ['nombre' => 'Ana', 'correo' => 'ana@example.com', 'taller' => 'otro']);
verificar($estado === 422, 'Rechaza taller manipulado');
[$estado] = pedir("procesar.$extension", ['nombre' => '<script>alert(1)</script>', 'correo' => 'ana@example.com', 'taller' => 'ceramica']);
verificar($estado === 302, 'Redirige después del envío válido');
[$estado, $cuerpo] = pedir("resultado.$extension");
verificar($estado === 200 && str_contains($cuerpo, 'ana@example.com'), 'Conserva inscripción en sesión');
verificar(!str_contains($cuerpo, '<script>') && str_contains($cuerpo, '&lt;script&gt;'), 'Muestra texto sin ejecutar HTML');
[$estado, $cuerpo] = pedir("resultado.$extension");
verificar($estado === 200 && str_contains($cuerpo, 'ana@example.com'), 'Recargar conserva la confirmación');
curl_close($cliente);
