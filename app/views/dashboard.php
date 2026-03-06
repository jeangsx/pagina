<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard RRHH</title>
    <link rel="stylesheet" href="<?= asset('estilos.css') ?>">
    <link rel="stylesheet" href="<?= asset('dashboard.css') ?>">
    <script src="<?= asset('theme.js') ?>" defer></script>
</head>
<body class="dashboard-body">
<button class="theme-toggle" type="button" data-theme-toggle aria-label="Cambiar tema"></button>
<?php
$view = $_GET['view'] ?? 'table';
$activeView = in_array($view, ['table', 'gallery'], true) ? $view : 'table';
?>
<div class="dashboard-layout">
    <aside class="dashboard-sidebar">
        <div class="sidebar-header">
            <div class="sidebar-brand-icon">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M3 13h2v7H3v-7zm4-5h2v12H7V8zm4-3h2v15h-2V5zm4 5h2v10h-2v-10zm4-3h2v13h-2V7z"/></svg>
            </div>
            <div class="sidebar-brand-text">
                <h3>Dashboard</h3>
                <p>Panel de Administración</p>
            </div>
        </div>
        <nav class="sidebar-nav">
            <span class="sidebar-section">Panel</span>
            <a class="sidebar-link active" href="<?= route('dashboard', 'index') ?>">
                <span class="sidebar-link-icon">🏠</span>Inicio
            </a>
            <a class="sidebar-link" href="<?= route('dashboard', 'audit') ?>">
                <span class="sidebar-link-icon">📋</span>Auditoría
            </a>
            <span class="sidebar-section">CRM Ventas</span>
            <a class="sidebar-link" href="<?= route('sales', 'index') ?>">
                <span class="sidebar-link-icon">🛒</span>Gestión de Ventas
            </a>
            <a class="sidebar-link" href="<?= route('sales', 'analytics') ?>">
                <span class="sidebar-link-icon">📊</span>Analytics
            </a>
            <a class="sidebar-link" href="<?= route('sales', 'publicSalesPage') ?>" target="_blank">
                <span class="sidebar-link-icon">🌐</span>Página de Ventas
            </a>
            <span class="sidebar-section">Usuarios</span>
            <a class="sidebar-link" href="<?= route('dashboard', 'addEmployee') ?>">
                <span class="sidebar-link-icon">➕</span>Agregar empleado
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
            <h1>Dashboard Principal</h1>

            <div class="module-headline">
                <h2>Centro de Control - LaPeruvianita</h2>
                <p>Resumen de ventas y métricas en tiempo real</p>
            </div>

            <!-- Estadísticas CRM Ventas -->
            <div class="stats-grid">
                <?php
                // Cargar estadísticas de ventas
                $salesStats = [];
                $salesFile = DATA_PATH . '/sales.json';
                if (file_exists($salesFile)) {
                    $salesData = json_decode(file_get_contents($salesFile), true) ?? [];
                    $totalVentas = count($salesData);
                    $ventasCompletadas = count(array_filter($salesData, function($s) { return ($s['status'] ?? '') === 'completed'; }));
                    $ventasPendientes = count(array_filter($salesData, function($s) { return ($s['status'] ?? '') === 'pending'; }));
                    $ventasCanceladas = count(array_filter($salesData, function($s) { return ($s['status'] ?? '') === 'cancelled'; }));
                    $ingresosTotales = array_sum(array_column($salesData, 'amount'));
                    $clientesUnicos = count(array_unique(array_column($salesData, 'client_email')));
                    
                    $salesStats = [
                        'total_ventas' => $totalVentas,
                        'completadas' => $ventasCompletadas,
                        'pendientes' => $ventasPendientes,
                        'canceladas' => $ventasCanceladas,
                        'ingresos' => $ingresosTotales,
                        'clientes' => $clientesUnicos
                    ];
                }
                ?>
                <article class="stat-card">
                    <h4>Total Ventas</h4>
                    <p class="stat-value"><?= $salesStats['total_ventas'] ?? 0 ?></p>
                    <small>Transacciones registradas</small>
                </article>
                <article class="stat-card">
                    <h4>Ingresos Totales</h4>
                    <p class="stat-value">S/ <?= number_format($salesStats['ingresos'] ?? 0, 2) ?></p>
                    <small>Total facturado</small>
                </article>
                <article class="stat-card">
                    <h4>Clientes Únicos</h4>
                    <p class="stat-value"><?= $salesStats['clientes'] ?? 0 ?></p>
                    <small>Clientes registrados</small>
                </article>
                <article class="stat-card stat-card--success">
                    <h4>Completadas</h4>
                    <p class="stat-value"><?= $salesStats['completadas'] ?? 0 ?></p>
                    <small>Ventas exitosas</small>
                </article>
                <article class="stat-card stat-card--warning">
                    <h4>Pendientes</h4>
                    <p class="stat-value"><?= $salesStats['pendientes'] ?? 0 ?></p>
                    <small>En proceso</small>
                </article>
                <article class="stat-card stat-card--danger">
                    <h4>Canceladas</h4>
                    <p class="stat-value"><?= $salesStats['canceladas'] ?? 0 ?></p>
                    <small>No completadas</small>
                </article>
            </div>

            <!-- Acciones Rápidas -->
            <div class="module-header">
                <div>
                    <h3>Acciones Rápidas</h3>
                    <p class="subtitle">Accede a las funciones principales</p>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 16px; margin-bottom: 24px;">
                <a href="<?= route('sales', 'index') ?>" style="display: block; padding: 20px; background: linear-gradient(135deg, #0078d4, #106ebe); color: white; border-radius: 8px; text-decoration: none; transition: transform 0.2s;">
                    <h4 style="margin: 0 0 8px 0;">📊 Gestión de Ventas</h4>
                    <p style="margin: 0; font-size: 13px; opacity: 0.9;">Administra todas las transacciones</p>
                </a>
                <a href="<?= route('sales', 'analytics') ?>" style="display: block; padding: 20px; background: linear-gradient(135deg, #107c10, #0e6b0e); color: white; border-radius: 8px; text-decoration: none; transition: transform 0.2s;">
                    <h4 style="margin: 0 0 8px 0;">📈 Analytics</h4>
                    <p style="margin: 0; font-size: 13px; opacity: 0.9;">Ver métricas y gráficos</p>
                </a>
                <a href="<?= route('sales', 'addSale') ?>" style="display: block; padding: 20px; background: linear-gradient(135deg, #ff8c00, #e07b00); color: white; border-radius: 8px; text-decoration: none; transition: transform 0.2s;">
                    <h4 style="margin: 0 0 8px 0;">➕ Nueva Venta</h4>
                    <p style="margin: 0; font-size: 13px; opacity: 0.9;">Registrar una nueva venta</p>
                </a>
                <a href="<?= route('sales', 'publicSalesPage') ?>" target="_blank" style="display: block; padding: 20px; background: linear-gradient(135deg, #8764b8, #6b4f9e); color: white; border-radius: 8px; text-decoration: none; transition: transform 0.2s;">
                    <h4 style="margin: 0 0 8px 0;">🛒 Tienda Online</h4>
                    <p style="margin: 0; font-size: 13px; opacity: 0.9;">Ver página pública</p>
                </a>
            </div>

            <div class="module-header">
                <div>
                    <h3>Recursos Humanos</h3>
                    <p class="subtitle">Gestión de personal y empleados</p>
                </div>

                <div class="module-actions">
                    <a class="btn-secondary btn-inline" href="<?= route('dashboard', 'audit') ?>">Exportar</a>
                    <a class="btn-primary btn-inline" href="<?= route('dashboard', 'addEmployee') ?>">Agregar Empleado</a>
                </div>
            </div>
            <?php
            // calcular estadísticas por tipo de empleado
            $rowsForStats = $allUsers ?? (isset($user) ? [$user] : []);
            $totalPersonal = count($rowsForStats);
            $counts = [];
            foreach ($rowsForStats as $r) {
                $t = trim($r['type'] ?? '');
                if ($t === '') $t = 'Otro';
                if (!isset($counts[$t])) $counts[$t] = 0;
                $counts[$t]++;
            }

            $instructores = $counts['Instructor'] ?? 0;
            $desarrolladores = $counts['Desarrollador'] ?? 0;
            $administradores = $counts['Administrador'] ?? 0;
            $asistAdministrativos = $counts['Asistente Administrativo'] ?? 0;
            ?>

            <div class="stats-grid">
                <article class="stat-card">
                    <h4>Total Personal</h4>
                    <p class="stat-value"><?= $totalPersonal ?></p>
                    <small>Empleados registrados</small>
                </article>
                <article class="stat-card">
                    <h4>Instructores</h4>
                    <p class="stat-value"><?= $instructores ?></p>
                    <small>Equipo docente</small>
                </article>
                <article class="stat-card">
                    <h4>Desarrolladores</h4>
                    <p class="stat-value"><?= $desarrolladores ?></p>
                    <small>Equipo técnico</small>
                </article>
                <article class="stat-card">
                    <h4>Administradores</h4>
                    <p class="stat-value"><?= $administradores ?></p>
                    <small>Personal administrativo</small>
                </article>
                <article class="stat-card">
                    <h4>Asist. Administrativos</h4>
                    <p class="stat-value"><?= $asistAdministrativos ?></p>
                    <small>Personal de soporte</small>
                </article>
            </div>

            <div class="subtab-row media-tabs">
                <a class="subtab-item <?= $activeView === 'gallery' ? 'active' : '' ?>" href="<?= route('dashboard', 'index') ?>&view=gallery">Galería de Fotos</a>
                <a class="subtab-item <?= $activeView === 'table' ? 'active' : '' ?>" href="<?= route('dashboard', 'index') ?>&view=table">Tabla Detallada</a>
            </div>

            <form class="filter-row" method="get" action="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>" aria-label="Filtros de búsqueda">
                <input type="hidden" name="controller" value="dashboard">
                <input type="hidden" name="action" value="index">
                <input
                    type="search"
                    name="search"
                    value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                    placeholder="Buscar por nombre, email o puesto..."
                    aria-label="Buscar personal">

                <select name="type" aria-label="Filtrar por tipo" onchange="this.form.submit()">
                    <option value="" <?= (isset($_GET['type']) && $_GET['type'] === '') || !isset($_GET['type']) ? 'selected' : '' ?>>Todos los tipos</option>
                    <option value="Instructor" <?= (isset($_GET['type']) && $_GET['type'] === 'Instructor') ? 'selected' : '' ?>>Instructor</option>
                    <option value="Desarrollador" <?= (isset($_GET['type']) && $_GET['type'] === 'Desarrollador') ? 'selected' : '' ?>>Desarrollador</option>
                    <option value="Administrador" <?= (isset($_GET['type']) && $_GET['type'] === 'Administrador') ? 'selected' : '' ?>>Administrador</option>
                    <option value="Asistente Administrativo" <?= (isset($_GET['type']) && $_GET['type'] === 'Asistente Administrativo') ? 'selected' : '' ?>>Asistente Administrativo</option>
                </select>

                <select name="status" aria-label="Filtrar por estado" onchange="this.form.submit()">
                    <option value="" <?= (isset($_GET['status']) && $_GET['status'] === '') || !isset($_GET['status']) ? 'selected' : '' ?>>Todos los estados</option>
                    <option value="Activo" <?= (isset($_GET['status']) && $_GET['status'] === 'Activo') ? 'selected' : '' ?>>Activo</option>
                    <option value="Inactivo" <?= (isset($_GET['status']) && $_GET['status'] === 'Inactivo') ? 'selected' : '' ?>>Inactivo</option>
                </select>

                <button class="btn-secondary" type="submit">Aplicar</button>
            </form>

            <?php if ($activeView === 'gallery'): ?>
                <div class="gallery-grid">
                    <?php
                    $galleryRows = $allUsers ?? [];
                    if (empty($galleryRows)) {
                        $galleryRows = isset($user) ? [$user] : [];
                    }
                    ?>
                    <?php foreach ($galleryRows as $u): ?>
                        <?php
                        $name = trim($u['name'] ?? '');
                        $initial = strtoupper(substr($name !== '' ? $name : 'N', 0, 1));
                        $photoUrl = trim($u['photo_url'] ?? '');
                        ?>
                        <article class="profile-card">
                            <?php if ($photoUrl !== ''): ?>
                                <div class="avatar avatar--image">
                                    <img src="<?= asset($photoUrl) ?>" alt="Foto de <?= htmlspecialchars($name) ?>">
                                </div>
                            <?php else: ?>
                                <div class="avatar"><?= htmlspecialchars($initial) ?></div>
                            <?php endif; ?>
                            <h4><?= htmlspecialchars($name) ?></h4>
                            <span class="role-chip"><?= htmlspecialchars($u['type'] ?? 'Sin tipo') ?></span>
                            <p><?= htmlspecialchars($u['email'] ?? '') ?></p>
                            <small>Registrado: <?= htmlspecialchars($u['created_at'] ?? '-') ?></small>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="table-wrap table-wrap--dashboard">
                    <table class="audit-table dashboard-table">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Tipo</th>
                            <th>Puesto</th>
                            <th>Departamento</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $rows = $allUsers ?? [];
                        if (empty($rows)) :
                            // fallback a mostrar usuario actual
                            $rows = isset($user) ? [$user] : [];
                        endif;

                        foreach ($rows as $u) :
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($u['name'] ?? '') ?></td>
                                <td><?= htmlspecialchars($u['email'] ?? '') ?></td>
                                <td><span class="role-chip"><?= htmlspecialchars($u['type'] ?? '') ?></span></td>
                                <td><?= htmlspecialchars($u['position'] ?? '') ?></td>
                                <td><?= htmlspecialchars($u['department'] ?? '') ?></td>
                                <td><span class="status-chip"><?= htmlspecialchars($u['status'] ?? '') ?></span></td>
                                <td>
                                    <a class="table-link" href="<?= route('dashboard', 'viewEmployee') ?>&id=<?= urlencode($u['id'] ?? '') ?>">Ver</a>
                                    <a class="table-link" href="<?= route('dashboard', 'editEmployee') ?>&id=<?= urlencode($u['id'] ?? '') ?>">Editar</a>
                                </td>
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
