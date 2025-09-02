<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yamaha MT-15 Store - The Dark Side of Japan</title>
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
            overflow-x: hidden;
        }

        /* Navbar */
        nav {
            position: fixed;
            width: 100%;
            background: rgba(26, 26, 26, 0.95);
            backdrop-filter: blur(10px);
            z-index: 1000;
            padding: 1rem 5%;
            transition: all 0.3s ease;
        }

        nav.scrolled {
            padding: 0.5rem 5%;
            background: rgba(0, 0, 0, 0.98);
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
            animation: glow 2s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from { filter: drop-shadow(0 0 5px rgba(0, 51, 160, 0.5)); }
            to { filter: drop-shadow(0 0 20px rgba(0, 51, 160, 0.8)); }
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            color: var(--text-light);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            padding: 0.5rem 0;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--yamaha-blue);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(ellipse at center, #2d2d2d 0%, #000 100%);
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%230033A0" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,186.7C384,213,480,235,576,213.3C672,192,768,128,864,128C960,128,1056,192,1152,213.3C1248,235,1344,213,1392,202.7L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat;
            background-size: cover;
            animation: wave 20s linear infinite;
            opacity: 0.3;
        }

        @keyframes wave {
            0% { transform: translateX(0) translateY(0); }
            100% { transform: translateX(-50%) translateY(-50%); }
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 0 2rem;
        }

        .hero h1 {
            font-size: clamp(3rem, 8vw, 6rem);
            font-weight: 900;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 3px;
            background: linear-gradient(45deg, #fff, var(--yamaha-blue));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: slideInDown 1s ease-out;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-subtitle {
            font-size: 1.5rem;
            color: #888;
            margin-bottom: 2rem;
            animation: fadeIn 1.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .cta-button {
            display: inline-block;
            padding: 1rem 3rem;
            background: linear-gradient(45deg, var(--yamaha-blue), #0066FF);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            animation: pulse 2s infinite;
            position: relative;
            overflow: hidden;
        }

        .cta-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }

        .cta-button:hover::before {
            left: 100%;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 51, 160, 0.5);
        }

        /* Moto Showcase */
        .moto-showcase {
            position: absolute;
            bottom: 10%;
            right: 5%;
            width: 500px;
            height: 300px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 200"><rect fill="%23333" x="100" y="80" width="200" height="40" rx="5"/><circle fill="%23222" cx="80" cy="150" r="30"/><circle fill="%23222" cx="320" cy="150" r="30"/><path fill="%230033A0" d="M100,80 L150,60 L250,60 L300,80 L280,120 L120,120 Z"/><rect fill="%23FF0000" x="140" y="70" width="120" height="5"/></svg>') no-repeat center;
            background-size: contain;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        /* Features Section */
        .features {
            padding: 5rem 5%;
            background: var(--gradient-dark);
        }

        .features-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .features h2 {
            text-align: center;
            font-size: 3rem;
            margin-bottom: 3rem;
            text-transform: uppercase;
            background: linear-gradient(45deg, var(--yamaha-blue), #fff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(0, 51, 160, 0.3);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(0, 51, 160, 0.1) 0%, transparent 70%);
            transform: rotate(45deg);
            transition: all 0.5s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            border-color: var(--yamaha-blue);
            box-shadow: 0 20px 40px rgba(0, 51, 160, 0.3);
        }

        .feature-card:hover::before {
            transform: rotate(45deg) translate(50%, 50%);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1rem;
            background: linear-gradient(45deg, var(--yamaha-blue), #0066FF);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--yamaha-blue);
        }

        /* Products Section */
        .products {
            padding: 5rem 5%;
            background: #0a0a0a;
        }

        .products h2 {
            text-align: center;
            font-size: 3rem;
            margin-bottom: 3rem;
            text-transform: uppercase;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .product-card {
            background: linear-gradient(135deg, #1a1a1a, #2d2d2d);
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
        }

        .product-card::after {
            content: 'NUEVO';
            position: absolute;
            top: 20px;
            right: -30px;
            background: var(--accent-red);
            color: white;
            padding: 5px 40px;
            transform: rotate(45deg);
            font-size: 0.8rem;
            font-weight: bold;
        }

        .product-image {
            height: 200px;
            background: linear-gradient(45deg, #333, #555);
            position: relative;
            overflow: hidden;
        }

        .product-image::before {
            content: '🏍️';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 4rem;
            opacity: 0.5;
        }

        .product-info {
            padding: 1.5rem;
        }

        .product-name {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
            color: var(--yamaha-blue);
        }

        .product-price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #fff;
            margin-bottom: 1rem;
        }

        .product-button {
            width: 100%;
            padding: 0.8rem;
            background: var(--yamaha-blue);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        .product-button:hover {
            background: #0066FF;
            transform: scale(1.05);
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 51, 160, 0.4);
        }

        /* Newsletter */
        .newsletter {
            padding: 4rem 5%;
            background: linear-gradient(135deg, var(--yamaha-blue), #0066FF);
            text-align: center;
        }

        .newsletter h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .newsletter-form {
            max-width: 500px;
            margin: 2rem auto;
            display: flex;
            gap: 1rem;
        }

        .newsletter-form input {
            flex: 1;
            padding: 1rem;
            border: none;
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.9);
            color: #333;
        }

        .newsletter-form button {
            padding: 1rem 2rem;
            background: var(--yamaha-dark);
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .newsletter-form button:hover {
            background: #000;
            transform: scale(1.05);
        }

        /* Footer */
        footer {
            padding: 3rem 5%;
            background: #000;
            text-align: center;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .social-links a {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: var(--yamaha-blue);
            transform: rotate(360deg) scale(1.1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .hero h1 {
                font-size: 3rem;
            }
            
            .moto-showcase {
                width: 300px;
                height: 180px;
            }
            
            .newsletter-form {
                flex-direction: column;
            }
        }

        /* Animations on scroll */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.5s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav id="navbar">
        <div class="nav-container">
            <div class="logo">MT-15 STORE</div>
            <ul class="nav-links">
                <li><a href="#home">Inicio</a></li>
                <li><a href="#features">Características</a></li>
                <li><a href="#products">Productos</a></li>
                <li><a href="/lista-compras">Lista de Compras</a></li>
                <li><a href="#contact">Contacto</a></li>
                <li style="position: relative;">
                    <a href="/carrito" style="background: var(--accent-red); padding: 0.5rem 1.5rem; border-radius: 25px;">
                        🛒 Carrito
                        @if(isset($cartCount) && $cartCount > 0)
                        <span style="background: var(--accent-red); color: white; border-radius: 50%; padding: 2px 6px; font-size: 0.75rem; position: absolute; top: -5px; right: -10px;">{{ $cartCount }}</span>
                        @endif
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Yamaha MT-15</h1>
            <p class="hero-subtitle">The Dark Side of Japan</p>
            <a href="#products" class="cta-button">Explorar Productos</a>
        </div>
        <div class="moto-showcase"></div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="features-container">
            <h2>¿Por qué MT-15?</h2>
            <div class="features-grid">
                <div class="feature-card fade-in">
                    <div class="feature-icon">⚡</div>
                    <h3>Potencia Pura</h3>
                    <p>Motor de 155cc con tecnología VVA que entrega 18.4 HP de adrenalina pura.</p>
                </div>
                <div class="feature-card fade-in">
                    <div class="feature-icon">🎯</div>
                    <h3>Diseño Agresivo</h3>
                    <p>Estilo streetfighter inspirado en la MT-09 con líneas afiladas y presencia imponente.</p>
                </div>
                <div class="feature-card fade-in">
                    <div class="feature-icon">🛡️</div>
                    <h3>Tecnología Avanzada</h3>
                    <p>Sistema de frenos ABS, iluminación LED completa y panel digital multifunción.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="products" id="products">
        <h2>Productos Destacados</h2>
        <div class="products-grid">
            @if(isset($productos))
                @foreach($productos as $producto)
                <div class="product-card fade-in">
                    <div class="product-image" style="background-image: url('{{ $producto['imagen'] ?? '' }}'); background-size: cover; background-position: center;"></div>
                    <div class="product-info">
                        <h3 class="product-name">{{ $producto['nombre'] }}</h3>
                        <p class="product-price">${{ number_format($producto['precio'], 2) }}</p>
                        <div style="display: flex; gap: 0.5rem;">
                            <button class="product-button" style="flex: 1;" 
                                    onclick="addToCartQuick({{ $producto['id'] }}, '{{ $producto['nombre'] }}', {{ $producto['precio'] }}, '{{ $producto['imagen'] ?? '' }}')">
                                🛒 Añadir
                            </button>
                            <a href="/detalles/{{ $producto['id'] }}" class="product-button" 
                            style="flex: 1; display: flex; align-items: center; justify-content: center; text-decoration: none; color: white; background: linear-gradient(45deg, #333, #555);">
                                👁️ Ver
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="product-card fade-in">
                    <div class="product-image"></div>
                    <div class="product-info">
                        <h3 class="product-name">Casco MT-15 Edition</h3>
                        <p class="product-price">$299.99</p>
                        <button class="product-button">Añadir al Carrito</button>
                    </div>
                </div>
                <div class="product-card fade-in">
                    <div class="product-image"></div>
                    <div class="product-info">
                        <h3 class="product-name">Escape Akrapovic</h3>
                        <p class="product-price">$599.99</p>
                        <button class="product-button">Añadir al Carrito</button>
                    </div>
                </div>
                <div class="product-card fade-in">
                    <div class="product-image"></div>
                    <div class="product-info">
                        <h3 class="product-name">Kit Performance</h3>
                        <p class="product-price">$899.99</p>
                        <button class="product-button">Añadir al Carrito</button>
                    </div>
                </div>
                <div class="product-card fade-in">
                    <div class="product-image"></div>
                    <div class="product-info">
                        <h3 class="product-name">Guantes Racing</h3>
                        <p class="product-price">$149.99</p>
                        <button class="product-button">Añadir al Carrito</button>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter">
        <h2>Únete a la Comunidad MT</h2>
        <p>Recibe ofertas exclusivas y novedades sobre la MT-15</p>
        <form class="newsletter-form">
            <input type="email" placeholder="Tu correo electrónico" required>
            <button type="submit">Suscribirse</button>
        </form>
    </section>

    <!-- Footer -->
    <footer id="contact">
        <div class="footer-content">
            <div class="social-links">
                <a href="#">📘</a>
                <a href="#">📷</a>
                <a href="#">🐦</a>
                <a href="#">📺</a>
            </div>
            <p>&copy; 2024 MT-15 Store. Todos los derechos reservados.</p>
            <p>Distribuidor Oficial Yamaha</p>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Fade in animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in').forEach(el => {
            observer.observe(el);
        });

        // Función para añadir al carrito
        function addToCartQuick(productId, productName, productPrice, productImage) {
            fetch('/carrito/agregar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    id: productId,
                    nombre: productName,
                    precio: productPrice,
                    imagen: productImage,
                    cantidad: 1
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Actualizar el contador del carrito
                    updateCartBadge(data.cartCount);
                    
                    // Mostrar confirmación
                    const button = event.target;
                    const originalText = button.textContent;
                    button.textContent = '✓ Añadido';
                    button.style.background = '#00C851';
                    
                    setTimeout(() => {
                        button.textContent = originalText;
                        button.style.background = '';
                    }, 2000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al añadir al carrito');
            });
        }
        
        // Actualizar el contador del carrito
        function updateCartBadge(count) {
            const cartLink = document.querySelector('.nav-links a[href="/carrito"]');
            if (cartLink) {
                cartLink.innerHTML = `🛒 Carrito ${count > 0 ? `<span style="background: var(--accent-red); color: white; border-radius: 50%; padding: 2px 6px; font-size: 0.75rem; position: absolute; top: -5px; right: -10px;">${count}</span>` : ''}`;
            }
        }
    </script>
</body>
</html>