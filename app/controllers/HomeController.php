<?php
class HomeController {
    private $roomModel;
    public function __construct($db) {
        $this->roomModel = new Room($db);
    }

    public function index() {
        $rooms = array_slice($this->roomModel->getAll(), 0, 6);
        include __DIR__ . '/../views/home/index.php';
    }

    public function rooms() {
        $rooms = $this->roomModel->getAll();
        include __DIR__ . '/../views/rooms/list.php';
    }

    public function roomDetails($id) {
        $room = $this->roomModel->find($id);
        if (!$room) {
            http_response_code(404);
            include __DIR__ . '/../views/errors/404.php';
            return;
        }
        include __DIR__ . '/../views/rooms/details.php';
    }

    public function search() {
        $checkIn = $_GET['check_in'] ?? '';
        $checkOut = $_GET['check_out'] ?? '';
        $rooms = [];
        $error = null;
        if ($checkIn && $checkOut) {
            if ($checkIn >= $checkOut) {
                $error = 'Check-out must be after check-in.';
            } else {
                $rooms = $this->roomModel->getAvailableSearch($checkIn, $checkOut);
            }
        }
        include __DIR__ . '/../views/rooms/search.php';
    }
}
