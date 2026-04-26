<?php include __DIR__ . '/../layouts/header.php'; ?>
<section class="hero-section rounded-4 p-5 mb-5 text-white shadow-lg">
    <div class="row align-items-center g-4">
        <div class="col-lg-7">
            <span class="badge text-bg-warning mb-3">Smart Hotel Operations</span>
            <h1 class="display-5 fw-bold">Run your hotel bookings, guests, billing and staff workflow from one place.</h1>
            <p class="lead mt-3">HavenHub is a beginner-friendly but professional management platform for small and medium hotels.</p>
            <div class="d-flex gap-3 flex-wrap mt-4">
                <a href="<?= BASE_URL; ?>/search" class="btn btn-warning btn-lg">Search Rooms</a>
                <a href="<?= BASE_URL; ?>/rooms" class="btn btn-outline-light btn-lg">View Rooms</a>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="glass-card p-4">
                <h4 class="mb-3">Quick Room Search</h4>
                <form action="<?= BASE_URL; ?>/search" method="GET" class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Check-in</label>
                        <input type="date" name="check_in" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Check-out</label>
                        <input type="date" name="check_out" class="form-control" required>
                    </div>
                    <div class="col-12 d-grid">
                        <button class="btn btn-warning">Check Availability</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold mb-0">Featured Rooms</h2>
        <a href="<?= BASE_URL; ?>/rooms" class="btn btn-outline-dark btn-sm">See All</a>
    </div>
    <div class="row g-4">
        <?php foreach ($rooms as $room): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card room-card h-100 border-0 shadow-sm">
                    <img src="<?= htmlspecialchars($room['image']); ?>" class="card-img-top" alt="Room image">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title mb-0">Room <?= htmlspecialchars($room['room_number']); ?></h5>
                            <span class="badge text-bg-success"><?= htmlspecialchars($room['status']); ?></span>
                        </div>
                        <p class="text-muted mb-2"><?= htmlspecialchars($room['category']); ?> · <?= htmlspecialchars($room['type']); ?></p>
                        <p class="fw-bold fs-5 mb-3"><?= format_money($room['price']); ?> <small class="text-muted fs-6">/ night</small></p>
                        <a href="<?= BASE_URL; ?>/room?id=<?= $room['id']; ?>" class="btn btn-dark w-100">View Details</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="row g-4">
    <div class="col-md-4"><div class="p-4 bg-white rounded-4 shadow-sm h-100"><i class="bi bi-building text-warning fs-1"></i><h4 class="mt-3">Room Management</h4><p class="mb-0 text-muted">Admin can control room types, pricing, images and maintenance status.</p></div></div>
    <div class="col-md-4"><div class="p-4 bg-white rounded-4 shadow-sm h-100"><i class="bi bi-calendar-check text-warning fs-1"></i><h4 class="mt-3">Booking Control</h4><p class="mb-0 text-muted">Availability checks prevent double booking and help streamline reservations.</p></div></div>
    <div class="col-md-4"><div class="p-4 bg-white rounded-4 shadow-sm h-100"><i class="bi bi-receipt text-warning fs-1"></i><h4 class="mt-3">Billing & Services</h4><p class="mb-0 text-muted">Staff can add services and instantly update the guest invoice.</p></div></div>
</section>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
