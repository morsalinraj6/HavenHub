<?php include __DIR__ . '/../layouts/header.php'; ?>
<h2 class="fw-bold mb-4">Admin Dashboard</h2>
<div class="row g-4 mb-4">
    <div class="col-md-4"><div class="card border-0 shadow-sm rounded-4"><div class="card-body"><h6 class="text-muted">Total Revenue</h6><p class="display-6 fw-bold mb-0"><?= format_money($revenue); ?></p></div></div></div>
    <div class="col-md-4"><div class="card border-0 shadow-sm rounded-4"><div class="card-body"><h6 class="text-muted">Total Bookings</h6><p class="display-6 fw-bold mb-0"><?= count($bookings); ?></p></div></div></div>
    <div class="col-md-4"><div class="card border-0 shadow-sm rounded-4"><div class="card-body"><h6 class="text-muted">Total Room Groups</h6><p class="display-6 fw-bold mb-0"><?= count($statusCounts); ?></p></div></div></div>
</div>
<div class="row g-4">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body">
                <h4 class="fw-bold mb-3">Room Status Overview</h4>
                <?php foreach ($statusCounts as $status): ?>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span><?= htmlspecialchars($status['status']); ?></span>
                        <strong><?= (int)$status['total']; ?></strong>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-0">
                <div class="p-4 pb-2"><h4 class="fw-bold mb-0">Recent Bookings</h4></div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light"><tr><th>Guest</th><th>Room</th><th>Dates</th><th>Status</th></tr></thead>
                        <tbody>
                            <?php foreach (array_slice($bookings, 0, 8) as $booking): ?>
                            <tr>
                                <td><?= htmlspecialchars($booking['guest_name']); ?></td>
                                <td><?= htmlspecialchars($booking['room_number']); ?></td>
                                <td><?= htmlspecialchars($booking['check_in']); ?> to <?= htmlspecialchars($booking['check_out']); ?></td>
                                <td><span class="badge text-bg-secondary"><?= htmlspecialchars($booking['status']); ?></span></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
