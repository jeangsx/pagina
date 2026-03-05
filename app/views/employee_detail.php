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
        <h3>Dashboard</h3>
        <p>Panel de Administración</p>

        <span class="sidebar-section">PANEL</span>
        <a class="sidebar-link" href="<?= route('dashboard', 'index') ?>">Inicio</a>
        <a class="sidebar-link" href="<?= route('dashboard', 'audit') ?>">Auditoría</a>

        <span class="sidebar-section">GENERAL</span>
        <a class="sidebar-link" href="<?= route('dashboard', 'addEmployee') ?>">Agregar empleado</a>
        <a class="sidebar-link" href="<?= route('dashboard', 'logout') ?>">Cerrar sesión</a>
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