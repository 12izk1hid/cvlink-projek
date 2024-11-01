<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"> CV. Link </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 <?= $loged? '': 'd-none' ?>">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= base_url('/client') ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pesan Sekarang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
            </ul>
            <?php if ($loged): ?>
                <button class="btn btn-primary rounded-pill" onclick="toggleDrawer()"><i class="fa-solid fa-user"></i></button>
            <?php else: ?>
                <button class="btn btn-primary" onclick="window.location.href='<?= base_url('login') ?>'">Login</button>
            <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="drawer d-none" id="drawer">
        <div class="p-4">
            <h5>User Name</h5>
            <p>Logout</p>
            <hr>
            <h6>Menu</h6>
            <ul class="list-unstyled">
                <li><a href="#" class="text-decoration-none">Home</a></li>
                <li><a href="#" class="text-decoration-none">Profile</a></li>
                <li><a href="#" class="text-decoration-none">Settings</a></li>
            </ul>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function toggleDrawer() {
            $('#drawer').toggleClass('d-none');
        }
    </script>