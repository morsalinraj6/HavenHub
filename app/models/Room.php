<?php
class Room {
    private $db;
    public function __construct($db) { $this->db = $db; }

    public function getAll() {
        return $this->db->query("SELECT * FROM rooms ORDER BY id DESC")->fetchAll();
    }

    public function getAvailableSearch($checkIn, $checkOut) {
        $sql = "SELECT * FROM rooms r
                WHERE r.status = 'Available'
                AND r.id NOT IN (
                    SELECT b.room_id FROM bookings b
                    WHERE b.status IN ('Pending', 'Confirmed', 'Checked-In')
                    AND NOT (b.check_out <= :check_in OR b.check_in >= :check_out)
                )
                ORDER BY r.price ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':check_in' => $checkIn, ':check_out' => $checkOut]);
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM rooms WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $sql = "INSERT INTO rooms (room_number, type, category, price, status, image)
                VALUES (:room_number, :type, :category, :price, :status, :image)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($id, $data) {
        $data[':id'] = $id;
        $sql = "UPDATE rooms SET room_number = :room_number, type = :type, category = :category,
                price = :price, status = :status, image = :image WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM rooms WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function statusCounts() {
        return $this->db->query("SELECT status, COUNT(*) AS total FROM rooms GROUP BY status")->fetchAll();
    }
}
