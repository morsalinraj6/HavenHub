<?php include __DIR__ . '/../layouts/header.php'; ?>
<div class="row g-4 align-items-start">
    <div class="col-lg-7">
        <img src="<?= htmlspecialchars($room['image']); ?>" class="img-fluid rounded-4 shadow-sm w-100 details-img" alt="Room image">
    </div>
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <h2 class="fw-bold">Room <?= htmlspecialchars($room['room_number']); ?></h2>
                <p class="text-muted mb-2"><?= htmlspecialchars($room['category']); ?> · <?= htmlspecialchars($room['type']); ?></p>
                <p><span class="badge text-bg-<?= $room['status'] === 'Available' ? 'success' : ($room['status'] === 'Occupied' ? 'danger' : 'warning'); ?>"><?= htmlspecialchars($room['status']); ?></span></p>
                <h3 class="fw-bold mb-3"><?= format_money($room['price']); ?> <small class="fs-6 text-muted">per night</small></h3>
                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item px-0">Free Wi‑Fi</li>
                    <li class="list-group-item px-0">Room Service Available</li>
                    <li class="list-group-item px-0">Professional Billing & Service Tracking</li>
                </ul>
                <?php if (is_logged_in() && current_user()['role'] === 'Guest' && $room['status'] === 'Available'): ?>
                    <a href="<?= BASE_URL; ?>/booking/create?room_id=<?= $room['id']; ?>" class="btn btn-warning btn-lg w-100">Book This Room</a>
                <?php else: ?>
                    <a href="<?= BASE_URL; ?>/auth/login" class="btn btn-dark w-100">Login as Guest to Book</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
