<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Empleado</title>
    <link rel="stylesheet" href="<?= asset('estilos.css') ?>">
    <link rel="stylesheet" href="<?= asset('dashboard.css') ?>">
    <link rel="stylesheet" href="<?= asset('employee_detail.css') ?>">
    <script src="<?= asset('theme.js') ?>" defer></script>
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
                <h3>Dashboard</h3>
                <p>Panel de Administración</p>
            </div>
        </div>
        <nav class="sidebar-nav">
            <span class="sidebar-section">Panel</span>
            <a class="sidebar-link" href="<?= route('dashboard', 'index') ?>">
                <span class="sidebar-link-icon">🏠</span>Inicio
            </a>
            <a class="sidebar-link" href="<?= route('dashboard', 'audit') ?>">
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
            <?php if (isset($user) && $user): ?>
                <h1>Información del Empleado</h1>

                <div class="employee-detail-card">
                    <!-- Encabezado con avatar y nombre -->
                    <div class="employee-header">
                        <div class="employee-avatar"><?= strtoupper(substr($user['name'] ?? 'U', 0, 1)) ?></div>
                        <div class="employee-header-info">
                            <h2><?= htmlspecialchars($user['name'] ?? 'N/A') ?></h2>
                            <p><?= htmlspecialchars($user['type'] ?? 'N/A') ?></p>
                        </div>
                    </div>

                    <!-- Información de Contacto -->
                    <h3 style="font-size: 1.1rem; color: var(--text-secondary, #666); font-weight: 700; margin-top: 2rem; margin-bottom: 1rem;">Información de Contacto</h3>
                    <div class="detail-grid">
                        <div class="detail-item">
                            <label>Email</label>
                            <div class="value"><?= htmlspecialchars($user['email'] ?? 'N/A') ?></div>
                        </div>
                        <div class="detail-item">
                            <label>Teléfono</label>
                            <div class="value"><?= htmlspecialchars($user['phone'] ?? 'No registrado') ?></div>
                        </div>
                    </div>

                    <!-- Información Laboral -->
                    <h3 style="font-size: 1.1rem; color: var(--text-secondary, #666); font-weight: 700; margin-top: 2rem; margin-bottom: 1rem;">Información Laboral</h3>
                    <div class="detail-grid">
                        <div class="detail-item">
                            <label>Departamento</label>
                            <div class="value"><?= htmlspecialchars($user['department'] ?? 'No asignado') ?></div>
                        </div>
                        <div class="detail-item">
                            <label>Puesto</label>
                            <div class="value"><?= htmlspecialchars($user['position'] ?? 'No asignado') ?></div>
                        </div>
                        <div class="detail-item">
                            <label>Fecha de Contratación</label>
                            <div class="value"><?= htmlspecialchars($user['hired_at'] ?? 'No registrada') ?></div>
                        </div>
                    </div>

                    <!-- Estado -->
                    <h3 style="font-size: 1.1rem; color: var(--text-secondary, #666); font-weight: 700; margin-top: 2rem; margin-bottom: 1rem;">Estado</h3>
                    <div class="detail-grid">
                        <div class="detail-item">
                            <label>Estado Actual</label>
                            <div class="value">
                                <span class="status-badge <?= strtolower($user['status'] ?? '') === 'activo' ? 'status-badge--active' : 'status-badge--inactive' ?>">
                                    <?= htmlspecialchars($user['status'] ?? 'N/A') ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Metadata -->
                    <h3 style="font-size: 1.1rem; color: var(--text-secondary, #666); font-weight: 700; margin-top: 2rem; margin-bottom: 1rem;">Información Adicional</h3>
                    <div class="detail-grid">
                        <div class="detail-item">
                            <label>Registrado en</label>
                            <div class="value"><?= htmlspecialchars($user['created_at'] ?? 'N/A') ?></div>
                        </div>
                        <div class="detail-item">
                            <label>ID del Empleado</label>
                            <div class="value" style="font-family: monospace; font-size: 0.9rem;"><?= htmlspecialchars($user['id'] ?? 'N/A') ?></div>
                        </div>
                    </div>

                    <a href="<?= route('dashboard', 'index') ?>" class="btn-back">← Volver al Dashboard</a>
                </div>
            <?php else: ?>
                <h1>Empleado no encontrado</h1>
                <div class="employee-detail-card">
                    <p>No se pudo encontrar el empleado solicitado.</p>
                    <a href="<?= route('dashboard', 'index') ?>" class="btn-back">← Volver al Dashboard</a>
                </div>
            <?php endif; ?>
        </section>
    </main>
</div>

</body>
</html>