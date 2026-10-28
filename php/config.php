<?php
declare(strict_types=1);
session_set_cookie_params(['httponly' => true, 'samesite' => 'Lax', 'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off']);
session_start();
header('Cache-Control: no-store');
header('X-Content-Type-Options: nosniff');
const TALLERES = ['fotografia' => 'Fotografía urbana', 'ceramica' => 'Cerámica a mano', 'huerto' => 'Mi primer huerto'];
function escapar(string $valor): string { return htmlspecialchars($valor, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
