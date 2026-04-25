<?php include __DIR__ . '/../layouts/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Manage Bookings</h2>
        <p class="text-muted mb-0">Update reservation progress and review guest bookings.</p>
    </div>
</div>
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark"><tr><th>ID</th><th>Guest</th><th>Room</th><th>Dates</th><th>Status</th><th>Invoice</th><th>Action</th></tr></thead>
                <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td>#<?= $booking['id']; ?></td>
                        <td><?= htmlspecialchars($booking['guest_name']); ?><br><small class="text-muted"><?= htmlspecialchars($booking['email']); ?></small></td>
                        <td><?= htmlspecialchars($booking['room_number']); ?> (<?= htmlspecialchars($booking['category']); ?>)</td>
                        <td><?= htmlspecialchars($booking['check_in']); ?><br>to <?= htmlspecialchars($booking['check_out']); ?></td>
                        <td><span class="badge text-bg-secondary"><?= htmlspecialchars($booking['status']); ?></span></td>
                        <td><a href="<?= BASE_URL; ?>/invoice?id=<?= $booking['id']; ?>" class="btn btn-outline-dark btn-sm">Invoice</a></td>
                        <td>
                            <form method="POST" action="<?= BASE_URL; ?>/booking/status" class="d-flex gap-2">
                                <input type="hidden" name="booking_id" value="<?= $booking['id']; ?>">
                                <select name="status" class="form-select form-select-sm">
                                    <?php foreach (['Pending', 'Confirmed', 'Checked-In', 'Checked-Out', 'Cancelled'] as $status): ?>
                                        <option value="<?= $status; ?>" <?= $booking['status'] === $status ? 'selected' : ''; ?>><?= $status; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <button class="btn btn-warning btn-sm">Save</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
