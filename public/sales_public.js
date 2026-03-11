/**
 * LaPeruvianita Shoes - Funcionalidad de Tienda Online
 */

(function() {
    'use strict';

    // Variables globales
    let currentUserEmail = null;
    let currentQuickProduct = null;
    let currentQuickPrice = 0;
    let currentCategory = 'all';
    let selectedSize = null;
    let selectedSizes = {}; // Guardar tallas por producto
    let cart = []; // Carrito de compras

    // ============================================
    // Carrito Persistente con localStorage
    // ============================================
    
    const CART_STORAGE_KEY = 'laperuvianita_cart';
    
    function saveCartToStorage() {
        try {
            localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cart));
        } catch (e) {
            console.warn('No se pudo guardar el carrito:', e);
        }
    }
    
    function loadCartFromStorage() {
        try {
            const saved = localStorage.getItem(CART_STORAGE_KEY);
            if (saved) {
                cart = JSON.parse(saved);
                updateCartDisplay();
            }
        } catch (e) {
            console.warn('No se pudo cargar el carrito:', e);
            cart = [];
        }
    }
    
    function clearCartStorage() {
        try {
            localStorage.removeItem(CART_STORAGE_KEY);
        } catch (e) {
            console.warn('No se pudo limpiar el carrito:', e);
        }
    }

    // ============================================
    // Inicialización
    // ============================================
    document.addEventListener('DOMContentLoaded', function() {
        console.log('LaPeruvianita Shoes - Tienda Online Cargada');
        
        // Cargar carrito desde localStorage
        loadCartFromStorage();
        
        // Configurar event listeners
        setupEventListeners();
    });

    // ============================================
    // Configuración de Event Listeners
    // ============================================
    function setupEventListeners() {
        // Cerrar modales al hacer click fuera
        document.querySelectorAll('.modal-overlay').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.style.display = 'none';
                }
            });
        });

        // Event listener para teclado (ESC para cerrar modales)
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeAllModals();
                closeMobileMenu();
            }
        });

        // Menú móvil - abrir al hacer click en hamburguesa
        const hamburgerBtn = document.querySelector('.hamburger-btn');
        if (hamburgerBtn) {
            hamburgerBtn.addEventListener('click', toggleMobileMenu);
        }

        // Mobile menu overlay click to close
        const mobileMenu = document.querySelector('.mobile-menu');
        if (mobileMenu) {
            mobileMenu.addEventListener('click', closeMobileMenu);
        }

        // Mobile menu close button
        const mobileMenuClose = document.querySelector('.mobile-menu-close');
        if (mobileMenuClose) {
            mobileMenuClose.addEventListener('click', closeMobileMenu);
        }
        
        // Cerrar menú de usuario desplegable al hacer click fuera
        document.addEventListener('click', function(event) {
            const userDropdownMenu = document.getElementById('userDropdownMenu');
            const userMenuBtn = document.getElementById('userMenuBtn');
            
            if (userDropdownMenu && userMenuBtn) {
                if (!userDropdownMenu.contains(event.target) && !userMenuBtn.contains(event.target)) {
                    userDropdownMenu.classList.remove('active');
                }
            }
        });
    }

    // ============================================
    // Funciones del Menú Móvil
    // ============================================
    function toggleMobileMenu() {
        const hamburgerBtn = document.querySelector('.hamburger-btn');
        const mobileMenu = document.querySelector('.mobile-menu');
        
        if (!hamburgerBtn || !mobileMenu) return;
        
        hamburgerBtn.classList.toggle('active');
        mobileMenu.classList.toggle('active');
        document.body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
    }

    function closeMobileMenu() {
        const hamburgerBtn = document.querySelector('.hamburger-btn');
        const mobileMenu = document.querySelector('.mobile-menu');
        
        if (!hamburgerBtn || !mobileMenu) return;
        
        hamburgerBtn.classList.remove('active');
        mobileMenu.classList.remove('active');
        document.body.style.overflow = '';
    }

    // Funciones globales para el menú móvil
    window.toggleMobileMenu = toggleMobileMenu;
    window.closeMobileMenu = closeMobileMenu;

    // ============================================
    // Funciones de Navegación por Categorías
    // ============================================
    
    /**
     * Cambia la categoría activa y filtra los productos
     * @param {string} category - Categoría a mostrar
     * @param {Event} event - Evento del clic
     */
    window.filterProducts = function(category, event) {
        currentCategory = category;
        
        // Desactivar todos los botones de categoría
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        
        // Desactivar todos los enlaces del menú
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.classList.remove('active');
        });

        // Filtrar productos
        const cards = document.querySelectorAll('.product-card');
        
        cards.forEach(card => {
            if (category === 'all' || card.dataset.category === category) {
                card.classList.remove('hidden');
                card.style.display = 'block';
            } else {
                card.classList.add('hidden');
                card.style.display = 'none';
            }
        });

        // Actualizar título de sección
        updateSectionTitle(category);
    };

    /**
     * Actualiza el título de la sección según la categoría
     * @param {string} category 
     */
    function updateSectionTitle(category) {
        const titleElement = document.querySelector('.section-title');
        const subtitleElement = document.querySelector('.section-subtitle');
        
        if (!titleElement) return;

        const titles = {
            'all': { title: 'Nuestra Colección', subtitle: 'Las mejores zapatillas de las marcas top' },
            'running': { title: 'Running', subtitle: 'Zapatillas para correr de alto rendimiento' },
            'urban': { title: 'Urbanas', subtitle: 'Estilo y comodidad para el día a día' },
            'basketball': { title: 'Basketball', subtitle: 'Diseñadas para la cancha' },
            'formal': { title: 'Formales', subtitle: 'Elegancia y sofisticación' },
            'training': { title: 'Training', subtitle: 'Para tu entrenamiento diario' },
            'kids': { title: 'Niños', subtitle: 'Para los más pequeños de la casa' },
            'hombres': { title: 'Hombres', subtitle: 'Colección masculina' },
            'mujeres': { title: 'Mujeres', subtitle: 'Colección femenina' }
        };

        const config = titles[category] || titles['all'];
        titleElement.textContent = config.title;
        
        if (subtitleElement) {
            subtitleElement.textContent = config.subtitle;
        }
    }

    // ============================================
    // Funciones del Menú de Navegación
    // ============================================

    /**
     * Muestra los productos para hombres
     */
    window.showHombres = function(event) {
        // Desactivar todos los botones de categoría
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        
        filterProducts('running', event);
        setActiveNav('hombres');
        logCategoryView('hombres');
        
        // Scroll hacia los productos
        scrollToProducts();
    };

    /**
     * Muestra los productos para mujeres
     */
    window.showMujeres = function(event) {
        // Desactivar todos los botones de categoría
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        
        filterProducts('urban', event);
        setActiveNav('mujeres');
        logCategoryView('mujeres');
        
        // Scroll hacia los productos
        scrollToProducts();
    };

    /**
     * Muestra los productos para niños
     */
    window.showNinos = function(event) {
        // Desactivar todos los botones de categoría
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        
        filterProducts('kids', event);
        setActiveNav('ninos');
        logCategoryView('kids');
        
        // Scroll hacia los productos
        scrollToProducts();
    };

    /**
     * Muestra todos los productos (Nuevo)
     */
    window.showNuevo = function(event) {
        // Desactivar todos los botones de categoría
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        
        filterProducts('all', event);
        setActiveNav('nuevo');
        logCategoryView('nuevo');
        
        // Scroll hacia los productos
        scrollToProducts();
    };

    /**
     * Scroll suave hacia la sección de productos
     */
    function scrollToProducts() {
        const productsSection = document.querySelector('.products-section');
        if (productsSection) {
            productsSection.scrollIntoView({ behavior: 'smooth' });
        }
    }

    /**
     * Muestra la colección completa (Ver Colección)
     */
    window.showColeccion = function(event) {
        // Desactivar todos los botones de categoría
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        
        filterProducts('all', event);
        setActiveNav('coleccion');
        logCategoryView('all');
        
        // Scroll hacia los productos
        scrollToProducts();
    };

    /**
     * Muestra las ofertas
     */
    window.showOfertas = function(event) {
        // Desactivar todos los botones de categoría
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        
        // Filtrar productos con descuento
        const cards = document.querySelectorAll('.product-card');
        cards.forEach(card => {
            const badge = card.querySelector('.product-badge.discount, .product-badge[discount]');
            if (badge) {
                card.classList.remove('hidden');
                card.style.display = 'block';
            } else {
                card.classList.add('hidden');
                card.style.display = 'none';
            }
        });
        
        // Actualizar título
        const titleElement = document.querySelector('.section-title');
        if (titleElement) {
            titleElement.textContent = '🔥 Ofertas';
        }
        
        setActiveNav('ofertas');
        logCategoryView('ofertas');
        
        // Scroll hacia los productos
        scrollToProducts();
    };

    /**
     * Muestra productos de una marca específica
     */
    window.showMarca = function(marca) {
        const cards = document.querySelectorAll('.product-card');
        
        cards.forEach(card => {
            const title = card.querySelector('.product-title').textContent.toLowerCase();
            if (title.includes(marca.toLowerCase())) {
                card.classList.remove('hidden');
                card.style.display = 'block';
            } else {
                card.classList.add('hidden');
                card.style.display = 'none';
            }
        });
        
        // Actualizar título
        const titleElement = document.querySelector('.section-title');
        if (titleElement) {
            titleElement.textContent = marca;
        }
    };

    /**
     * Establece el enlace de navegación activo
     */
    function setActiveNav(activeItem) {
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.classList.remove('active');
        });
        
        // Si hay un elemento con ID específico, marcarlo activo
        const activeLink = document.getElementById('nav-' + activeItem);
        if (activeLink) {
            activeLink.classList.add('active');
        }
    }

    /**
     * Registra la vista de categoría
     */
    function logCategoryView(category) {
        if (currentUserEmail) {
            logClientAction(currentUserEmail, 'view_category', category);
        }
    }

    // ============================================
    // Funciones de Productos
    // ============================================

    /**
     * Selecciona un color en el producto
     */
    window.selectColor = function(element) {
        if (!element) return;
        
        const parent = element.parentElement;
        if (!parent) return;
        
        parent.querySelectorAll('.color-dot').forEach(dot => dot.classList.remove('active'));
        element.classList.add('active');
    };

    /**
     * Selecciona una talla del producto
     */
    window.selectSize = function(size, productIndex) {
        // Guardar la talla seleccionada
        selectedSizes[productIndex] = size;
        
        // Actualizar visual del modal
        const sizeOptions = document.querySelectorAll('.size-option');
        sizeOptions.forEach(opt => {
            opt.classList.remove('active');
            if (opt.textContent === size) {
                opt.classList.add('active');
            }
        });
        
        showNotification('Talla ' + size + ' seleccionada', 'success');
    };

    // ============================================
    // Funciones del Carrito
    // ============================================

    /**
     * Agrega un producto al carrito
     */
    window.addToCart = function(productName, price, productIndex) {
        const size = selectedSizes[productIndex] || '40'; // Default 40 si no hay talla
        
        const product = {
            id: Date.now(),
            name: productName,
            price: price,
            size: size,
            quantity: 1
        };
        
        cart.push(product);
        saveCartToStorage(); // Guardar en localStorage
        updateCartDisplay();
        showNotification('¡Agregado al carrito! 🛒', 'success');
    };

    /**
     * Elimina un producto del carrito
     */
    window.removeFromCart = function(productId) {
        // Encontrar el producto antes de eliminar para mostrar mensaje
        var product = cart.find(function(item) { return item.id === productId; });
        var productName = product ? product.name : 'Producto';
        
        // Eliminar del array
        cart = cart.filter(function(item) { return item.id !== productId; });
        
        saveCartToStorage(); // Guardar en localStorage
        
        // Actualizar visualización
        updateCartDisplay();
        
        // Actualizar contenido del modal
        var cartItems = document.getElementById('cartItems');
        var cartTotal = document.getElementById('cartTotal');
        
        if (!cartItems || !cartTotal) return;
        
        if (cart.length === 0) {
            cartItems.innerHTML = '<div style="text-align: center; padding: 40px 20px; color: #666;">' +
                '<div style="font-size: 50px; margin-bottom: 15px;">🛒</div>' +
                '<p>Tu carrito está vacío</p>' +
                '<p style="font-size: 14px; margin-top: 10px;">Agrega productos para verlos aquí</p>' +
            '</div>';
            cartTotal.textContent = 'S/ 0.00';
        } else {
            var total = 0;
            cartItems.innerHTML = '';
            
            cart.forEach(function(item) {
                total += item.price;
                var itemHtml = '<div class="cart-item">' +
                    '<div class="cart-item-info">' +
                    '<h4>' + item.name + '</h4>' +
                    '<p>Talla: ' + item.size + '</p>' +
                    '<p class="cart-item-price">S/ ' + item.price.toFixed(2) + '</p>' +
                    '</div>' +
                    '<button class="cart-item-remove" onclick="removeFromCart(' + item.id + '); return false;">❌</button>' +
                    '</div>';
                cartItems.innerHTML += itemHtml;
            });
            
            cartTotal.textContent = 'S/ ' + total.toFixed(2);
        }
        
        showNotification(productName + ' eliminado del carrito', 'success');
    };

    /**
     * Actualiza la visualización del carrito (badge y contenido)
     */
    function updateCartDisplay() {
        // Actualizar badge del carrito
        const cartBadge = document.getElementById('cart-count');
        if (cartBadge) {
            var oldCount = parseInt(cartBadge.textContent) || 0;
            var newCount = cart.length;
            
            cartBadge.textContent = newCount;
            cartBadge.style.display = newCount > 0 ? 'flex' : 'none';
            
            // Animación si hay cambio
            if (newCount !== oldCount) {
                cartBadge.classList.add('updated');
                setTimeout(function() {
                    cartBadge.classList.remove('updated');
                }, 300);
                
                // Animación del ícono del carrito
                var cartBtn = document.querySelector('.cart-icon-btn');
                if (cartBtn) {
                    cartBtn.classList.add('bump');
                    setTimeout(function() {
                        cartBtn.classList.remove('bump');
                    }, 300);
                }
            }
        }
    }

    /**
     * Abre el modal del carrito
     */
    window.openCart = function() {
        const modal = document.getElementById('cartModal');
        if (!modal) return;
        
        const cartItems = document.getElementById('cartItems');
        const cartTotal = document.getElementById('cartTotal');
        
        if (!cartItems || !cartTotal) return;
        
        if (cart.length === 0) {
            cartItems.innerHTML = '<div style="text-align: center; padding: 40px 20px; color: #666;">' +
                '<div style="font-size: 50px; margin-bottom: 15px;">🛒</div>' +
                '<p>Tu carrito está vacío</p>' +
                '<p style="font-size: 14px; margin-top: 10px;">Agrega productos para verlos aquí</p>' +
            '</div>';
            cartTotal.textContent = 'S/ 0.00';
        } else {
            let total = 0;
            cartItems.innerHTML = '';
            
            cart.forEach(function(item) {
                total += item.price;
                var itemHtml = '<div class="cart-item">' +
                    '<div class="cart-item-info">' +
                    '<h4>' + item.name + '</h4>' +
                    '<p>Talla: ' + item.size + '</p>' +
                    '<p class="cart-item-price">S/ ' + item.price.toFixed(2) + '</p>' +
                    '</div>' +
                    '<button class="cart-item-remove" onclick="removeFromCart(' + item.id + ')">❌</button>' +
                    '</div>';
                cartItems.innerHTML += itemHtml;
            });
            
            cartTotal.textContent = 'S/ ' + total.toFixed(2);
        }
        
        modal.style.display = 'flex';
    };

    /**
     * Cierra el modal del carrito
     */
    window.closeCart = function() {
        const modal = document.getElementById('cartModal');
        if (modal) {
            modal.style.display = 'none';
        }
    };

    /**
     * Alterna el estado de favorito
     */
    window.toggleFavorite = function(element) {
        // No requiere login - permitir favoritos sin sesión
        if (!element) return;
        
        if (element.textContent === '🤍') {
            element.textContent = '❤️';
            showNotification('¡Agregado a favoritos! ❤️', 'success');
        } else {
            element.textContent = '🤍';
            showNotification('Eliminado de favoritos', 'success');
        }
    };

    // ============================================
    // Funciones de Modal de Login
    // ============================================

    window.openLoginModal = function() {
        document.getElementById('loginModal').style.display = 'flex';
    };

    window.closeLoginModal = function() {
        document.getElementById('loginModal').style.display = 'none';
    };

    window.handleLogin = function(e) {
        e.preventDefault();
        
        const emailInput = document.getElementById('loginEmail');
        const nameInput = document.getElementById('loginName');
        
        if (!emailInput || !nameInput) return;
        
        const email = emailInput.value.trim();
        const name = nameInput.value.trim();

        if (!email.toLowerCase().endsWith('@gmail.com')) {
            showNotification('Solo se permiten cuentas Gmail para clientes', 'error');
            return;
        }

        // Usar jQuery si está disponible, si no usar fetch
        if (typeof jQuery !== 'undefined') {
            $.ajax({
                url: '?controller=sales&action=registerClient',
                type: 'POST',
                data: { email: email, client_name: name },
                dataType: 'json',
                success: function(response) {
                    handleLoginResponse(response, email, name);
                },
                error: function() {
                    showNotification('Error al conectar con el servidor', 'error');
                }
            });
        } else {
            // Usar fetch API
            const formData = new FormData();
            formData.append('email', email);
            formData.append('client_name', name);

            fetch('?controller=sales&action=registerClient', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => handleLoginResponse(data, email, name))
            .catch(error => {
                showNotification('Error al conectar con el servidor', 'error');
            });
        }
    };

    function handleLoginResponse(response, email, name) {
        if (response.success) {
            currentUserEmail = email;
            updateUserArea(email);
            closeLoginModal();
            showNotification('¡Bienvenido a LaPeruvianita Shoes! 👟', 'success');
            logClientAction(email, 'view_product', 'Login - Catálogo');
            
            // Si el usuario estaba intentando finalizar una orden, completarla automáticamente
            if (isCheckingOut) {
                isCheckingOut = false; // Resetear la bandera
                // Abrir el checkout para completar el pedido
                setTimeout(() => openCheckout(), 500);
            }
        } else {
            showNotification(response.message || 'Error al iniciar sesión', 'error');
        }
    }

    window.updateUserArea = function(email) {
        const userArea = document.getElementById('userArea');
        if (!userArea) return;
        
        // Truncar el email para mostrar solo los primeros 20 caracteres
        const displayEmail = email.length > 20 ? email.substring(0, 20) + '...' : email;
        
        userArea.innerHTML = `
            <div class="user-profile-menu">
                <button class="user-email-btn" id="userMenuBtn" title="${email}">
                    👤 ${displayEmail}
                    <span class="menu-arrow">▼</span>
                </button>
                <div class="user-dropdown-menu" id="userDropdownMenu">
                    <div class="dropdown-header">${email}</div>
                    <a href="#" class="dropdown-item" id="viewProfileLink">
                        <span>📋</span> Ver Perfil
                    </a>
                    <a href="#" class="dropdown-item" id="editProfileLink">
                        <span>✏️</span> Editar Perfil
                    </a>
                    <a href="#" class="dropdown-item" id="changePasswordLink">
                        <span>🔐</span> Cambiar Contraseña
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item logout-item" id="logoutLink">
                        <span>🚪</span> Cerrar Sesión
                    </a>
                </div>
            </div>
        `;
        
        // Agregar event listeners después de crear el HTML
        setTimeout(() => {
            const userMenuBtn = document.getElementById('userMenuBtn');
            const viewProfileLink = document.getElementById('viewProfileLink');
            const editProfileLink = document.getElementById('editProfileLink');
            const changePasswordLink = document.getElementById('changePasswordLink');
            const logoutLink = document.getElementById('logoutLink');
            const userDropdownMenu = document.getElementById('userDropdownMenu');
            
            if (userMenuBtn) {
                userMenuBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (userDropdownMenu) {
                        userDropdownMenu.classList.toggle('active');
                    }
                });
            }
            
            if (viewProfileLink) {
                viewProfileLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    showNotification('📋 Función de perfil en desarrollo', 'info');
                    if (userDropdownMenu) userDropdownMenu.classList.remove('active');
                });
            }
            
            if (editProfileLink) {
                editProfileLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    showNotification('✏️ Función de editar perfil en desarrollo', 'info');
                    if (userDropdownMenu) userDropdownMenu.classList.remove('active');
                });
            }
            
            if (changePasswordLink) {
                changePasswordLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    showNotification('🔐 Función de cambiar contraseña en desarrollo', 'info');
                    if (userDropdownMenu) userDropdownMenu.classList.remove('active');
                });
            }
            
            if (logoutLink) {
                logoutLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    logout();
                });
            }
        }, 0);
    };

    window.logout = function(event) {
        if (event) {
            event.preventDefault();
        }
        currentUserEmail = null;
        
        const userArea = document.getElementById('userArea');
        if (userArea) {
            userArea.innerHTML = '<button class="user-btn" onclick="openLoginModal()">Mi Cuenta</button>';
        }
        
        // Limpiar carrito
        cart = [];
        clearCartStorage();
        
        showNotification('Sesión cerrada correctamente', 'success');
    };
    
    window.openProfileModal = function(event) {
        event.preventDefault();
        showNotification('📋 Función de perfil en desarrollo', 'info');
        const menu = document.getElementById('userDropdownMenu');
        if (menu) menu.classList.remove('active');
    };
    
    window.openEditProfileModal = function(event) {
        event.preventDefault();
        showNotification('✏️ Función de editar perfil en desarrollo', 'info');
        const menu = document.getElementById('userDropdownMenu');
        if (menu) menu.classList.remove('active');
    };
    
    window.openChangePasswordModal = function(event) {
        event.preventDefault();
        showNotification('🔐 Función de cambiar contraseña en desarrollo', 'info');
        const menu = document.getElementById('userDropdownMenu');
        if (menu) menu.classList.remove('active');
    };

    // ============================================
    // Funciones de Vista Rápida (Quick View)
    // ============================================

    window.viewProduct = function(productName, price, productIndex) {
        // No requiere login - mostrar directamente los detalles
        currentQuickProduct = productName;
        currentQuickPrice = price;

        // Obtener el índice del producto si no se proporcionó
        if (!productIndex) {
            productIndex = getProductIndex(productName);
        }
        const savedSize = selectedSizes[productIndex] || null;

        // Actualizar contenido del modal
        const titleEl = document.getElementById('quickTitle');
        const priceEl = document.getElementById('quickPrice');
        const originalEl = document.getElementById('quickOriginal');
        const buyBtn = document.getElementById('quickBuyBtn');

        if (titleEl) titleEl.textContent = productName;
        if (priceEl) priceEl.textContent = 'S/ ' + price.toFixed(2);
        if (originalEl) originalEl.textContent = '';
        if (buyBtn) buyBtn.textContent = 'Agregar al Carrito - S/ ' + price.toFixed(2);

        // Actualizar tallas - marcar la talla guardada si existe
        const sizeOptions = document.querySelectorAll('.size-option');
        sizeOptions.forEach(opt => {
            opt.classList.remove('active');
            if (savedSize && opt.textContent === savedSize) {
                opt.classList.add('active');
            }
        });

        // Mostrar modal
        const modal = document.getElementById('quickViewModal');
        if (modal) {
            modal.style.display = 'flex';
        }
    };

    window.closeQuickView = function() {
        const modal = document.getElementById('quickViewModal');
        if (modal) {
            modal.style.display = 'none';
        }
    };

    window.quickPurchase = function() {
        // Agregar al carrito con la talla seleccionada
        if (currentQuickProduct && currentQuickPrice) {
            var productIndex = getProductIndex(currentQuickProduct);
            addToCart(currentQuickProduct, currentQuickPrice, productIndex);
        }
        closeQuickView();
    };

    /**
     * Finaliza la compra - Abre el proceso de checkout
     */
    window.checkout = function() {
        // 1. Validación estricta: Si no hay productos, NO hacer nada más
        if (!cart || cart.length === 0) {
            showNotification('❌ Debes seleccionar al menos un producto para continuar.', 'error');
            return;
        }
        
        // Validación adicional: Verificar que los productos tengan datos válidos
        const validCart = cart.every(item => item.name && item.price && item.size);
        if (!validCart) {
            showNotification('❌ Hay productos inválidos en tu carrito. Por favor, revisa y vuelve a intentar.', 'error');
            return;
        }
        
        // Mostrar cantidad de productos en carrito
        const itemCount = cart.length;
        const itemText = itemCount === 1 ? 'producto' : 'productos';
        console.log(`Iniciando checkout con ${itemCount} ${itemText}`);
        
        // Abrir el modal de checkout directamente
        openCheckout();
    };
    
    /**
     * Abre el modal de checkout
     */
    window.openCheckout = function() {
        closeCart();
        const modal = document.getElementById('checkoutModal');
        if (!modal) return;
        
        // Resetear el checkout al primer paso
        resetCheckout();
        
        // Mostrar modal
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    };
    
    /**
     * Cierra el modal de checkout
     */
    window.closeCheckout = function() {
        const modal = document.getElementById('checkoutModal');
        if (modal) {
            modal.style.display = 'none';
        }
        document.body.style.overflow = '';
    };
    
    /**
     * Resetea el proceso de checkout
     */
    function resetCheckout() {
        // Resetear todos los steps
        document.querySelectorAll('.checkout-step').forEach(function(step) {
            step.classList.remove('active');
        });
        document.querySelectorAll('.progress-step').forEach(function(step) {
            step.classList.remove('active', 'completed');
        });
        
        // Ir al step 1
        goToStep(1);
    }
    
    /**
     * Navega a un paso específico del checkout
     */
    window.goToStep = function(stepNumber) {
        // Validar datos del paso 1 antes de ir al paso 2
        if (stepNumber === 2) {
            if (!validateStep1()) return;
        }
        
        // Validar método de envío antes de ir al paso 3
        if (stepNumber === 3) {
            if (!validateStep2()) return;
        }
        
        // Validar método de pago antes de ir al paso 4
        if (stepNumber === 4) {
            if (!validateStep3()) return;
            // Generar resumen del pedido
            generateOrderSummary();
        }
        
        // Actualizar UI
        document.querySelectorAll('.checkout-step').forEach(function(step) {
            step.classList.remove('active');
        });
        document.querySelectorAll('.progress-step').forEach(function(step) {
            step.classList.remove('active');
            var stepNum = parseInt(step.dataset.step);
            if (stepNum < stepNumber) {
                step.classList.add('completed');
            } else if (stepNum === stepNumber) {
                step.classList.add('active');
            }
        });
        
        var currentStep = document.getElementById('checkoutStep' + stepNumber);
        if (currentStep) {
            currentStep.classList.add('active');
        }
        
        // Scroll al inicio del modal
        var modal = document.querySelector('.checkout-modal');
        if (modal) modal.scrollTop = 0;
    };
    
    /**
     * Valida el paso 1 - Datos del cliente
     */
    function validateStep1() {
        var name = document.getElementById('customerName').value.trim();
        var email = document.getElementById('customerEmail').value.trim();
        var phone = document.getElementById('customerPhone').value.trim();
        var dni = document.getElementById('customerDni').value.trim();
        var address = document.getElementById('customerAddress').value.trim();
        var city = document.getElementById('customerCity').value;
        var district = document.getElementById('customerDistrict').value.trim();
        
        if (!name || !email || !phone || !dni || !address || !city || !district) {
            showNotification('Por favor, completa todos los campos requeridos', 'error');
            return false;
        }
        
        // Validar email
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            showNotification('Por favor, ingresa un correo electrónico válido', 'error');
            return false;
        }
        
        // Validar DNI (8 dígitos)
        if (dni.length !== 8 || !/^\d+$/.test(dni)) {
            showNotification('El DNI debe tener 8 dígitos', 'error');
            return false;
        }
        
        return true;
    }
    
    /**
     * Valida el paso 2 - Envío
     */
    function validateStep2() {
        var shipping = document.querySelector('input[name="shipping"]:checked');
        if (!shipping) {
            showNotification('Por favor, selecciona un método de envío', 'error');
            return false;
        }
        return true;
    }
    
    /**
     * Valida el paso 3 - Pago
     */
    function validateStep3() {
        var payment = document.querySelector('input[name="payment"]:checked');
        if (!payment) {
            showNotification('Por favor, selecciona un método de pago', 'error');
            return false;
        }
        
        var paymentValue = payment.value;
        
        // Validar campos de tarjeta
        if (paymentValue === 'card') {
            var cardNumber = document.getElementById('cardNumber').value.trim();
            var cardExpiry = document.getElementById('cardExpiry').value.trim();
            var cardCvv = document.getElementById('cardCvv').value.trim();
            var cardName = document.getElementById('cardName').value.trim();
            
            if (!cardNumber || !cardExpiry || !cardCvv || !cardName) {
                showNotification('Por favor, completa los datos de tu tarjeta', 'error');
                return false;
            }
        }
        
        // Validar referencia Yape
        if (paymentValue === 'yape') {
            var yapeRef = document.getElementById('yapeReference').value.trim();
            if (!yapeRef) {
                showNotification('Por favor, ingresa el número de operación', 'error');
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * Actualiza el costo de envío según la opción seleccionada
     */
    window.updateShippingCost = function() {
        var shipping = document.querySelector('input[name="shipping"]:checked');
        if (!shipping) return 0;
        
        var costs = {
            'standard': 15,
            'express': 25,
            'store': 0
        };
        
        return costs[shipping.value] || 0;
    };
    
    /**
     * Muestra/oculta campos de pago según el método seleccionado
     */
    window.togglePaymentFields = function() {
        var payment = document.querySelector('input[name="payment"]:checked');
        if (!payment) return;
        
        var cardFields = document.getElementById('cardPaymentFields');
        var yapeFields = document.getElementById('yapePaymentFields');
        
        if (cardFields) cardFields.style.display = payment.value === 'card' ? 'block' : 'none';
        if (yapeFields) yapeFields.style.display = payment.value === 'yape' ? 'block' : 'none';
    };
    
    /**
     * Genera el resumen del pedido para el paso 4
     */
    function generateOrderSummary() {
        // Datos del cliente
        document.getElementById('summaryName').textContent = document.getElementById('customerName').value;
        document.getElementById('summaryEmail').textContent = document.getElementById('customerEmail').value;
        document.getElementById('summaryPhone').textContent = document.getElementById('customerPhone').value;
        document.getElementById('summaryAddress').textContent = 
            document.getElementById('customerAddress').value + ', ' + 
            document.getElementById('customerDistrict').value + ', ' + 
            document.getElementById('customerCity').options[document.getElementById('customerCity').selectedIndex].text;
        
        // Envío
        var shipping = document.querySelector('input[name="shipping"]:checked');
        var shippingText = 'Envío Regular';
        var shippingCost = 15;
        if (shipping) {
            if (shipping.value === 'express') {
                shippingText = 'Envío Express';
                shippingCost = 25;
            } else if (shipping.value === 'store') {
                shippingText = 'Recojo en Tienda';
                shippingCost = 0;
            }
        }
        document.getElementById('summaryShipping').textContent = shippingText + ' - S/ ' + shippingCost.toFixed(2);
        
        // Pago
        var payment = document.querySelector('input[name="payment"]:checked');
        var paymentText = 'Tarjeta';
        if (payment) {
            if (payment.value === 'yape') paymentText = 'Yape / Plin';
            else if (payment.value === 'cash') paymentText = 'Efectivo contra entrega';
        }
        document.getElementById('summaryPayment').textContent = paymentText;
        
        // Productos
        var productsHtml = '';
        cart.forEach(function(item) {
            productsHtml += '<div class="summary-product-item">' +
                '<span>' + item.name + ' (Talla: ' + item.size + ')</span>' +
                '<span>S/ ' + item.price.toFixed(2) + '</span>' +
            '</div>';
        });
        document.getElementById('summaryProducts').innerHTML = productsHtml || '<p>No hay productos</p>';
        
        // Totales
        var subtotal = cart.reduce(function(sum, item) { return sum + item.price; }, 0);
        document.getElementById('summarySubtotal').textContent = 'S/ ' + subtotal.toFixed(2);
        document.getElementById('summaryShippingCost').textContent = 'S/ ' + shippingCost.toFixed(2);
        document.getElementById('summaryTotal').textContent = 'S/ ' + (subtotal + shippingCost).toFixed(2);
    }
    
    /**
     * Finaliza la compra
     */
    window.finalizeOrder = function() {
        // VALIDACIÓN OBLIGATORIA: El usuario DEBE estar registrado para completar la compra
        if (!currentUserEmail) {
            showNotification('⚠️ Debes iniciar sesión o registrarte para completar tu pedido', 'warning');
            isCheckingOut = true; // Marcar que después del login queremos finalizar la orden
            closeCheckout();
            openLoginModal();
            return;
        }
        
        // Validación adicional del carrito
        if (!cart || cart.length === 0) {
            showNotification('❌ Tu carrito está vacío. No se puede completar el pedido.', 'error');
            return;
        }
        
        // Simular procesamiento
        showNotification('Procesando tu pedido...', 'info');
        
        setTimeout(function() {
            var subtotal = cart.reduce(function(sum, item) { return sum + item.price; }, 0);
            var shippingCost = updateShippingCost();
            var total = subtotal + shippingCost;
            
            // Registrar la compra con el usuario autenticado
            var customerEmail = currentUserEmail; // Usar el email del usuario autenticado
            if (customerEmail) {
                cart.forEach(function(item) {
                    logClientAction(customerEmail, 'register_purchase', item.name + ' (Talla: ' + item.size + ')');
                });
            }
            
            // Mostrar éxito
            showNotification('🎉 ¡Pedido confirmado! Total: S/ ' + total.toFixed(2), 'success');
            
            // Limpiar carrito
            cart = [];
            clearCartStorage();
            updateCartDisplay();
            
            // Cerrar checkout
            closeCheckout();
            
            // Resetear bandera de checkout
            isCheckingOut = false;
        }, 1500);
    };

    // ============================================
    // Funciones de Compra
    // ============================================

    window.purchaseProduct = function(productName, price) {
        // Agregar directamente al carrito
        var productIndex = getProductIndex(productName);
        addToCart(productName, price, productIndex);
    };

    window.closePurchaseModal = function() {
        const modal = document.getElementById('purchaseModal');
        if (modal) {
            modal.style.display = 'none';
        }
    };

    window.confirmPurchase = function(e) {
        e.preventDefault();
        
        // Pedir login solo al confirmar la compra
        if (!currentUserEmail) {
            showNotification('Por favor, inicia sesión para completar tu compra', 'error');
            closePurchaseModal();
            openLoginModal();
            return;
        }
        
        const productInput = document.getElementById('purchaseProduct');
        const amountInput = document.getElementById('purchaseAmount');

        if (!productInput || !amountInput) return;

        const product = productInput.value;
        const amount = amountInput.value;

        logClientAction(currentUserEmail, 'register_purchase', product);
        
        closePurchaseModal();
        showNotification(`¡Pedido confirmado! ${product} - S/ ${amount}`, 'success');
        
        // Mostrar botón de cancelar
        const index = getProductIndex(product);
        if (index) {
            const cartBtn = document.getElementById('btn-cart-' + index);
            const cancelBtn = document.getElementById('btn-cancel-' + index);
            
            if (cartBtn) cartBtn.style.display = 'none';
            if (cancelBtn) cancelBtn.style.display = 'block';
        }
    };

    window.cancelPurchase = function(productName) {
        if (!currentUserEmail) return;
        
        logClientAction(currentUserEmail, 'cancel_purchase', productName);
        showNotification(`Pedido cancelado: ${productName}`, 'error');
        
        // Ocultar botón de cancelar
        const index = getProductIndex(productName);
        if (index) {
            const cartBtn = document.getElementById('btn-cart-' + index);
            const cancelBtn = document.getElementById('btn-cancel-' + index);
            
            if (cartBtn) cartBtn.style.display = 'block';
            if (cancelBtn) cancelBtn.style.display = 'none';
        }
    };

    // ============================================
    // Funciones Auxiliares
    // ============================================

    /**
     * Obtiene el índice del producto por nombre
     */
    window.getProductIndex = function(productName) {
        const products = [
            'Nike Air Max 270 React',
            'Adidas Superstar Original',
            'Nike ZoomX Vaporfly',
            'Jordan Air Jordan 1 High',
            'Nike Metcon 8',
            'Puma RS-X³ Puzzle',
            'Nike Air Max 90 Easy',
            'Cole Haan ZerøGrand',
            'Adidas Ultraboost 22'
        ];
        
        for (let i = 0; i < products.length; i++) {
            if (productName.includes(products[i])) return i + 1;
        }
        return null;
    };

    /**
     * Registra la acción del cliente en el servidor
     */
    window.logClientAction = function(email, action, product) {
        // Usar jQuery si está disponible
        if (typeof jQuery !== 'undefined') {
            $.ajax({
                url: '?controller=sales&action=apiLogClientAction',
                type: 'POST',
                data: { email: email, action: action, product: product },
                dataType: 'json',
                success: function(response) {
                    console.log('Acción registrada:', response);
                },
                error: function() {
                    console.log('Error al registrar acción');
                }
            });
        } else {
            // Usar fetch API
            const formData = new FormData();
            formData.append('email', email);
            formData.append('action', action);
            formData.append('product', product);

            fetch('?controller=sales&action=apiLogClientAction', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => console.log('Acción registrada:', data))
            .catch(error => console.log('Error al registrar acción:', error));
        }
    };

    /**
     * Muestra una notificación toast
     */
    window.showNotification = function(message, type) {
        const notification = document.createElement('div');
        notification.className = 'toast-notification ' + type;
        notification.textContent = message;
        document.body.appendChild(notification);
        
        // Animación de entrada
        setTimeout(() => {
            notification.style.opacity = '1';
            notification.style.transform = 'translateX(0)';
        }, 10);
        
        // Remover después de 4 segundos
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(150px)';
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 400);
        }, 4000);
    };

    /**
     * Cierra todos los modales
     */
    function closeAllModals() {
        document.querySelectorAll('.modal-overlay').forEach(modal => {
            modal.style.display = 'none';
        });
    }

    // ============================================
    // Funciones de Búsqueda
    // ============================================

    /**
     * Busca productos por término
     */
    window.searchProducts = function(searchTerm) {
        // Desactivar todos los botones de categoría
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        
        // Desactivar todos los enlaces del menú
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.classList.remove('active');
        });
        
        const cards = document.querySelectorAll('.product-card');
        const term = searchTerm.toLowerCase();
        
        cards.forEach(card => {
            const title = card.querySelector('.product-title').textContent.toLowerCase();
            const category = card.dataset.category || '';
            
            if (title.includes(term) || category.includes(term)) {
                card.classList.remove('hidden');
                card.style.display = 'block';
            } else {
                card.classList.add('hidden');
                card.style.display = 'none';
            }
        });
        
        // Actualizar título
        const titleElement = document.querySelector('.section-title');
        if (titleElement) {
            titleElement.textContent = 'Resultados de búsqueda: "' + searchTerm + '"';
        }
    };

    /**
     * Maneja la búsqueda desde el input
     */
    window.handleSearch = function(event) {
        // Esperar a que el usuario termine de escribir (300ms)
        clearTimeout(window.searchTimeout);
        
        window.searchTimeout = setTimeout(function() {
            const searchTerm = event.target.value.trim();
            
            if (searchTerm.length > 0) {
                searchProducts(searchTerm);
            } else {
                // Si está vacío, mostrar todos
                filterProducts('all', event);
            }
        }, 300);
    };

    /**
     * Activa la búsqueda al hacer click en el icono
     */
    window.triggerSearch = function() {
        const input = document.getElementById('searchInput');
        if (input) {
            const searchTerm = input.value.trim();
            if (searchTerm.length > 0) {
                searchProducts(searchTerm);
            } else {
                filterProducts('all');
            }
            
            // Scroll hacia los productos
            const productsSection = document.querySelector('.products-section');
            if (productsSection) {
                productsSection.scrollIntoView({ behavior: 'smooth' });
            }
        }
    };

    /**
     * Maneja la búsqueda desde el input móvil
     */
    window.handleMobileSearch = function(event) {
        clearTimeout(window.searchTimeout);
        
        window.searchTimeout = setTimeout(function() {
            const searchTerm = event.target.value.trim();
            
            if (searchTerm.length > 0) {
                // Sincronizar con el input principal
                const mainInput = document.getElementById('searchInput');
                if (mainInput) mainInput.value = searchTerm;
                
                searchProducts(searchTerm);
            } else {
                filterProducts('all', event);
            }
        }, 300);
    };

    // ============================================
    // Filtros Avanzados
    // ============================================
    
    /**
     * Aplica filtro de precio
     */
    window.applyPriceFilter = function(priceRange) {
        const cards = document.querySelectorAll('.product-card');
        
        cards.forEach(card => {
            if (priceRange === 'all') {
                card.classList.remove('hidden-by-price');
                return;
            }
            
            const priceText = card.querySelector('.product-price');
            if (!priceText) return;
            
            // Extraer precio del texto
            const priceMatch = priceText.textContent.match(/S\/\s?([\d.]+)/);
            if (!priceMatch) return;
            
            const price = parseFloat(priceMatch[1]);
            let minPrice = 0, maxPrice = Infinity;
            
            if (priceRange === '600+') {
                minPrice = 600;
            } else {
                const range = priceRange.split('-');
                minPrice = parseFloat(range[0]);
                maxPrice = parseFloat(range[1]);
            }
            
            if (price >= minPrice && price < maxPrice) {
                card.classList.remove('hidden-by-price');
            } else {
                card.classList.add('hidden-by-price');
            }
        });
        
        updateFiltersVisibility();
    };
    
    /**
     * Aplica filtro de marca
     */
    window.applyBrandFilter = function(brand) {
        const cards = document.querySelectorAll('.product-card');
        
        cards.forEach(card => {
            if (brand === 'all') {
                card.classList.remove('hidden-by-brand');
                return;
            }
            
            const cardBrand = card.getAttribute('data-brand');
            
            if (cardBrand && cardBrand.toLowerCase() === brand.toLowerCase()) {
                card.classList.remove('hidden-by-brand');
            } else {
                card.classList.add('hidden-by-brand');
            }
        });
        
        updateFiltersVisibility();
    };
    
    /**
     * Aplica ordenamiento
     */
    window.applySort = function(sortType) {
        const grid = document.getElementById('productsGrid');
        if (!grid) return;
        
        const cards = Array.from(document.querySelectorAll('.product-card'));
        
        cards.sort((a, b) => {
            const priceA = extractPrice(a);
            const priceB = extractPrice(b);
            const nameA = a.querySelector('.product-title')?.textContent || '';
            const nameB = b.querySelector('.product-title')?.textContent || '';
            
            switch(sortType) {
                case 'price-asc':
                    return priceA - priceB;
                case 'price-desc':
                    return priceB - priceA;
                case 'name-asc':
                    return nameA.localeCompare(nameB);
                case 'name-desc':
                    return nameB.localeCompare(nameA);
                default:
                    return 0;
            }
        });
        
        // Reordenar en el DOM
        cards.forEach(card => grid.appendChild(card));
    };
    
    /**
     * Extrae el precio de una tarjeta
     */
    function extractPrice(card) {
        const priceText = card.querySelector('.product-price');
        if (!priceText) return 0;
        const match = priceText.textContent.match(/S\/\s?([\d.]+)/);
        return match ? parseFloat(match[1]) : 0;
    }
    
    /**
     * Limpia todos los filtros
     */
    window.clearFilters = function() {
        // Resetear selects
        document.getElementById('priceFilter').value = 'all';
        document.getElementById('brandFilter').value = 'all';
        document.getElementById('sortFilter').value = 'default';
        
        // Remover clases de hide
        document.querySelectorAll('.product-card').forEach(card => {
            card.classList.remove('hidden-by-price', 'hidden-by-brand');
        });
        
        // Resetear búsqueda
        const searchInput = document.getElementById('searchInput');
        if (searchInput) searchInput.value = '';
        
        filterProducts('all');
    };
    
    /**
     * Actualiza visibilidad basada en todos los filtros
     */
    function updateFiltersVisibility() {
        const cards = document.querySelectorAll('.product-card');
        
        cards.forEach(card => {
            const hasPriceFilter = card.classList.contains('hidden-by-price');
            const hasBrandFilter = card.classList.contains('hidden-by-brand');
            
            if (hasPriceFilter || hasBrandFilter) {
                card.style.display = 'none';
            } else {
                card.style.display = '';
            }
        });
    }

})();
