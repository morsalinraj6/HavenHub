<?php include __DIR__ . '/../layouts/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4 p-lg-5">
                <h2 class="fw-bold text-center mb-4">Login</h2>
                <form method="POST" novalidate>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars(old('email')); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required minlength="6">
                    </div>
                    <button class="btn btn-warning w-100">Login</button>
                </form>
                <p class="text-center mt-3 mb-0">No account? <a href="<?= BASE_URL; ?>/auth/register">Create one</a></p>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
