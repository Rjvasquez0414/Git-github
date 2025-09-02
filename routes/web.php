<?php

use Illuminate\Support\Facades\Route;

// Ruta principal
// Ruta principal (tu landing page actual)
Route::get('/', function () {
    $cartCount = session('cart') ? count(session('cart')) : 0;
    
    $productos = [
        ['id' => 1, 'nombre' => 'Casco MT-15 Edition', 'precio' => 299.99, 'imagen' => '/images/products/casco-mt15.png'],
        ['id' => 2, 'nombre' => 'Escape Akrapovic', 'precio' => 599.99, 'imagen' => '/images/products/escape.jpg.png'],
        ['id' => 3, 'nombre' => 'Kit Performance', 'precio' => 899.99, 'imagen' => '/images/products/kit.png'],
        ['id' => 4, 'nombre' => 'Guantes Racing', 'precio' => 149.99, 'imagen' => '/images/products/guantes.png']
    ];
    
    return view('welcome', compact('cartCount', 'productos'));
});

// Ruta para lista de compras
Route::get('/lista-compras', function () {
    $lista = session('lista_compras', []);
    return view('lista-compras', compact('lista'));
});

Route::post('/lista-compras/agregar', function () {
    $item = request('item');
    $lista = session('lista_compras', []);
    $lista[] = ['id' => uniqid(), 'item' => $item, 'completado' => false];
    session(['lista_compras' => $lista]);
    return redirect('/lista-compras');
});

Route::post('/lista-compras/eliminar/{id}', function ($id) {
    $lista = session('lista_compras', []);
    $lista = array_filter($lista, fn($item) => $item['id'] !== $id);
    session(['lista_compras' => array_values($lista)]);
    return redirect('/lista-compras');
});

// Ruta para detalles del producto
// Ruta para detalles del producto
Route::get('/detalles/{id?}', function ($id = 1) {
    $productos = [
        1 => [
            'nombre' => 'Casco MT-15 Edition',
            'precio' => 299.99,
            'descripcion' => 'Casco edición especial MT-15 con diseño aerodinámico',
            'categoria' => 'Cascos',
            'imagen' => '/images/products/casco-mt15.png'
        ],
        2 => [
            'nombre' => 'Escape Akrapovic',
            'precio' => 599.99,
            'descripcion' => 'Sistema de escape deportivo de alto rendimiento',
            'categoria' => 'Performance',
            'imagen' => '/images/products/escape.jpg.png'
        ],
        3 => [
            'nombre' => 'Kit Performance',
            'precio' => 899.99,
            'descripcion' => 'Kit completo de mejoras de rendimiento para MT-15',
            'categoria' => 'Performance',
            'imagen' => '/images/products/kit.png'
        ],
        4 => [
            'nombre' => 'Guantes Racing',
            'precio' => 149.99,
            'descripcion' => 'Guantes profesionales con protección de carbono',
            'categoria' => 'Equipamiento',
            'imagen' => '/images/products/guantes.png'
        ]
    ];
    
    $producto = $productos[$id] ?? $productos[1];
    $cartCount = session('cart') ? count(session('cart')) : 0;
    
    return view('detalles', compact('producto', 'id', 'cartCount'));
})->name('producto.detalles');

// Ruta para mostrar el carrito
Route::get('/carrito', function () {
    $cart = session('cart', []);
    $cartCount = count($cart);
    $total = 0;
    
    foreach ($cart as $item) {
        $total += $item['precio'] * $item['cantidad'];
    }
    
    return view('carrito', compact('cart', 'cartCount', 'total'));
})->name('carrito');

// Ruta para agregar al carrito
Route::post('/carrito/agregar', function () {
    $data = request()->json()->all();
    $cart = session('cart', []);
    
    $id = $data['id'];
    
    // Si el producto ya existe, aumentar cantidad
    if (isset($cart[$id])) {
        $cart[$id]['cantidad'] += $data['cantidad'] ?? 1;
    } else {
        // Agregar nuevo producto
        $cart[$id] = [
            'id' => $id,
            'nombre' => $data['nombre'],
            'precio' => $data['precio'],
            'imagen' => $data['imagen'] ?? '',
            'cantidad' => $data['cantidad'] ?? 1
        ];
    }
    
    session(['cart' => $cart]);
    
    return response()->json([
        'success' => true,
        'cartCount' => count($cart),
        'message' => 'Producto agregado al carrito'
    ]);
})->name('carrito.agregar');

// Ruta para actualizar cantidad
Route::post('/carrito/actualizar', function () {
    $data = request()->json()->all();
    $cart = session('cart', []);
    
    $id = $data['id'];
    
    if (isset($cart[$id])) {
        $cart[$id]['cantidad'] = $data['cantidad'];
        
        if ($cart[$id]['cantidad'] <= 0) {
            unset($cart[$id]);
        }
    }
    
    session(['cart' => $cart]);
    
    return response()->json([
        'success' => true,
        'cartCount' => count($cart)
    ]);
})->name('carrito.actualizar');

// Ruta para eliminar del carrito
Route::post('/carrito/eliminar', function () {
    $data = request()->json()->all();
    $cart = session('cart', []);
    
    $id = $data['id'];
    
    if (isset($cart[$id])) {
        unset($cart[$id]);
    }
    
    session(['cart' => $cart]);
    
    return response()->json([
        'success' => true,
        'cartCount' => count($cart)
    ]);
})->name('carrito.eliminar');

// Ruta para vaciar el carrito
Route::post('/carrito/vaciar', function () {
    session()->forget('cart');
    
    return response()->json([
        'success' => true,
        'cartCount' => 0
    ]);
})->name('carrito.vaciar');
})->name('carrito.vaciar');
