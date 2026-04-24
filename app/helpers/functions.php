<?php
function sanitize($value) {
    return htmlspecialchars(trim((string)$value), ENT_QUOTES, 'UTF-8');
}

function redirect($path) {
    header('Location: ' . BASE_URL . '/' . ltrim($path, '/'));
    exit;
}

function set_flash($type, $message) {
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function get_flash() {
    if (!empty($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}

function is_logged_in() {
    return !empty($_SESSION['user']);
}

function current_user() {
    return $_SESSION['user'] ?? null;
}

function require_login() {
    if (!is_logged_in()) {
        set_flash('danger', 'Please login first.');
        redirect('auth/login');
    }
}

function require_role($roles) {
    require_login();
    $roles = (array)$roles;
    $user = current_user();
    if (!$user || !in_array($user['role'], $roles, true)) {
        http_response_code(403);
        include __DIR__ . '/../views/errors/403.php';
        exit;
    }
}

function old($key, $default='') {
    return $_SESSION['old'][$key] ?? $default;
}

function save_old_input($data) {
    $_SESSION['old'] = $data;
}

function clear_old_input() {
    unset($_SESSION['old']);
}

function is_room_available($pdo, $roomId, $checkIn, $checkOut, $excludeBookingId = null) {
    $sql = "SELECT COUNT(*) AS total FROM bookings
            WHERE room_id = :room_id
            AND status IN ('Pending', 'Confirmed', 'Checked-In')
            AND NOT (check_out <= :check_in OR check_in >= :check_out)";
    if ($excludeBookingId) {
        $sql .= " AND id != :exclude_id";
    }
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':room_id', $roomId, PDO::PARAM_INT);
    $stmt->bindValue(':check_in', $checkIn);
    $stmt->bindValue(':check_out', $checkOut);
    if ($excludeBookingId) {
        $stmt->bindValue(':exclude_id', $excludeBookingId, PDO::PARAM_INT);
    }
    $stmt->execute();
    $row = $stmt->fetch();
    return (int)$row['total'] === 0;
}

function booking_nights($checkIn, $checkOut) {
    $in = new DateTime($checkIn);
    $out = new DateTime($checkOut);
    return max(1, (int)$in->diff($out)->days);
}

function format_money($amount) {
    return '$' . number_format((float)$amount, 2);
}
