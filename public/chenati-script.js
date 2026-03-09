/**
 * CHENATI SPORTS - APPLE STYLE SCRIPT
 * Ultra Minimal Luxury Tech Interactions
 */

// Database de productos con detalles
const PRODUCTS_DATABASE = {
    '1': {
        id: '1',
        name: 'Chenati Pro Max',
        price: 189.00,
        image: 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&q=95&auto=format',
        description: 'La zapatilla de rendimiento máximo diseñada para atletas profesionales. Combina tecnología de amortiguación avanzada con un diseño ultraligero para un desempeño sin igual.',
        originalPrice: 249.00,
        discount: 24
    },
    '2': {
        id: '2',
        name: 'Chenati Ultra',
        price: 229.00,
        image: 'https://images.unsplash.com/photo-1525966222134-fcaba7b3ebc3?w=600&q=95&auto=format',
        description: 'Diseñada para ultramaratones y entrenamientos extremos. Sistema de amortiguación elite con tecnología de propulsión activa para máxima eficiencia.',
        originalPrice: 299.00,
        discount: 23
    },
    '3': {
        id: '3',
        name: 'Chenati Sport',
        price: 149.00,
        image: 'https://images.unsplash.com/photo-1460353581641-37baddab0fa2?w=600&q=95&auto=format',
        description: 'Zapatilla versátil para entrenamiento diario y uso casual. Perfecta para correr, caminar o cualquier actividad deportiva con estilo.',
        originalPrice: 199.00,
        discount: 25
    },
    '4': {
        id: '4',
        name: 'Chenati Runner',
        price: 169.00,
        image: 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=600&q=95&auto=format',
        description: 'Diseñada específicamente para corredores de ruta. Amortiguación balanceada con flexibilidad natural para un corrimiento eficiente.',
        originalPrice: 219.00,
        discount: 23
    },
    '5': {
        id: '5',
        name: 'Chenati Elite',
        price: 199.00,
        image: 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&q=95&auto=format',
        description: 'Colección exclusiva para competidores serios. Premium materials y tecnología de vanguardia para rendimiento competitivo.',
        originalPrice: 269.00,
        discount: 26
    },
    '6': {
        id: '6',
        name: 'Chenati Performance',
        price: 179.00,
        image: 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?w=600&q=95&auto=format',
        description: 'Desempeño fiable para entrenamientos frecuentes. Durabilidad excepcional con estilo moderno y acabado premium.',
        originalPrice: 229.00,
        discount: 22
    },
    '7': {
        id: '7',
        name: 'Chenati Swift',
        price: 159.00,
        image: 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&q=95&auto=format',
        description: 'Ligera y rápida. Diseña para atletas que buscan velocidad y agilidad en cada movimiento.',
        originalPrice: 209.00,
        discount: 24
    },
    '8': {
        id: '8',
        name: 'Chenati Force',
        price: 219.00,
        image: 'https://images.unsplash.com/photo-1525966222134-fcaba7b3ebc3?w=600&q=95&auto=format',
        description: 'Potencia y estabilidad en cada paso. Fortalecer tu desempeño con esta zapatilla de fuerza premium.',
        originalPrice: 289.00,
        discount: 24
    },
    '9': {
        id: '9',
        name: 'Chenati Legend',
        price: 239.00,
        image: 'https://images.unsplash.com/photo-1460353581641-37baddab0fa2?w=600&q=95&auto=format',
        description: 'Edición legendaria con tecnología de punta. La opción definitiva para campeones.',
        originalPrice: 319.00,
        discount: 25
    },
    '10': {
        id: '10',
        name: 'Chenati Stride',
        price: 179.00,
        image: 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=600&q=95&auto=format',
        description: 'Avanza con confianza. Cada zancada es una experiencia de comodidad y rendimiento.',
        originalPrice: 239.00,
        discount: 25
    },
    '11': {
        id: '11',
        name: 'Chenati Apex',
        price: 249.00,
        image: 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&q=95&auto=format',
        description: 'Lo más alto del rendimiento. Alcanza tu pico con esta zapatilla de élite.',
        originalPrice: 329.00,
        discount: 24
    },
    '12': {
        id: '12',
        name: 'Chenati Vision',
        price: 189.00,
        image: 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?w=600&q=95&auto=format',
        description: 'Claridad de propósito en cada movimiento. Diseña para quienes ven clara su meta.',
        originalPrice: 249.00,
        discount: 24
    }
};

(() => {
    'use strict';

    // ===== Shopping Cart Management =====
    let cart = JSON.parse(localStorage.getItem('chenati-cart')) || [];

    const updateCartDisplay = () => {
        const cartCount = document.querySelector('#cart-count');
        if (cartCount) {
            cartCount.textContent = cart.length;
        }
    };

    const addToCart = (productId, productName, productPrice, quantity = 1) => {
        const product = PRODUCTS_DATABASE[productId];
        
        const cartItem = {
            id: productId,
            name: productName,
            price: parseFloat(productPrice),
            quantity: quantity,
            addedAt: new Date().toISOString(),
            image: product ? product.image : ''
        };

        const existingItem = cart.find(item => item.id === productId);
        
        if (existingItem) {
            existingItem.quantity += quantity;
        } else {
            cart.push(cartItem);
        }

        localStorage.setItem('chenati-cart', JSON.stringify(cart));
        updateCartDisplay();
        showNotification(`${productName} agregado al carrito`);
    };

    const removeFromCart = (productId) => {
        cart = cart.filter(item => item.id !== productId);
        localStorage.setItem('chenati-cart', JSON.stringify(cart));
        updateCartDisplay();
        renderCartItems();
        updateCartSummary();
    };

    const showNotification = (message) => {
        const notification = document.createElement('div');
        notification.className = 'notification';
        notification.textContent = message;
        notification.style.cssText = `
            position: fixed;
            top: 80px;
            right: 20px;
            background-color: var(--color-black);
            color: white;
            padding: 16px 24px;
            border-radius: 8px;
            font-size: 14px;
            animation: slideInRight 0.4s ease;
            z-index: 2000;
        `;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.animation = 'slideOutRight 0.4s ease';
            setTimeout(() => notification.remove(), 400);
        }, 3000);
    };

    // ===== Modal Management =====
    const openModal = (modalId) => {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    };

    const closeModal = (modalId) => {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    };

    const setupModalCloseButtons = () => {
        document.querySelectorAll('.modal-close').forEach(btn => {
            btn.addEventListener('click', function() {
                const modal = this.closest('.modal');
                if (modal) {
                    closeModal(modal.id);
                }
            });
        });

        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal(this.id);
                }
            });
        });
    };

    // ===== Product Detail Modal =====
    const openProductDetail = (productId) => {
        const product = PRODUCTS_DATABASE[productId];
        if (!product) return;

        document.getElementById('product-detail-name').textContent = product.name;
        document.getElementById('product-detail-img').src = product.image;
        document.getElementById('product-detail-price').textContent = `$${product.price.toFixed(2)}`;
        document.getElementById('product-detail-description').textContent = product.description;
        document.getElementById('product-quantity').value = '1';
        document.getElementById('product-size').value = '';
        document.getElementById('product-color').value = '';

        openModal('product-modal');
    };

    const setupProductDetailActions = () => {
        const addToCartBtn = document.getElementById('add-to-cart-detail');
        if (addToCartBtn) {
            addToCartBtn.addEventListener('click', function() {
                const productName = document.getElementById('product-detail-name').textContent;
                const productPrice = document.getElementById('product-detail-price').textContent.replace('$', '');
                const productId = Object.keys(PRODUCTS_DATABASE).find(id => 
                    PRODUCTS_DATABASE[id].name === productName
                );
                const quantity = parseInt(document.getElementById('product-quantity').value) || 1;
                const size = document.getElementById('product-size').value;
                const color = document.getElementById('product-color').value;

                if (!size || !color) {
                    showNotification('Por favor selecciona talla y color');
                    return;
                }

                addToCart(productId, productName, productPrice, quantity);
                closeModal('product-modal');
            });
        }

        const buyNowBtn = document.getElementById('buy-now');
        if (buyNowBtn) {
            buyNowBtn.addEventListener('click', function() {
                addToCartBtn.click();
                setTimeout(() => {
                    openModal('cart-modal');
                }, 500);
            });
        }

        // Quantity controls
        document.getElementById('qty-plus')?.addEventListener('click', function() {
            const input = document.getElementById('product-quantity');
            input.value = Math.min(parseInt(input.value) + 1, 10);
        });

        document.getElementById('qty-minus')?.addEventListener('click', function() {
            const input = document.getElementById('product-quantity');
            input.value = Math.max(parseInt(input.value) - 1, 1);
        });
    };

    // ===== Cart Modal =====
    const renderCartItems = () => {
        const itemsList = document.getElementById('cart-items-list');
        const emptyCart = document.getElementById('empty-cart');

        if (cart.length === 0) {
            itemsList.innerHTML = '';
            emptyCart.style.display = 'flex';
            return;
        }

        emptyCart.style.display = 'none';
        itemsList.innerHTML = cart.map(item => `
            <div class="cart-item">
                <div class="cart-item-image">👟</div>
                <div class="cart-item-details">
                    <h4>${item.name}</h4>
                    <p>Cantidad: ${item.quantity}</p>
                </div>
                <div class="cart-item-price">$${(item.price * item.quantity).toFixed(2)}</div>
                <button class="cart-item-remove" data-product="${item.id}" aria-label="Eliminar">🗑️</button>
            </div>
        `).join('');

        // Agregar listeners para eliminar
        document.querySelectorAll('.cart-item-remove').forEach(btn => {
            btn.addEventListener('click', function() {
                const productId = this.getAttribute('data-product');
                removeFromCart(productId);
            });
        });
    };

    const updateCartSummary = () => {
        const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const shipping = subtotal > 100 ? 0 : 10;
        const tax = subtotal * 0.08; // 8% tax
        const total = subtotal + shipping + tax;

        document.getElementById('cart-subtotal').textContent = `$${subtotal.toFixed(2)}`;
        document.getElementById('cart-shipping').textContent = shipping === 0 ? 'Gratis' : `$${shipping.toFixed(2)}`;
        document.getElementById('cart-tax').textContent = `$${tax.toFixed(2)}`;
        document.getElementById('cart-total').textContent = `$${total.toFixed(2)}`;
    };

    const setupCartButton = () => {
        const cartBtn = document.querySelector('#cart-btn');
        if (cartBtn) {
            cartBtn.addEventListener('click', () => {
                renderCartItems();
                updateCartSummary();
                openModal('cart-modal');
            });
        }
    };

    const setupCheckoutButton = () => {
        const checkoutBtn = document.getElementById('checkout-btn');
        if (checkoutBtn) {
            checkoutBtn.addEventListener('click', function() {
                if (cart.length === 0) {
                    showNotification('El carrito está vacío');
                    return;
                }
                
                closeModal('cart-modal');
                renderCheckoutItems();
                updateCheckoutTotals();
                currentCheckoutStep = 1;
                showCheckoutStep(1);
                openModal('checkout-modal');
            });
        }

        const continueShoppingBtn = document.getElementById('continue-shopping');
        if (continueShoppingBtn) {
            continueShoppingBtn.addEventListener('click', function() {
                closeModal('cart-modal');
            });
        }
    };

    // ===== Checkout Flow =====
    let currentCheckoutStep = 1;

    const showCheckoutStep = (stepNumber) => {
        // Ocultar todos los pasos
        document.querySelectorAll('.checkout-step').forEach(step => {
            step.classList.remove('active');
        });

        // Mostrar el paso actual
        const currentStep = document.getElementById(`step-${stepNumber}`);
        if (currentStep) {
            currentStep.classList.add('active');
        }

        // Actualizar indicador de progreso
        document.querySelectorAll('.progress-step').forEach((step, index) => {
            const stepNum = index + 1;
            step.classList.remove('active', 'completed');
            
            if (stepNum === stepNumber) {
                step.classList.add('active');
            } else if (stepNum < stepNumber) {
                step.classList.add('completed');
            }
        });

        // Actualizar botones de navegación
        const prevBtn = document.getElementById('prev-step');
        const nextBtn = document.getElementById('next-step');

        if (prevBtn && nextBtn) {
            prevBtn.style.display = stepNumber === 1 ? 'none' : 'block';
            
            if (stepNumber === 4) {
                nextBtn.textContent = 'Iniciar Sesión';
                nextBtn.disabled = false;
            } else {
                nextBtn.textContent = 'Siguiente';
                nextBtn.disabled = false;
            }
        }

        currentCheckoutStep = stepNumber;
    };

    const renderCheckoutItems = () => {
        const itemsList = document.getElementById('checkout-items-list');
        itemsList.innerHTML = cart.map(item => `
            <div class="checkout-item">
                <div class="checkout-item-details">
                    <h5>${item.name}</h5>
                    <p>Cantidad: ${item.quantity}</p>
                </div>
                <div class="checkout-item-price">$${(item.price * item.quantity).toFixed(2)}</div>
            </div>
        `).join('');
    };

    const updateCheckoutTotals = () => {
        const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const tax = subtotal * 0.08; // 8% tax
        const total = subtotal + tax;

        document.getElementById('checkout-subtotal').textContent = `$${subtotal.toFixed(2)}`;
        document.getElementById('checkout-tax').textContent = `$${tax.toFixed(2)}`;
        document.getElementById('checkout-final-total').textContent = `$${total.toFixed(2)}`;
    };

    const setupCheckoutNavigation = () => {
        const nextBtn = document.getElementById('next-step');
        const prevBtn = document.getElementById('prev-step');

        if (nextBtn) {
            nextBtn.addEventListener('click', function() {
                if (currentCheckoutStep < 4) {
                    // Validar el paso actual antes de avanzar
                    if (validateCheckoutStep(currentCheckoutStep)) {
                        showCheckoutStep(currentCheckoutStep + 1);
                    }
                } else if (currentCheckoutStep === 4) {
                    // En el paso 4, validar login
                    handleCheckoutLogin();
                }
            });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', function() {
                if (currentCheckoutStep > 1) {
                    showCheckoutStep(currentCheckoutStep - 1);
                }
            });
        }

        // Setup payment method change
        document.querySelectorAll('input[name="payment"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const cardForm = document.getElementById('card-form');
                if (this.value === 'card') {
                    cardForm.style.display = 'block';
                } else {
                    cardForm.style.display = 'none';
                }
            });
        });
    };

    const validateCheckoutStep = (step) => {
        if (step === 1) {
            // Paso de confirmación siempre válido
            return true;
        } else if (step === 2) {
            // Validar campos de envío
            const form = document.querySelector('.checkout-form');
            const inputs = form.querySelectorAll('input[required], select[required]');
            for (let input of inputs) {
                if (!input.value.trim()) {
                    showNotification('Por favor completa todos los campos de envío');
                    return false;
                }
            }
            return true;
        } else if (step === 3) {
            // Validar pago
            const cardForm = document.getElementById('card-form');
            if (cardForm.style.display !== 'none') {
                const cardInputs = cardForm.querySelectorAll('input[required]');
                for (let input of cardInputs) {
                    if (!input.value.trim()) {
                        showNotification('Por favor completa los datos de tu tarjeta');
                        return false;
                    }
                }
            }
            return true;
        }
        return true;
    };

    const handleCheckoutLogin = () => {
        const email = document.getElementById('login-email').value.trim();
        const password = document.getElementById('login-password').value.trim();

        // Validar que los campos no estén vacíos
        if (!email || !password) {
            showNotification('Por favor completa el email y contraseña');
            return;
        }

        // Validar formato de email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            showNotification('Por favor ingresa un email válido');
            return;
        }

        // Mostrar estado de carga
        const nextBtn = document.getElementById('next-step');
        const originalText = nextBtn.textContent;
        nextBtn.disabled = true;
        nextBtn.textContent = 'Verificando...';

        // Simular verificación de credenciales (en producción, esto sería una llamada AJAX)
        setTimeout(() => {
            // Para este demo, aceptar cualquier email/contraseña válida
            // En producción, verificar contra la base de datos
            
            // Guardar credenciales en sessionStorage (NO en producción con datos reales)
            sessionStorage.setItem('chenati_user', JSON.stringify({
                email: email,
                loginTime: new Date().toISOString()
            }));

            // Mostrar confirmación de compra
            showCheckoutConfirmation(email);
            
            // Limpiar formulario
            document.getElementById('checkout-login-form').reset();
            nextBtn.disabled = false;
            nextBtn.textContent = originalText;
        }, 1500);
    };

    const showCheckoutConfirmation = (email) => {
        // Cambiar contenido del step 4 a confirmación
        const step4 = document.getElementById('step-4');
        const orderNumber = 'CHE-' + new Date().toISOString().slice(0, 10).replace(/-/g, '') + '-' + Math.floor(Math.random() * 100000);
        const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0) * 1.08;

        step4.innerHTML = `
            <div class="checkout-confirmation">
                <div class="confirmation-icon">✓</div>
                <h3>¡Compra Completada!</h3>
                <p class="confirmation-subtitle">Tu pedido ha sido procesado exitosamente</p>
                
                <div class="confirmation-details">
                    <div class="detail-row">
                        <span class="detail-label">Número de Pedido:</span>
                        <span class="detail-value">#${orderNumber}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Email de Confirmación:</span>
                        <span class="detail-value">${email}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Monto Total:</span>
                        <span class="detail-value">$${total.toFixed(2)}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Tiempo de Entrega:</span>
                        <span class="detail-value">5-7 días hábiles</span>
                    </div>
                </div>

                <div class="confirmation-message">
                    <p>📧 Se ha enviado un email de confirmación a <strong>${email}</strong></p>
                    <p>Puedes rastrear tu pedido desde tu cuenta en Chenati Sports.</p>
                </div>
            </div>
        `;

        // Cambiar los botones de navegación
        const prevBtn = document.getElementById('prev-step');
        const nextBtn = document.getElementById('next-step');
        
        if (prevBtn) prevBtn.style.display = 'none';
        if (nextBtn) {
            nextBtn.textContent = 'Volver a la tienda';
            nextBtn.onclick = function() {
                closeModal('checkout-modal');
                cart = [];
                localStorage.removeItem('chenati-cart');
                updateCartDisplay();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            };
        }
    };

    // ===== Product Card Actions =====
    const setupProductActions = () => {
        // Botones "Agregar al carrito" en cards
        document.querySelectorAll('.btn-cart').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const productId = btn.getAttribute('data-product');
                const productName = btn.getAttribute('data-name');
                const productPrice = btn.getAttribute('data-price');
                
                addToCart(productId, productName, productPrice);

                const originalText = btn.textContent;
                btn.textContent = '✓ Agregado';
                btn.classList.add('added');
                
                setTimeout(() => {
                    btn.textContent = originalText;
                    btn.classList.remove('added');
                }, 2000);
            });
        });

        // Botones "Ver detalle"
        document.querySelectorAll('.btn-detail').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const productId = btn.getAttribute('data-product');
                openProductDetail(productId);
            });
        });
    };

    // ===== Smooth Scroll Navigation =====
    const setupSmoothScroll = () => {
        const links = document.querySelectorAll('a[href^="#"]');
        
        links.forEach(link => {
            link.addEventListener('click', (e) => {
                const href = link.getAttribute('href');
                if (href === '#') return;
                
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    };

    // ===== Navbar Appearance on Scroll =====
    const setupNavbarScroll = () => {
        const navbar = document.querySelector('.navbar');
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 100) {
                navbar.style.boxShadow = '0 1px 3px rgba(0, 0, 0, 0.06)';
            } else {
                navbar.style.boxShadow = 'none';
            }
        }, { passive: true });
    };

    // ===== Image Lazy Loading =====
    const setupLazyLoading = () => {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.style.opacity = '0';
                        
                        setTimeout(() => {
                            img.style.transition = 'opacity 0.6s ease';
                            img.style.opacity = '1';
                        }, 100);
                        
                        imageObserver.unobserve(img);
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('img').forEach(img => {
                imageObserver.observe(img);
            });
        }
    };

    // ===== Feature Card Intersection Observer =====
    const setupFeatureAnimations = () => {
        if ('IntersectionObserver' in window) {
            const observerOptions = {
                threshold: 0.2,
                rootMargin: '0px 0px -100px 0px'
            };

            const featureObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                        featureObserver.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.feature-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
                featureObserver.observe(card);
            });
        }
    };

    // ===== Initialize All Features =====
    const init = () => {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initializeApp);
        } else {
            initializeApp();
        }
    };

    const initializeApp = () => {
        updateCartDisplay();
        setupModalCloseButtons();
        setupProductDetailActions();
        setupCartButton();
        setupCheckoutButton();
        setupCheckoutNavigation();
        setupProductActions();
        setupSmoothScroll();
        setupNavbarScroll();
        setupLazyLoading();
        setupFeatureAnimations();

        console.log('🎨 Chenati Sports - Premium Experience Initialized');
        console.log(`🛒 Carrito: ${cart.length} producto(s)`);
    };

    init();
})();

// ===== CSS Animations =====
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from { opacity: 0; transform: translateX(100px); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes slideOutRight {
        from { opacity: 1; transform: translateX(0); }
        to { opacity: 0; transform: translateX(100px); }
    }
`;
document.head.appendChild(style);
