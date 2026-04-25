<?php include __DIR__ . '/../layouts/header.php'; ?>
<h2 class="fw-bold mb-4">Guest Dashboard</h2>
<div class="row g-4 mb-4">
    <div class="col-md-4"><div class="card border-0 shadow-sm rounded-4"><div class="card-body"><h5>Total Bookings</h5><p class="display-6 fw-bold mb-0"><?= count($bookings); ?></p></div></div></div>
    <div class="col-md-4"><div class="card border-0 shadow-sm rounded-4"><div class="card-body"><h5>Current User</h5><p class="display-6 fw-bold mb-0"><?= htmlspecialchars(current_user()['name']); ?></p></div></div></div>
    <div class="col-md-4"><div class="card border-0 shadow-sm rounded-4"><div class="card-body"><h5>Role</h5><p class="display-6 fw-bold mb-0"><?= htmlspecialchars(current_user()['role']); ?></p></div></div></div>
</div>
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 pt-4 px-4"><h4 class="fw-bold mb-0">Booking History</h4></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light"><tr><th>Room</th><th>Dates</th><th>Nights</th><th>Status</th><th>Invoice</th></tr></thead>
                <tbody>
                    <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?= htmlspecialchars($booking['room_number']); ?> (<?= htmlspecialchars($booking['category']); ?>)</td>
                        <td><?= htmlspecialchars($booking['check_in']); ?> to <?= htmlspecialchars($booking['check_out']); ?></td>
                        <td><?= (int)$booking['total_nights']; ?></td>
                        <td><span class="badge text-bg-secondary"><?= htmlspecialchars($booking['status']); ?></span></td>
                        <td><a href="<?= BASE_URL; ?>/invoice?id=<?= $booking['id']; ?>" class="btn btn-outline-dark btn-sm">View Bill</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
