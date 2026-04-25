<?php include __DIR__ . '/../layouts/header.php'; ?>
<h2 class="fw-bold mb-4">Staff Dashboard</h2>
<div class="row g-4">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0 pt-4 px-4"><h4 class="fw-bold mb-0">Bookings</h4></div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light"><tr><th>ID</th><th>Guest</th><th>Room</th><th>Status</th><th>Invoice</th></tr></thead>
                        <tbody>
                            <?php foreach ($bookings as $booking): ?>
                            <tr>
                                <td>#<?= $booking['id']; ?></td>
                                <td><?= htmlspecialchars($booking['guest_name']); ?></td>
                                <td><?= htmlspecialchars($booking['room_number']); ?></td>
                                <td><?= htmlspecialchars($booking['status']); ?></td>
                                <td><a href="<?= BASE_URL; ?>/invoice?id=<?= $booking['id']; ?>" class="btn btn-outline-dark btn-sm">Open</a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <h4 class="fw-bold mb-3">Add Extra Service</h4>
                <form method="POST" action="<?= BASE_URL; ?>/services/add" class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Booking</label>
                        <select name="booking_id" class="form-select" required>
                            <option value="">Select booking</option>
                            <?php foreach ($bookings as $booking): ?>
                                <option value="<?= $booking['id']; ?>">#<?= $booking['id']; ?> - <?= htmlspecialchars($booking['guest_name']); ?> - Room <?= htmlspecialchars($booking['room_number']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Service Name</label>
                        <input type="text" name="service_name" class="form-control" placeholder="Food / Laundry / Airport Pickup" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Cost</label>
                        <input type="number" name="cost" min="1" step="0.01" class="form-control" required>
                    </div>
                    <div class="col-12 d-grid"><button class="btn btn-warning">Add Service</button></div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
