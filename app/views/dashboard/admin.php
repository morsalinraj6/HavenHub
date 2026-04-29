<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="row g-4">

    <!-- Sidebar -->
    <div class="col-lg-3">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">
                <h5 class="fw-bold mb-4">Admin Panel</h5>

                <div class="list-group list-group-flush">
                    <a href="<?= BASE_URL; ?>/dashboard" class="list-group-item list-group-item-action active">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>

                    <a href="<?= BASE_URL; ?>/admin/rooms" class="list-group-item list-group-item-action">
                        <i class="bi bi-door-open me-2"></i> Manage Rooms
                    </a>

                    <a href="<?= BASE_URL; ?>/bookings/manage" class="list-group-item list-group-item-action">
                        <i class="bi bi-calendar-check me-2"></i> Bookings
                    </a>

                    <a href="<?= BASE_URL; ?>/logout" class="list-group-item list-group-item-action text-danger">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Dashboard -->
    <div class="col-lg-9">

        <h2 class="fw-bold mb-4">Admin Dashboard</h2>

        <!-- Stats -->
        <div class="row g-4 mb-4">

            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 text-center p-4">
                    <i class="bi bi-cash-stack fs-2 text-success mb-2"></i>
                    <h6 class="text-muted">Total Revenue</h6>
                    <h2 class="fw-bold"><?= format_money($revenue); ?></h2>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 text-center p-4">
                    <i class="bi bi-calendar-check fs-2 text-primary mb-2"></i>
                    <h6 class="text-muted">Total Bookings</h6>
                    <h2 class="fw-bold"><?= count($bookings); ?></h2>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 text-center p-4">
                    <i class="bi bi-building fs-2 text-warning mb-2"></i>
                    <h6 class="text-muted">Room Groups</h6>
                    <h2 class="fw-bold"><?= count($statusCounts); ?></h2>
                </div>
            </div>

        </div>

        <div class="row g-4">

            <!-- Room Status -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Room Status Overview</h5>

                        <?php foreach ($statusCounts as $status): ?>
                            <?php
                                $color = $status['status'] === 'Available' ? 'success' :
                                        ($status['status'] === 'Occupied' ? 'danger' : 'warning');
                            ?>

                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                <span><?= htmlspecialchars($status['status']); ?></span>
                                <span class="badge bg-<?= $color; ?> rounded-pill px-3 py-2">
                                    <?= (int)$status['total']; ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Recent Bookings -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 h-100">
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
                                            <td><?= htmlspecialchars($booking['room_number']); ?></td>
                                            <td>
                                                <span class="badge bg-<?= $statusColor; ?> rounded-pill px-3 py-2">
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

    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>