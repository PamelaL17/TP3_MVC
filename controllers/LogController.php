<?php

namespace App\Controllers;

use App\Models\Log;
use App\Providers\View;
use App\Providers\Auth;

class LogController
{
    public function __construct()
    {
        Auth::session();
        Auth::privilege(1); // Accessible uniquement aux administrateurs
    }

    public function index()
    {
        $log = new Log();
        $logs = $log->select('visit_date', 'DESC');
        return View::render('logs/index', ['logs' => $logs]);
    }

    public function store($data)
    {
        $log = new Log();
        $logData = [
            'user_id' => $_SESSION['user_id'] ?? null,
            'username' => $_SESSION['user_name'] ?? 'Visitor',
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'visited_page' => $data['visited_page'],
        ];
        $log->insert($logData);
    }
}