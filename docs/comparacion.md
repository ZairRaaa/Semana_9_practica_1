# Comparación PHP y JSP

| Aspecto | PHP | JSP / Tomcat |
| --- | --- | --- |
| Ciclo | Analiza y ejecuta el script para responder; OPcache puede reutilizar código compilado. | Jasper traduce la JSP a servlet Java y lo compila cuando hace falta; el contenedor inicializa, atiende solicitudes y destruye la instancia. |
| Memoria | Los datos ordinarios del script no persisten entre solicitudes; los procesos pueden reutilizarse. | La JVM permanece activa y recolecta objetos; varias solicitudes pueden compartir un servlet. |
| Sesión | session_start y $_SESSION recuperan y guardan datos en el servidor. | session.setAttribute guarda datos identificados mediante JSESSIONID. |
| Despliegue | Archivos en Apache con PHP configurado. | Aplicación en webapps o WAR en un contenedor compatible. |
| Escalabilidad | Varios procesos o servidores; resolver el almacenamiento de sesiones entre nodos. | Varias instancias de Tomcat; resolver igualmente las sesiones entre nodos. |

HTTP no conserva por sí mismo los datos de solicitudes anteriores. La cookie identifica la sesión en el servidor. Tras el POST válido, una redirección 302 lleva a la confirmación; recargar repite el GET.

Fuentes oficiales consultadas: [sesiones PHP](https://www.php.net/manual/en/book.session.php), [uso básico](https://www.php.net/manual/en/session.examples.basic.php) y [Jasper de Tomcat 10.1](https://tomcat.apache.org/tomcat-10.1-doc/jasper-howto.html).

## Asistencia de IA

El código y la documentación se generaron con asistencia de IA. No se afirma que el 70 % haya sido escrito manualmente; ese requisito de la guía debe completarlo el estudiante.

/* IA: comparar ciclos PHP y JSP → Solución manual: pendiente de revisión y explicación del estudiante con las fuentes oficiales. */

/* IA: el servidor PHP no respondía con su configuración habitual → Solución manual: pendiente de revisión del estudiante; las pruebas pasaron con -n y mbstring, sin modificar php.ini. No se determinó la causa original. */
