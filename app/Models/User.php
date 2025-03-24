<?php
namespace App\Models;

use App\Config\Database;
use PDO;

class User
{
    private $connection;

    public function __construct()
    {
        $this->connection = (new Database())->connect();
    }

    public function register($firstName, $lastName, $email, $mobilePhone, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (first_name, last_name, email, mobile_phone, password) 
                VALUES (:first_name, :last_name, :email, :mobile_phone, :password)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':first_name', $firstName);
        $stmt->bindParam(':last_name', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mobile_phone', $mobilePhone);
        $stmt->bindParam(':password', $hashedPassword);
        return $stmt->execute();
    }

    public function login($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return null;
    }

    public function getAllEmails()
    {
        $stmt = $this->connection->query("SELECT email FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function isEmailExists($email)
    {
        $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $existingEmail = $stmt->fetchColumn();
        
        return $existingEmail > 0;
    }

    public function isMobilePhoneExists($mobilePhone)
    {
        $sql = "SELECT COUNT(*) FROM users WHERE mobile_phone = :mobile_phone";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':mobile_phone', $mobilePhone);
        $stmt->execute();
        $existingPhone = $stmt->fetchColumn();
        
        return $existingPhone > 0;
    }
}
