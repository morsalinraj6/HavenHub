<?php include __DIR__ . '/../layouts/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4 p-lg-5">
                <h2 class="fw-bold text-center mb-4">Create Account</h2>
                <form method="POST" class="row g-3" novalidate>
                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars(old('name')); ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars(old('email')); ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required minlength="6">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" required minlength="6">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select">
                            <option value="Guest" <?= old('role') === 'Guest' ? 'selected' : ''; ?>>Guest</option>
                            <option value="Staff" <?= old('role') === 'Staff' ? 'selected' : ''; ?>>Staff</option>
                            <option value="Admin" <?= old('role') === 'Admin' ? 'selected' : ''; ?>>Admin</option>
                        </select>
                        <small class="text-muted">For a real production system, only admin should create staff/admin users from a protected panel.</small>
                    </div>
                    <div class="col-12 d-grid"><button class="btn btn-warning">Register</button></div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
