<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



// Ruta principal (tu landing page actual)
Route::get('/', function () {
    return view('welcome');
});

// Ruta para detalles del producto
Route::get('/detalles/{id?}', function ($id = 1) {
    $productos = [
        1 => [
            'nombre' => 'Casco MT-15 Edition',
            'precio' => 299.99,
            'descripcion' => 'Casco edición especial MT-15 con diseño aerodinámico',
            'categoria' => 'Cascos'
        ],
        2 => [
            'nombre' => 'Escape Akrapovic',
            'precio' => 599.99,
            'descripcion' => 'Sistema de escape deportivo de alto rendimiento',
            'categoria' => 'Performance'
        ],
        3 => [
            'nombre' => 'Kit Performance',
            'precio' => 899.99,
            'descripcion' => 'Kit completo de mejoras de rendimiento para MT-15',
            'categoria' => 'Performance'
        ],
        4 => [
            'nombre' => 'Guantes Racing',
            'precio' => 149.99,
            'descripcion' => 'Guantes profesionales con protección de carbono',
            'categoria' => 'Equipamiento'
        ]
    ];
    
    $producto = $productos[$id] ?? $productos[1];
    
    return view('detalles', compact('producto', 'id'));
})->name('producto.detalles');