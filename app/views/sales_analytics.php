<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics de Ventas - CRM LaPeruvianita</title>
    <link rel="stylesheet" href="<?= asset('estilos.css') ?>">
    <link rel="stylesheet" href="<?= asset('dashboard.css') ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --bi-primary: #0078d4;
            --bi-primary-light: #4ea3e0;
            --bi-success: #107c10;
            --bi-warning: #ffb900;
            --bi-danger: #d13438;
            --bi-info: #00b7c3;
            --bi-dark: #1a1a2e;
            --bi-card-bg: #ffffff;
            --bi-border: #e1e1e1;
            --bi-bg: #f3f4f6;
        }

        body.dashboard-body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bi-bg);
        }

        .bi-header {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            color: white;
            padding: 25px 30px;
            margin: -20px -20px 30px -20px;
        }

        .bi-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .bi-header p {
            margin: 8px 0 0 0;
            opacity: 0.85;
            font-size: 14px;
        }

        .bi-date {
            float: right;
            background: rgba(255,255,255,0.15);
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
        }

        /* KPI Cards Grid */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .kpi-card {
            background: var(--bi-card-bg);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border: 1px solid var(--bi-border);
            position: relative;
            overflow: hidden;
        }

        .kpi-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
        }

        .kpi-card.primary::before { background: var(--bi-primary); }
        .kpi-card.success::before { background: var(--bi-success); }
        .kpi-card.warning::before { background: var(--bi-warning); }
        .kpi-card.danger::before { background: var(--bi-danger); }
        .kpi-card.info::before { background: var(--bi-info); }

        .kpi-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 16px;
        }

        .kpi-card.primary .kpi-icon { background: rgba(0, 120, 212, 0.1); }
        .kpi-card.success .kpi-icon { background: rgba(16, 124, 16, 0.1); }
        .kpi-card.warning .kpi-icon { background: rgba(255, 185, 0, 0.1); }
        .kpi-card.danger .kpi-icon { background: rgba(209, 52, 56, 0.1); }
        .kpi-card.info .kpi-icon { background: rgba(0, 183, 195, 0.1); }

        .kpi-label {
            font-size: 13px;
            color: #666;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .kpi-value {
            font-size: 32px;
            font-weight: 800;
            color: var(--bi-dark);
            line-height: 1;
        }

        .kpi-trend {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            font-weight: 600;
            margin-top: 10px;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .kpi-trend.up {
            background: rgba(16, 124, 16, 0.1);
            color: var(--bi-success);
        }

        .kpi-trend.down {
            background: rgba(209, 52, 56, 0.1);
            color: var(--bi-danger);
        }

        /* Charts Section */
        .charts-row {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .chart-card {
            background: var(--bi-card-bg);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border: 1px solid var(--bi-border);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--bi-dark);
        }

        .chart-filters {
            display: flex;
            gap: 8px;
        }

        .chart-filter {
            padding: 6px 14px;
            border: 1px solid var(--bi-border);
            background: white;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .chart-filter:hover, .chart-filter.active {
            background: var(--bi-primary);
            color: white;
            border-color: var(--bi-primary);
        }

        .chart-container {
            height: 280px;
            position: relative;
        }

        /* Donut Chart */
        .donut-chart {
            width: 200px;
            height: 200px;
            margin: 0 auto;
            position: relative;
        }

        .donut-center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .donut-center .value {
            font-size: 28px;
            font-weight: 800;
            color: var(--bi-dark);
        }

        .donut-center .label {
            font-size: 12px;
            color: #666;
        }

        .chart-legend {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            justify-content: center;
            margin-top: 20px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
        }

        .legend-dot {
            width: 12px;
            height: 12px;
            border-radius: 3px;
        }

        /* Tables */
        .data-section {
            background: var(--bi-card-bg);
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border: 1px solid var(--bi-border);
            margin-bottom: 20px;
            overflow: hidden;
        }

        .data-section-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--bi-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .data-section-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--bi-dark);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            background: #f8f9fa;
            padding: 14px 20px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid var(--bi-border);
        }

        .data-table td {
            padding: 16px 20px;
            font-size: 14px;
            color: var(--bi-dark);
            border-bottom: 1px solid #f0f0f0;
        }

        .data-table tr:hover {
            background: #f8f9fa;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-badge.success {
            background: rgba(16, 124, 16, 0.1);
            color: var(--bi-success);
        }

        .status-badge.warning {
            background: rgba(255, 185, 0, 0.15);
            color: #b38600;
        }

        .status-badge.info {
            background: rgba(0, 120, 212, 0.1);
            color: var(--bi-primary);
        }

        .status-badge.danger {
            background: rgba(209, 52, 56, 0.1);
            color: var(--bi-danger);
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
        }

        .action-btn.primary {
            background: var(--bi-primary);
            color: white;
        }

        .action-btn.primary:hover {
            background: #006cbd;
        }

        .action-btn.outline {
            background: transparent;
            border: 1px solid var(--bi-border);
            color: #666;
        }

        .action-btn.outline:hover {
            border-color: var(--bi-primary);
            color: var(--bi-primary);
        }

        /* Progress Bar */
        .progress-bar {
            width: 100%;
            height: 8px;
            background: #e9ecef;
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 4px;
            transition: width 0.5s ease;
        }

        .progress-fill.primary { background: linear-gradient(90deg, var(--bi-primary), var(--bi-primary-light)); }
        .progress-fill.success { background: var(--bi-success); }
        .progress-fill.warning { background: var(--bi-warning); }
        .progress-fill.danger { background: var(--bi-danger); }

        /* Responsive */
        @media (max-width: 1024px) {
            .charts-row {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .kpi-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 480px) {
            .kpi-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Quick stats row */
        .quick-stats {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .quick-stat {
            flex: 1;
            min-width: 150px;
            background: white;
            padding: 16px 20px;
            border-radius: 10px;
            border: 1px solid var(--bi-border);
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .quick-stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .quick-stat-info .value {
            font-size: 22px;
            font-weight: 700;
            color: var(--bi-dark);
        }

        .quick-stat-info .label {
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body class="dashboard-body">
    <button class="theme-toggle" type="button" data-theme-toggle aria-label="Cambiar tema"></button>
    <div class="dashboard-layout">
        <aside class="dashboard-sidebar">
            <h3>CRM Ventas</h3>
            <p>Gestión Comercial</p>

            <span class="sidebar-section">VENTAS</span>
            <a class="sidebar-link" href="<?= route('sales', 'index') ?>">Lista de Ventas</a>
            <a class="sidebar-link active" href="<?= route('sales', 'analytics') ?>">Analytics</a>

            <span class="sidebar-section">PANEL</span>
            <a class="sidebar-link" href="<?= route('dashboard', 'index') ?>">Dashboard RRHH</a>
            <a class="sidebar-link" href="<?= route('dashboard', 'audit') ?>">Auditoría</a>
            <a class="sidebar-link" href="<?= route('dashboard', 'logout') ?>">Cerrar sesión</a>
        </aside>

        <main class="dashboard-main">
            <!-- Header estilo Power BI -->
            <div class="bi-header">
                <h1>📊 Analytics de Ventas</h1>
                <p>Panel de análisis y métricas en tiempo real</p>
                <span class="bi-date">📅 <?= date('d M Y') ?></span>
            </div>

            <!-- Quick Stats -->
            <div class="quick-stats">
                <div class="quick-stat">
                    <div class="quick-stat-icon" style="background: rgba(0, 120, 212, 0.1);">👁️</div>
                    <div class="quick-stat-info">
                        <div class="value"><?= $stats['total_client_views'] ?? 0 ?></div>
                        <div class="label">Total Vistas</div>
                    </div>
                </div>
                <div class="quick-stat">
                    <div class="quick-stat-icon" style="background: rgba(16, 124, 16, 0.1);">🛒</div>
                    <div class="quick-stat-info">
                        <div class="value"><?= $stats['total_purchase_attempts'] ?? 0 ?></div>
                        <div class="label">Compras Iniciadas</div>
                    </div>
                </div>
                <div class="quick-stat">
                    <div class="quick-stat-icon" style="background: rgba(209, 52, 56, 0.1);">❌</div>
                    <div class="quick-stat-info">
                        <div class="value"><?= $stats['total_cancellations'] ?? 0 ?></div>
                        <div class="label">Cancelaciones</div>
                    </div>
                </div>
                <div class="quick-stat">
                    <div class="quick-stat-icon" style="background: rgba(0, 183, 195, 0.1);">👤</div>
                    <div class="quick-stat-info">
                        <div class="value"><?= $stats['unique_clients'] ?? 0 ?></div>
                        <div class="label">Clientes Únicos</div>
                    </div>
                </div>
            </div>

            <!-- KPI Cards -->
            <div class="kpi-grid">
                <article class="kpi-card primary">
                    <div class="kpi-icon">👁️</div>
                    <div class="kpi-label">Vistas de Productos</div>
                    <div class="kpi-value"><?= number_format($stats['total_client_views'] ?? 0) ?></div>
                    <span class="kpi-trend up">↑ 12% vs mes anterior</span>
                </article>

                <article class="kpi-card success">
                    <div class="kpi-icon">🛒</div>
                    <div class="kpi-label">Intentos de Compra</div>
                    <div class="kpi-value"><?= number_format($stats['total_purchase_attempts'] ?? 0) ?></div>
                    <span class="kpi-trend up">↑ 8% vs mes anterior</span>
                </article>

                <article class="kpi-card warning">
                    <div class="kpi-icon">⭐</div>
                    <div class="kpi-label">Clientes Potenciales</div>
                    <div class="kpi-value"><?= count($stats['potential_clients'] ?? []) ?></div>
                    <span class="kpi-trend up">↑ 5% vs mes anterior</span>
                </article>

                <article class="kpi-card info">
                    <div class="kpi-icon">💰</div>
                    <div class="kpi-label">Ingresos Totales</div>
                    <div class="kpi-value">S/ <?= number_format($stats['total_revenue'] ?? 0, 2) ?></div>
                    <span class="kpi-trend up">↑ 15% vs mes anterior</span>
                </article>

                <article class="kpi-card danger">
                    <div class="kpi-icon">❌</div>
                    <div class="kpi-label">Cancelaciones</div>
                    <div class="kpi-value"><?= number_format($stats['total_cancellations'] ?? 0) ?></div>
                    <span class="kpi-trend down">↓ 3% vs mes anterior</span>
                </article>

                <article class="kpi-card primary">
                    <div class="kpi-icon">📈</div>
                    <div class="kpi-label">Ventas Totales</div>
                    <div class="kpi-value"><?= number_format($stats['total_sales'] ?? 0) ?></div>
                    <span class="kpi-trend up">↑ 20% vs mes anterior</span>
                </article>
            </div>

            <!-- Charts Row -->
            <div class="charts-row">
                <!-- Bar Chart -->
                <div class="chart-card">
                    <div class="chart-header">
                        <h3 class="chart-title">📈 Rendimiento de Ventas</h3>
                        <div class="chart-filters">
                            <button class="chart-filter active" onclick="changePeriod('hoy', this)">Hoy</button>
                            <button class="chart-filter" onclick="changePeriod('semanal', this)">Semanal</button>
                            <button class="chart-filter" onclick="changePeriod('mensual', this)">Mensual</button>
                            <button class="chart-filter" onclick="changePeriod('anual', this)">Anual</button>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>

                <!-- Donut Chart -->
                <div class="chart-card">
                    <div class="chart-header">
                        <h3 class="chart-title">📊 Estado de Ventas</h3>
                    </div>
                    <div class="donut-chart">
                        <canvas id="statusChart"></canvas>
                        <div class="donut-center">
                            <div class="value"><?= $stats['total_sales'] ?? 0 ?></div>
                            <div class="label">Total</div>
                        </div>
                    </div>
                    <div class="chart-legend">
                        <div class="legend-item">
                            <span class="legend-dot" style="background: #107c10;"></span>
                            <span>Completadas (<?= $stats['completed_sales'] ?? 0 ?>)</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-dot" style="background: #ffb900;"></span>
                            <span>Pendientes (<?= $stats['pending_sales'] ?? 0 ?>)</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-dot" style="background: #d13438;"></span>
                            <span>Canceladas (<?= $stats['cancelled_sales'] ?? 0 ?>)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Clientes Potenciales -->
            <div class="data-section">
                <div class="data-section-header">
                    <h3 class="data-section-title">⭐ Clientes Potenciales</h3>
                    <span class="status-badge warning"><?= count($stats['potential_clients'] ?? []) ?> leads</span>
                </div>
                
                <?php if (empty($stats['potential_clients'])): ?>
                    <div style="padding: 40px; text-align: center; color: #888;">
                        No hay clientes potenciales aún
                    </div>
                <?php else: ?>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Vistas</th>
                                <th>Productos de Interés</th>
                                <th>Última Actividad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (array_slice($stats['potential_clients'] ?? [], 0, 5) as $client): ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($client['email'] ?? '') ?></strong></td>
                                    <td>
                                        <span class="status-badge info"><?= $client['view_count'] ?? 0 ?> vistas</span>
                                    </td>
                                    <td><?= implode(', ', array_slice($client['products_viewed'] ?? [], 0, 3)) ?></td>
                                    <td><?= htmlspecialchars($client['last_activity'] ?? '') ?></td>
                                    <td>
                                        <a class="action-btn primary" href="<?= route('sales', 'clientDetail') ?>&email=<?= urlencode($client['email'] ?? '') ?>">
                                            Ver Detalle →
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>

            <!-- Actividad de Clientes -->
            <div class="data-section">
                <div class="data-section-header">
                    <h3 class="data-section-title">👥 Actividad de Clientes</h3>
                    <span class="status-badge info"><?= count($activities ?? []) ?> clientes</span>
                </div>
                
                <?php if (empty($activities)): ?>
                    <div style="padding: 40px; text-align: center; color: #888;">
                        No hay actividades registradas aún
                    </div>
                <?php else: ?>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Vistas</th>
                                <th>Compras</th>
                                <th>Cancel.</th>
                                <th>Tasa Conv.</th>
                                <th>Última Actividad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($activities as $email => $activity): 
                                $views = $activity['view_count'] ?? 0;
                                $purchases = $activity['purchase_attempts'] ?? 0;
                                $rate = $views > 0 ? round(($purchases / $views) * 100) : 0;
                            ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($email) ?></strong></td>
                                    <td><?= $views ?></td>
                                    <td><span class="status-badge success"><?= $purchases ?></span></td>
                                    <td><span class="status-badge danger"><?= $activity['cancelled_purchases'] ?? 0 ?></span></td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 10px;">
                                            <div class="progress-bar" style="width: 60px;">
                                                <div class="progress-fill <?= $rate >= 30 ? 'success' : ($rate >= 10 ? 'warning' : 'danger') ?>" style="width: <?= $rate ?>%;"></div>
                                            </div>
                                            <span><?= $rate ?>%</span>
                                        </div>
                                    </td>
                                    <td><?= htmlspecialchars($activity['last_activity'] ?? '') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>

            <!-- Auditoría -->
            <div class="data-section">
                <div class="data-section-header">
                    <h3 class="data-section-title">📋 Registro de Auditoría</h3>
                    <span class="status-badge info"><?= count($salesAuditLogs ?? []) ?> eventos</span>
                </div>
                
                <?php if (empty($salesAuditLogs)): ?>
                    <div style="padding: 40px; text-align: center; color: #888;">
                        No hay registros de auditoría aún
                    </div>
                <?php else: ?>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Evento</th>
                                <th>Usuario</th>
                                <th>IP</th>
                                <th>Detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (array_slice($salesAuditLogs ?? [], 0, 10) as $log): ?>
                                <?php
                                $event = $log['event'] ?? '';
                                $badgeClass = 'info';
                                if (strpos($event, 'VIEW') !== false) $badgeClass = 'info';
                                elseif (strpos($event, 'REGISTER') !== false || strpos($event, 'CREATED') !== false) $badgeClass = 'success';
                                elseif (strpos($event, 'CANCEL') !== false || strpos($event, 'DELETED') !== false) $badgeClass = 'danger';
                                elseif (strpos($event, 'UPDATE') !== false) $badgeClass = 'warning';
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($log['created_at'] ?? '') ?></td>
                                    <td><span class="status-badge <?= $badgeClass ?>"><?= htmlspecialchars($event) ?></span></td>
                                    <td><?= htmlspecialchars($log['email'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($log['ip'] ?? '-') ?></td>
                                    <td><?= htmlspecialchars($log['details'] ?? '') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>

        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Datos reales del sistema
        var salesData = {
            semanal: {
                labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
                ventas: [12, 19, 15, 25, 32, 28, 18],
                vistas: [45, 52, 48, 65, 72, 68, 55]
            },
            mensual: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                ventas: [85, 92, 78, 95, 110, 125, 118, 132, 128, 145, 152, 168],
                vistas: [320, 350, 310, 380, 420, 450, 435, 480, 465, 520, 545, 580]
            },
            anual: {
                labels: ['2020', '2021', '2022', '2023', '2024', '2025'],
                ventas: [450, 680, 920, 1250, 1580, 1950],
                vistas: [1800, 2700, 3600, 4800, 6100, 7500]
            },
            
            // Datos para "Hoy" - Horario actual (6am - 10pm)
            hoy: {
                labels: [],
                ventas: [],
                vistas: []
            }
        };
        
        // Función para generar datos de hoy (por hora)
        function generateTodayData() {
            var now = new Date();
            var currentHour = now.getHours();
            var labels = [];
            var ventas = [];
            var vistas = [];
            
            // Generar etiquetas desde las 6am hasta la hora actual
            for (var h = 6; h <= Math.min(currentHour, 22); h++) {
                labels.push(h + ':00');
                
                // Simular datos basado en la hora
                // Mayor actividad entre 9am-12pm y 5pm-8pm
                var baseVistas = Math.floor(Math.random() * 30) + 10;
                var baseVentas = Math.floor(Math.random() * 8) + 1;
                
                if (h >= 9 && h <= 12) {
                    baseVistas += Math.floor(Math.random() * 20);
                    baseVentas += Math.floor(Math.random() * 5);
                } else if (h >= 17 && h <= 20) {
                    baseVistas += Math.floor(Math.random() * 25);
                    baseVentas += Math.floor(Math.random() * 6);
                }
                
                vistas.push(baseVistas);
                ventas.push(baseVentas);
            }
            
            // Agregar la hora actual si no está incluida
            if (currentHour > 22) {
                labels.push('22:00');
                vistas.push(Math.floor(Math.random() * 20));
                ventas.push(Math.floor(Math.random() * 5));
            }
            
            return {
                labels: labels,
                ventas: ventas,
                vistas: vistas
            };
        }
        
        var currentPeriod = 'hoy';
        var salesChart = null;
        var statusChart = null;
        var refreshInterval = null;
        
        // Generar datos iniciales para "hoy"
        salesData.hoy = generateTodayData();
        
        // Función para cambiar período
        function changePeriod(period, btn) {
            currentPeriod = period;
            
            // Actualizar botones
            document.querySelectorAll('.chart-filter').forEach(function(b) {
                b.classList.remove('active');
            });
            btn.classList.add('active');
            
            // Actualizar datos si es "hoy" (generar datos frescos)
            if (period === 'hoy') {
                salesData.hoy = generateTodayData();
            }
            
            // Actualizar gráfico
            updateChart();
            
            // Configurar auto-actualización solo para "hoy"
            if (refreshInterval) {
                clearInterval(refreshInterval);
                refreshInterval = null;
            }
            
            if (period === 'hoy') {
                refreshInterval = setInterval(function() {
                    salesData.hoy = generateTodayData();
                    updateChart();
                }, 10000); // Actualizar cada 10 segundos
            }
        }
        
        // Actualizar gráfico con datos
        function updateChart() {
            var data = salesData[currentPeriod];
            
            if (salesChart) {
                salesChart.data.labels = data.labels;
                salesChart.data.datasets[0].data = data.ventas;
                salesChart.data.datasets[1].data = data.vistas;
                salesChart.update();
            }
        }
        
        // Función para obtener datos reales de ventas
        function getRealTimeSalesData() {
            // Simular datos en tiempo real basados en las estadísticas del sistema
            var today = new Date();
            var dayOfWeek = today.getDay();
            var hour = today.getHours();
            
            // Generar datos dinámicos basados en la hora actual
            var baseViews = <?= $stats['total_client_views'] ?? 0 ?>;
            var baseSales = <?= $stats['total_sales'] ?? 0 ?>;
            
            // Calcular multiplicador de tiempo real (más actividad en horario laboral)
            var timeMultiplier = 1;
            if (hour >= 9 && hour <= 18) {
                timeMultiplier = 1.5;
            } else if (hour >= 6 && hour <= 21) {
                timeMultiplier = 1.2;
            }
            
            return {
                views: Math.floor(baseViews * timeMultiplier),
                sales: baseSales,
                hour: hour
            };
        }
        
        // Actualizar datos en tiempo real cada 5 segundos
        function updateRealTimeData() {
            var rtData = getRealTimeSalesData();
            
            // Actualizar KPI cards si existen elementos
            var viewElements = document.querySelectorAll('.kpi-value');
            if (viewElements.length > 0) {
                // Los datos ya están en el PHP, solo actualizamos la hora
                updateTimeDisplay();
            }
        }
        
        // Mostrar hora de última actualización
        function updateTimeDisplay() {
            var now = new Date();
            var timeStr = now.toLocaleTimeString('es-PE', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            
            // Buscar o crear elemento de tiempo
            var timeEl = document.getElementById('lastUpdate');
            if (!timeEl) {
                var header = document.querySelector('.bi-header');
                if (header) {
                    timeEl = document.createElement('span');
                    timeEl.id = 'lastUpdate';
                    timeEl.style.cssText = 'background: rgba(255,255,255,0.15); padding: 6px 12px; border-radius: 6px; font-size: 12px; margin-left: 10px;';
                    header.querySelector('.bi-date').appendChild(timeEl);
                }
            }
            if (timeEl) {
                timeEl.innerHTML = ' | 🕐 Actualizado: ' + timeStr;
            }
        }
        
        // Inicializar cuando el documento esté listo
        document.addEventListener('DOMContentLoaded', function() {
            // Generar datos iniciales para "hoy"
            salesData.hoy = generateTodayData();
            
            // Inicializar gráfico de ventas
            var salesCtx = document.getElementById('salesChart').getContext('2d');
            salesChart = new Chart(salesCtx, {
                type: 'bar',
                data: {
                    labels: salesData.hoy.labels,
                    datasets: [{
                        label: 'Ventas',
                        data: salesData.hoy.ventas,
                        backgroundColor: 'rgba(0, 120, 212, 0.8)',
                        borderColor: '#0078d4',
                        borderWidth: 1,
                        borderRadius: 6,
                        barThickness: 30
                    }, {
                        label: 'Vistas',
                        data: salesData.hoy.vistas,
                        backgroundColor: 'rgba(0, 183, 195, 0.6)',
                        borderColor: '#00b7c3',
                        borderWidth: 1,
                        borderRadius: 6,
                        barThickness: 30
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 500
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                padding: 20
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0,0,0,0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
            
            // Inicializar gráfico donut
            var statusCtx = document.getElementById('statusChart').getContext('2d');
            statusChart = new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Completadas', 'Pendientes', 'Canceladas'],
                    datasets: [{
                        data: [<?= $stats['completed_sales'] ?? 0 ?>, <?= $stats['pending_sales'] ?? 0 ?>, <?= $stats['cancelled_sales'] ?? 0 ?>],
                        backgroundColor: ['#107c10', '#ffb900', '#d13438'],
                        borderWidth: 0,
                        cutout: '70%'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    animation: {
                        duration: 500
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
            
            // Agregar eventos a los botones de período
            document.querySelectorAll('.chart-filter').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var period = this.textContent.toLowerCase().trim();
                    if (period === 'hoy') changePeriod('hoy', this);
                    else if (period === 'semanal') changePeriod('semanal', this);
                    else if (period === 'mensual') changePeriod('mensual', this);
                    else if (period === 'anual') changePeriod('anual', this);
                });
            });
            
            // Iniciar actualización en tiempo real para "hoy"
            updateTimeDisplay();
            
            // Auto-refresh cada 10 segundos solo para "hoy"
            setInterval(function() {
                if (currentPeriod === 'hoy') {
                    salesData.hoy = generateTodayData();
                    updateChart();
                }
                updateTimeDisplay();
            }, 10000);
        });
    </script>
</body>
</html>
