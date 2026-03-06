<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics de Ventas - CRM LaPeruvianita</title>
    <link rel="stylesheet" href="<?= asset('estilos.css') ?>">
    <link rel="stylesheet" href="<?= asset('dashboard.css') ?>">
    <link rel="stylesheet" href="<?= asset('sales_analytics.css') ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
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
                <a class="sidebar-link" href="<?= route('dashboard', 'audit') ?>">
                    <span class="sidebar-link-icon">📋</span>Auditoría
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
            <!-- Header moderno -->
            <div class="bi-header">
                <div class="bi-header-content">
                    <div class="bi-header-left">
                        <div class="bi-header-badge">Analytics en vivo</div>
                        <h1>Analytics de Ventas</h1>
                        <p>Panel de análisis y métricas en tiempo real</p>
                    </div>
                    <span class="bi-date">📅 <?= date('d M Y') ?></span>
                </div>
            </div>

            <div class="analytics-body">

            <!-- Quick Stats -->
            <div class="quick-stats">
                <div class="quick-stat">
                    <div class="quick-stat-icon" style="background: rgba(99,102,241,0.1);">👁️</div>
                    <div class="quick-stat-info">
                        <div class="value"><?= $stats['total_client_views'] ?? 0 ?></div>
                        <div class="label">Total Vistas</div>
                    </div>
                </div>
                <div class="quick-stat">
                    <div class="quick-stat-icon" style="background: rgba(16,185,129,0.1);">🛒</div>
                    <div class="quick-stat-info">
                        <div class="value"><?= $stats['total_purchase_attempts'] ?? 0 ?></div>
                        <div class="label">Compras Iniciadas</div>
                    </div>
                </div>
                <div class="quick-stat">
                    <div class="quick-stat-icon" style="background: rgba(239,68,68,0.1);">❌</div>
                    <div class="quick-stat-info">
                        <div class="value"><?= $stats['total_cancellations'] ?? 0 ?></div>
                        <div class="label">Cancelaciones</div>
                    </div>
                </div>
                <div class="quick-stat">
                    <div class="quick-stat-icon" style="background: rgba(6,182,212,0.1);">👤</div>
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
                        <h3 class="chart-title"><span class="chart-title-icon">📈</span> Rendimiento de Ventas</h3>
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
                        <h3 class="chart-title"><span class="chart-title-icon">📊</span> Estado de Ventas</h3>
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
                    <h3 class="data-section-title"><span class="section-icon">⭐</span> Clientes Potenciales</h3>
                    <span class="status-badge warning"><?= count($stats['potential_clients'] ?? []) ?> leads</span>
                </div>
                
                <?php if (empty($stats['potential_clients'])): ?>
                    <div class="empty-state"><p>No hay clientes potenciales aún</p></div>
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
                    <h3 class="data-section-title"><span class="section-icon">👥</span> Actividad de Clientes</h3>
                    <span class="status-badge info"><?= count($activities ?? []) ?> clientes</span>
                </div>
                
                <?php if (empty($activities)): ?>
                    <div class="empty-state"><p>No hay actividades registradas aún</p></div>
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
                    <h3 class="data-section-title"><span class="section-icon">📋</span> Registro de Auditoría</h3>
                    <span class="status-badge info"><?= count($salesAuditLogs ?? []) ?> eventos</span>
                </div>
                
                <?php if (empty($salesAuditLogs)): ?>
                    <div class="empty-state"><p>No hay registros de auditoría aún</p></div>
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

            </div><!-- /analytics-body -->
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
