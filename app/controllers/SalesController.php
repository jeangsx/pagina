<?php

require_once MODEL_PATH . '/SalesModel.php';
require_once MODEL_PATH . '/AuditModel.php';
require_once MODEL_PATH . '/UserModel.php';

class SalesController
{
    private $salesModel;
    private $userModel;

    public function __construct()
    {
        $this->salesModel = new SalesModel();
        $this->userModel = new UserModel();
    }

    /**
     * Página principal de ventas - lista de ventas
     */
    public function index()
    {
        authRequired();

        $sales = $this->salesModel->getAll();
        $stats = $this->salesModel->getStats();

        // Filtrar por búsqueda
        $search = $_GET['search'] ?? '';
        $statusFilter = $_GET['status'] ?? '';

        if ($search) {
            $sales = array_filter($sales, function($sale) use ($search) {
                return stripos($sale['client_name'], $search) !== false ||
                       stripos($sale['client_email'], $search) !== false ||
                       stripos($sale['product'], $search) !== false;
            });
        }

        if ($statusFilter) {
            $sales = array_filter($sales, function($sale) use ($statusFilter) {
                return $sale['status'] === $statusFilter;
            });
        }

        // Ordenar por fecha descendente
        usort($sales, function($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });

        require VIEW_PATH . '/sales.php';
    }

    /**
     * Muestra el formulario para agregar una nueva venta
     */
    public function addSale()
    {
        authRequired();

        require VIEW_PATH . '/sales_add.php';
    }

    /**
     * Procesa la creación de una nueva venta
     */
    public function createSale()
    {
        authRequired();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect(route('sales', 'addSale'));
        }

        $data = [
            'client_email' => trim($_POST['client_email'] ?? ''),
            'client_name' => trim($_POST['client_name'] ?? ''),
            'product' => trim($_POST['product'] ?? ''),
            'amount' => floatval($_POST['amount'] ?? 0),
            'status' => $_POST['status'] ?? 'pending',
            'payment_method' => $_POST['payment_method'] ?? 'pago_online',
            'notes' => trim($_POST['notes'] ?? '')
        ];

        if (empty($data['client_email']) || empty($data['product'])) {
            $_SESSION['sales_error'] = 'El email del cliente y el producto son requeridos.';
            redirect(route('sales', 'addSale'));
        }

        $sale = $this->salesModel->create($data);

        // Registrar en auditoría
        $audit = new AuditModel();
        $userEmail = $_SESSION['user_id'];
        $audit->log('SALE_CREATED', $userEmail, "Venta creada: {$sale['id']} - Cliente: {$data['client_email']} - Producto: {$data['product']}");

        $_SESSION['sales_success'] = 'Venta creada exitosamente.';
        redirect(route('sales', 'index'));
    }

    /**
     * Muestra el formulario para editar una venta
     */
    public function editSale()
    {
        authRequired();

        $id = $_GET['id'] ?? '';
        
        if (empty($id)) {
            $_SESSION['sales_error'] = 'ID de venta no proporcionado.';
            redirect(route('sales', 'index'));
        }

        $sale = $this->salesModel->findById($id);

        if (!$sale) {
            $_SESSION['sales_error'] = 'Venta no encontrada.';
            redirect(route('sales', 'index'));
        }

        require VIEW_PATH . '/sales_edit.php';
    }

    /**
     * Procesa la actualización de una venta
     */
    public function updateSale()
    {
        authRequired();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect(route('sales', 'index'));
        }

        $id = $_POST['id'] ?? '';
        
        if (empty($id)) {
            $_SESSION['sales_error'] = 'ID de venta no proporcionado.';
            redirect(route('sales', 'index'));
        }

        $data = [
            'client_email' => trim($_POST['client_email'] ?? ''),
            'client_name' => trim($_POST['client_name'] ?? ''),
            'product' => trim($_POST['product'] ?? ''),
            'amount' => floatval($_POST['amount'] ?? 0),
            'status' => $_POST['status'] ?? 'pending',
            'payment_method' => $_POST['payment_method'] ?? 'pago_online',
            'notes' => trim($_POST['notes'] ?? '')
        ];

        if (empty($data['client_email']) || empty($data['product'])) {
            $_SESSION['sales_error'] = 'El email del cliente y el producto son requeridos.';
            redirect(route('sales', 'editSale') . '&id=' . urlencode($id));
        }

        $updated = $this->salesModel->update($id, $data);

        if ($updated) {
            // Registrar en auditoría
            $audit = new AuditModel();
            $userEmail = $_SESSION['user_id'];
            $audit->log('SALE_UPDATED', $userEmail, "Venta actualizada: {$id} - Cliente: {$data['client_email']} - Estado: {$data['status']}");

            $_SESSION['sales_success'] = 'Venta actualizada exitosamente.';
        } else {
            $_SESSION['sales_error'] = 'Error al actualizar la venta.';
        }

        redirect(route('sales', 'index'));
    }

    /**
     * Elimina una venta
     */
    public function deleteSale()
    {
        authRequired();

        $id = $_GET['id'] ?? '';

        if (empty($id)) {
            $_SESSION['sales_error'] = 'ID de venta no proporcionado.';
            redirect(route('sales', 'index'));
        }

        $deleted = $this->salesModel->delete($id);

        if ($deleted) {
            // Registrar en auditoría
            $audit = new AuditModel();
            $userEmail = $_SESSION['user_id'];
            $audit->log('SALE_DELETED', $userEmail, "Venta eliminada: {$id}");

            $_SESSION['sales_success'] = 'Venta eliminada exitosamente.';
        } else {
            $_SESSION['sales_error'] = 'Error al eliminar la venta.';
        }

        redirect(route('sales', 'index'));
    }

    /**
     * Muestra las analytics y auditoría de ventas
     */
    public function analytics()
    {
        authRequired();

        $stats = $this->salesModel->getStats();
        $activities = $this->salesModel->getAllClientActivities();
        
        // Obtener logs de auditoría relacionados con ventas
        $auditModel = new AuditModel();
        $allAuditLogs = [];
        
        $auditFile = DATA_PATH . '/audit.json';
        if (file_exists($auditFile)) {
            $allAuditLogs = json_decode(file_get_contents($auditFile), true) ?? [];
        }

        // Filtrar solo logs relacionados con ventas y acciones de clientes
        $salesAuditLogs = array_filter($allAuditLogs, function($log) {
            $event = $log['event'] ?? '';
            return strpos($event, 'SALE_') !== false || strpos($event, 'CLIENT_ACTION_') !== false;
        });

        // Ordenar por fecha descendente
        usort($salesAuditLogs, function($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });

        // Limitar a los últimos 100
        $salesAuditLogs = array_slice($salesAuditLogs, 0, 100);

        require VIEW_PATH . '/sales_analytics.php';
    }

    /**
     * API endpoint para registrar acción de cliente (desde la página pública de ventas)
     */
    public function apiLogClientAction()
    {
        // Esta acción puede ser llamada sin autenticación para registrar vistas de productos
        header('Content-Type: application/json');

        $email = trim($_POST['email'] ?? '');
        $action = $_POST['action'] ?? '';
        $product = trim($_POST['product'] ?? '');

        // Validar que sea un email de Gmail (cliente)
        if (empty($email)) {
            echo json_encode(['success' => false, 'message' => 'Email requerido']);
            return;
        }

        if (!preg_match('/@gmail\.com$/', strtolower($email))) {
            echo json_encode(['success' => false, 'message' => 'Solo se permiten cuentas Gmail para clientes']);
            return;
        }

        $validActions = ['view_product', 'register_purchase', 'cancel_purchase'];
        if (!in_array($action, $validActions)) {
            echo json_encode(['success' => false, 'message' => 'Acción inválida']);
            return;
        }

        // Validar que el cliente existe en el sistema
        $user = $this->userModel->findByEmail($email);
        if (!$user) {
            // Si no existe, lo registramos como cliente potencial
            $this->userModel->create([
                'email' => $email,
                'name' => $_POST['client_name'] ?? $email,
                'type' => 'Cliente',
                'status' => 'Activo'
            ]);
        }

        // Registrar la acción
        $this->salesModel->logClientAction($email, $action, $product);

        // Actualizar el tipo de usuario si es necesario
        $userType = $this->salesModel->getUserType($email);

        echo json_encode([
            'success' => true, 
            'message' => 'Acción registrada',
            'user_type' => $userType
        ]);
    }

    /**
     * Muestra la página pública de ventas para clientes
     */
    public function publicSalesPage()
    {
        // Página pública - no requiere autenticación
        require VIEW_PATH . '/sales_public.php';
    }

    /**
     * Procesa el registro de un nuevo cliente desde la página pública
     */
    public function registerClient()
    {
        header('Content-Type: application/json');

        $email = trim($_POST['email'] ?? '');
        $name = trim($_POST['name'] ?? '');

        // Validar que sea un email de Gmail
        if (empty($email)) {
            echo json_encode(['success' => false, 'message' => 'Email requerido']);
            return;
        }

        if (!preg_match('/@gmail\.com$/', strtolower($email))) {
            echo json_encode(['success' => false, 'message' => 'Solo se permiten cuentas Gmail para clientes']);
            return;
        }

        // Verificar si ya existe
        $existingUser = $this->userModel->findByEmail($email);
        
        if ($existingUser) {
            // Registrar actividad de login
            $this->salesModel->logClientAction($email, 'view_product', 'Login/Sesión');
            
            echo json_encode([
                'success' => true, 
                'message' => 'Bienvenido de nuevo',
                'user_type' => 'client'
            ]);
            return;
        }

        // Crear nuevo cliente
        $this->userModel->create([
            'email' => $email,
            'name' => $name ?: $email,
            'type' => 'Cliente',
            'status' => 'Activo'
        ]);

        // Registrar actividad
        $this->salesModel->logClientAction($email, 'view_product', 'Registro de cuenta');

        echo json_encode([
            'success' => true, 
            'message' => 'Cliente registrado exitosamente',
            'user_type' => 'client'
        ]);
    }

    /**
     * Muestra el detalle de actividades de un cliente específico
     */
    public function clientDetail()
    {
        authRequired();

        $email = $_GET['email'] ?? '';

        if (empty($email)) {
            $_SESSION['sales_error'] = 'Email de cliente no proporcionado.';
            redirect(route('sales', 'analytics'));
        }

        $activity = $this->salesModel->getClientActivity($email);
        
        if (!$activity) {
            $_SESSION['sales_error'] = 'No se encontró actividad para este cliente.';
            redirect(route('sales', 'analytics'));
        }

        // Obtener ventas del cliente
        $sales = $this->salesModel->findByClientEmail($email);

        require VIEW_PATH . '/sales_client_detail.php';
    }

    /**
     * Exporta las ventas a CSV
     */
    public function exportSales()
    {
        authRequired();

        $sales = $this->salesModel->getAll();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="ventas_' . date('Y-m-d') . '.csv"');
        
        $output = fopen('php://output', 'w');
        
        // Encabezados
        fputcsv($output, ['ID', 'Cliente', 'Email', 'Producto', 'Monto', 'Estado', 'Fecha', 'Notas']);
        
        foreach ($sales as $sale) {
            fputcsv($output, [
                $sale['id'],
                $sale['client_name'],
                $sale['client_email'],
                $sale['product'],
                $sale['amount'],
                $sale['status'],
                $sale['created_at'],
                $sale['notes']
            ]);
        }
        
        fclose($output);
        exit;
    }
    
    /**
     * API: Obtiene las ventas en tiempo real (JSON)
     */
    public function apiGetSales()
    {
        authRequired();
        
        header('Content-Type: application/json');
        
        $sales = $this->salesModel->getAll();
        $stats = $this->salesModel->getStats();
        
        // Aplicar filtros si existen
        $search = $_GET['search'] ?? '';
        $statusFilter = $_GET['status'] ?? '';
        
        if ($search) {
            $sales = array_filter($sales, function($sale) use ($search) {
                return stripos($sale['client_name'], $search) !== false ||
                       stripos($sale['client_email'], $search) !== false ||
                       stripos($sale['product'], $search) !== false;
            });
        }
        
        if ($statusFilter) {
            $sales = array_filter($sales, function($sale) use ($statusFilter) {
                return $sale['status'] === $statusFilter;
            });
        }
        
        // Ordenar por fecha descendente
        usort($sales, function($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });
        
        echo json_encode([
            'success' => true,
            'sales' => $sales,
            'stats' => $stats,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
        exit;
    }
}
