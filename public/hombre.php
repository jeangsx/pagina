<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Chenati Sports - Zapatillas para Hombre">
    <title>Colección Hombre - Chenati Sports</title>
    <link rel="stylesheet" href="chenati-styles.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container-nav">
            <div class="logo">
                <span class="logo-text"><a href="index.php" style="color: inherit; text-decoration: none;">Chenati Sports</a></span>
            </div>
            <ul class="nav-menu">
                <li><a href="hombre.php">Hombre</a></li>
                <li><a href="mujer.php">Mujer</a></li>
                <li><a href="ninos.php">Niños</a></li>
                <li><a href="ofertas.php">Ofertas</a></li>
                <li><a href="contacto.php">Contacto</a></li>
            </ul>
            <div class="nav-actions">
                <div class="nav-cart">
                    <button class="cart-button" id="cart-btn" aria-label="Carrito de compras">
                        <span class="cart-icon">🛒</span>
                        <span class="cart-count" id="cart-count">0</span>
                    </button>
                </div>
                <div class="nav-auth">
                    <button class="btn btn-nav-login" id="login-btn">Iniciar sesión</button>
                    <div class="user-menu" id="user-menu" style="display: none;">
                        <span class="user-name" id="user-name"></span>
                        <button class="btn btn-logout" id="logout-btn">Cerrar sesión</button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Category Header -->
    <section class="category-header">
        <div class="category-header-content">
            <h1>Colección para Hombre</h1>
            <p>Descubre nuestras zapatillas de rendimiento diseñadas específicamente para hombres</p>
            <button class="btn btn-secondary">Ver todas las categorías</button>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="collection-section">
        <div class="collection-header">
            <h2 class="collection-title">Zapatillas para Hombre</h2>
        </div>
        <div class="product-grid">
            <!-- Product 1 -->
            <article class="product-card" data-product-id="1">
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&q=95&auto=format" alt="Chenati Pro Max">
                </div>
                <div class="product-info">
                    <h3 class="product-name">Chenati Pro Max</h3>
                    <p class="product-price">$189.00</p>
                    <div class="product-actions">
                        <button class="btn-detail" data-product="1">Ver detalle</button>
                        <button class="btn-cart" data-product="1" data-name="Chenati Pro Max" data-price="189.00">Agregar</button>
                    </div>
                </div>
            </article>

            <!-- Product 4 -->
            <article class="product-card" data-product-id="4">
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=600&q=95&auto=format" alt="Chenati Runner">
                </div>
                <div class="product-info">
                    <h3 class="product-name">Chenati Runner</h3>
                    <p class="product-price">$169.00</p>
                    <div class="product-actions">
                        <button class="btn-detail" data-product="4">Ver detalle</button>
                        <button class="btn-cart" data-product="4" data-name="Chenati Runner" data-price="169.00">Agregar</button>
                    </div>
                </div>
            </article>

            <!-- Product 5 -->
            <article class="product-card" data-product-id="5">
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&q=95&auto=format" alt="Chenati Elite">
                </div>
                <div class="product-info">
                    <h3 class="product-name">Chenati Elite</h3>
                    <p class="product-price">$199.00</p>
                    <div class="product-actions">
                        <button class="btn-detail" data-product="5">Ver detalle</button>
                        <button class="btn-cart" data-product="5" data-name="Chenati Elite" data-price="199.00">Agregar</button>
                    </div>
                </div>
            </article>

            <!-- Product 8 -->
            <article class="product-card" data-product-id="8">
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1525966222134-fcaba7b3ebc3?w=600&q=95&auto=format" alt="Chenati Force">
                </div>
                <div class="product-info">
                    <h3 class="product-name">Chenati Force</h3>
                    <p class="product-price">$219.00</p>
                    <div class="product-actions">
                        <button class="btn-detail" data-product="8">Ver detalle</button>
                        <button class="btn-cart" data-product="8" data-name="Chenati Force" data-price="219.00">Agregar</button>
                    </div>
                </div>
            </article>

            <!-- Product 11 -->
            <article class="product-card" data-product-id="11">
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&q=95&auto=format" alt="Chenati Apex">
                </div>
                <div class="product-info">
                    <h3 class="product-name">Chenati Apex</h3>
                    <p class="product-price">$249.00</p>
                    <div class="product-actions">
                        <button class="btn-detail" data-product="11">Ver detalle</button>
                        <button class="btn-cart" data-product="11" data-name="Chenati Apex" data-price="249.00">Agregar</button>
                    </div>
                </div>
            </article>

            <!-- Product 6 -->
            <article class="product-card" data-product-id="6">
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?w=600&q=95&auto=format" alt="Chenati Performance">
                </div>
                <div class="product-info">
                    <h3 class="product-name">Chenati Performance</h3>
                    <p class="product-price">$179.00</p>
                    <div class="product-actions">
                        <button class="btn-detail" data-product="6">Ver detalle</button>
                        <button class="btn-cart" data-product="6" data-name="Chenati Performance" data-price="179.00">Agregar</button>
                    </div>
                </div>
            </article>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-links">
                <a href="#envio">Políticas de envío</a>
                <a href="#devoluciones">Devoluciones</a>
                <a href="#contacto">Contacto</a>
                <a href="#redes">Redes sociales</a>
            </div>
            <p class="footer-copy">&copy; 2026 Chenati Sports. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Modal Detalle Producto -->
    <div class="modal" id="product-modal">
        <div class="modal-content modal-product">
            <button class="modal-close" aria-label="Cerrar modal">&times;</button>
            <div class="product-detail-container">
                <div class="product-detail-image">
                    <img id="product-detail-img" src="" alt="Producto">
                </div>
                <div class="product-detail-info">
                    <h2 id="product-detail-name"></h2>
                    <div class="product-detail-rating">
                        <span class="stars">★★★★★</span>
                        <span class="reviews">(245 reseñas)</span>
                    </div>
                    <div class="product-detail-price">
                        <span id="product-detail-price" class="price"></span>
                        <span class="original-price">$299.00</span>
                    </div>
                    <p id="product-detail-description" class="product-detail-desc"></p>
                    
                    <div class="product-detail-specs">
                        <h4>Características</h4>
                        <ul id="product-specs">
                            <li>Amortiguación de última generación</li>
                            <li>Material transpirable premium</li>
                            <li>Peso ultra ligero (170g)</li>
                            <li>Suela antideslizante reforzada</li>
                            <li>Diseño ergonómico avanzado</li>
                        </ul>
                    </div>

                    <div class="product-detail-options">
                        <div class="option-group">
                            <label>Talla:</label>
                            <select id="product-size" class="size-select">
                                <option value="">Seleccionar talla</option>
                                <option value="40">40</option>
                                <option value="41">41</option>
                                <option value="42">42</option>
                                <option value="43">43</option>
                                <option value="44">44</option>
                                <option value="45">45</option>
                                <option value="46">46</option>
                            </select>
                        </div>
                        <div class="option-group">
                            <label>Color:</label>
                            <select id="product-color" class="color-select">
                                <option value="">Seleccionar color</option>
                                <option value="Negro">Negro</option>
                                <option value="Blanco">Blanco</option>
                                <option value="Azul">Azul</option>
                                <option value="Gris">Gris</option>
                            </select>
                        </div>
                        <div class="option-group">
                            <label>Cantidad:</label>
                            <div class="quantity-selector">
                                <button class="qty-btn" id="qty-minus">−</button>
                                <input type="number" id="product-quantity" value="1" min="1" max="10">
                                <button class="qty-btn" id="qty-plus">+</button>
                            </div>
                        </div>
                    </div>

                    <div class="product-detail-actions">
                        <button class="btn btn-primary" id="add-to-cart-detail">Agregar al carrito</button>
                        <button class="btn btn-secondary" id="buy-now">Comprar ahora</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Carrito -->
    <div class="modal" id="cart-modal">
        <div class="modal-content modal-cart">
            <button class="modal-close" aria-label="Cerrar modal">&times;</button>
            <h2>Carrito de Compras</h2>
            
            <div class="cart-items-container">
                <div id="cart-items-list" class="cart-items-list">
                    <!-- Los items del carrito se agregan aquí dinámicamente -->
                </div>
                <div id="empty-cart" class="empty-cart">
                    <p>Tu carrito está vacío</p>
                    <p class="empty-cart-text">Agrega productos para continuar</p>
                </div>
            </div>

            <div class="cart-summary">
                <div class="summary-row">
                    <span>Subtotal:</span>
                    <span id="cart-subtotal">$0.00</span>
                </div>
                <div class="summary-row">
                    <span>Envío:</span>
                    <span id="cart-shipping">$0.00</span>
                </div>
                <div class="summary-row">
                    <span>Impuesto:</span>
                    <span id="cart-tax">$0.00</span>
                </div>
                <div class="summary-row summary-total">
                    <span>Total:</span>
                    <span id="cart-total">$0.00</span>
                </div>
            </div>

            <div class="cart-actions">
                <button class="btn btn-secondary" id="continue-shopping">Continuar comprando</button>
                <button class="btn btn-primary" id="checkout-btn">Proceder al pago</button>
            </div>
        </div>
    </div>

    <!-- Modal Login -->
    <div class="modal" id="login-modal">
        <div class="modal-content modal-login">
            <button class="modal-close" aria-label="Cerrar modal">&times;</button>
            <div class="login-container">
                <h2>Iniciar Sesión</h2>
                <p class="login-subtitle">Accede a tu cuenta Chenati Sports</p>
                
                <form class="login-form" id="modal-login-form">
                    <div class="form-row">
                        <input type="text" id="modal-login-name" placeholder="Nombre completo" required>
                    </div>
                    <div class="form-row">
                        <input type="email" id="modal-login-email" placeholder="Correo electrónico" required>
                    </div>
                    <div class="form-row">
                        <input type="password" id="modal-login-password" placeholder="Contraseña" required>
                    </div>
                    <div class="login-options">
                        <label class="checkbox-custom">
                            <input type="checkbox" id="remember-me">
                            <span>Recuérdame</span>
                        </label>
                        <a href="index.php?controller=auth&action=forgot" class="forgot-password">¿Olvidaste tu contraseña?</a>
                    </div>
                </form>

                <button class="btn btn-primary" id="modal-login-submit" style="width: 100%; margin-top: 20px;">Iniciar Sesión</button>

                <div class="login-security">
                    🔒 Tu información está protegida con encriptación SSL 256-bit
                </div>

                <div class="login-footer">
                    <p>¿No tienes cuenta? <a href="index.php?controller=auth&action=register" class="register-link">Crear cuenta aquí</a></p>
                </div>
            </div>
        </div>
    </div>

    <style>
        .category-header {
            margin-top: 80px;
            padding: 60px 20px;
            background: linear-gradient(135deg, #f5f5f7 0%, #e8e8ed 100%);
            text-align: center;
        }

        .category-header-content h1 {
            font-size: 42px;
            margin-bottom: 16px;
            color: #000;
        }

        .category-header-content p {
            font-size: 18px;
            color: #555;
            margin-bottom: 24px;
        }
    </style>

    <script src="chenati-script.js"></script>
</body>
</html>
