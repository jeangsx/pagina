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
        <h3>CRM Ventas</h3>
        <p>Gestión Comercial</p>

        <span class="sidebar-section">VENTAS</span>
        <a class="sidebar-link" href="<?= route('sales', 'index') ?>">Lista de Ventas</a>
        <a class="sidebar-link" href="<?= route('sales', 'analytics') ?>">Analytics</a>

        <span class="sidebar-section">PANEL</span>
        <a class="sidebar-link" href="<?= route('dashboard', 'index') ?>">Dashboard RRHH</a>
        <a class="sidebar-link" href="<?= route('dashboard', 'logout') ?>">Cerrar sesión</a>
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
