</div>

<footer class="mt-5 pt-5 pb-4 text-white" style="background: linear-gradient(90deg, #03045e, #0077b6);">
    <div class="container">

        <div class="row text-center text-md-start">

            <!-- Brand -->
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold">HavenHub</h5>
                <p class="small">
                    A modern hotel management & guest experience platform designed 
                    for seamless booking and management.
                </p>
            </div>

            <!-- Quick Links -->
            <div class="col-md-4 mb-4">
                <h6 class="fw-semibold">Quick Links</h6>
                <ul class="list-unstyled small">
                    <li><a href="<?= BASE_URL ?>" class="text-white text-decoration-none">Home</a></li>
                    <li><a href="<?= BASE_URL ?>/rooms" class="text-white text-decoration-none">Rooms</a></li>
                    <li><a href="<?= BASE_URL ?>/search" class="text-white text-decoration-none">Search</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="col-md-4 mb-4">
                <h6 class="fw-semibold">Contact</h6>
                <p class="small mb-1"><i class="bi bi-envelope"></i> support@havenhub.com</p>
                <p class="small"><i class="bi bi-telephone"></i> +880 1234-567890</p>
            </div>

        </div>

        <hr class="border-light">

        <!-- Bottom -->
        <div class="text-center small">
            <p class="mb-1">
                &copy; <?= date('Y'); ?> HavenHub. All rights reserved.
            </p>
            <small class="text-light opacity-75">
                Built with Core PHP, MySQL & Bootstrap.
            </small>
        </div>

    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL; ?>/assets/js/app.js"></script>

</body>
</html>