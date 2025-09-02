<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Carrito de Compras - MT-15 Store</title>
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
            --success-green: #00C851;
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

        .cart-badge {
            background: var(--accent-red);
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 0.75rem;
            position: absolute;
            top: -5px;
            right: -10px;
        }

        /* Cart Container */
        .cart-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 5%;
        }

        .cart-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .cart-header h1 {
            font-size: 3rem;
            background: linear-gradient(45deg, #fff, var(--yamaha-blue));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1rem;
        }

        /* Cart Layout */
        .cart-layout {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 2rem;
        }

        /* Cart Items */
        .cart-items {
            background: rgba(255, 255, 255, 0.02);
            border-radius: 20px;
            padding: 2rem;
        }

        .empty-cart {
            text-align: center;
            padding: 4rem;
        }

        .empty-cart-icon {
            font-size: 5rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .empty-cart h2 {
            color: #888;
            margin-bottom: 2rem;
        }

        .btn-continue-shopping {
            display: inline-block;
            padding: 1rem 2rem;
            background: linear-gradient(45deg, var(--yamaha-blue), #0066FF);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-continue-shopping:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 51, 160, 0.5);
        }

        /* Cart Item */
        .cart-item {
            display: grid;
            grid-template-columns: 120px 1fr auto;
            gap: 1.5rem;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .cart-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: var(--yamaha-blue);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .cart-item:hover::before {
            transform: scaleY(1);
        }

        .cart-item:hover {
            background: rgba(255, 255, 255, 0.08);
            transform: translateX(5px);
        }

        .item-image {
            width: 120px;
            height: 120px;
            background: linear-gradient(45deg, #333, #555);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            overflow: hidden;
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .item-details {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .item-name {
            font-size: 1.3rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #fff;
        }

        .item-category {
            color: var(--yamaha-blue);
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .item-price {
            font-size: 1.2rem;
            color: #fff;
        }

        .item-controls {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            justify-content: space-between;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .qty-btn {
            width: 35px;
            height: 35px;
            background: transparent;
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .qty-btn:hover {
            background: var(--yamaha-blue);
        }

        .qty-input {
            width: 50px;
            height: 35px;
            background: transparent;
            border: none;
            color: white;
            text-align: center;
            font-size: 1rem;
        }

        .item-total {
            font-size: 1.3rem;
            font-weight: bold;
            color: var(--yamaha-blue);
        }

        .btn-remove {
            background: transparent;
            border: none;
            color: #ff4444;
            cursor: pointer;
            font-size: 1.2rem;
            padding: 0.5rem;
            transition: all 0.3s ease;
        }

        .btn-remove:hover {
            transform: scale(1.2);
            color: #ff0000;
        }

        /* Cart Summary */
        .cart-summary {
            background: linear-gradient(135deg, rgba(0, 51, 160, 0.1), rgba(0, 51, 160, 0.05));
            border: 1px solid rgba(0, 51, 160, 0.3);
            border-radius: 20px;
            padding: 2rem;
            position: sticky;
            top: 100px;
            height: fit-content;
        }

        .summary-title {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .summary-row:last-of-type {
            border-bottom: none;
            margin-bottom: 2rem;
            padding-top: 1rem;
        }

        .summary-label {
            color: #888;
        }

        .summary-value {
            font-weight: bold;
            color: #fff;
        }

        .summary-total {
            font-size: 1.8rem;
            color: var(--yamaha-blue);
        }

        .promo-code {
            margin-bottom: 2rem;
        }

        .promo-input-group {
            display: flex;
            gap: 0.5rem;
        }

        .promo-input {
            flex: 1;
            padding: 0.8rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            color: white;
        }

        .btn-apply {
            padding: 0.8rem 1.5rem;
            background: var(--yamaha-blue);
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-apply:hover {
            background: #0066FF;
        }

        .btn-checkout {
            width: 100%;
            padding: 1.2rem;
            background: linear-gradient(45deg, var(--success-green), #00FF00);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        .btn-checkout::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-checkout:hover::before {
            left: 100%;
        }

        .btn-checkout:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 200, 81, 0.5);
        }

        .security-badges {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .security-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #888;
            font-size: 0.9rem;
        }

        /* Actions Bar */
        .cart-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-clear {
            padding: 0.8rem 1.5rem;
            background: transparent;
            color: #ff4444;
            border: 2px solid #ff4444;
            border-radius: 50px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-clear:hover {
            background: #ff4444;
            color: white;
        }

        .btn-update {
            padding: 0.8rem 1.5rem;
            background: var(--yamaha-blue);
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-update:hover {
            background: #0066FF;
            transform: translateY(-2px);
        }

        /* Toast Notifications */
        .toast {
            position: fixed;
            top: 100px;
            right: 20px;
            padding: 1rem 1.5rem;
            background: var(--success-green);
            color: white;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
            transform: translateX(400px);
            transition: transform 0.3s ease;
            z-index: 2000;
        }

        .toast.show {
            transform: translateX(0);
        }

        /* Loading Overlay */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 3000;
        }

        .loading-overlay.active {
            display: flex;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top-color: var(--yamaha-blue);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .cart-layout {
                grid-template-columns: 1fr;
            }

            .cart-summary {
                position: static;
                margin-top: 2rem;
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .cart-item {
                grid-template-columns: 80px 1fr;
                gap: 1rem;
            }

            .item-image {
                width: 80px;
                height: 80px;
            }

            .item-controls {
                grid-column: 2;
                flex-direction: row;
                justify-content: space-between;
                margin-top: 1rem;
            }

            .cart-header h1 {
                font-size: 2rem;
            }
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
                        <span class="cart-badge">{{ $cartCount }}</span>
                        @endif
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Cart Container -->
    <div class="cart-container">
        <div class="cart-header">
            <h1>Carrito de Compras</h1>
            <p>Revisa tus productos antes de proceder al pago</p>
        </div>

        @if(empty($cart))
        <!-- Empty Cart -->
        <div class="empty-cart">
            <div class="empty-cart-icon">🛒</div>
            <h2>Tu carrito está vacío</h2>
            <p>¡Añade algunos productos increíbles para tu MT-15!</p>
            <a href="/#products" class="btn-continue-shopping">Continuar Comprando</a>
        </div>
        @else
        <!-- Cart with items -->
        <div class="cart-layout">
            <div class="cart-items">
                @foreach($cart as $item)
                <div class="cart-item" data-id="{{ $item['id'] }}">
                    <div class="item-image">
                        @if(isset($item['imagen']) && $item['imagen'])
                        <img src="{{ $item['imagen'] }}" alt="{{ $item['nombre'] }}">
                        @else
                        🏍️
                        @endif
                    </div>
                    <div class="item-details">
                        <h3 class="item-name">{{ $item['nombre'] }}</h3>
                        <div class="item-category">Accesorios MT-15</div>
                        <div class="item-price">${{ number_format($item['precio'], 2) }}</div>
                    </div>
                    <div class="item-controls">
                        <button class="btn-remove" onclick="removeItem({{ $item['id'] }})">🗑️</button>
                        <div class="quantity-controls">
                            <button class="qty-btn" onclick="updateQuantity({{ $item['id'] }}, -1)">-</button>
                            <input type="number" class="qty-input" value="{{ $item['cantidad'] }}" min="1" 
                                   id="qty-{{ $item['id'] }}" onchange="updateQuantity({{ $item['id'] }}, 0)">
                            <button class="qty-btn" onclick="updateQuantity({{ $item['id'] }}, 1)">+</button>
                        </div>
                        <div class="item-total">${{ number_format($item['precio'] * $item['cantidad'], 2) }}</div>
                    </div>
                </div>
                @endforeach

                <div class="cart-actions">
                    <button class="btn-clear" onclick="clearCart()">Vaciar Carrito</button>
                    <a href="/#products" class="btn-update">Seguir Comprando</a>
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="cart-summary">
                <h2 class="summary-title">Resumen del Pedido</h2>
                
                <div class="summary-row">
                    <span class="summary-label">Subtotal:</span>
                    <span class="summary-value" id="subtotal">${{ number_format($total, 2) }}</span>
                </div>
                
                <div class="summary-row">
                    <span class="summary-label">Envío:</span>
                    <span class="summary-value">
                        @if($total > 500)
                        <span style="color: var(--success-green);">GRATIS</span>
                        @else
                        $15.00
                        @endif
                    </span>
                </div>
                
                <div class="summary-row">
                    <span class="summary-label">Impuestos (19%):</span>
                    <span class="summary-value">${{ number_format($total * 0.19, 2) }}</span>
                </div>
                
                <div class="summary-row">
                    <span class="summary-label" style="font-size: 1.2rem;">Total:</span>
                    <span class="summary-total" id="total">
                        ${{ number_format($total + ($total > 500 ? 0 : 15) + ($total * 0.19), 2) }}
                    </span>
                </div>

                <div class="promo-code">
                    <label style="display: block; margin-bottom: 0.5rem; color: #888;">Código promocional</label>
                    <div class="promo-input-group">
                        <input type="text" class="promo-input" placeholder="Ingresa tu código">
                        <button class="btn-apply">Aplicar</button>
                    </div>
                </div>

                <button class="btn-checkout" onclick="proceedToCheckout()">
                    Proceder al Pago 🚀
                </button>

                <div class="security-badges">
                    <div class="security-badge">
                        🔒 Pago Seguro
                    </div>
                    <div class="security-badge">
                        ✓ SSL Encriptado
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toast"></div>

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner"></div>
    </div>

    <script>
        // CSRF Token for Laravel
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Show toast notification
        function showToast(message, type = 'success') {
            const toast = document.getElementById('toast');
            toast.textContent = message;
            toast.style.background = type === 'success' ? 'var(--success-green)' : 'var(--accent-red)';
            toast.classList.add('show');
            
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }

        // Show loading
        function showLoading() {
            document.getElementById('loadingOverlay').classList.add('active');
        }

        // Hide loading
        function hideLoading() {
            document.getElementById('loadingOverlay').classList.remove('active');
        }

        // Update quantity
        function updateQuantity(productId, change) {
            const input = document.getElementById(`qty-${productId}`);
            let newQuantity;
            
            if (change === 0) {
                newQuantity = parseInt(input.value);
            } else {
                newQuantity = parseInt(input.value) + change;
            }
            
            if (newQuantity < 1) {
                newQuantity = 1;
            }
            
            input.value = newQuantity;
            
            // Update in backend
            fetch('/carrito/actualizar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    id: productId,
                    cantidad: newQuantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload(); // Reload to update totals
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error al actualizar cantidad', 'error');
            });
        }

        // Remove item from cart
        function removeItem(productId) {
            if (confirm('¿Estás seguro de eliminar este producto?')) {
                showLoading();
                
                fetch('/carrito/eliminar', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        id: productId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast('Producto eliminado del carrito');
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Error al eliminar producto', 'error');
                })
                .finally(() => {
                    hideLoading();
                });
            }
        }

        // Clear entire cart
        function clearCart() {
            if (confirm('¿Estás seguro de vaciar todo el carrito?')) {
                showLoading();
                
                fetch('/carrito/vaciar', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast('Carrito vaciado');
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Error al vaciar carrito', 'error');
                })
                .finally(() => {
                    hideLoading();
                });
            }
        }

        // Proceed to checkout
        function proceedToCheckout() {
            showToast('Redirigiendo al pago...', 'success');
            showLoading();
            
            // Aquí puedes redirigir a tu página de checkout
            setTimeout(() => {
                alert('¡Aquí iría la integración con tu pasarela de pago!');
                hideLoading();
            }, 2000);
        }

        // Apply promo code
        document.querySelector('.btn-apply')?.addEventListener('click', function() {
            const promoCode = document.querySelector('.promo-input').value;
            
            if (promoCode.toUpperCase() === 'MT15') {
                showToast('¡Código aplicado! 15% de descuento', 'success');
                // Aquí aplicarías el descuento real
            } else if (promoCode) {
                showToast('Código inválido', 'error');
            }
        });

        // Animate cart items on load
        document.addEventListener('DOMContentLoaded', function() {
            const items = document.querySelectorAll('.cart-item');
            items.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateX(-20px)';
                
                setTimeout(() => {
                    item.style.transition = 'all 0.5s ease';
                    item.style.opacity = '1';
                    item.style.transform = 'translateX(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>