<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" trimDirectiveWhitespaces="true" %>
<%@ include file="WEB-INF/funciones.jspf" %>
<%
request.setCharacterEncoding("UTF-8");
response.setHeader("Cache-Control", "no-store");
response.setHeader("X-Content-Type-Options", "nosniff");
List<String> errores = new ArrayList<>();
if (!"POST".equals(request.getMethod())) {
    response.setStatus(405);
    response.setHeader("Allow", "POST");
    errores.add("Envía tus datos desde el formulario.");
} else {
    String nombre = dato(request, "nombre");
    String correo = dato(request, "correo");
    String taller = dato(request, "taller");
    Map<String, String> talleres = Map.of("fotografia", "Fotografía urbana", "ceramica", "Cerámica a mano", "huerto", "Mi primer huerto");
    int longitud = nombre.codePointCount(0, nombre.length());
    if (longitud < 2 || longitud > 80) errores.add("El nombre debe tener entre 2 y 80 caracteres.");
    if (correo.length() > 120 || !correo.matches("^[A-Za-z0-9.!#$%&'*+/=?^_`{|}~-]+@[A-Za-z0-9](?:[A-Za-z0-9-]*[A-Za-z0-9])?(?:\\.[A-Za-z0-9](?:[A-Za-z0-9-]*[A-Za-z0-9])?)+$")) errores.add("Ingresa un correo válido de hasta 120 caracteres.");
    if (!talleres.containsKey(taller)) errores.add("Selecciona uno de los talleres disponibles.");
    if (errores.isEmpty()) {
        request.changeSessionId();
        Map<String, String> inscripcion = new LinkedHashMap<>();
        inscripcion.put("Participante", nombre);
        inscripcion.put("Correo", correo);
        inscripcion.put("Taller", talleres.get(taller));
        session.setAttribute("inscripcion", inscripcion);
        response.sendRedirect("resultado.jsp");
        return;
    }
    response.setStatus(422);
}
%>
<!doctype html><html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Revisa tus datos · Patio</title><link rel="stylesheet" href="estilos.css"></head><body><main class="resultado"><section class="tarjeta"><p class="etiqueta">PATIO / INSCRIPCIÓN</p><h1 style="font-size:40px">Revisa tus datos</h1><ul class="error"><% for (String error : errores) { %><li><%= escapar(error) %></li><% } %></ul><a class="boton" href="index.jsp">Volver al formulario</a></section></main></body></html>
