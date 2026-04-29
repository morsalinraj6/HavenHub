<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <h2 class="fw-bold mb-3">My Profile</h2>
                <p class="text-muted">View and update your account information.</p>

                <form method="POST" action="<?= BASE_URL; ?>/index.php?route=profile">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control"
                               value="<?= htmlspecialchars($user['name'] ?? ''); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control"
                               value="<?= htmlspecialchars($user['email'] ?? ''); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <input type="text" class="form-control"
                               value="<?= htmlspecialchars($user['role'] ?? ''); ?>" disabled>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" name="new_password" class="form-control"
                               placeholder="Leave blank if you do not want to change password">
                    </div>

                    <button type="submit" class="btn btn-warning px-4">
                        Update Profile
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>