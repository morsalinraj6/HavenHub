<?php
class Service {
    private $db;
    public function __construct($db) { $this->db = $db; }

    public function add($bookingId, $serviceName, $cost) {
        $stmt = $this->db->prepare("INSERT INTO services (booking_id, service_name, cost) VALUES (:booking_id, :service_name, :cost)");
        return $stmt->execute([
            ':booking_id' => $bookingId,
            ':service_name' => $serviceName,
            ':cost' => $cost,
        ]);
    }

    public function getByBooking($bookingId) {
        $stmt = $this->db->prepare("SELECT * FROM services WHERE booking_id = :booking_id ORDER BY id DESC");
        $stmt->execute([':booking_id' => $bookingId]);
        return $stmt->fetchAll();
    }

    public function totalByBooking($bookingId) {
        $stmt = $this->db->prepare("SELECT COALESCE(SUM(cost), 0) AS total FROM services WHERE booking_id = :booking_id");
        $stmt->execute([':booking_id' => $bookingId]);
        return $stmt->fetch()['total'];
    }
}
