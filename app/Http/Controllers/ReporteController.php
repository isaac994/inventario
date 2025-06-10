<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::all(); // Asegúrate de tener datos
        return Inertia::render('Reportes/Index', [
            'ventas' => $ventas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function exportPdf()
{
    try {
        ini_set('max_execution_time', 120);
        ini_set('memory_limit', '512M');

        $ventas = Venta::orderBy('fecha_registro', 'desc')->get();
        $total=$ventas->sum('total');

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf', compact('ventas','total'));

        return $pdf->stream('reporte_ventas.pdf');

    } catch (\Exception $e) {
        return response($e->getMessage(), 500);
    }
}

}
