<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\AnalyticsModel;

class ApiDashboardController extends Controller {
    private $model;

    public function __construct() {
        require_once __DIR__ . '/../Models/BaseModel.php';
        require_once __DIR__ . '/../Models/AnalyticsModel.php';
        $this->model = new AnalyticsModel();
    }

    public function index() {
        // GET /api/dashboard/stats - Get analytics statistics
        $stats = $this->model->getStats();
        $this->json(['ok' => true, 'data' => $stats]);
    }

    public function data() {
        // GET /api/dashboard/data - Get paginated analytics data
        $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $perPage = isset($_GET['per_page']) ? max(10, min(100, intval($_GET['per_page']))) : 50;
        
        $result = $this->model->getPaginated($page, $perPage);
        $this->json(['ok' => true, 'data' => $result]);
    }

    public function track() {
        // POST /api/dashboard/track - Track analytics event
        $body = $this->getJsonBody();
        
        $result = $this->model->add($body);
        if ($result) {
            $this->json(['ok' => true, 'message' => 'Analytics tracked']);
        } else {
            $this->json(['ok' => false, 'error' => 'Failed to track analytics'], 500);
        }
    }

    public function clear() {
        // POST /api/dashboard/clear - Clear all analytics data
        $result = $this->model->clear();
        if ($result) {
            $this->json(['ok' => true, 'message' => 'Analytics cleared']);
        } else {
            $this->json(['ok' => false, 'error' => 'Failed to clear analytics'], 500);
        }
    }
}
