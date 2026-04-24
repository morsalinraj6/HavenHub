<?php
class DashboardController {
    private $bookingModel;
    private $serviceModel;
    private $paymentModel;
    private $roomModel;

    public function __construct($db) {
        $this->bookingModel = new Booking($db);
        $this->serviceModel = new Service($db);
        $this->paymentModel = new Payment($db);
        $this->roomModel = new Room($db);
    }

    public function index() {
        require_login();
        $user = current_user();

        if ($user['role'] === 'Admin') {
            $revenue = $this->bookingModel->totalRevenue();
            $statusCounts = $this->roomModel->statusCounts();
            $bookings = $this->bookingModel->getAll();
            include __DIR__ . '/../views/dashboard/admin.php';
            return;
        }

        if ($user['role'] === 'Staff') {
            $bookings = $this->bookingModel->getAll();
            include __DIR__ . '/../views/dashboard/staff.php';
            return;
        }

        $bookings = $this->bookingModel->getByUser($user['id']);
        include __DIR__ . '/../views/dashboard/guest.php';
    }
}
