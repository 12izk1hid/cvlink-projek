<link rel="stylesheet" href="<?= base_url('assets/css/client.css') ?>">

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?= base_url('assets/images/petir2.jpg') ?>" class="d-block w-100" alt="Penangkalan Petir">
            <div class="carousel-caption d-none d-md-block">
                <h5>CV LINK</h5>
                <p>Penangkalan Petir</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="<?= base_url('assets/images/pengeboran.jpg') ?>" class="d-block w-100" alt="Pengeboran Air">
            <div class="carousel-caption d-none d-md-block">
                <h5>CV LINK</h5>
                <p>Pengeboran Air</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="<?= base_url('assets/images/jaringan.jpg') ?>" class="d-block w-100" alt="Instalasi Jaringan">
            <div class="carousel-caption d-none d-md-block">
                <h5>CV LINK</h5>
                <p>Instalasi Jaringan di Daerah Blank Spot</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="container my-5">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach($services as $service)  { ?>
            <div class="col">
                <div class="card h-100">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="assets/images/services/<?= $service['gambar_service'] ?>" class="img-fluid rounded-start" alt="Pengeboran Air">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?= $service['nama_service'] ?></h5>
                                <p class="card-text"><?= $service['harga_total'] ?></p>
                                <p class="card-text"><small class="text-muted"><?= $service['deskripsi'] ?></small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<!-- About Us Section -->
<div class="about-us container">
    <h2 class="section-title">About Us</h2>
    <p>CV LINK adalah perusahaan yang bergerak di bidang instalasi jaringan, pengeboran air, pemasangan CCTV, dan penangkal petir. Kami berkomitmen memberikan layanan terbaik untuk memenuhi kebutuhan pelanggan dengan kualitas dan profesionalitas yang tinggi.</p>
</div>

<!-- Order Now Section -->
<div class="order-now container">
    <h2 class="section-title">Pesan Sekarang</h2>
    <p>Hubungi kami sekarang untuk konsultasi dan pemesanan layanan yang Anda butuhkan. Kami siap melayani Anda dengan layanan instalasi yang cepat dan terpercaya.</p>
    <a href="<?= base_url('client/order') ?>" class="btn btn-primary">Pesan Sekarang</a>
</div>

<!-- Contact Section -->
<div class="contact container">
    <h2 class="section-title">Contact</h2>
    <p>Untuk informasi lebih lanjut atau pertanyaan, hubungi kami melalui:</p>
    <ul>
        <li>Email: info@cvlink.com</li>
        <li>Telepon: +62 123 4567 890</li>
        <li>Alamat: Jl. Contoh Alamat No. 1, Kota Contoh, Indonesia</li>
    </ul>
</div>