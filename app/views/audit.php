<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auditoría del Sistema</title>
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
                <h3>Dashboard</h3>
                <p>Panel de Administración</p>
            </div>
        </div>
        <nav class="sidebar-nav">
            <span class="sidebar-section">Panel</span>
            <a class="sidebar-link" href="<?= route('dashboard', 'index') ?>">
                <span class="sidebar-link-icon">🏠</span>Inicio
            </a>
            <a class="sidebar-link active" href="<?= route('dashboard', 'audit') ?>">
                <span class="sidebar-link-icon">📋</span>Auditoría
            </a>
            <span class="sidebar-section">General</span>
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
            <h1>Auditoría del sistema</h1>
            <p class="subtitle">Registro de eventos y actividad reciente.</p>

            <div class="table-wrap table-wrap--dashboard">
                <table class="audit-table dashboard-table">
                    <thead>
                    <tr>
                        <th>Evento</th>
                        <th>Email</th>
                        <th>IP</th>
                        <th>Fecha</th>
                        <th>Detalles</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($logs as $log): ?>
                        <tr>
                            <td><?= htmlspecialchars($log['event']) ?></td>
                            <td><?= htmlspecialchars($log['email']) ?></td>
                            <td><?= htmlspecialchars($log['ip']) ?></td>
                            <td><?= htmlspecialchars($log['created_at']) ?></td>
                            <td><?= htmlspecialchars($log['details']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="links-row">
                <a href="<?= route('dashboard', 'index') ?>">Volver al panel</a>
            </div>
        </section>
    </main>
</div>
</body>
</html>
