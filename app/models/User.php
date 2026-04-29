<?php

class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Create new user
    public function create($name, $email, $password, $role = 'Guest') {
        $sql = "INSERT INTO users (name, email, password, role) 
                VALUES (:name, :email, :password, :role)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':role' => $role,
        ]);
    }

    // Find user by email for login
    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    // Find user by id for profile
    public function findById($id) {
        $stmt = $this->db->prepare("SELECT id, name, email, role, created_at FROM users WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // Update profile information
    public function updateProfile($id, $name, $email) {
        $sql = "UPDATE users 
                SET name = :name, email = :email 
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':id' => $id
        ]);
    }

    // Update user password
    public function updatePassword($id, $password) {
        $sql = "UPDATE users 
                SET password = :password 
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':id' => $id
        ]);
    }
}