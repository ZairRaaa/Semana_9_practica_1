# Verificación y evidencias

Fecha: 28 de octubre de 2026.

## Ejecutado

- PHP 8.3.31: sintaxis de configuración, procesamiento y resultado sin errores.
- Servidor PHP con configuración mínima en 8091: nueve pruebas HTTP correctas.
- Estados comprobados: 200, 302, 405 y 422; sesión conservada y texto HTML escapado.
- Registro del servidor sin errores de aplicación durante estas pruebas.

## Pendiente

- Despliegue en Apache y arranque de MySQL para la guía.
- Compilar y probar JSP con Tomcat 10.1. Se encontró Tomcat 8.5.96 en XAMPP.
- Inspección visual en navegador, vista móvil y navegación por teclado.
- Capturas reales y publicación de commits en GitHub.

## Capturas para entregar

1. XAMPP con Apache/MySQL y consola de Tomcat 10.1, mostrando puertos.
2. Formulario PHP y confirmación de inscripción.
3. Formulario JSP y confirmación.
4. Network con POST 302 y GET 200, incluyendo Location.
5. Método rechazado 405 con Allow y datos inválidos 422.
6. Nueve pruebas correctas para cada servidor.
7. Registros de Apache (apache/logs/access.log y error.log) y Tomcat (logs/), sin borrar trazas.
8. Repositorio GitHub con los commits publicados.

Usar datos ficticios. Agregar nombres y apellidos del estudiante en la entrega. No se incluyen capturas simuladas como evidencia.
