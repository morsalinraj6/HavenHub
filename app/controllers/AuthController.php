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

    public function logout() {
        session_unset();
        session_destroy();
        session_start();
        set_flash('success', 'Logged out successfully.');
        redirect('auth/login');
    }
}
