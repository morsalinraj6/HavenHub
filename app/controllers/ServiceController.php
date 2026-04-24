<?php
class ServiceController {
    private $bookingModel;
    private $serviceModel;
    private $paymentModel;

    public function __construct($db) {
        $this->bookingModel = new Booking($db);
        $this->serviceModel = new Service($db);
        $this->paymentModel = new Payment($db);
    }

    public function add() {
        require_role(['Staff']);
        $bookingId = (int)($_POST['booking_id'] ?? 0);
        $serviceName = sanitize($_POST['service_name'] ?? '');
        $cost = (float)($_POST['cost'] ?? 0);
        if (!$bookingId || !$serviceName || $cost <= 0) {
            set_flash('danger', 'Please provide valid service data.');
            redirect('dashboard');
        }

        $booking = $this->bookingModel->find($bookingId);
        if (!$booking) {
            set_flash('danger', 'Booking not found.');
            redirect('dashboard');
        }

        $this->serviceModel->add($bookingId, $serviceName, $cost);
        $roomTotal = $booking['price'] * $booking['total_nights'];
        $serviceTotal = $this->serviceModel->totalByBooking($bookingId);
        $this->paymentModel->upsert($bookingId, $roomTotal + $serviceTotal);
        set_flash('success', 'Service added and invoice updated.');
        redirect('dashboard');
    }
}
