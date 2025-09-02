<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $producto['nombre'] ?? 'Producto' }} - MT-15 Store</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --yamaha-blue: #0033A0;
            --yamaha-dark: #1a1a1a;
            --accent-red: #FF0000;
            --text-light: #f0f0f0;
            --gradient-dark: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        }

        body {
            font-family: 'Arial', sans-serif;
            background: var(--yamaha-dark);
            color: var(--text-light);
            min-height: 100vh;
        }

        /* Navbar */
        nav {
            background: rgba(26, 26, 26, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 5%;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1400px;
            margin: 0 auto;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            background: linear-gradient(45deg, var(--yamaha-blue), #0066FF);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-decoration: none;
            display: inline-block;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
            align-items: center;
        }

        .nav-links a {
            color: var(--text-light);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            padding: 0.5rem 0;
        }

        .nav-links a:hover {
            color: var(--yamaha-blue);
        }

        /* Breadcrumb */
        .breadcrumb {
            padding: 2rem 5%;
            max-width: 1400px;
            margin: 0 auto;
        }

        .breadcrumb a {
            color: #888;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .breadcrumb a:hover {
            color: var(--yamaha-blue);
        }

        .breadcrumb span {
            color: #666;
            margin: 0 0.5rem;
        }

        /* Product Detail Container */
        .product-detail {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem 5%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: start;
        }

        /* Image Gallery */
        .product-gallery {
            position: sticky;
            top: 100px;
        }

        .main-image {
            width: 100%;
            height: 500px;
            background: linear-gradient(135deg, #2d2d2d, #1a1a1a);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 5rem;
            position: relative;
            overflow: hidden;
        }

        .main-image::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, var(--yamaha-blue) 0%, transparent 70%);
            opacity: 0.1;
            animation: pulse 3s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }

        .thumbnail-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            margin-top: 1rem;
        }

        .thumbnail {
            height: 80px;
            background: linear-gradient(135deg, #333, #222);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            border: 2px solid transparent;
        }

        .thumbnail:hover {
            border-color: var(--yamaha-blue);
            transform: scale(1.05);
        }

        .thumbnail.active {
            border-color: var(--yamaha-blue);
            box-shadow: 0 0 20px rgba(0, 51, 160, 0.5);
        }

        /* Product Info */
        .product-info {
            padding-top: 2rem;
        }

        .product-category {
            color: var(--yamaha-blue);
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .product-title {
            font-size: 3rem;
            margin-bottom: 1rem;
            line-height: 1.2;
            background: linear-gradient(45deg, #fff, #ddd);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .rating {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            margin-bottom: 2rem;
        }

        .stars {
            color: #FFD700;
            font-size: 1.2rem;
        }

        .rating-text {
            color: #888;
            margin-left: 1rem;
        }

        .price-section {
            margin-bottom: 2rem;
            padding: 2rem;
            background: rgba(0, 51, 160, 0.1);
            border-radius: 15px;
            border: 1px solid rgba(0, 51, 160, 0.3);
        }

        .price-label {
            color: #888;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .price {
            font-size: 3rem;
            font-weight: bold;
            color: var(--yamaha-blue);
            margin-bottom: 0.5rem;
        }

        .price-disclaimer {
            color: #666;
            font-size: 0.9rem;
        }

        .product-description {
            margin-bottom: 2rem;
            line-height: 1.8;
            color: #ccc;
        }

        /* Product Options */
        .product-options {
            margin-bottom: 2rem;
        }

        .option-group {
            margin-bottom: 1.5rem;
        }

        .option-label {
            font-weight: bold;
            margin-bottom: 0.8rem;
            color: #fff;
        }

        .color-options {
            display: flex;
            gap: 1rem;
        }

        .color-option {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            border: 3px solid transparent;
            transition: all 0.3s ease;
            position: relative;
        }

        .color-option:hover {
            transform: scale(1.1);
        }

        .color-option.selected {
            border-color: var(--yamaha-blue);
            box-shadow: 0 0 15px rgba(0, 51, 160, 0.5);
        }

        .color-option.selected::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-weight: bold;
        }

        .size-options {
            display: flex;
            gap: 1rem;
        }

        .size-option {
            padding: 0.8rem 1.5rem;
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .size-option:hover {
            border-color: var(--yamaha-blue);
            background: rgba(0, 51, 160, 0.1);
        }

        .size-option.selected {
            background: var(--yamaha-blue);
            border-color: var(--yamaha-blue);
        }

        /* Quantity Selector */
        .quantity-selector {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            overflow: hidden;
        }

        .qty-btn {
            width: 40px;
            height: 40px;
            background: transparent;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .qty-btn:hover {
            background: rgba(0, 51, 160, 0.3);
        }

        .qty-input {
            width: 60px;
            height: 40px;
            background: transparent;
            border: none;
            color: white;
            text-align: center;
            font-size: 1.2rem;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .btn {
            flex: 1;
            padding: 1.2rem;
            border: none;
            border-radius: 50px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
            position: relative;
            overflow: hidden;
        }

        .btn-primary {
            background: linear-gradient(45deg, var(--yamaha-blue), #0066FF);
            color: white;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 51, 160, 0.5);
        }

        .btn-secondary {
            background: transparent;
            color: var(--yamaha-blue);
            border: 2px solid var(--yamaha-blue);
        }

        .btn-secondary:hover {
            background: var(--yamaha-blue);
            color: white;
            transform: translateY(-2px);
        }

        .btn-icon {
            width: 50px;
            height: 50px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            flex: none;
            font-size: 1.5rem;
        }

        /* Features List */
        .features-list {
            list-style: none;
            margin-bottom: 2rem;
        }

        .features-list li {
            padding: 0.8rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .features-list li::before {
            content: '✓';
            color: var(--yamaha-blue);
            font-weight: bold;
            font-size: 1.2rem;
        }

        /* Shipping Info */
        .shipping-info {
            background: rgba(0, 255, 0, 0.05);
            border: 1px solid rgba(0, 255, 0, 0.2);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .shipping-info h4 {
            color: #00FF00;
            margin-bottom: 0.5rem;
        }

<<<<<<< HEAD
=======
        /* Tabs Section */
        .tabs-section {
            max-width: 1400px;
            margin: 4rem auto;
            padding: 0 5%;
        }

        .tabs {
            display: flex;
            gap: 1rem;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 2rem;
        }

        .tab {
            padding: 1rem 2rem;
            background: transparent;
            border: none;
            color: #888;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            font-size: 1.1rem;
        }

        .tab::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--yamaha-blue);
            transition: width 0.3s ease;
        }

        .tab:hover {
            color: white;
        }

        .tab.active {
            color: var(--yamaha-blue);
        }

        .tab.active::after {
            width: 100%;
        }

        .tab-content {
            padding: 2rem;
            background: rgba(255, 255, 255, 0.02);
            border-radius: 15px;
            min-height: 300px;
        }

        .specs-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
        }

        .spec-item {
            display: flex;
            justify-content: space-between;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
        }

        .spec-label {
            color: #888;
        }

        .spec-value {
            font-weight: bold;
            color: var(--yamaha-blue);
        }

        /* Related Products */
        .related-products {
            max-width: 1400px;
            margin: 4rem auto;
            padding: 0 5%;
        }

        .related-products h2 {
            font-size: 2.5rem;
            margin-bottom: 2rem;
            text-align: center;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .related-card {
            background: linear-gradient(135deg, #1a1a1a, #2d2d2d);
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .related-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 51, 160, 0.3);
        }

        .related-image {
            height: 200px;
            background: linear-gradient(45deg, #333, #555);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
        }

        .related-info {
            padding: 1.5rem;
        }

        .related-name {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .related-price {
            font-size: 1.5rem;
            color: var(--yamaha-blue);
            font-weight: bold;
        }

>>>>>>> desarrollo
        /* Responsive */
        @media (max-width: 1024px) {
            .product-detail {
                grid-template-columns: 1fr;
            }

            .product-gallery {
                position: static;
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .product-title {
                font-size: 2rem;
            }

            .price {
                font-size: 2rem;
            }

            .action-buttons {
                flex-direction: column;
            }
<<<<<<< HEAD
=======

            .specs-grid {
                grid-template-columns: 1fr;
            }

            .tabs {
                flex-direction: column;
            }
>>>>>>> desarrollo
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav>
        <div class="nav-container">
            <a href="/" class="logo">MT-15 STORE</a>
            <ul class="nav-links">
                <li><a href="/">Inicio</a></li>
                <li><a href="/#products">Productos</a></li>
                <li><a href="/#contact">Contacto</a></li>
                <li style="position: relative;">
                    <a href="/carrito" style="background: var(--accent-red); padding: 0.5rem 1.5rem; border-radius: 25px;">
                        🛒 Carrito
                        @if($cartCount > 0)
                        <span style="background: var(--accent-red); color: white; border-radius: 50%; padding: 2px 6px; font-size: 0.75rem; position: absolute; top: -5px; right: -10px;">{{ $cartCount }}</span>
                        @endif
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="/">Inicio</a>
        <span>/</span>
        <a href="/#products">Productos</a>
        <span>/</span>
        <span style="color: white;">{{ $producto['nombre'] ?? 'Producto' }}</span>
    </div>

    <!-- Product Detail -->
    <div class="product-detail">
        <!-- Gallery -->
        <div class="product-gallery">
            <div class="main-image">
<<<<<<< HEAD
                @if(isset($producto['imagen']) && $producto['imagen'])
                <img src="{{ $producto['imagen'] }}" alt="{{ $producto['nombre'] }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                🏍️
                @endif
=======
                🏍️
>>>>>>> desarrollo
            </div>
            <div class="thumbnail-grid">
                <div class="thumbnail active">📷</div>
                <div class="thumbnail">🎯</div>
                <div class="thumbnail">⚡</div>
                <div class="thumbnail">🔧</div>
            </div>
        </div>

        <!-- Product Info -->
        <div class="product-info">
            <div class="product-category">{{ $producto['categoria'] ?? 'CATEGORÍA' }}</div>
            <h1 class="product-title">{{ $producto['nombre'] ?? 'Nombre del Producto' }}</h1>
            
            <div class="rating">
                <div class="stars">⭐⭐⭐⭐⭐</div>
                <span class="rating-text">4.8 (234 reseñas)</span>
            </div>

            <div class="price-section">
                <div class="price-label">Precio especial</div>
                <div class="price">${{ $producto['precio'] ?? '0.00' }}</div>
                <div class="price-disclaimer">IVA incluido - Envío calculado al finalizar</div>
            </div>

            <div class="product-description">
                <p>{{ $producto['descripcion'] ?? 'Descripción del producto' }}</p>
<<<<<<< HEAD
                <p>Diseñado específicamente para la Yamaha MT-15, este producto combina calidad premium con el estilo agresivo que caracteriza a la línea MT.</p>
=======
                <p>Diseñado específicamente para la Yamaha MT-15, este producto combina calidad premium con el estilo agresivo que caracteriza a la línea MT. Fabricado con los más altos estándares de calidad para garantizar durabilidad y rendimiento excepcional.</p>
>>>>>>> desarrollo
            </div>

            <!-- Product Options -->
            <div class="product-options">
                <div class="option-group">
                    <div class="option-label">Color:</div>
                    <div class="color-options">
                        <div class="color-option selected" style="background: #0033A0;"></div>
                        <div class="color-option" style="background: #FF0000;"></div>
                        <div class="color-option" style="background: #000;"></div>
                        <div class="color-option" style="background: #FFD700;"></div>
                    </div>
                </div>

                <div class="option-group">
                    <div class="option-label">Talla:</div>
                    <div class="size-options">
                        <div class="size-option">S</div>
                        <div class="size-option selected">M</div>
                        <div class="size-option">L</div>
                        <div class="size-option">XL</div>
                    </div>
                </div>
            </div>

            <!-- Quantity -->
            <div class="quantity-selector">
                <span>Cantidad:</span>
                <div class="quantity-controls">
                    <button class="qty-btn" onclick="decrementQty()">-</button>
                    <input type="number" class="qty-input" value="1" min="1" id="quantity">
                    <button class="qty-btn" onclick="incrementQty()">+</button>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <button class="btn btn-primary" onclick="addToCart()">
                    Añadir al Carrito
                </button>
                <button class="btn btn-secondary">
                    Comprar Ahora
                </button>
                <button class="btn btn-secondary btn-icon">
                    ❤️
                </button>
            </div>

            <!-- Shipping Info -->
            <div class="shipping-info">
                <h4>✓ Envío Gratis</h4>
                <p>En compras superiores a $500. Entrega estimada: 3-5 días hábiles.</p>
            </div>

            <!-- Features -->
            <ul class="features-list">
                <li>Garantía oficial Yamaha de 1 año</li>
                <li>Compatible con todos los modelos MT-15</li>
                <li>Instalación profesional disponible</li>
                <li>Soporte técnico 24/7</li>
            </ul>
        </div>
    </div>

<<<<<<< HEAD
=======
    <!-- Tabs Section -->
    <div class="tabs-section">
        <div class="tabs">
            <button class="tab active" onclick="showTab('description')">Descripción</button>
            <button class="tab" onclick="showTab('specs')">Especificaciones</button>
            <button class="tab" onclick="showTab('reviews')">Reseñas</button>
            <button class="tab" onclick="showTab('shipping')">Envío</button>
        </div>
        
        <div class="tab-content" id="tab-content">
            <div id="description-content">
                <h3>Descripción Detallada</h3>
                <p>Este producto ha sido diseñado específicamente para los entusiastas de la Yamaha MT-15 que buscan mejorar su experiencia de conducción. Cada detalle ha sido cuidadosamente pensado para ofrecer el máximo rendimiento y estilo.</p>
                <br>
                <p>Características principales:</p>
                <ul style="margin-left: 2rem; margin-top: 1rem;">
                    <li>Material de alta calidad resistente a condiciones extremas</li>
                    <li>Diseño aerodinámico que mejora el rendimiento</li>
                    <li>Fácil instalación con manual incluido</li>
                    <li>Certificación de seguridad internacional</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <div class="related-products">
        <h2>Productos Relacionados</h2>
        <div class="related-grid">
            <a href="/detalles/1" class="related-card">
                <div class="related-image">🪖</div>
                <div class="related-info">
                    <div class="related-name">Casco MT-15 Edition</div>
                    <div class="related-price">$299.99</div>
                </div>
            </a>
            <a href="/detalles/2" class="related-card">
                <div class="related-image">🔧</div>
                <div class="related-info">
                    <div class="related-name">Escape Akrapovic</div>
                    <div class="related-price">$599.99</div>
                </div>
            </a>
            <a href="/detalles/3" class="related-card">
                <div class="related-image">⚙️</div>
                <div class="related-info">
                    <div class="related-name">Kit Performance</div>
                    <div class="related-price">$899.99</div>
                </div>
            </a>
            <a href="/detalles/4" class="related-card">
                <div class="related-image">🧤</div>
                <div class="related-info">
                    <div class="related-name">Guantes Racing</div>
                    <div class="related-price">$149.99</div>
                </div>
            </a>
        </div>
    </div>

>>>>>>> desarrollo
    <script>
        // Quantity controls
        function incrementQty() {
            const input = document.getElementById('quantity');
            input.value = parseInt(input.value) + 1;
        }

        function decrementQty() {
            const input = document.getElementById('quantity');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }

        // Add to cart
        function addToCart() {
            const quantity = parseInt(document.getElementById('quantity').value);
            
            fetch('/carrito/agregar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    id: {{ $id }},
                    nombre: '{{ $producto["nombre"] }}',
                    precio: {{ $producto["precio"] }},
                    imagen: '{{ $producto["imagen"] ?? "" }}',
                    cantidad: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Actualizar el contador del carrito
                    const cartBadge = document.querySelector('.nav-links a[href="/carrito"]');
                    if (cartBadge) {
                        cartBadge.innerHTML = `🛒 Carrito <span style="background: var(--accent-red); color: white; border-radius: 50%; padding: 2px 6px; font-size: 0.75rem; position: absolute; top: -5px; right: -10px;">${data.cartCount}</span>`;
                    }
                    
                    // Mostrar confirmación
                    const btn = event.target;
                    const originalText = btn.textContent;
                    btn.textContent = '✓ Añadido al Carrito';
                    btn.style.background = 'linear-gradient(45deg, #00C851, #00FF00)';
                    
                    setTimeout(() => {
                        btn.textContent = originalText;
                        btn.style.background = '';
                    }, 2000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al añadir al carrito');
            });
        }

        // Color selection
        document.querySelectorAll('.color-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.color-option').forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
            });
        });

        // Size selection
        document.querySelectorAll('.size-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.size-option').forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
            });
        });

        // Thumbnail gallery
        document.querySelectorAll('.thumbnail').forEach(thumb => {
            thumb.addEventListener('click', function() {
                document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
<<<<<<< HEAD
            });
        });
=======
                // Here you would change the main image
            });
        });

        // Tabs functionality
        function showTab(tabName) {
            // Update active tab
            document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
            event.target.classList.add('active');

            // Update content
            const content = document.getElementById('tab-content');
            
            switch(tabName) {
                case 'description':
                    content.innerHTML = `
                        <div id="description-content">
                            <h3>Descripción Detallada</h3>
                            <p>Este producto ha sido diseñado específicamente para los entusiastas de la Yamaha MT-15 que buscan mejorar su experiencia de conducción. Cada detalle ha sido cuidadosamente pensado para ofrecer el máximo rendimiento y estilo.</p>
                            <br>
                            <p>Características principales:</p>
                            <ul style="margin-left: 2rem; margin-top: 1rem;">
                                <li>Material de alta calidad resistente a condiciones extremas</li>
                                <li>Diseño aerodinámico que mejora el rendimiento</li>
                                <li>Fácil instalación con manual incluido</li>
                                <li>Certificación de seguridad internacional</li>
                            </ul>
                        </div>
                    `;
                    break;
                case 'specs':
                    content.innerHTML = `
                        <div class="specs-grid">
                            <div class="spec-item">
                                <span class="spec-label">Material</span>
                                <span class="spec-value">Fibra de carbono</span>
                            </div>
                            <div class="spec-item">
                                <span class="spec-label">Peso</span>
                                <span class="spec-value">1.2 kg</span>
                            </div>
                            <div class="spec-item">
                                <span class="spec-label">Compatibilidad</span>
                                <span class="spec-value">MT-15 2019-2024</span>
                            </div>
                            <div class="spec-item">
                                <span class="spec-label">Certificación</span>
                                <span class="spec-value">ECE 22.06</span>
                            </div>
                            <div class="spec-item">
                                <span class="spec-label">Garantía</span>
                                <span class="spec-value">1 año</span>
                            </div>
                            <div class="spec-item">
                                <span class="spec-label">País de origen</span>
                                <span class="spec-value">Japón</span>
                            </div>
                        </div>
                    `;
                    break;
                case 'reviews':
                    content.innerHTML = `
                        <div>
                            <h3>Reseñas de Clientes</h3>
                            <div style="margin-top: 2rem;">
                                <div style="padding: 1.5rem; background: rgba(255,255,255,0.05); border-radius: 10px; margin-bottom: 1rem;">
                                    <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                                        <strong>Carlos M.</strong>
                                        <span style="color: #FFD700;">⭐⭐⭐⭐⭐</span>
                                    </div>
                                    <p>Excelente producto, superó mis expectativas. La calidad es premium y la instalación fue muy sencilla.</p>
                                </div>
                                <div style="padding: 1.5rem; background: rgba(255,255,255,0.05); border-radius: 10px; margin-bottom: 1rem;">
                                    <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                                        <strong>Ana R.</strong>
                                        <span style="color: #FFD700;">⭐⭐⭐⭐</span>
                                    </div>
                                    <p>Muy buen producto, solo tardó un poco más de lo esperado en llegar, pero valió la pena la espera.</p>
                                </div>
                            </div>
                        </div>
                    `;
                    break;
                case 'shipping':
                    content.innerHTML = `
                        <div>
                            <h3>Información de Envío</h3>
                            <div style="margin-top: 2rem;">
                                <p><strong>Envío Estándar:</strong> 3-5 días hábiles - GRATIS en compras mayores a $500</p>
                                <p><strong>Envío Express:</strong> 1-2 días hábiles - $15.99</p>
                                <p><strong>Envío Internacional:</strong> 7-15 días hábiles - Tarifa variable según destino</p>
                                <br>
                                <h4>Política de Devoluciones</h4>
                                <p>Aceptamos devoluciones dentro de los 30 días posteriores a la compra. El producto debe estar en su empaque original y sin usar.</p>
                            </div>
                        </div>
                    `;
                    break;
            }
        }
>>>>>>> desarrollo
    </script>
</body>
</html>