<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Cliente - CRM</title>
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
            <a class="sidebar-link active" href="<?= route('sales', 'analytics') ?>">
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
            <h1>Detalle del Cliente</h1>

            <div class="module-headline">
                <h2>Información del Cliente</h2>
                <p>Historial completo de actividades y ventas</p>
            </div>

            <a class="btn-secondary" href="<?= route('sales', 'analytics') ?>">← Volver a Analytics</a>

            <!-- Información del Cliente -->
            <div class="stats-grid" style="margin-top: 1.5rem;">
                <article class="stat-card">
                    <h4>Email</h4>
                    <p class=" style="font-size: 1remstat-value";"><?= htmlspecialchars($activity['email'] ?? '') ?></p>
                </article>
                <article class="stat-card">
                    <h4>Total de Vistas</h4>
                    <p class="stat-value"><?= $activity['view_count'] ?? 0 ?></p>
                    <small>Productos visualizados</small>
                </article>
                <article class="stat-card">
                    <h4>Intentos de Compra</h4>
                    <p class="stat-value"><?= $activity['purchase_attempts'] ?? 0 ?></p>
                    <small>Inicios de compra</small>
                </article>
                <article class="stat-card">
                    <h4>Compras Canceladas</h4>
                    <p class="stat-value"><?= $activity['cancelled_purchases'] ?? 0 ?></p>
                    <small>Cancelaciones</small>
                </article>
                <article class="stat-card">
                    <h4>Última Actividad</h4>
                    <p class="stat-value" style="font-size: 0.9rem;"><?= htmlspecialchars($activity['last_activity'] ?? '-') ?></p>
                </article>
            </div>

            <!-- Productos Vistos -->
            <?php if (!empty($activity['products_viewed'])): ?>
            <div class="module-header" style="margin-top: 2rem;">
                <div>
                    <h3>👁️ Productos Vistos</h3>
                </div>
            </div>
            <div class="tags-container">
                <?php foreach ($activity['products_viewed'] as $product): ?>
                    <span class="role-chip"><?= htmlspecialchars($product) ?></span>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- Productos Comprados -->
            <?php if (!empty($activity['products_purchased'])): ?>
            <div class="module-header" style="margin-top: 2rem;">
                <div>
                    <h3>🛒 Productos Comprados</h3>
                </div>
            </div>
            <div class="tags-container">
                <?php foreach ($activity['products_purchased'] as $product): ?>
                    <span class="status-chip"><?= htmlspecialchars($product) ?></span>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- Ventas del Cliente -->
            <div class="module-header" style="margin-top: 2rem;">
                <div>
                    <h3>📊 Historial de Ventas</h3>
                </div>
            </div>

            <?php if (empty($sales)): ?>
                <div class="alert alert-info">No hay ventas registradas para este cliente.</div>
            <?php else: ?>
            <div class="table-wrap table-wrap--dashboard">
                <table class="audit-table dashboard-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Monto</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sales as $sale): ?>
                            <tr>
                                <td><?= htmlspecialchars(substr($sale['id'], -8)) ?></td>
                                <td><?= htmlspecialchars($sale['product'] ?? '') ?></td>
                                <td>S/ <?= number_format($sale['amount'] ?? 0, 2) ?></td>
                                <td>
                                    <?php 
                                    $statusClass = '';
                                    switch ($sale['status'] ?? '') {
                                        case 'completed':
                                            $statusClass = 'status-chip';
                                            break;
                                        case 'pending':
                                            $statusClass = 'status-chip status-pending';
                                            break;
                                        case 'cancelled':
                                            $statusClass = 'status-chip status-cancelled';
                                            break;
                                    }
                                    ?>
                                    <span class="<?= $statusClass ?>"><?= htmlspecialchars($sale['status'] ?? '') ?></span>
                                </td>
                                <td><?= htmlspecialchars($sale['created_at'] ?? '') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>

        </section>
    </main>
</div>
</body>
</html>
