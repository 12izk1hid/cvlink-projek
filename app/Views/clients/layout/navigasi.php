<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">CV. Link</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 <?= session()->get('isLogin') ? '' : 'd-none' ?>">
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url('/client') ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pesanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
            </ul>
            <?php if (session()->get('isLogin')): ?>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="profileMenu" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user"></i> <?= session()->get('nama') ?>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="profileMenu">
                        <li><a class="dropdown-item" href="<?= base_url('/client/profile') ?>">Profile</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('/client/settings') ?>">Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a></li>
                    </ul>
                </div>
            <?php else: ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
                <button class="btn btn-primary" onclick="window.location.href='<?= base_url('login') ?>'">Login</button>
            <?php endif; ?>
        </div>
    </div>
</nav>