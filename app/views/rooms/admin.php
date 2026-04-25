<?php include __DIR__ . '/../layouts/header.php'; ?>

<h2 class="fw-bold mb-4">Room Management</h2>

<div class="row g-4 mb-4">

    <!-- LEFT SIDE: ADD ROOM -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <h4 class="fw-bold mb-3">Add Room</h4>

                <form method="POST" action="<?= BASE_URL; ?>/admin/rooms/save" class="row g-3">

                    <!-- IMPORTANT: id hidden + empty -->
                    <input type="hidden" name="id" value="">

                    <div class="col-md-6">
                        <label class="form-label">Room Number</label>
                        <input type="text" name="room_number" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Price</label>
                        <input type="number" name="price" min="1" step="0.01" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-select">
                            <option value="AC">AC</option>
                            <option value="Non-AC">Non-AC</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-select">
                            <option value="Deluxe">Deluxe</option>
                            <option value="Suite">Suite</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="Available">Available</option>
                            <option value="Occupied">Occupied</option>
                            <option value="Maintenance">Maintenance</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Image URL</label>
                        <input type="text" name="image" class="form-control">
                    </div>

                    <div class="col-12 d-grid">
                        <button type="submit" class="btn btn-warning">Add Room</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- RIGHT SIDE: ROOM LIST -->
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-0">
                <div class="table-responsive">

                    <table class="table align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Room</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($rooms as $room): ?>
                            <tr>
                                <td><?= $room['id']; ?></td>

                                <td>
                                    <?= htmlspecialchars($room['room_number']); ?><br>
                                    <small class="text-muted"><?= htmlspecialchars($room['category']); ?></small>
                                </td>

                                <td><?= htmlspecialchars($room['type']); ?></td>

                                <td><?= format_money($room['price']); ?></td>

                                <td><?= htmlspecialchars($room['status']); ?></td>

                                <td>
                                    <form method="POST" action="<?= BASE_URL; ?>/admin/rooms/delete" onsubmit="return confirm('Delete this room?')">
                                        <input type="hidden" name="id" value="<?= $room['id']; ?>">
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                    </form>
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