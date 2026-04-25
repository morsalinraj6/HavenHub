<?php include __DIR__ . '/../layouts/header.php'; ?>
<div class="row g-4">
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <img src="<?= htmlspecialchars($room['image']); ?>" class="card-img-top" alt="Room image">
            <div class="card-body p-4">
                <h3 class="fw-bold">Room <?= htmlspecialchars($room['room_number']); ?></h3>
                <p class="text-muted"><?= htmlspecialchars($room['category']); ?> · <?= htmlspecialchars($room['type']); ?></p>
                <p class="fw-bold fs-4 mb-0"><?= format_money($room['price']); ?> / night</p>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <h3 class="fw-bold mb-3">Book this room</h3>
                <form method="POST" class="row g-3">
                    <input type="hidden" name="room_id" value="<?= $room['id']; ?>">
                    <div class="col-md-6">
                        <label class="form-label">Check-in date</label>
                        <input type="date" name="check_in" class="form-control" value="<?= htmlspecialchars(old('check_in')); ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Check-out date</label>
                        <input type="date" name="check_out" class="form-control" value="<?= htmlspecialchars(old('check_out')); ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Guests</label>
                        <input type="number" name="guests" min="1" max="6" class="form-control" value="<?= htmlspecialchars(old('guests', 1)); ?>" required>
                    </div>
                    <div class="col-12 d-grid">
                        <button class="btn btn-warning btn-lg">Confirm Booking</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
