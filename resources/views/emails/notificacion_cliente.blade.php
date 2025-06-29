<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Notificación de Visita</title>
</head>
<body>
    <h2>¡Hola {{ $cliente->nombre_cliente }}!</h2>

    <p>Este es un aviso para informarte que se ha programado una visita a tu ubicación por parte de nuestro vendedor.</p>

    <ul>
        <li><strong>Vendedor asignado:</strong> {{ $cliente->vendedor->nombre_vendedor }} {{ $cliente->vendedor->apellido_paterno }}</li>
        <li><strong>Fecha y hora de visita:</strong> {{ \Carbon\Carbon::parse($visita->fecha_visita)->format('d/m/Y H:i') }}</li>
        <li><strong>Ubicación:</strong> {{ $cliente->barrio }}</li>
    </ul>

    <p>Si tienes alguna duda, por favor comunícate con nosotros.</p>

    <p>Gracias por confiar en nuestros servicios.</p>
</body>
</html>
