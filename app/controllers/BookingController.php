<?php
class BookingController {
    private $db;
    private $roomModel;
    private $bookingModel;
    private $paymentModel;
    private $serviceModel;

    public function __construct($db) {
        $this->db = $db;
        $this->roomModel = new Room($db);
        $this->bookingModel = new Booking($db);
        $this->paymentModel = new Payment($db);
        $this->serviceModel = new Service($db);
    }

    public function create() {
        require_role(['Guest']);
        $roomId = (int)($_GET['room_id'] ?? $_POST['room_id'] ?? 0);
        $room = $this->roomModel->find($roomId);
        if (!$room) {
            set_flash('danger', 'Room not found.');
            redirect('rooms');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $checkIn = $_POST['check_in'] ?? '';
            $checkOut = $_POST['check_out'] ?? '';
            $guests = max(1, (int)($_POST['guests'] ?? 1));
            if (!$checkIn || !$checkOut || $checkIn >= $checkOut) {
                save_old_input($_POST);
                set_flash('danger', 'Please select a valid date range.');
                redirect('booking/create?room_id=' . $roomId);
            }

            if (!is_room_available($this->db, $roomId, $checkIn, $checkOut)) {
                save_old_input($_POST);
                set_flash('danger', 'This room is not available for the selected dates.');
                redirect('booking/create?room_id=' . $roomId);
            }

            $nights = booking_nights($checkIn, $checkOut);
            $bookingId = $this->bookingModel->create([
                ':user_id' => current_user()['id'],
                ':room_id' => $roomId,
                ':check_in' => $checkIn,
                ':check_out' => $checkOut,
                ':guests' => $guests,
                ':total_nights' => $nights,
                ':status' => 'Pending',
            ]);
            $total = $nights * $room['price'];
            $this->paymentModel->upsert($bookingId, $total);
            clear_old_input();
            set_flash('success', 'Booking created successfully.');
            redirect('dashboard');
        }

        include __DIR__ . '/../views/bookings/create.php';
    }

    public function manage() {
        require_role(['Admin', 'Staff']);
        $bookings = $this->bookingModel->getAll();
        include __DIR__ . '/../views/bookings/manage.php';
    }

    public function updateStatus() {
        require_role(['Admin', 'Staff']);
        $id = (int)($_POST['booking_id'] ?? 0);
        $status = $_POST['status'] ?? '';
        $allowed = ['Pending', 'Confirmed', 'Checked-In', 'Checked-Out', 'Cancelled'];
        if ($id && in_array($status, $allowed, true)) {
            $this->bookingModel->updateStatus($id, $status);
            set_flash('success', 'Booking status updated.');
        } else {
            set_flash('danger', 'Invalid booking status request.');
        }
        redirect('bookings/manage');
    }

    public function invoice($id) {
        require_login();
        $booking = $this->bookingModel->find((int)$id);
        if (!$booking) {
            http_response_code(404);
            include __DIR__ . '/../views/errors/404.php';
            return;
        }
        $user = current_user();
        if ($user['role'] === 'Guest' && (int)$booking['user_id'] !== (int)$user['id']) {
            http_response_code(403);
            include __DIR__ . '/../views/errors/403.php';
            return;
        }
        $services = $this->serviceModel->getByBooking($id);
        $payment = $this->paymentModel->getByBooking($id);
        include __DIR__ . '/../views/bookings/invoice.php';
    }
}
