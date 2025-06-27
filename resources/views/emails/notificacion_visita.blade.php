<h1>¡Hola {{ $vendedor->nombre_vendedor }}!</h1>

<p>Se te ha asignado una nueva visita:</p>

<ul>
    <li>🧾 Cliente: {{ $clientes[0]->nombre_cliente }}</li>
    <li>📍 Barrio: {{ $clientes[0]->barrio }}</li>
    <li>📅 Fecha y hora: {{ \Carbon\Carbon::parse($clientes[0]->fecha_visita)->format('d/m/Y H:i') }}</li>
</ul>

<p>¡Te deseamos mucho éxito en tu visita!</p>
