<?php include __DIR__ . '/../layouts/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">All Rooms</h2>
        <p class="text-muted mb-0">Explore available accommodations in HavenHub.</p>
    </div>
</div>
<div class="row g-4">
    <?php foreach ($rooms as $room): ?>
        <div class="col-md-6 col-lg-4">
            <div class="card room-card h-100 border-0 shadow-sm">
                <img src="<?= htmlspecialchars($room['image']); ?>" class="card-img-top" alt="Room image">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="mb-0">Room <?= htmlspecialchars($room['room_number']); ?></h5>
                        <span class="badge text-bg-<?= $room['status'] === 'Available' ? 'success' : ($room['status'] === 'Occupied' ? 'danger' : 'warning'); ?>">
                            <?= htmlspecialchars($room['status']); ?>
                        </span>
                    </div>
                    <p class="text-muted"><?= htmlspecialchars($room['category']); ?> · <?= htmlspecialchars($room['type']); ?></p>
                    <p class="fw-bold"><?= format_money($room['price']); ?> / night</p>
                    <a href="<?= BASE_URL; ?>/room?id=<?= $room['id']; ?>" class="btn btn-dark">Details</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
