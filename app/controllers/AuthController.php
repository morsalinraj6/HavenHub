<?php

class AuthController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new User($db);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = $_POST['password'] ?? '';

            if (!$email || !$password) {
                save_old_input($_POST);
                set_flash('danger', 'Please provide valid login credentials.');
                redirect('auth/login');
            }

            $user = $this->userModel->findByEmail($email);

            if (!$user || !password_verify($password, $user['password'])) {
                save_old_input($_POST);
                set_flash('danger', 'Invalid email or password.');
                redirect('auth/login');
            }

            unset($user['password']);
            $_SESSION['user'] = $user;

            clear_old_input();
            set_flash('success', 'Welcome back, ' . $user['name'] . '!');
            redirect('dashboard');
        }

        include __DIR__ . '/../views/auth/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = sanitize($_POST['name'] ?? '');
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = $_POST['password'] ?? '';
            $confirm = $_POST['confirm_password'] ?? '';
            $role = in_array($_POST['role'] ?? 'Guest', ['Guest', 'Staff', 'Admin'], true) ? $_POST['role'] : 'Guest';

            if (!$name || !$email || strlen($password) < 6 || $password !== $confirm) {
                save_old_input($_POST);
                set_flash('danger', 'Please complete the form correctly. Password must be at least 6 characters.');
                redirect('auth/register');
            }

            if ($this->userModel->findByEmail($email)) {
                save_old_input($_POST);
                set_flash('danger', 'Email already exists.');
                redirect('auth/register');
            }

            $this->userModel->create($name, $email, $password, $role);

            clear_old_input();
            set_flash('success', 'Registration successful. Please login.');
            redirect('auth/login');
        }

        include __DIR__ . '/../views/auth/register.php';
    }

    public function profile() {
        require_login();

        $userId = $_SESSION['user']['id'];
        $user = $this->userModel->findById($userId);

        if (!$user) {
            set_flash('danger', 'User profile not found.');
            redirect('dashboard');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = sanitize($_POST['name'] ?? '');
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $newPassword = $_POST['new_password'] ?? '';

            if (!$name || !$email) {
                set_flash('danger', 'Name and valid email are required.');
                redirect('profile');
            }

            $existingUser = $this->userModel->findByEmail($email);

            if ($existingUser && $existingUser['id'] != $userId) {
                set_flash('danger', 'This email is already used by another account.');
                redirect('profile');
            }

            $this->userModel->updateProfile($userId, $name, $email);

            if (!empty($newPassword)) {
                if (strlen($newPassword) < 6) {
                    set_flash('danger', 'Password must be at least 6 characters.');
                    redirect('profile');
                }

                $this->userModel->updatePassword($userId, $newPassword);
            }

            $_SESSION['user']['name'] = $name;
            $_SESSION['user']['email'] = $email;

            set_flash('success', 'Profile updated successfully.');
            redirect('profile');
        }

        include __DIR__ . '/../views/auth/profile.php';
    }

    public function logout() {
        session_unset();
        session_destroy();
        session_start();

        set_flash('success', 'Logged out successfully.');
        redirect('auth/login');
    }
}