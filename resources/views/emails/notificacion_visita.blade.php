<h1>¡Hola {{ $vendedor->nombre_vendedor }}!</h1>
<p>Estos son los clientes que debes visitar esta semana:</p>

<ul>
    @foreach($clientes as $cliente)
        <li>
            {{ $cliente->nombre_cliente }} - {{ $cliente->barrio }}  
            | 📅 Fecha y hora: {{ \Carbon\Carbon::parse($cliente->fecha_visita)->format('d/m/Y H:i') }}
        </li>
    @endforeach
</ul>

<p>¡Éxito en tus visitas!</p>

