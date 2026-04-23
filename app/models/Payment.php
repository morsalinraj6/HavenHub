<?php
class Payment {
    private $db;
    public function __construct($db) { $this->db = $db; }

    public function upsert($bookingId, $totalAmount) {
        $stmt = $this->db->prepare("SELECT id FROM payments WHERE booking_id = :booking_id LIMIT 1");
        $stmt->execute([':booking_id' => $bookingId]);
        $existing = $stmt->fetch();

        if ($existing) {
            $update = $this->db->prepare("UPDATE payments SET total_amount = :total_amount WHERE booking_id = :booking_id");
            return $update->execute([':total_amount' => $totalAmount, ':booking_id' => $bookingId]);
        }

        $insert = $this->db->prepare("INSERT INTO payments (booking_id, total_amount) VALUES (:booking_id, :total_amount)");
        return $insert->execute([':booking_id' => $bookingId, ':total_amount' => $totalAmount]);
    }

    public function getByBooking($bookingId) {
        $stmt = $this->db->prepare("SELECT * FROM payments WHERE booking_id = :booking_id LIMIT 1");
        $stmt->execute([':booking_id' => $bookingId]);
        return $stmt->fetch();
    }
}
