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
    // Inicialización
    // ============================================
    document.addEventListener('DOMContentLoaded', function() {
        console.log('LaPeruvianita Shoes - Tienda Online Cargada');
        
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
            }
        });
    }

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
            cartBadge.textContent = cart.length;
            cartBadge.style.display = cart.length > 0 ? 'flex' : 'none';
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
        } else {
            showNotification(response.message || 'Error al iniciar sesión', 'error');
        }
    }

    window.updateUserArea = function(email) {
        const userArea = document.getElementById('userArea');
        if (!userArea) return;
        
        userArea.innerHTML = `
            <div class="user-info-display">
                <span>👤 ${email}</span>
                <button class="logout-btn" onclick="logout()">Cerrar Sesión</button>
            </div>
        `;
    };

    window.logout = function() {
        currentUserEmail = null;
        
        const userArea = document.getElementById('userArea');
        if (userArea) {
            userArea.innerHTML = '<button class="user-btn" onclick="openLoginModal()">Mi Cuenta</button>';
        }
        
        showNotification('Sesión cerrada correctamente', 'success');
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
     * Finaliza la compra
     */
    window.checkout = function() {
        if (cart.length === 0) {
            showNotification('El carrito está vacío', 'error');
            return;
        }
        
        if (!currentUserEmail) {
            showNotification('Por favor, inicia sesión para completar tu compra', 'error');
            closeCart();
            openLoginModal();
            return;
        }
        
        // Registrar cada producto en el sistema
        cart.forEach(function(item) {
            logClientAction(currentUserEmail, 'register_purchase', item.name + ' (Talla: ' + item.size + ')');
        });
        
        var total = cart.reduce(function(sum, item) { return sum + item.price; }, 0);
        showNotification('¡Compra exitosa! Total: S/ ' + total.toFixed(2), 'success');
        
        // Limpiar carrito
        cart = [];
        updateCartDisplay();
        closeCart();
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

})();
