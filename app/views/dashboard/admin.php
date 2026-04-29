<?php include __DIR__ . '/../layouts/header.php'; ?>

<h2 class="fw-bold mb-4">Admin Dashboard</h2>

<!-- 🔥 STATS CARDS -->
<div class="row g-4 mb-4">

    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 text-center p-4">
            <i class="bi bi-currency-dollar fs-2 text-success mb-2"></i>
            <h6 class="text-muted">Total Revenue</h6>
            <h2 class="fw-bold"><?= format_money($revenue); ?></h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 text-center p-4">
            <i class="bi bi-calendar-check fs-2 text-primary mb-2"></i>
            <h6 class="text-muted">Total Bookings</h6>
            <h2 class="fw-bold"><?= count($bookings); ?></h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 text-center p-4">
            <i class="bi bi-door-open fs-2 text-warning mb-2"></i>
            <h6 class="text-muted">Room Categories</h6>
            <h2 class="fw-bold"><?= count($statusCounts); ?></h2>
        </div>
    </div>

</div>

<div class="row g-4">

    <!-- 🔥 ROOM STATUS -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Room Status Overview</h5>

                <?php foreach ($statusCounts as $status): ?>

                    <?php
                        $color = $status['status'] === 'Available' ? 'success' :
                                 ($status['status'] === 'Occupied' ? 'danger' : 'warning');
                    ?>

                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <span><?= htmlspecialchars($status['status']); ?></span>

                        <span class="badge bg-<?= $color; ?> px-3 py-2 rounded-pill">
                            <?= (int)$status['total']; ?>
                        </span>
                    </div>

                <?php endforeach; ?>

            </div>
        </div>
    </div>

    <!-- 🔥 RECENT BOOKINGS -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm h-100">

            <div class="card-body p-0">

                <div class="p-4 pb-2">
                    <h5 class="fw-bold mb-0">Recent Bookings</h5>
                </div>

                <div class="table-responsive">

                    <table class="table align-middle mb-0">

                        <thead class="table-light">
                            <tr>
                                <th>Guest</th>
                                <th>Room</th>
                                <th>Dates</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                        <?php foreach (array_slice($bookings, 0, 8) as $booking): ?>

                            <?php
                                $statusColor = $booking['status'] === 'Confirmed' ? 'success' :
                                               ($booking['status'] === 'Pending' ? 'warning' : 'secondary');
                            ?>

                            <tr>
                                <td><?= htmlspecialchars($booking['guest_name']); ?></td>

                                <td>
                                    <span class="fw-semibold">
                                        <?= htmlspecialchars($booking['room_number']); ?>
                                    </span>
                                </td>

                                <td>
                                    <small>
                                        <?= htmlspecialchars($booking['check_in']); ?><br>
                                        → <?= htmlspecialchars($booking['check_out']); ?>
                                    </small>
                                </td>

                                <td>
                                    <span class="badge bg-<?= $statusColor; ?> px-3 py-2 rounded-pill">
                                        <?= htmlspecialchars($booking['status']); ?>
                                    </span>
                                </td>
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