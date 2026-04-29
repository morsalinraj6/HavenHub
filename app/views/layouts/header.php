<?php $flash = get_flash(); $user = current_user(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME; ?></title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= BASE_URL; ?>/assets/css/style.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm sticky-top"
     style="background: linear-gradient(90deg, #03045e, #0077b6);">

  <div class="container">

    <a class="navbar-brand fw-bold fs-4" href="<?= BASE_URL; ?>">
        <i class="bi bi-building"></i> HavenHub
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">

      <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">

        <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL; ?>">Home</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL; ?>/rooms">Rooms</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL; ?>/search">Search</a>
        </li>

        <?php if ($user): ?>

            <li class="nav-item">
                <a class="nav-link" href="<?= BASE_URL; ?>/dashboard">Dashboard</a>
            </li>

            <!-- 🔥 PROFILE LINK ADDED -->
            <li class="nav-item">
                <a class="nav-link" href="<?= BASE_URL; ?>/profile">Profile</a>
            </li>

            <?php if ($user['role'] === 'Admin'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL; ?>/admin/rooms">Manage Rooms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL; ?>/bookings/manage">Bookings</a>
                </li>
            <?php elseif ($user['role'] === 'Staff'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL; ?>/bookings/manage">Manage Bookings</a>
                </li>
            <?php endif; ?>

            <li class="nav-item">
                <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                    <?= htmlspecialchars($user['role']); ?>
                </span>
            </li>

            <li class="nav-item">
                <a class="btn btn-warning btn-sm px-3" href="<?= BASE_URL; ?>/logout">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </li>

        <?php else: ?>

            <li class="nav-item">
                <a class="nav-link" href="<?= BASE_URL; ?>/auth/login">Login</a>
            </li>

            <li class="nav-item">
                <a class="btn btn-warning btn-sm px-3" href="<?= BASE_URL; ?>/auth/register">
                    Signup
                </a>
            </li>

        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>

<div class="container py-4">

<?php if ($flash): ?>
    <div class="alert alert-<?= htmlspecialchars($flash['type']); ?> alert-dismissible fade show shadow-sm" role="alert">
        <?= htmlspecialchars($flash['message']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>