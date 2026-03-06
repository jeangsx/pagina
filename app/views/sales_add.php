<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Venta - CRM</title>
    <link rel="stylesheet" href="<?= asset('estilos.css') ?>">
    <link rel="stylesheet" href="<?= asset('dashboard.css') ?>">
    <script src="<?= asset('theme.js') ?>" defer></script>
</head>
<body class="dashboard-body">
<button class="theme-toggle" type="button" data-theme-toggle aria-label="Cambiar tema"></button>
<div class="dashboard-layout">
    <aside class="dashboard-sidebar">
        <div class="sidebar-header">
            <div class="sidebar-brand-icon">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M3 13h2v7H3v-7zm4-5h2v12H7V8zm4-3h2v15h-2V5zm4 5h2v10h-2v-10zm4-3h2v13h-2V7z"/></svg>
            </div>
            <div class="sidebar-brand-text">
                <h3>CRM Ventas</h3>
                <p>Gestión Comercial</p>
            </div>
        </div>
        <nav class="sidebar-nav">
            <span class="sidebar-section">Ventas</span>
            <a class="sidebar-link" href="<?= route('sales', 'index') ?>">
                <span class="sidebar-link-icon">🛒</span>Lista de Ventas
            </a>
            <a class="sidebar-link" href="<?= route('sales', 'analytics') ?>">
                <span class="sidebar-link-icon">📊</span>Analytics
            </a>
            <span class="sidebar-section">Panel</span>
            <a class="sidebar-link" href="<?= route('dashboard', 'index') ?>">
                <span class="sidebar-link-icon">👥</span>Dashboard RRHH
            </a>
            <a class="sidebar-link danger-link" href="<?= route('dashboard', 'logout') ?>">
                <span class="sidebar-link-icon">🚪</span>Cerrar sesión
            </a>
        </nav>
        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="sidebar-user-avatar">A</div>
                <div class="sidebar-user-info">
                    <div class="sidebar-user-name">Administrador</div>
                    <div class="sidebar-user-role">Gerente</div>
                </div>
            </div>
        </div>
    </aside>

    <main class="dashboard-main">
        <section class="panel panel--wide hr-panel hr-panel--fullscreen">
            <h1>Nueva Venta</h1>

            <div class="module-headline">
                <h2>Registrar Nueva Venta</h2>
                <p>Ingresa los datos del cliente y la venta</p>
            </div>

            <!-- Mensajes de error -->
            <?php if (isset($_SESSION['sales_error'])): ?>
                <div class="alert alert-error"><?= htmlspecialchars($_SESSION['sales_error']) ?></div>
                <?php unset($_SESSION['sales_error']); ?>
            <?php endif; ?>

            <form class="form-container" method="post" action="<?= route('sales', 'createSale') ?>">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="client_email">Email del Cliente <span class="required">*</span></label>
                        <input type="email" id="client_email" name="client_email" required 
                               placeholder="cliente@gmail.com">
                        <small>Solo se aceptan correos Gmail para clientes</small>
                    </div>

                    <div class="form-group">
                        <label for="client_name">Nombre del Cliente</label>
                        <input type="text" id="client_name" name="client_name" 
                               placeholder="Nombre completo">
                    </div>

                    <div class="form-group">
                        <label for="product">Producto <span class="required">*</span></label>
                        <input type="text" id="product" name="product" required 
                               placeholder="Nombre del producto">
                    </div>

                    <div class="form-group">
                        <label for="amount">Monto (S/)</label>
                        <input type="number" id="amount" name="amount" step="0.01" min="0" 
                               placeholder="0.00" value="0">
                    </div>

                    <div class="form-group">
                        <label for="status">Estado</label>
                        <select id="status" name="status">
                            <option value="pending">Pendiente</option>
                            <option value="completed">Completada</option>
                            <option value="cancelled">Cancelada</option>
                        </select>
                    </div>

                    <div class="form-group form-group--full">
                        <label for="notes">Notas</label>
                        <textarea id="notes" name="notes" rows="4" 
                                  placeholder="Observaciones adicionales..."></textarea>
                    </div>
                </div>

                <div class="form-actions">
                    <a class="btn-secondary" href="<?= route('sales', 'index') ?>">Cancelar</a>
                    <button type="submit" class="btn-primary">Guardar Venta</button>
                </div>
            </form>
        </section>
    </main>
</div>
</body>
</html>
