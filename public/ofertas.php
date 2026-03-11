<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Chenati Sports - Ofertas Especiales">
    <title>Ofertas Especiales - Chenati Sports</title>
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
    <section class="category-header offer-header">
        <div class="category-header-content">
            <h1>🎉 Ofertas Especiales</h1>
            <p>¡Descuentos increíbles en las mejores zapatillas Chenati Sports!</p>
            <button class="btn btn-secondary">Ver todas las ofertas</button>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="collection-section">
        <div class="collection-header">
            <h2 class="collection-title">Zapatillas en Descuento</h2>
        </div>
        <div class="product-grid">
            <!-- Product 1 - 24% OFF -->
            <article class="product-card offer-card" data-product-id="1">
                <div class="offer-badge">-24%</div>
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&q=95&auto=format" alt="Chenati Pro Max">
                </div>
                <div class="product-info">
                    <h3 class="product-name">Chenati Pro Max</h3>
                    <div class="price-section">
                        <p class="product-price">$189.00</p>
                        <p class="original-price-tag">$249.00</p>
                    </div>
                    <div class="product-actions">
                        <button class="btn-detail" data-product="1">Ver detalle</button>
                        <button class="btn-cart" data-product="1" data-name="Chenati Pro Max" data-price="189.00">Agregar</button>
                    </div>
                </div>
            </article>

            <!-- Product 2 - 23% OFF -->
            <article class="product-card offer-card" data-product-id="2">
                <div class="offer-badge">-23%</div>
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1525966222134-fcaba7b3ebc3?w=600&q=95&auto=format" alt="Chenati Ultra">
                </div>
                <div class="product-info">
                    <h3 class="product-name">Chenati Ultra</h3>
                    <div class="price-section">
                        <p class="product-price">$229.00</p>
                        <p class="original-price-tag">$299.00</p>
                    </div>
                    <div class="product-actions">
                        <button class="btn-detail" data-product="2">Ver detalle</button>
                        <button class="btn-cart" data-product="2" data-name="Chenati Ultra" data-price="229.00">Agregar</button>
                    </div>
                </div>
            </article>

            <!-- Product 3 - 25% OFF -->
            <article class="product-card offer-card" data-product-id="3">
                <div class="offer-badge">-25%</div>
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1460353581641-37baddab0fa2?w=600&q=95&auto=format" alt="Chenati Sport">
                </div>
                <div class="product-info">
                    <h3 class="product-name">Chenati Sport</h3>
                    <div class="price-section">
                        <p class="product-price">$149.00</p>
                        <p class="original-price-tag">$199.00</p>
                    </div>
                    <div class="product-actions">
                        <button class="btn-detail" data-product="3">Ver detalle</button>
                        <button class="btn-cart" data-product="3" data-name="Chenati Sport" data-price="149.00">Agregar</button>
                    </div>
                </div>
            </article>

            <!-- Product 8 - 24% OFF -->
            <article class="product-card offer-card" data-product-id="8">
                <div class="offer-badge">-24%</div>
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1525966222134-fcaba7b3ebc3?w=600&q=95&auto=format" alt="Chenati Force">
                </div>
                <div class="product-info">
                    <h3 class="product-name">Chenati Force</h3>
                    <div class="price-section">
                        <p class="product-price">$219.00</p>
                        <p class="original-price-tag">$289.00</p>
                    </div>
                    <div class="product-actions">
                        <button class="btn-detail" data-product="8">Ver detalle</button>
                        <button class="btn-cart" data-product="8" data-name="Chenati Force" data-price="219.00">Agregar</button>
                    </div>
                </div>
            </article>

            <!-- Product 9 - 25% OFF -->
            <article class="product-card offer-card" data-product-id="9">
                <div class="offer-badge">-25%</div>
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1460353581641-37baddab0fa2?w=600&q=95&auto=format" alt="Chenati Legend">
                </div>
                <div class="product-info">
                    <h3 class="product-name">Chenati Legend</h3>
                    <div class="price-section">
                        <p class="product-price">$239.00</p>
                        <p class="original-price-tag">$319.00</p>
                    </div>
                    <div class="product-actions">
                        <button class="btn-detail" data-product="9">Ver detalle</button>
                        <button class="btn-cart" data-product="9" data-name="Chenati Legend" data-price="239.00">Agregar</button>
                    </div>
                </div>
            </article>

            <!-- Product 11 - 24% OFF -->
            <article class="product-card offer-card" data-product-id="11">
                <div class="offer-badge">-24%</div>
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&q=95&auto=format" alt="Chenati Apex">
                </div>
                <div class="product-info">
                    <h3 class="product-name">Chenati Apex</h3>
                    <div class="price-section">
                        <p class="product-price">$249.00</p>
                        <p class="original-price-tag">$329.00</p>
                    </div>
                    <div class="product-actions">
                        <button class="btn-detail" data-product="11">Ver detalle</button>
                        <button class="btn-cart" data-product="11" data-name="Chenati Apex" data-price="249.00">Agregar</button>
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
                                <option value="36">36</option>
                                <option value="37">37</option>
                                <option value="38">38</option>
                                <option value="39">39</option>
                                <option value="40">40</option>
                                <option value="41">41</option>
                                <option value="42">42</option>
                                <option value="43">43</option>
                                <option value="44">44</option>
                                <option value="45">45</option>
                            </select>
                        </div>
                        <div class="option-group">
                            <label>Color:</label>
                            <select id="product-color" class="color-select">
                                <option value="">Seleccionar color</option>
                                <option value="Negro">Negro</option>
                                <option value="Blanco">Blanco</option>
                                <option value="Azul">Azul</option>
                                <option value="Rojo">Rojo</option>
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

        .offer-header {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
        }

        .offer-header h1,
        .offer-header p {
            color: white;
        }

        .category-header-content h1 {
            font-size: 42px;
            margin-bottom: 16px;
            color: #000;
        }

        .offer-header h1 {
            color: white;
        }

        .category-header-content p {
            font-size: 18px;
            color: #555;
            margin-bottom: 24px;
        }

        .offer-header p {
            color: rgba(255, 255, 255, 0.95);
        }

        .offer-card {
            position: relative;
        }

        .offer-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background-color: #ff6b6b;
            color: white;
            padding: 8px 12px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 14px;
            z-index: 10;
        }

        .price-section {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .original-price-tag {
            color: #999;
            text-decoration: line-through;
            font-size: 14px;
        }
    </style>

    <script src="chenati-script.js"></script>
</body>
</html>
