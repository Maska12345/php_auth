<?php
namespace App\Controllers;

use App\Models\User;

class HomeController
{
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit(); 
        }
        $userModel = new User();
        $emails = $userModel->getAllEmails();
        ob_start();
        require_once __DIR__ . '/../Views/home.php';
        $content = ob_get_clean();
        require_once __DIR__ . '/../Views/layout.php';
    }
}
