<?php

class RoomController {
    private $roomModel;

    public function __construct($db) {
        $this->roomModel = new Room($db);
    }

    // Admin room page
    public function admin() {
        require_role(['Admin']);
        $rooms = $this->roomModel->getAll();
        include __DIR__ . '/../views/rooms/admin.php';
    }

    // Save (Add + Update)
    public function save() {
        require_role(['Admin']);

        // Proper id check (very important fix)
        $rawId = trim($_POST['id'] ?? '');
        $id = ($rawId !== '' && ctype_digit($rawId)) ? (int)$rawId : 0;

        // Collect form data
        $data = [
            ':room_number' => sanitize($_POST['room_number'] ?? ''),
            ':type' => sanitize($_POST['type'] ?? 'AC'),
            ':category' => sanitize($_POST['category'] ?? 'Deluxe'),
            ':price' => (float)($_POST['price'] ?? 0),
            ':status' => sanitize($_POST['status'] ?? 'Available'),
            ':image' => sanitize($_POST['image'] ?? 'https://images.unsplash.com/photo-1566073771259-6a8506099945?q=80&w=1200&auto=format&fit=crop'),
        ];

        // Validation
        if ($data[':room_number'] === '' || $data[':price'] <= 0) {
            set_flash('danger', 'Please provide valid room information.');
            redirect('admin/rooms');
        }

        // UPDATE
        if ($id > 0) {
            $result = $this->roomModel->update($id, $data);

            if ($result) {
                set_flash('success', 'Room updated successfully.');
            } else {
                set_flash('danger', 'Room update failed.');
            }
        }

        // INSERT
        else {
            $result = $this->roomModel->create($data);

            if ($result) {
                set_flash('success', 'Room added successfully.');
            } else {
                set_flash('danger', 'Room add failed.');
            }
        }

        redirect('admin/rooms');
    }

    // Delete room
    public function delete() {
        require_role(['Admin']);

        $id = (int)($_POST['id'] ?? 0);

        if ($id > 0) {
            $result = $this->roomModel->delete($id);

            if ($result) {
                set_flash('success', 'Room deleted successfully.');
            } else {
                set_flash('danger', 'Room delete failed.');
            }
        }

        redirect('admin/rooms');
    }
}