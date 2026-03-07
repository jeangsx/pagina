<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Venta - CRM</title>
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
            <div class="sidebar-user-container">
                <button class="sidebar-user" id="user-menu-toggle" type="button">
                    <div class="sidebar-user-avatar">A</div>
                    <div class="sidebar-user-info">
                        <div class="sidebar-user-name">Administrador</div>
                        <div class="sidebar-user-role">Gerente</div>
                    </div>
                    <span class="sidebar-user-toggle-icon">⋮</span>
                </button>
                <div class="sidebar-user-menu" id="user-menu">
                    <a href="<?= route('dashboard', 'editProfile') ?>" class="sidebar-user-menu-item">
                        <span class="menu-icon">👤</span>
                        <span class="menu-text">Editar perfil</span>
                    </a>
                    <a href="<?= route('dashboard', 'logout') ?>" class="sidebar-user-menu-item sidebar-user-menu-logout">
                        <span class="menu-icon">🚪</span>
                        <span class="menu-text">Cerrar sesión</span>
                    </a>
                </div>
            </div>
        </div>
    </aside>

    <main class="dashboard-main">
        <section class="panel panel--wide hr-panel hr-panel--fullscreen">
            <h1>Editar Venta</h1>

            <div class="module-headline">
                <h2>Modificar Datos de la Venta</h2>
                <p>Actualiza la información de la transacción</p>
            </div>

            <!-- Mensajes de error -->
            <?php if (isset($_SESSION['sales_error'])): ?>
                <div class="alert alert-error"><?= htmlspecialchars($_SESSION['sales_error']) ?></div>
                <?php unset($_SESSION['sales_error']); ?>
            <?php endif; ?>

            <form class="form-container" method="post" action="<?= route('sales', 'updateSale') ?>">
                <input type="hidden" name="id" value="<?= htmlspecialchars($sale['id'] ?? '') ?>">
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="client_email">Email del Cliente <span class="required">*</span></label>
                        <input type="email" id="client_email" name="client_email" required 
                               value="<?= htmlspecialchars($sale['client_email'] ?? '') ?>"
                               placeholder="cliente@gmail.com">
                    </div>

                    <div class="form-group">
                        <label for="client_name">Nombre del Cliente</label>
                        <input type="text" id="client_name" name="client_name" 
                               value="<?= htmlspecialchars($sale['client_name'] ?? '') ?>"
                               placeholder="Nombre completo">
                    </div>

                    <div class="form-group">
                        <label for="product">Producto <span class="required">*</span></label>
                        <input type="text" id="product" name="product" required 
                               value="<?= htmlspecialchars($sale['product'] ?? '') ?>"
                               placeholder="Nombre del producto">
                    </div>

                    <div class="form-group">
                        <label for="amount">Monto (S/)</label>
                        <input type="number" id="amount" name="amount" step="0.01" min="0" 
                               value="<?= htmlspecialchars($sale['amount'] ?? 0) ?>"
                               placeholder="0.00">
                    </div>

                    <div class="form-group">
                        <label for="status">Estado</label>
                        <select id="status" name="status">
                            <option value="pending" <?= ($sale['status'] ?? 'pending') === 'pending' ? 'selected' : '' ?>>Pendiente</option>
                            <option value="completed" <?= ($sale['status'] ?? '') === 'completed' ? 'selected' : '' ?>>Completada</option>
                            <option value="cancelled" <?= ($sale['status'] ?? '') === 'cancelled' ? 'selected' : '' ?>>Cancelada</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="payment_method">Método de Pago <span class="required">*</span></label>
                        <select id="payment_method" name="payment_method" required>
                            <option value="pago_online" <?= ($sale['payment_method'] ?? '') === 'pago_online' ? 'selected' : '' ?>>Pago en Línea</option>
                            <option value="contra_entrega" <?= ($sale['payment_method'] ?? '') === 'contra_entrega' ? 'selected' : '' ?>>Contra Entrega</option>
                        </select>
                        <small>El pago en línea se refleja en ingresos. Contra entrega no se contabiliza como ingreso.</small>
                    </div>

                    <div class="form-group form-group--full">
                        <label for="notes">Notas</label>
                        <textarea id="notes" name="notes" rows="4" 
                                  placeholder="Observaciones adicionales..."><?= htmlspecialchars($sale['notes'] ?? '') ?></textarea>
                    </div>
                </div>

                <div class="form-info">
                    <p><strong>Creado:</strong> <?= htmlspecialchars($sale['created_at'] ?? '-') ?></p>
                    <p><strong>Última actualización:</strong> <?= htmlspecialchars($sale['updated_at'] ?? '-') ?></p>
                </div>

                <div class="form-actions">
                    <a class="btn-secondary" href="<?= route('sales', 'index') ?>">Cancelar</a>
                    <button type="submit" class="btn-primary">Actualizar Venta</button>
                </div>
            </form>
        </section>
    </main>
</div>
</body>
</html>
