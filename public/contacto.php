<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Contacto - Chenati Sports">
    <title>Contacto - Chenati Sports</title>
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

    <!-- Contact Header -->
    <section class="contact-header">
        <div class="contact-header-content">
            <h1>Contáctanos</h1>
            <p>¿Preguntas? Nos encantaría saber de ti. Envíanos un mensaje y nos pondremos en contacto pronto.</p>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="contact-section">
        <div class="contact-container">
            <!-- Contact Form -->
            <div class="contact-form-wrapper">
                <h2>Envía tu Mensaje</h2>
                <form class="contact-form" id="contact-form">
                    <div class="form-row">
                        <input type="text" placeholder="Tu nombre" required>
                    </div>
                    <div class="form-row">
                        <input type="email" placeholder="Tu correo electrónico" required>
                    </div>
                    <div class="form-row">
                        <input type="text" placeholder="Asunto" required style="grid-column: 1 / -1;">
                    </div>
                    <div class="form-row">
                        <textarea placeholder="Tu mensaje" rows="6" required style="grid-column: 1 / -1; font-family: var(--font-family); resize: vertical;"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Enviar Mensaje</button>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="contact-info">
                <h2>Información de Contacto</h2>
                
                <div class="contact-item">
                    <div class="contact-icon">📍</div>
                    <div class="contact-details">
                        <h3>Ubicación</h3>
                        <p>Avenida Principal 123<br>Ciudad, País 12345</p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">📞</div>
                    <div class="contact-details">
                        <h3>Teléfono</h3>
                        <p>+1 (555) 123-4567<br>+1 (555) 987-6543</p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">📧</div>
                    <div class="contact-details">
                        <h3>Email</h3>
                        <p><a href="mailto:info@chenati.com">info@chenati.com</a><br><a href="mailto:soporte@chenati.com">soporte@chenati.com</a></p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">🕐</div>
                    <div class="contact-details">
                        <h3>Horario de Atención</h3>
                        <p>Lunes - Viernes: 9:00 AM - 6:00 PM<br>Sábado: 10:00 AM - 4:00 PM<br>Domingo: Cerrado</p>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="social-links">
                    <h3>Síguenos</h3>
                    <div class="social-icons">
                        <a href="#facebook" class="social-icon facebook">f</a>
                        <a href="#instagram" class="social-icon instagram">📷</a>
                        <a href="#twitter" class="social-icon twitter">𝕏</a>
                        <a href="#youtube" class="social-icon youtube">▶️</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="faq-container">
            <h2>Preguntas Frecuentes</h2>
            
            <div class="faq-item">
                <button class="faq-question">¿Cuál es el tiempo de entrega?</button>
                <div class="faq-answer" style="display: none;">
                    <p>Típicamente nuestras entregas toman entre 5-7 días hábiles dentro del país. Ofrecemos envío express de 2-3 días por una tarifa adicional.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">¿Cuál es la política de devolución?</button>
                <div class="faq-answer" style="display: none;">
                    <p>Aceptamos devoluciones dentro de 30 días de la compra. El producto debe estar en condición original y sin uso. Contacta a nuestro equipo de soporte para iniciar una devolución.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">¿Cómo puedo cambiar mi talla?</button>
                <div class="faq-answer" style="display: none;">
                    <p>Si necesitas cambiar la talla de tu pedido, por favor contacta al equipo de soporte dentro de las 24 horas de tu compra.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">¿Ofrecen descuentos por mayor?</button>
                <div class="faq-answer" style="display: none;">
                    <p>Sí, ofrecemos descuentos especiales para compras en volumen. Contacta a nuestro equipo de ventas para más información.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">¿Cómo puedo rastrear mi orden?</button>
                <div class="faq-answer" style="display: none;">
                    <p>Una vez que tu orden se envía, recibirás un email con el número de seguimiento. Puedes usar este número para rastrear tu paquete en tiempo real.</p>
                </div>
            </div>
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

    <style>
        .contact-header {
            margin-top: 80px;
            padding: 60px 20px;
            background: linear-gradient(135deg, #0066CC 0%, #004499 100%);
            text-align: center;
            color: white;
        }

        .contact-header-content h1 {
            font-size: 42px;
            margin-bottom: 16px;
            color: white;
        }

        .contact-header-content p {
            font-size: 18px;
            color: rgba(255, 255, 255, 0.95);
            margin: 0;
        }

        .contact-section {
            max-width: 1200px;
            margin: 60px auto;
            padding: 0 20px;
        }

        .contact-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
        }

        .contact-form-wrapper h2,
        .contact-info h2 {
            font-size: 28px;
            margin-bottom: 24px;
        }

        .contact-form {
            display: grid;
            gap: 16px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr;
            gap: 8px;
        }

        .contact-form input,
        .contact-form textarea {
            padding: 12px 16px;
            border: 1px solid #E5E5E7;
            border-radius: var(--border-radius);
            font-size: 16px;
            font-family: var(--font-family);
            transition: var(--transition);
        }

        .contact-form input:focus,
        .contact-form textarea:focus {
            outline: none;
            border-color: var(--color-accent-blue);
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
        }

        .contact-item {
            display: flex;
            gap: 20px;
            margin-bottom: 32px;
        }

        .contact-icon {
            font-size: 32px;
            min-width: 50px;
            text-align: center;
        }

        .contact-details h3 {
            font-size: 18px;
            margin-bottom: 8px;
        }

        .contact-details p {
            color: var(--color-body-gray);
            margin: 0;
            line-height: 1.6;
        }

        .contact-details a {
            color: var(--color-accent-blue);
            text-decoration: none;
        }

        .social-links {
            margin-top: 40px;
            padding-top: 40px;
            border-top: 1px solid #E5E5E7;
        }

        .social-icons {
            display: flex;
            gap: 16px;
            margin-top: 16px;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--color-light-gray);
            color: var(--color-dark-gray);
            font-weight: 700;
            text-decoration: none;
            transition: var(--transition);
        }

        .social-icon:hover {
            background-color: var(--color-accent-blue);
            color: white;
        }

        .faq-section {
            max-width: 900px;
            margin: 60px auto;
            padding: 0 20px;
        }

        .faq-container h2 {
            font-size: 32px;
            margin-bottom: 40px;
            text-align: center;
        }

        .faq-item {
            margin-bottom: 16px;
            border: 1px solid #E5E5E7;
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        .faq-question {
            width: 100%;
            padding: 20px;
            background-color: var(--color-light-gray);
            border: none;
            text-align: left;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .faq-question::after {
            content: "▼";
            font-size: 12px;
            transition: var(--transition);
        }

        .faq-question.active::after {
            transform: rotate(180deg);
        }

        .faq-question:hover {
            background-color: #EFEFEF;
        }

        .faq-answer {
            padding: 20px;
            background-color: var(--color-white);
            border-top: 1px solid #E5E5E7;
        }

        .faq-answer p {
            margin: 0;
            color: var(--color-body-gray);
            line-height: 1.6;
        }

        @media (max-width: 768px) {
            .contact-container {
                grid-template-columns: 1fr;
                gap: 40px;
            }
        }
    </style>

    <script>
        // Setup login modal
        document.addEventListener('DOMContentLoaded', function() {
            const loginBtn = document.getElementById('login-btn');
            const cartBtn = document.getElementById('cart-btn');
            
            if (loginBtn) {
                loginBtn.addEventListener('click', function() {
                    const modal = document.getElementById('login-modal');
                    if (modal) modal.classList.add('active');
                });
            }

            if (cartBtn) {
                cartBtn.addEventListener('click', function() {
                    const modal = document.getElementById('cart-modal');
                    if (modal) modal.classList.add('active');
                });
            }

            // Setup modal close buttons
            document.querySelectorAll('.modal-close').forEach(btn => {
                btn.addEventListener('click', function() {
                    const modal = this.closest('.modal');
                    if (modal) modal.classList.remove('active');
                });
            });

            // Setup FAQ accordion
            document.querySelectorAll('.faq-question').forEach(button => {
                button.addEventListener('click', function() {
                    const answer = this.nextElementSibling;
                    const isActive = this.classList.contains('active');
                    
                    // Close all other FAQs
                    document.querySelectorAll('.faq-question').forEach(q => {
                        q.classList.remove('active');
                        q.nextElementSibling.style.display = 'none';
                    });
                    
                    // Toggle current FAQ
                    if (!isActive) {
                        this.classList.add('active');
                        answer.style.display = 'block';
                    }
                });
            });

            // Setup contact form
            const contactForm = document.getElementById('contact-form');
            if (contactForm) {
                contactForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    // Show success message
                    const btn = this.querySelector('button[type="submit"]');
                    const originalText = btn.textContent;
                    btn.textContent = '✓ Mensaje enviado!';
                    btn.disabled = true;
                    
                    setTimeout(() => {
                        btn.textContent = originalText;
                        btn.disabled = false;
                        this.reset();
                    }, 2000);
                });
            }
        });
    </script>
</body>
</html>
