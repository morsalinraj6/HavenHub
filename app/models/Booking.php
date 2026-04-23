<?php
class Booking {
    private $db;
    public function __construct($db) { $this->db = $db; }

    public function create($data) {
        $sql = "INSERT INTO bookings (user_id, room_id, check_in, check_out, guests, total_nights, status)
                VALUES (:user_id, :room_id, :check_in, :check_out, :guests, :total_nights, :status)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
        return $this->db->lastInsertId();
    }

    public function getByUser($userId) {
        $sql = "SELECT b.*, r.room_number, r.type, r.category, r.price
                FROM bookings b
                JOIN rooms r ON r.id = b.room_id
                WHERE b.user_id = :user_id
                ORDER BY b.id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function getAll() {
        $sql = "SELECT b.*, u.name AS guest_name, u.email, r.room_number, r.category, r.price
                FROM bookings b
                JOIN users u ON u.id = b.user_id
                JOIN rooms r ON r.id = b.room_id
                ORDER BY b.id DESC";
        return $this->db->query($sql)->fetchAll();
    }

    public function find($id) {
        $sql = "SELECT b.*, u.name AS guest_name, u.email, r.room_number, r.type, r.category, r.price
                FROM bookings b
                JOIN users u ON u.id = b.user_id
                JOIN rooms r ON r.id = b.room_id
                WHERE b.id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function updateStatus($id, $status) {
        $stmt = $this->db->prepare("UPDATE bookings SET status = :status WHERE id = :id");
        return $stmt->execute([':status' => $status, ':id' => $id]);
    }

    public function totalRevenue() {
        $sql = "SELECT COALESCE(SUM(p.total_amount), 0) AS revenue FROM payments p";
        return $this->db->query($sql)->fetch()['revenue'];
    }
}
