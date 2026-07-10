<?php
namespace App\Models;

class AnalyticsModel extends BaseModel {
    public function __construct() {
        parent::__construct(__DIR__ . '/../../analytics.json');
    }

    public function add($data) {
        $analytics = $this->readData();
        
        $newEntry = [
            'id' => uniqid(),
            'timestamp' => date('Y-m-d H:i:s'),
            'page' => $data['page'] ?? '',
            'action' => $data['action'] ?? '',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
            'ip' => $_SERVER['REMOTE_ADDR'] ?? '',
            'referrer' => $_SERVER['HTTP_REFERER'] ?? '',
            'data' => $data['data'] ?? []
        ];
        
        $analytics[] = $newEntry;
        return $this->writeData($analytics);
    }

    public function getStats() {
        $analytics = $this->readData();
        
        $stats = [
            'total_visits' => count($analytics),
            'unique_pages' => [],
            'actions' => [],
            'daily_visits' => [],
            'hourly_visits' => []
        ];
        
        foreach ($analytics as $entry) {
            // Count unique pages
            $page = $entry['page'] ?? 'unknown';
            if (!isset($stats['unique_pages'][$page])) {
                $stats['unique_pages'][$page] = 0;
            }
            $stats['unique_pages'][$page]++;
            
            // Count actions
            $action = $entry['action'] ?? 'view';
            if (!isset($stats['actions'][$action])) {
                $stats['actions'][$action] = 0;
            }
            $stats['actions'][$action]++;
            
            // Daily visits
            $date = substr($entry['timestamp'] ?? '', 0, 10);
            if (!isset($stats['daily_visits'][$date])) {
                $stats['daily_visits'][$date] = 0;
            }
            $stats['daily_visits'][$date]++;
            
            // Hourly visits
            $hour = substr($entry['timestamp'] ?? '', 11, 2);
            if (!isset($stats['hourly_visits'][$hour])) {
                $stats['hourly_visits'][$hour] = 0;
            }
            $stats['hourly_visits'][$hour]++;
        }
        
        // Sort daily visits by date
        ksort($stats['daily_visits']);
        
        // Sort hourly visits by hour
        ksort($stats['hourly_visits']);
        
        return $stats;
    }

    public function getPaginated($page = 1, $perPage = 50) {
        $analytics = $this->readData();
        
        // Reverse to show newest first
        $analytics = array_reverse($analytics);
        
        $total = count($analytics);
        $offset = ($page - 1) * $perPage;
        
        $pagedData = array_slice($analytics, $offset, $perPage);
        
        return [
            'data' => $pagedData,
            'total' => $total,
            'page' => $page,
            'per_page' => $perPage,
            'total_pages' => ceil($total / $perPage)
        ];
    }

    public function clear() {
        return $this->writeData([]);
    }
}
