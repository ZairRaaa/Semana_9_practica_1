<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" trimDirectiveWhitespaces="true" %>
<%@ include file="WEB-INF/funciones.jspf" %>
<%
response.setHeader("Cache-Control", "no-store");
response.setHeader("X-Content-Type-Options", "nosniff");
Map<String, String> inscripcion = (Map<String, String>) session.getAttribute("inscripcion");
if (inscripcion == null) { response.sendRedirect("index.jsp"); return; }
%>
<!doctype html><html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Ya estás dentro · Patio</title><link rel="stylesheet" href="estilos.css"></head><body><main class="resultado"><section class="tarjeta"><p class="etiqueta">PATIO / INSCRIPCIÓN COMPLETADA</p><h1 style="font-size:44px">¡A crear!</h1><p>Tu inscripción de demostración está registrada en esta sesión.</p><dl><% for (Map.Entry<String, String> campo : inscripcion.entrySet()) { %><dt><%= escapar(campo.getKey()) %></dt><dd><%= escapar(campo.getValue()) %></dd><% } %></dl><a class="boton" href="index.jsp">Explorar otro taller</a></section></main></body></html>
