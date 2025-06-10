<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\DashboardController;
use App\Models\Producto;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\VentasExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClientesExport;
use App\Exports\VendedoresExport;
use Illuminate\Http\Request;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos/{producto}', [ProductoController::class, 'show'])->name('productos.show');
    Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');

    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
    Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::get('/categorias/{categoria}', [CategoriaController::class, 'show'])->name('categorias.show');
    Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
    Route::put('/categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');
    Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');

    // Rutas para el módulo de usuarios
    Route::resource('usuarios', UsuarioController::class);

    // Rutas para el módulo de ventas
    Route::resource('ventas', VentaController::class);

    // Rutas para el módulo de reportes
    Route::get('/reporte/fecha', function() {
        return Inertia::render('Reportes/ReporteFecha', [
            'ventas' => \App\Models\Venta::all()
        ]);
    });
    Route::get('/reporte/cliente', function(\Illuminate\Http\Request $request) {
        $query = \App\Models\Venta::query();
        $clientes = $query->select('cliente_nombre', \DB::raw('SUM(total) as total'), \DB::raw('COUNT(*) as cantidad'))
            ->groupBy('cliente_nombre')
            ->get();
        return Inertia::render('Reportes/ReporteCliente', [
            'clientes' => $clientes
        ]);
    });
    Route::get('/reporte/vendedor', function(\Illuminate\Http\Request $request) {
        $query = \App\Models\Venta::query();
        $vendedores = $query->select('usuario_id', \DB::raw('SUM(total) as total'), \DB::raw('COUNT(*) as cantidad'))
            ->groupBy('usuario_id')
            ->with('usuario')
            ->get();
        return Inertia::render('Reportes/ReporteVendedor', [
            'vendedores' => $vendedores
        ]);
    });
    Route::resource('reportes', ReporteController::class);
    Route::resource('/reportes/fecha', ReporteController::class);

    Route::get('/pdf', function (\Illuminate\Http\Request $request) {
        $query = \App\Models\Venta::query();
        if ($request->filled('fechaInicio')) {
            $query->whereDate('fecha_registro', '>=', $request->fechaInicio);
        }
        if ($request->filled('fechaFin')) {
            $query->whereDate('fecha_registro', '<=', $request->fechaFin);
        }
        $ventas = $query->orderBy('fecha_registro', 'desc')->get();
        $total = $ventas->sum('total');
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf', compact('ventas', 'total'));
        return $pdf->stream('reporte_ventas.pdf');
    })->name('reportes.pdf');

    Route::get('/pdf-clientes', function (\Illuminate\Http\Request $request) {
        $query = \App\Models\Venta::query();
        if ($request->filled('busqueda')) {
            $query->where('cliente_nombre', 'like', '%' . $request->busqueda . '%');
        }
        $clientes = $query->select('cliente_nombre', \DB::raw('SUM(total) as total'), \DB::raw('COUNT(*) as cantidad'))
            ->groupBy('cliente_nombre')
            ->get();
        $total = $clientes->sum('total');
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf_clientes', compact('clientes', 'total'));
        return $pdf->stream('reporte_clientes.pdf');
    })->name('reportes.pdf_clientes');

    Route::get('/pdf-vendedores', function (\Illuminate\Http\Request $request) {
        $query = \App\Models\Venta::query();
        if ($request->filled('busqueda')) {
            $query->whereHas('usuario', function($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->busqueda . '%');
            });
        }
        $vendedores = $query->select('usuario_id', \DB::raw('SUM(total) as total'), \DB::raw('COUNT(*) as cantidad'))
            ->groupBy('usuario_id')
            ->with('usuario')
            ->get();
        $total = $vendedores->sum('total');
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf_vendedores', compact('vendedores', 'total'));
        return $pdf->stream('reporte_vendedores.pdf');
    })->name('reportes.pdf_vendedores');

    Route::get('/xls', function (\Illuminate\Http\Request $request) {
        $fechaInicio = $request->input('fechaInicio');
        $fechaFin = $request->input('fechaFin');
        return Excel::download(new VentasExport($fechaInicio, $fechaFin), 'ventas.xlsx');
    });

    Route::get('/xls-clientes', function (\Illuminate\Http\Request $request) {
        $busqueda = $request->input('busqueda');
        return Excel::download(new ClientesExport($busqueda), 'clientes.xlsx');
    });

    Route::get('/xls-vendedores', function (\Illuminate\Http\Request $request) {
        $busqueda = $request->input('busqueda');
        return Excel::download(new VendedoresExport($busqueda), 'vendedores.xlsx');
    });

});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
