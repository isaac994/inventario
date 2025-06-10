<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Ventas</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; }
        th { background: #eee; }
    </style>
</head>
<body>

    <h2>Reporte de Ventas</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $venta->cliente_nombre }}</td>
                    <td>{{ $venta->total }}</td>
                    <td>{{ $venta->fecha_registro }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h1>
        total:{{ $total }}
    </h1>

</body>
</html>
