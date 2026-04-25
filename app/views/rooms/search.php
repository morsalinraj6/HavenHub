<?php include __DIR__ . '/../layouts/header.php'; ?>
<div class="row g-4">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <h3 class="fw-bold">Search Rooms</h3>
                <form method="GET" action="<?= BASE_URL; ?>/search" class="row g-3 mt-1">
                    <div class="col-12">
                        <label class="form-label">Check-in</label>
                        <input type="date" name="check_in" class="form-control" value="<?= htmlspecialchars($checkIn); ?>" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Check-out</label>
                        <input type="date" name="check_out" class="form-control" value="<?= htmlspecialchars($checkOut); ?>" required>
                    </div>
                    <div class="col-12 d-grid"><button class="btn btn-warning">Search</button></div>
                </form>
                <?php if ($error): ?><div class="alert alert-danger mt-3 mb-0"><?= htmlspecialchars($error); ?></div><?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold mb-0">Available Rooms</h3>
            <?php if ($checkIn && $checkOut && !$error): ?><span class="badge text-bg-dark"><?= count($rooms); ?> result(s)</span><?php endif; ?>
        </div>
        <div class="row g-4">
            <?php if ($checkIn && $checkOut && empty($rooms) && !$error): ?>
                <div class="col-12"><div class="alert alert-warning">No rooms available for the selected dates.</div></div>
            <?php endif; ?>
            <?php foreach ($rooms as $room): ?>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100 room-card">
                        <img src="<?= htmlspecialchars($room['image']); ?>" class="card-img-top" alt="Room image">
                        <div class="card-body">
                            <h5 class="fw-bold">Room <?= htmlspecialchars($room['room_number']); ?></h5>
                            <p class="text-muted"><?= htmlspecialchars($room['category']); ?> · <?= htmlspecialchars($room['type']); ?></p>
                            <p class="fw-bold"><?= format_money($room['price']); ?> / night</p>
                            <a href="<?= BASE_URL; ?>/room?id=<?= $room['id']; ?>" class="btn btn-dark btn-sm">Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
