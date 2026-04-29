<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">All Rooms</h2>
        <p class="text-muted mb-0">Explore available accommodations in HavenHub.</p>
    </div>
</div>

<div class="row g-4">

<?php foreach ($rooms as $room): ?>

    <?php
        $statusClass = $room['status'] === 'Available' ? 'success' :
                      ($room['status'] === 'Occupied' ? 'danger' : 'warning');
    ?>

    <div class="col-md-6 col-lg-4">
        <div class="card h-100 border-0 shadow-sm">

            <!-- Image -->
            <div class="position-relative">
                <img src="<?= htmlspecialchars($room['image']); ?>"
                     class="card-img-top"
                     style="height:220px; object-fit:cover;"
                     alt="Room image">

                <!-- Status badge on image -->
                <span class="badge bg-<?= $statusClass; ?> position-absolute top-0 end-0 m-2 px-3 py-2 rounded-pill">
                    <?= htmlspecialchars($room['status']); ?>
                </span>
            </div>

            <div class="card-body">

                <!-- Room Title -->
                <h5 class="fw-bold mb-1">
                    Room <?= htmlspecialchars($room['room_number']); ?>
                </h5>

                <!-- Type + Category -->
                <p class="text-muted small mb-2">
                    <?= htmlspecialchars($room['category']); ?> · <?= htmlspecialchars($room['type']); ?>
                </p>

                <!-- Price -->
                <h6 class="text-warning fw-bold mb-3">
                    <?= format_money($room['price']); ?> / night
                </h6>

                <!-- Button -->
                <a href="<?= BASE_URL; ?>/room?id=<?= $room['id']; ?>"
                   class="btn btn-warning w-100 shadow-sm">
                   View Details
                </a>

            </div>
        </div>
    </div>

<?php endforeach; ?>

</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>