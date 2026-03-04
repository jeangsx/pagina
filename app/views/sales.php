<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Ventas - CRM</title>
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
        <a class="sidebar-link active" href="<?= route('sales', 'index') ?>">Lista de Ventas</a>
        <a class="sidebar-link" href="<?= route('sales', 'analytics') ?>">Analytics</a>

        <span class="sidebar-section">PANEL</span>
        <a class="sidebar-link" href="<?= route('dashboard', 'index') ?>">Dashboard RRHH</a>
        <a class="sidebar-link" href="<?= route('dashboard', 'audit') ?>">Auditoría</a>
        <a class="sidebar-link" href="<?= route('dashboard', 'logout') ?>">Cerrar sesión</a>
    </aside>

    <main class="dashboard-main">
        <section class="panel panel--wide hr-panel hr-panel--fullscreen">
            <h1>Gestión de Ventas</h1>

            <div class="module-headline">
                <h2>Control de Ventas</h2>
                <p>Administra las ventas y controla el proceso de compra de clientes</p>
            </div>

            <!-- Estadísticas -->
            <div class="stats-grid">
                <article class="stat-card">
                    <h4>Total Ventas</h4>
                    <p class="stat-value"><?= $stats['total_sales'] ?? 0 ?></p>
                    <small>Ventas registradas</small>
                </article>
                <article class="stat-card">
                    <h4>Completadas</h4>
                    <p class="stat-value"><?= $stats['completed_sales'] ?? 0 ?></p>
                    <small>Ventas finalizadas</small>
                </article>
                <article class="stat-card">
                    <h4>Pendientes</h4>
                    <p class="stat-value"><?= $stats['pending_sales'] ?? 0 ?></p>
                    <small>En proceso</small>
                </article>
                <article class="stat-card">
                    <h4>Canceladas</h4>
                    <p class="stat-value"><?= $stats['cancelled_sales'] ?? 0 ?></p>
                    <small>Ventas canceladas</small>
                </article>
                <article class="stat-card">
                    <h4>Ingresos Totales</h4>
                    <p class="stat-value">S/ <?= number_format($stats['total_revenue'] ?? 0, 2) ?></p>
                    <small>Total facturado</small>
                </article>
                <article class="stat-card">
                    <h4>Clientes Únicos</h4>
                    <p class="stat-value"><?= $stats['unique_clients'] ?? 0 ?></p>
                    <small>Clientes registrados</small>
                </article>
            </div>

            <!-- Acciones -->
            <div class="module-header">
                <div>
                    <h3>Lista de Ventas</h3>
                    <p class="subtitle">Administra todas las transacciones</p>
                </div>

                <div class="module-actions">
                    <a class="btn-secondary btn-inline" href="<?= route('sales', 'exportSales') ?>">Exportar CSV</a>
                    <a class="btn-primary btn-inline" href="<?= route('sales', 'addSale') ?>">Nueva Venta</a>
                </div>
            </div>

            <!-- Mensajes -->
            <?php if (isset($_SESSION['sales_success'])): ?>
                <div class="alert alert-success"><?= htmlspecialchars($_SESSION['sales_success']) ?></div>
                <?php unset($_SESSION['sales_success']); ?>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['sales_error'])): ?>
                <div class="alert alert-error"><?= htmlspecialchars($_SESSION['sales_error']) ?></div>
                <?php unset($_SESSION['sales_error']); ?>
            <?php endif; ?>

            <!-- Filtros -->
            <form class="filter-row" method="get" action="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>" aria-label="Filtros de búsqueda">
                <input type="hidden" name="controller" value="sales">
                <input type="hidden" name="action" value="index">
                
                <input
                    type="search"
                    name="search"
                    value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                    placeholder="Buscar por cliente, email o producto..."
                    aria-label="Buscar ventas">

                <select name="status" aria-label="Filtrar por estado" onchange="this.form.submit()">
                    <option value="" <?= (isset($_GET['status']) && $_GET['status'] === '') || !isset($_GET['status']) ? 'selected' : '' ?>>Todos los estados</option>
                    <option value="pending" <?= isset($_GET['status']) && $_GET['status'] === 'pending' ? 'selected' : '' ?>>Pendiente</option>
                    <option value="completed" <?= isset($_GET['status']) && $_GET['status'] === 'completed' ? 'selected' : '' ?>>Completada</option>
                    <option value="cancelled" <?= isset($_GET['status']) && $_GET['status'] === 'cancelled' ? 'selected' : '' ?>>Cancelada</option>
                </select>

                <button class="btn-secondary" type="submit">Aplicar</button>
            </form>

            <!-- Tabla de ventas -->
            <div class="table-wrap table-wrap--dashboard">
                <table class="audit-table dashboard-table">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Email</th>
                            <th>Producto</th>
                            <th>Monto</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($sales)): ?>
                            <tr>
                                <td colspan="7" style="text-align: center;">No hay ventas registradas</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($sales as $sale): ?>
                                <tr>
                                    <td><?= htmlspecialchars($sale['client_name'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($sale['client_email'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($sale['product'] ?? '') ?></td>
                                    <td>S/ <?= number_format($sale['amount'] ?? 0, 2) ?></td>
                                    <td>
                                        <?php 
                                        $statusClass = '';
                                        $statusText = '';
                                        switch ($sale['status'] ?? '') {
                                            case 'completed':
                                                $statusClass = 'status-chip';
                                                $statusText = 'Completada';
                                                break;
                                            case 'pending':
                                                $statusClass = 'status-chip status-pending';
                                                $statusText = 'Pendiente';
                                                break;
                                            case 'cancelled':
                                                $statusClass = 'status-chip status-cancelled';
                                                $statusText = 'Cancelada';
                                                break;
                                            default:
                                                $statusClass = 'role-chip';
                                                $statusText = $sale['status'] ?? 'Sin estado';
                                        }
                                        ?>
                                        <span class="<?= $statusClass ?>"><?= $statusText ?></span>
                                    </td>
                                    <td><?= htmlspecialchars($sale['created_at'] ?? '') ?></td>
                                    <td>
                                        <a class="table-link" href="<?= route('sales', 'editSale') ?>&id=<?= urlencode($sale['id'] ?? '') ?>">Editar</a>
                                        <a class="table-link table-link-danger" href="<?= route('sales', 'deleteSale') ?>&id=<?= urlencode($sale['id'] ?? '') ?>" onclick="return confirm('¿Estás seguro de eliminar esta venta?')">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Indicador de actualización en tiempo real -->
            <div id="realtime-indicator" style="display: none; position: fixed; bottom: 20px; right: 20px; background: var(--bi-primary, #0078d4); color: white; padding: 8px 16px; border-radius: 20px; font-size: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.2); z-index: 1000;">
                🔄 Sincronizado
            </div>
        </section>
    </main>
</div>

<script>
// Función para cargar ventas en tiempo real
async function loadSalesRealtime() {
    try {
        // Obtener parámetros de búsqueda del formulario
        const searchInput = document.querySelector('input[name="search"]');
        const statusSelect = document.querySelector('select[name="status"]');
        
        const params = new URLSearchParams();
        params.append('controller', 'sales');
        params.append('action', 'apiGetSales');
        
        if (searchInput && searchInput.value) {
            params.append('search', searchInput.value);
        }
        if (statusSelect && statusSelect.value) {
            params.append('status', statusSelect.value);
        }
        
        const response = await fetch('?' + params.toString());
        const data = await response.json();
        
        if (data.success) {
            updateSalesTable(data.sales);
            updateStats(data.stats);
            
            // Mostrar indicador de sincronización
            const indicator = document.getElementById('realtime-indicator');
            if (indicator) {
                indicator.style.display = 'block';
                setTimeout(() => {
                    indicator.style.display = 'none';
                }, 2000);
            }
        }
    } catch (error) {
        console.error('Error al cargar ventas:', error);
    }
}

// Actualizar tabla de ventas
function updateSalesTable(sales) {
    const tbody = document.querySelector('tbody');
    if (!tbody) return;
    
    if (!sales || sales.length === 0) {
        tbody.innerHTML = '<tr><td colspan="7" style="text-align: center;">No hay ventas registradas</td></tr>';
        return;
    }
    
    let html = '';
    sales.forEach(function(sale) {
        let statusClass = '';
        let statusText = '';
        
        switch (sale.status) {
            case 'completed':
                statusClass = 'status-chip';
                statusText = 'Completada';
                break;
            case 'pending':
                statusClass = 'status-chip status-pending';
                statusText = 'Pendiente';
                break;
            case 'cancelled':
                statusClass = 'status-chip status-cancelled';
                statusText = 'Cancelada';
                break;
            default:
                statusClass = 'role-chip';
                statusText = sale.status || 'Sin estado';
        }
        
        html += '<tr>' +
            '<td>' + escapeHtml(sale.client_name || '') + '</td>' +
            '<td>' + escapeHtml(sale.client_email || '') + '</td>' +
            '<td>' + escapeHtml(sale.product || '') + '</td>' +
            '<td>S/ ' + Number(sale.amount || 0).toFixed(2) + '</td>' +
            '<td><span class="' + statusClass + '">' + statusText + '</span></td>' +
            '<td>' + escapeHtml(sale.created_at || '') + '</td>' +
            '<td>' +
                '<a class="table-link" href="?controller=sales&action=editSale&id=' + encodeURIComponent(sale.id || '') + '">Editar</a> ' +
                '<a class="table-link table-link-danger" href="?controller=sales&action=deleteSale&id=' + encodeURIComponent(sale.id || '') + '" onclick="return confirm(\'¿Estás seguro de eliminar esta venta?\')">Eliminar</a>' +
            '</td>' +
        '</tr>';
    });
    
    tbody.innerHTML = html;
}

// Actualizar estadísticas
function updateStats(stats) {
    if (!stats) return;
    
    const statCards = document.querySelectorAll('.stat-card');
    if (statCards.length >= 6) {
        if (statCards[0].querySelector('.stat-value')) {
            statCards[0].querySelector('.stat-value').textContent = stats.total_sales || 0;
        }
        if (statCards[1].querySelector('.stat-value')) {
            statCards[1].querySelector('.stat-value').textContent = stats.completed_sales || 0;
        }
        if (statCards[2].querySelector('.stat-value')) {
            statCards[2].querySelector('.stat-value').textContent = stats.pending_sales || 0;
        }
        if (statCards[3].querySelector('.stat-value')) {
            statCards[3].querySelector('.stat-value').textContent = stats.cancelled_sales || 0;
        }
        if (statCards[4].querySelector('.stat-value')) {
            statCards[4].querySelector('.stat-value').textContent = 'S/ ' + Number(stats.total_revenue || 0).toFixed(2);
        }
        if (statCards[5].querySelector('.stat-value')) {
            statCards[5].querySelector('.stat-value').textContent = stats.unique_clients || 0;
        }
    }
}

// Función para escapar HTML
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// Iniciar actualización en tiempo real cada 10 segundos
document.addEventListener('DOMContentLoaded', function() {
    // Cargar inmediatamente
    loadSalesRealtime();
    
    // Actualizar cada 10 segundos
    setInterval(loadSalesRealtime, 10000);
});
</script>
</body>
</html>
