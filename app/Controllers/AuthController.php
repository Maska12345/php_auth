<?php
namespace App\Controllers;

use App\Models\User;

class AuthController
{
    public function showRegisterForm()
    {
        ob_start(); 
        require_once __DIR__ . '/../Views/register.php';
        $content = ob_get_clean();
        require_once __DIR__ . '/../Views/layout.php';
    }

    public function register()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $mobile_phone = $_POST['mobile_phone'];
            $password = $_POST['password'];

            $userModel = new User();

            if ($userModel->isEmailExists($email)) {
                $error = "This email is already registered.";
            } elseif ($userModel->isMobilePhoneExists($mobile_phone)) {
                $error = "This mobile phone number is already registered.";
            } else {
                if ($userModel->register($first_name, $last_name, $email, $mobile_phone, $password)) {
                    $_SESSION['user'] = ['email' => $email]; 
        
                    header('Location: /');
                    exit();
                }
            }
        }

        ob_start();
        require_once __DIR__ . '/../Views/register.php';
        $content = ob_get_clean();
        require_once __DIR__ . '/../Views/layout.php';
    }

    public function showLoginForm()
    {
        ob_start();
        require_once __DIR__ . '/../Views/login.php';
        $content = ob_get_clean();
        require_once __DIR__ . '/../Views/layout.php';
    }

    public function login()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $userModel = new User();
            
            $user = $userModel->login($email, $password);

            if ($user) {
                $_SESSION['user'] = ['email' => $user['email']];
                header('Location: /');
                exit();
            } else {
                $error = "Incorrect email or password. Please try again.";
            }
        }

        ob_start();
        require_once __DIR__ . '/../Views/login.php';
        $content = ob_get_clean();
        require_once __DIR__ . '/../Views/layout.php';
    }

    public function logout()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();  
        header('Location: /login');  
        exit();
    }
}
