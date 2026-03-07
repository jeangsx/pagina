<?php

require_once MODEL_PATH . '/database.php';

class SalesModel
{
    private $jsonFile;

    public function __construct()
    {
        $this->jsonFile = DATA_PATH . '/sales.json';

        if (!file_exists($this->jsonFile)) {
            file_put_contents($this->jsonFile, json_encode([]));
        }
    }

    /**
     * Determina el tipo de usuario basado en su email
     * @param string $email
     * @return string 'client' (Gmail) o 'employee' (dominio empresarial)
     */
    public function getUserType($email)
    {
        $emailLower = strtolower($email);
        
        // Si termina en @gmail.com es cliente
        if (preg_match('/@gmail\.com$/', $emailLower)) {
            return 'client';
        }
        
        // Cualquier otro dominio se considera empleado/empresa
        return 'employee';
    }

    /**
     * Crea una nueva venta
     * @param array $data
     * @return array
     */
    public function create($data)
    {
        $sales = json_decode(file_get_contents($this->jsonFile), true);
        
        $sale = [
            'id' => uniqid(),
            'client_email' => $data['client_email'] ?? '',
            'client_name' => $data['client_name'] ?? '',
            'product' => $data['product'] ?? '',
            'amount' => floatval($data['amount'] ?? 0),
            'status' => $data['status'] ?? 'pending', // pending, completed, cancelled
            'payment_method' => $data['payment_method'] ?? 'pago_online', // pago_online, contra_entrega
            'notes' => $data['notes'] ?? '',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $sales[] = $sale;
        file_put_contents($this->jsonFile, json_encode($sales, JSON_PRETTY_PRINT));

        // Intentar guardar en MySQL
        try {
            $db = Database::connect();
            $sql = "INSERT INTO sales (id, client_email, client_name, product, amount, status, payment_method, notes, created_at, updated_at)
                    VALUES (:id, :client_email, :client_name, :product, :amount, :status, :payment_method, :notes, :created_at, :updated_at)";
            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':id' => $sale['id'],
                ':client_email' => $sale['client_email'],
                ':client_name' => $sale['client_name'],
                ':product' => $sale['product'],
                ':amount' => $sale['amount'],
                ':status' => $sale['status'],
                ':payment_method' => $sale['payment_method'],
                ':notes' => $sale['notes'],
                ':created_at' => $sale['created_at'],
                ':updated_at' => $sale['updated_at']
            ]);
        } catch (Exception $e) {
            // Ignorar errores de base de datos
        }

        return $sale;
    }

    /**
     * Obtiene todas las ventas
     * @return array
     */
    public function getAll()
    {
        return json_decode(file_get_contents($this->jsonFile), true) ?? [];
    }

    /**
     * Busca una venta por ID
     * @param string $id
     * @return array|null
     */
    public function findById($id)
    {
        $sales = json_decode(file_get_contents($this->jsonFile), true) ?? [];
        
        foreach ($sales as $sale) {
            if ($sale['id'] === $id) {
                return $sale;
            }
        }
        
        return null;
    }

    /**
     * Busca ventas por email del cliente
     * @param string $email
     * @return array
     */
    public function findByClientEmail($email)
    {
        $sales = json_decode(file_get_contents($this->jsonFile), true) ?? [];
        $result = [];
        
        foreach ($sales as $sale) {
            if (strtolower($sale['client_email']) === strtolower($email)) {
                $result[] = $sale;
            }
        }
        
        return $result;
    }

    /**
     * Actualiza una venta
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function update($id, $data)
    {
        $sales = json_decode(file_get_contents($this->jsonFile), true) ?? [];
        $updated = false;
        $updatedSale = null;

        foreach ($sales as &$sale) {
            if ($sale['id'] === $id) {
                $sale['client_email'] = $data['client_email'] ?? $sale['client_email'];
                $sale['client_name'] = $data['client_name'] ?? $sale['client_name'];
                $sale['product'] = $data['product'] ?? $sale['product'];
                $sale['amount'] = isset($data['amount']) ? floatval($data['amount']) : $sale['amount'];
                $sale['status'] = $data['status'] ?? $sale['status'];
                $sale['payment_method'] = $data['payment_method'] ?? $sale['payment_method'] ?? 'pago_online';
                $sale['notes'] = $data['notes'] ?? $sale['notes'];
                $sale['updated_at'] = date('Y-m-d H:i:s');
                $updated = true;
                $updatedSale = $sale;
                break;
            }
        }
        unset($sale);

        if ($updated) {
            file_put_contents($this->jsonFile, json_encode($sales, JSON_PRETTY_PRINT));

            // Intentar actualizar en MySQL
            try {
                $db = Database::connect();
                $sql = "UPDATE sales SET client_email=:client_email, client_name=:client_name, 
                        product=:product, amount=:amount, status=:status, payment_method=:payment_method, 
                        notes=:notes, updated_at=:updated_at WHERE id=:id";
                $stmt = $db->prepare($sql);
                $stmt->execute([
                    ':id' => $id,
                    ':client_email' => $updatedSale['client_email'],
                    ':client_name' => $updatedSale['client_name'],
                    ':product' => $updatedSale['product'],
                    ':amount' => $updatedSale['amount'],
                    ':status' => $updatedSale['status'],
                    ':payment_method' => $updatedSale['payment_method'],
                    ':notes' => $updatedSale['notes'],
                    ':updated_at' => $updatedSale['updated_at']
                ]);
            } catch (Exception $e) {
                // Ignorar errores
            }
        }

        return $updated;
    }

    /**
     * Elimina una venta
     * @param string $id
     * @return bool
     */
    public function delete($id)
    {
        $sales = json_decode(file_get_contents($this->jsonFile), true) ?? [];
        $newSales = [];
        $deleted = false;

        foreach ($sales as $sale) {
            if ($sale['id'] !== $id) {
                $newSales[] = $sale;
            } else {
                $deleted = true;
            }
        }

        if ($deleted) {
            file_put_contents($this->jsonFile, json_encode($newSales, JSON_PRETTY_PRINT));
        }

        return $deleted;
    }

    /**
     * Registra la acción de un cliente en la página de ventas
     * Tipos de acción: 'view_product', 'register_purchase', 'cancel_purchase'
     * @param string $email
     * @param string $action
     * @param string $product
     * @return void
     */
    public function logClientAction($email, $action, $product = '')
    {
        $auditModel = new AuditModel();
        
        $details = '';
        switch ($action) {
            case 'view_product':
                $details = "El cliente {$email} visualizó el producto: {$product}";
                break;
            case 'register_purchase':
                $details = "El cliente {$email} inició proceso de compra para: {$product}";
                break;
            case 'cancel_purchase':
                $details = "El cliente {$email} canceló la compra de: {$product}";
                break;
            default:
                $details = "Acción: {$action} - Producto: {$product}";
        }

        $auditModel->log('CLIENT_ACTION_' . strtoupper($action), $email, $details);
        
        // También guardamos en un log específico de ventas
        $this->updateClientActivity($email, $action, $product);
    }

    /**
     * Actualiza el contador de actividades del cliente
     * @param string $email
     * @param string $action
     * @param string $product
     */
    private function updateClientActivity($email, $action, $product)
    {
        $activityFile = DATA_PATH . '/client_activity.json';
        $activities = [];
        
        if (file_exists($activityFile)) {
            $activities = json_decode(file_get_contents($activityFile), true) ?? [];
        }

        $emailLower = strtolower($email);
        
        // Inicializar si no existe
        if (!isset($activities[$emailLower])) {
            $activities[$emailLower] = [
                'email' => $email,
                'view_count' => 0,
                'purchase_attempts' => 0,
                'cancelled_purchases' => 0,
                'last_activity' => date('Y-m-d H:i:s'),
                'products_viewed' => [],
                'products_purchased' => []
            ];
        }

        // Actualizar contadores
        switch ($action) {
            case 'view_product':
                $activities[$emailLower]['view_count']++;
                if (!in_array($product, $activities[$emailLower]['products_viewed'])) {
                    $activities[$emailLower]['products_viewed'][] = $product;
                }
                break;
            case 'register_purchase':
                $activities[$emailLower]['purchase_attempts']++;
                if (!in_array($product, $activities[$emailLower]['products_purchased'])) {
                    $activities[$emailLower]['products_purchased'][] = $product;
                }
                break;
            case 'cancel_purchase':
                $activities[$emailLower]['cancelled_purchases']++;
                break;
        }

        $activities[$emailLower]['last_activity'] = date('Y-m-d H:i:s');

        file_put_contents($activityFile, json_encode($activities, JSON_PRETTY_PRINT));
    }

    /**
     * Obtiene las actividades de un cliente
     * @param string $email
     * @return array|null
     */
    public function getClientActivity($email)
    {
        $activityFile = DATA_PATH . '/client_activity.json';
        
        if (!file_exists($activityFile)) {
            return null;
        }

        $activities = json_decode(file_get_contents($activityFile), true) ?? [];
        $emailLower = strtolower($email);

        return $activities[$emailLower] ?? null;
    }

    /**
     * Obtiene todas las actividades de clientes
     * @return array
     */
    public function getAllClientActivities()
    {
        $activityFile = DATA_PATH . '/client_activity.json';
        
        if (!file_exists($activityFile)) {
            return [];
        }

        return json_decode(file_get_contents($activityFile), true) ?? [];
    }

    /**
     * Obtiene estadísticas de ventas
     * @return array
     */
    public function getStats()
    {
        $sales = $this->getAll();
        $activities = $this->getAllClientActivities();

        $totalSales = count($sales);
        $completedSales = count(array_filter($sales, fn($s) => $s['status'] === 'completed'));
        $pendingSales = count(array_filter($sales, fn($s) => $s['status'] === 'pending'));
        $cancelledSales = count(array_filter($sales, fn($s) => $s['status'] === 'cancelled'));
        
        $totalRevenue = array_sum(array_map(fn($s) => floatval($s['amount']), $sales));
        
        //统计客户活动
        $totalClientViews = array_sum(array_map(fn($a) => $a['view_count'] ?? 0, $activities));
        $totalPurchaseAttempts = array_sum(array_map(fn($a) => $a['purchase_attempts'] ?? 0, $activities));
        $totalCancellations = array_sum(array_map(fn($a) => $a['cancelled_purchases'] ?? 0, $activities));
        
        // Identificar clientes potenciales (muchas vistas pero pocas compras)
        $potentialClients = [];
        foreach ($activities as $activity) {
            $views = $activity['view_count'] ?? 0;
            $purchases = $activity['purchase_attempts'] ?? 0;
            
            if ($views >= 3 && $purchases === 0) {
                $potentialClients[] = $activity;
            }
        }

        return [
            'total_sales' => $totalSales,
            'completed_sales' => $completedSales,
            'pending_sales' => $pendingSales,
            'cancelled_sales' => $cancelledSales,
            'total_revenue' => $totalRevenue,
            'total_client_views' => $totalClientViews,
            'total_purchase_attempts' => $totalPurchaseAttempts,
            'total_cancellations' => $totalCancellations,
            'potential_clients' => $potentialClients,
            'unique_clients' => count($activities)
        ];
    }
}
