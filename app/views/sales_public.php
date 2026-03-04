<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Peruvianita Shoes - Tienda Online de Zapatillas</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- CSS externo -->
    <link rel="stylesheet" href="<?= asset('sales_public.css') ?>">
</head>
<body>
    <!-- Header -->
    <header class="store-header">
        <div class="header-top">
            🚚 Envío gratis en pedidos mayores a S/200 | ⚡ Entregas en 24 horas | 🎁 ¡Primer pedido 20% dto!
        </div>
        <div class="header-main">
            <a href="#" class="logo">SENATI<span>Sports</span>           UR</a>
            
            <ul class="nav-links">
                <li class="nav-item">
                    <a id="nav-nuevo" onclick="showNuevo(event)">Nuevo</a>
                </li>
                <li class="nav-item">
                    <a id="nav-hombres" onclick="showHombres(event)">Hombres</a>
                </li>
                <li class="nav-item">
                    <a id="nav-mujeres" onclick="showMujeres(event)">Mujeres</a>
                </li>
                <li class="nav-item">
                    <a id="nav-ninos" onclick="showNinos(event)">Niños</a>
                </li>
                <li class="nav-item">
                    <a onclick="filterProducts('running', event)">Running</a>
                </li>
                <li class="nav-item">
                    <a onclick="filterProducts('urban', event)">Urbanas</a>
                </li>
                <li class="nav-item">
                    <a id="nav-ofertas" onclick="showOfertas(event)">Ofertas</a>
                </li>
            </ul>

            <div class="header-actions">
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Buscar zapatillas..." onkeyup="handleSearch(event)" onkeydown="if(event.key==='Enter'){triggerSearch();}">
                    <span class="search-icon" onclick="triggerSearch()" style="cursor:pointer;">🔍</span>
                </div>
                <button class="icon-btn" title="Favoritos">❤️</button>
                <button class="cart-icon-btn" onclick="openCart()" title="Carrito">🛒<span id="cart-count" class="cart-count">0</span></button>
                <div id="userArea">
                    <button class="user-btn" onclick="openLoginModal()">Mi Cuenta</button>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Banner -->
    <section class="hero-banner">
        <div class="hero-content">
            <div class="hero-badges">
                <span class="hero-badge">🔥 Nueva Colección</span>
                <span class="hero-badge outline">⭐ Los Más Vendidos</span>
            </div>
            <h1>EXPRESA TU ESTILO</h1>
            <p>Descubre las zapatillas más trend del momento. Comodidad y diseño en cada paso.</p>
            <div class="hero-buttons">
                <button class="btn-hero btn-hero-primary" onclick="openLoginModal()">
                    Comprar Ahora
                </button>
                <button class="btn-hero btn-hero-secondary" onclick="showColeccion(event)">
                    Ver Colección
                </button>
            </div>
        </div>
    </section>

    <!-- Categories Bar -->
    <div class="categories-bar">
        <div class="categories-container">
            <button class="category-btn active" onclick="filterProducts('all', event)">Todos</button>
            <button class="category-btn" onclick="filterProducts('running', event)">Running</button>
            <button class="category-btn" onclick="filterProducts('urban', event)">Urbanas</button>
            <button class="category-btn" onclick="filterProducts('basketball', event)">Basketball</button>
            <button class="category-btn" onclick="filterProducts('formal', event)">Formales</button>
            <button class="category-btn" onclick="filterProducts('training', event)">Training</button>
            <button class="category-btn" onclick="filterProducts('kids', event)">Niños</button>
        </div>
    </div>

    <!-- Products Grid -->
    <section class="products-section">
        <div class="section-header">
            <div>
                <h2 class="section-title">Nuestra Colección</h2>
                <p class="section-subtitle">Las mejores zapatillas de las marcas top</p>
            </div>
        </div>
        
        <div class="products-grid" id="productsGrid">
            <!-- Producto 1 -->
            <div class="product-card" data-category="running">
                <div class="product-badges">
                    <span class="product-badge">Más Vendido</span>
                </div>
                <button class="product-favorite" onclick="toggleFavorite(this)">🤍</button>
                <div class="product-image">👟</div>
                <div class="product-info">
                    <div class="product-category">Running</div>
                    <h3 class="product-title">Nike Air Max 270 React</h3>
                    <div class="product-colors">
                        <span class="color-dot active" style="background: #000;" onclick="selectColor(this)"></span>
                        <span class="color-dot" style="background: #fff; border: 1px solid #ddd;" onclick="selectColor(this)"></span>
                        <span class="color-dot" style="background: #ff6b6b;" onclick="selectColor(this)"></span>
                        <span class="color-dot" style="background: #4ecdc4;" onclick="selectColor(this)"></span>
                    </div>
                    <div class="product-price">
                        S/ 459.00
                        <span class="original-price">S/ 599.00</span>
                    </div>
                    <div class="product-reviews">
                        <span class="stars">★★★★★</span>
                        <span class="review-count">(128)</span>
                    </div>
                    <div class="product-actions">
                        <button class="btn-view" onclick="viewProduct('Nike Air Max 270 React', 459, 1)">Ver</button>
                        <button class="btn-add-cart" id="btn-cart-1" onclick="purchaseProduct('Nike Air Max 270 React', 459)">Comprar</button>
                        <button class="btn-add-cart btn-cancelled" id="btn-cancel-1" onclick="cancelPurchase('Nike Air Max 270 React')">Cancelar</button>
                    </div>
                </div>
            </div>

            <!-- Producto 2 -->
            <div class="product-card" data-category="urban">
                <button class="product-favorite" onclick="toggleFavorite(this)">🤍</button>
                <div class="product-image">🏃</div>
                <div class="product-info">
                    <div class="product-category">Urbanas</div>
                    <h3 class="product-title">Adidas Superstar Original</h3>
                    <div class="product-colors">
                        <span class="color-dot active" style="background: #fff; border: 1px solid #ddd;" onclick="selectColor(this)"></span>
                        <span class="color-dot" style="background: #000;" onclick="selectColor(this)"></span>
                        <span class="color-dot" style="background: #ffd700;" onclick="selectColor(this)"></span>
                    </div>
                    <div class="product-price">S/ 389.00</div>
                    <div class="product-reviews">
                        <span class="stars">★★★★★</span>
                        <span class="review-count">(256)</span>
                    </div>
                    <div class="product-actions">
                        <button class="btn-view" onclick="viewProduct('Adidas Superstar Original', 389, 2)">Ver</button>
                        <button class="btn-add-cart" id="btn-cart-2" onclick="purchaseProduct('Adidas Superstar Original', 389)">Comprar</button>
                        <button class="btn-add-cart btn-cancelled" id="btn-cancel-2" onclick="cancelPurchase('Adidas Superstar Original')">Cancelar</button>
                    </div>
                </div>
            </div>

            <!-- Producto 3 -->
            <div class="product-card" data-category="running">
                <div class="product-badges">
                    <span class="product-badge new">Nuevo</span>
                    <span class="product-badge discount">-25%</span>
                </div>
                <button class="product-favorite" onclick="toggleFavorite(this)">🤍</button>
                <div class="product-image">👟</div>
                <div class="product-info">
                    <div class="product-category">Running</div>
                    <h3 class="product-title">Nike ZoomX Vaporfly</h3>
                    <div class="product-colors">
                        <span class="color-dot active" style="background: #ff6b6b;" onclick="selectColor(this)"></span>
                        <span class="color-dot" style="background: #000;" onclick="selectColor(this)"></span>
                        <span class="color-dot" style="background: #fff; border: 1px solid #ddd;" onclick="selectColor(this)"></span>
                    </div>
                    <div class="product-price">
                        S/ 749.00
                        <span class="original-price">S/ 999.00</span>
                    </div>
                    <div class="product-reviews">
                        <span class="stars">★★★★★</span>
                        <span class="review-count">(89)</span>
                    </div>
                    <div class="product-actions">
                        <button class="btn-view" onclick="viewProduct('Nike ZoomX Vaporfly', 749, 3)">Ver</button>
                        <button class="btn-add-cart" id="btn-cart-3" onclick="purchaseProduct('Nike ZoomX Vaporfly', 749)">Comprar</button>
                        <button class="btn-add-cart btn-cancelled" id="btn-cancel-3" onclick="cancelPurchase('Nike ZoomX Vaporfly')">Cancelar</button>
                    </div>
                </div>
            </div>

            <!-- Producto 4 -->
            <div class="product-card" data-category="basketball">
                <button class="product-favorite" onclick="toggleFavorite(this)">🤍</button>
                <div class="product-image">🔥</div>
                <div class="product-info">
                    <div class="product-category">Basketball</div>
                    <h3 class="product-title">Jordan Air Jordan 1 High</h3>
                    <div class="product-colors">
                        <span class="color-dot active" style="background: #c0392b;" onclick="selectColor(this)"></span>
                        <span class="color-dot" style="background: #000;" onclick="selectColor(this)"></span>
                        <span class="color-dot" style="background: #fff; border: 1px solid #ddd;" onclick="selectColor(this)"></span>
                    </div>
                    <div class="product-price">S/ 659.00</div>
                    <div class="product-reviews">
                        <span class="stars">★★★★★</span>
                        <span class="review-count">(312)</span>
                    </div>
                    <div class="product-actions">
                        <button class="btn-view" onclick="viewProduct('Jordan Air Jordan 1 High', 659, 4)">Ver</button>
                        <button class="btn-add-cart" id="btn-cart-4" onclick="purchaseProduct('Jordan Air Jordan 1 High', 659)">Comprar</button>
                        <button class="btn-add-cart btn-cancelled" id="btn-cancel-4" onclick="cancelPurchase('Jordan Air Jordan 1 High')">Cancelar</button>
                    </div>
                </div>
            </div>

            <!-- Producto 5 -->
            <div class="product-card" data-category="training">
                <button class="product-favorite" onclick="toggleFavorite(this)">🤍</button>
                <div class="product-image">💪</div>
                <div class="product-info">
                    <div class="product-category">Training</div>
                    <h3 class="product-title">Nike Metcon 8</h3>
                    <div class="product-colors">
                        <span class="color-dot active" style="background: #000;" onclick="selectColor(this)"></span>
                        <span class="color-dot" style="background: #4ecdc4;" onclick="selectColor(this)"></span>
                        <span class="color-dot" style="background: #ff6b6b;" onclick="selectColor(this)"></span>
                    </div>
                    <div class="product-price">S/ 429.00</div>
                    <div class="product-reviews">
                        <span class="stars">★★★★☆</span>
                        <span class="review-count">(78)</span>
                    </div>
                    <div class="product-actions">
                        <button class="btn-view" onclick="viewProduct('Nike Metcon 8', 429, 5)">Ver</button>
                        <button class="btn-add-cart" id="btn-cart-5" onclick="purchaseProduct('Nike Metcon 8', 429)">Comprar</button>
                        <button class="btn-add-cart btn-cancelled" id="btn-cancel-5" onclick="cancelPurchase('Nike Metcon 8')">Cancelar</button>
                    </div>
                </div>
            </div>

            <!-- Producto 6 -->
            <div class="product-card" data-category="urban">
                <div class="product-badges">
                    <span class="product-badge">Top</span>
                </div>
                <button class="product-favorite" onclick="toggleFavorite(this)">🤍</button>
                <div class="product-image">👟</div>
                <div class="product-info">
                    <div class="product-category">Urbanas</div>
                    <h3 class="product-title">Puma RS-X³ Puzzle</h3>
                    <div class="product-colors">
                        <span class="color-dot active" style="background: #9b59b6;" onclick="selectColor(this)"></span>
                        <span class="color-dot" style="background: #000;" onclick="selectColor(this)"></span>
                        <span class="color-dot" style="background: #fff; border: 1px solid #ddd;" onclick="selectColor(this)"></span>
                    </div>
                    <div class="product-price">S/ 349.00</div>
                    <div class="product-reviews">
                        <span class="stars">★★★★★</span>
                        <span class="review-count">(156)</span>
                    </div>
                    <div class="product-actions">
                        <button class="btn-view" onclick="viewProduct('Puma RS-X³ Puzzle', 349, 6)">Ver</button>
                        <button class="btn-add-cart" id="btn-cart-6" onclick="purchaseProduct('Puma RS-X³ Puzzle', 349)">Comprar</button>
                        <button class="btn-add-cart btn-cancelled" id="btn-cancel-6" onclick="cancelPurchase('Puma RS-X³ Puzzle')">Cancelar</button>
                    </div>
                </div>
            </div>

            <!-- Producto 7 -->
            <div class="product-card" data-category="kids">
                <button class="product-favorite" onclick="toggleFavorite(this)">🤍</button>
                <div class="product-image">👞</div>
                <div class="product-info">
                    <div class="product-category">Niños</div>
                    <h3 class="product-title">Nike Air Max 90 Easy</h3>
                    <div class="product-colors">
                        <span class="color-dot active" style="background: #3498db;" onclick="selectColor(this)"></span>
                        <span class="color-dot" style="background: #ff6b6b;" onclick="selectColor(this)"></span>
                        <span class="color-dot" style="background: #000;" onclick="selectColor(this)"></span>
                    </div>
                    <div class="product-price">S/ 249.00</div>
                    <div class="product-reviews">
                        <span class="stars">★★★★★</span>
                        <span class="review-count">(45)</span>
                    </div>
                    <div class="product-actions">
                        <button class="btn-view" onclick="viewProduct('Nike Air Max 90 Easy', 249, 7)">Ver</button>
                        <button class="btn-add-cart" id="btn-cart-7" onclick="purchaseProduct('Nike Air Max 90 Easy', 249)">Comprar</button>
                        <button class="btn-add-cart btn-cancelled" id="btn-cancel-7" onclick="cancelPurchase('Nike Air Max 90 Easy')">Cancelar</button>
                    </div>
                </div>
            </div>

            <!-- Producto 8 -->
            <div class="product-card" data-category="formal">
                <button class="product-favorite" onclick="toggleFavorite(this)">🤍</button>
                <div class="product-image">👔</div>
                <div class="product-info">
                    <div class="product-category">Formales</div>
                    <h3 class="product-title">Cole Haan ZerøGrand</h3>
                    <div class="product-colors">
                        <span class="color-dot active" style="background: #8b4513;" onclick="selectColor(this)"></span>
                        <span class="color-dot" style="background: #000;" onclick="selectColor(this)"></span>
                    </div>
                    <div class="product-price">S/ 529.00</div>
                    <div class="product-reviews">
                        <span class="stars">★★★★☆</span>
                        <span class="review-count">(67)</span>
                    </div>
                    <div class="product-actions">
                        <button class="btn-view" onclick="viewProduct('Cole Haan ZerøGrand', 529, 8)">Ver</button>
                        <button class="btn-add-cart" id="btn-cart-8" onclick="purchaseProduct('Cole Haan ZerøGrand', 529)">Comprar</button>
                        <button class="btn-add-cart btn-cancelled" id="btn-cancel-8" onclick="cancelPurchase('Cole Haan ZerøGrand')">Cancelar</button>
                    </div>
                </div>
            </div>

            <!-- Producto 9 -->
            <div class="product-card" data-category="running">
                <div class="product-badges">
                    <span class="product-badge discount">-30%</span>
                </div>
                <button class="product-favorite" onclick="toggleFavorite(this)">🤍</button>
                <div class="product-image">🏃</div>
                <div class="product-info">
                    <div class="product-category">Running</div>
                    <h3 class="product-title">Adidas Ultraboost 22</h3>
                    <div class="product-colors">
                        <span class="color-dot active" style="background: #000;" onclick="selectColor(this)"></span>
                        <span class="color-dot" style="background: #fff; border: 1px solid #ddd;" onclick="selectColor(this)"></span>
                        <span class="color-dot" style="background: #4ecdc4;" onclick="selectColor(this)"></span>
                    </div>
                    <div class="product-price">
                        S/ 489.00
                        <span class="original-price">S/ 699.00</span>
                    </div>
                    <div class="product-reviews">
                        <span class="stars">★★★★★</span>
                        <span class="review-count">(234)</span>
                    </div>
                    <div class="product-actions">
                        <button class="btn-view" onclick="viewProduct('Adidas Ultraboost 22', 489, 9)">Ver</button>
                        <button class="btn-add-cart" id="btn-cart-9" onclick="purchaseProduct('Adidas Ultraboost 22', 489)">Comprar</button>
                        <button class="btn-add-cart btn-cancelled" id="btn-cancel-9" onclick="cancelPurchase('Adidas Ultraboost 22')">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="store-footer">
        <div class="footer-content">
            <div class="footer-section">
                <h4>LaPeruvianita Shoes</h4>
                <ul>
                    <li><a href="#">Sobre Nosotros</a></li>
                    <li><a href="#">Nuestras Tiendas</a></li>
                    <li><a href="#">Trabaja con Nosotros</a></li>
                    <li><a href="#">Franquicias</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Atención al Cliente</h4>
                <ul>
                    <li><a href="#">Contáctanos</a></li>
                    <li><a href="#">Preguntas Frecuentes</a></li>
                    <li><a href="#">Términos y Condiciones</a></li>
                    <li><a href="#">Política de Privacidad</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Servicios</h4>
                <ul>
                    <li><a href="#">Delivery</a></li>
                    <li><a href="#">Cambios y Devoluciones</a></li>
                    <li><a href="#">Guía de Tallas</a></li>
                    <li><a href="#">Cuidado de Zapatillas</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Síguenos</h4>
                <div class="social-icons">
                    <a href="#" class="social-icon">📘</a>
                    <a href="#" class="social-icon">📸</a>
                    <a href="#" class="social-icon">🎵</a>
                    <a href="#" class="social-icon">💬</a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2026 LaPeruvianita Shoes. Todos los derechos reservados.</p>
            <p>Diseñado con ❤️ para los amantes del calzado</p>
        </div>
    </footer>

    <!-- Login Modal -->
    <div class="modal-overlay" id="loginModal">
        <div class="modal-box">
            <div class="modal-header">
                <h3>👟 Bienvenido a LaPeruvianita Shoes</h3>
            </div>
            <div class="modal-body">
                <p style="text-align: center; color: #666; margin-bottom: 20px; font-size: 14px;">
                    Ingresa con tu cuenta Gmail para realizar pedidos y ver ofertas exclusivas
                </p>
                <form id="loginForm" onsubmit="handleLogin(event)">
                    <div class="form-group">
                        <label>Correo Electrónico</label>
                        <input type="email" class="form-control" id="loginEmail" placeholder="tucorreo@gmail.com" required>
                    </div>
                    <div class="form-group">
                        <label>Nombre Completo</label>
                        <input type="text" class="form-control" id="loginName" placeholder="Tu nombre">
                    </div>
                    <button type="submit" class="btn-submit">Continuar</button>
                    <button type="button" class="btn-cancel-modal" onclick="closeLoginModal()">Cancelar</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Purchase Modal -->
    <div class="modal-overlay" id="purchaseModal">
        <div class="modal-box">
            <div class="modal-header">
                <h3>🛒 Confirmar Pedido</h3>
            </div>
            <div class="modal-body">
                <div id="purchaseDetails" style="text-align: center; margin-bottom: 20px;"></div>
                <form id="purchaseForm" onsubmit="confirmPurchase(event)">
                    <input type="hidden" id="purchaseProduct">
                    <input type="hidden" id="purchaseAmount">
                    <button type="submit" class="btn-submit">Confirmar Pedido</button>
                    <button type="button" class="btn-cancel-modal" onclick="closePurchaseModal()">Cancelar</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Quick View Modal -->
    <div class="modal-overlay" id="quickViewModal">
        <div class="modal-box" style="max-width: 750px;">
            <div class="modal-header">
                <h3>👁️ Vista Rápida</h3>
            </div>
            <div class="modal-body">
                <div class="quick-view-content">
                    <div class="quick-view-image" id="quickImage">👟</div>
                    <div class="quick-view-details">
                        <h3 id="quickTitle"></h3>
                        <div>
                            <span class="price" id="quickPrice"></span>
                            <span class="original" id="quickOriginal"></span>
                        </div>
                        <p>Experimenta la máxima comodidad con estas zapatillas de alto rendimiento. Diseño moderno y materiales premium para tu día a día.</p>
                        <div class="quick-view-colors" id="quickColors"></div>
                        <div class="size-select">
                            <div class="size-option" onclick="selectSize('38', 1)">38</div>
                            <div class="size-option" onclick="selectSize('39', 1)">39</div>
                            <div class="size-option active" onclick="selectSize('40', 1)">40</div>
                            <div class="size-option" onclick="selectSize('41', 1)">41</div>
                            <div class="size-option" onclick="selectSize('42', 1)">42</div>
                        </div>
                        <button class="btn-quick-buy" id="quickBuyBtn" onclick="quickPurchase()">Agregar al Carrito</button>
                    </div>
                </div>
                <button type="button" class="btn-cancel-modal" onclick="closeQuickView()">Cerrar</button>
            </div>
        </div>
    </div>

    <!-- Cart Modal -->
    <div class="modal-overlay" id="cartModal">
        <div class="modal-box" style="max-width: 500px;">
            <div class="modal-header">
                <h3>🛒 Mi Carrito</h3>
            </div>
            <div class="modal-body cart-modal-content">
                <div id="cartItems"></div>
            </div>
            <div class="cart-footer">
                <div class="cart-total">
                    <span class="cart-total-label">Total:</span>
                    <span class="cart-total-amount" id="cartTotal">S/ 0.00</span>
                </div>
                <button class="btn-checkout" onclick="checkout()">Finalizar Compra</button>
                <button class="btn-continue-shopping" onclick="closeCart()">Seguir Comprando</button>
            </div>
        </div>
    </div>

    <!-- JS externo -->
    <script src="<?= asset('sales_public.js') ?>"></script>
</body>
</html>
