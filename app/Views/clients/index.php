<style>
/* Atur gambar dalam card supaya berbentuk persegi */
.card img {
    width: 100%; /* Lebar 100% dari elemen col-md-4 */
    height: 200px; /* Sesuaikan dengan ukuran persegi yang diinginkan */
    object-fit: cover; /* Pastikan gambar tetap proporsional dan memenuhi area persegi */
    border-radius: 0.375rem; /* Sudut rounded yang sama dengan card */
}

/* Atur gambar pada carousel supaya tetap proporsional */
.carousel-item img {
    max-height: 500px; /* Atur sesuai kebutuhan agar gambar carousel tidak terlalu tinggi */
    object-fit: cover; /* Pastikan gambar tetap proporsional dalam carousel */
}

    /* Efek timbul untuk about-us, order-now, contact, dan card */
    .about-us, .order-now, .contact, .card {
        padding: 2rem;
        background-color: #ffffff;
        margin-top: 2rem;
        border-radius: 8px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Efek timbul */
        transition: transform 0.3s, box-shadow 0.3s; /* Transisi untuk animasi */
    }

    /* Animasi saat hover untuk card */
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    }

    /* Animasi saat hover untuk about-us, order-now, contact */
    .about-us:hover, .order-now:hover, .contact:hover {
        transform: translateY(-5px);
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    }

    /* Pengaturan teks pada section title */
    .section-title {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 1rem;
        color: #333;
    }

    /* Carousel styling */
    .carousel-inner img {
        height: 500px;
        object-fit: cover;
    }
</style>


<!-- Carousel -->
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
        <!-- Card 1 -->
        <div class="col">
            <div class="card h-100">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="assets/images/pengeboran.jpg" class="img-fluid rounded-start" alt="Pengeboran Air">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Pengeboran Air</h5>
                            <p class="card-text">Pengeboran dilakukan hingga ditemukannya sumber air.</p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col">
            <div class="card h-100">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="assets/images/jaringan.jpg" class="img-fluid rounded-start" alt="Instalasi Jaringan">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Instalasi Jaringan</h5>
                            <p class="card-text">Pemasangan jaringan di daerah blank spot.</p>
                            <p class="card-text"><small class="text-muted">Last updated 5 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col">
            <div class="card h-100">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="assets/images/pipa.jpg" class="img-fluid rounded-start" alt="Instalasi Pipa">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Instalasi Pipa</h5>
                            <p class="card-text">Instalasi pipa untuk berbagai keperluan rumah dan industri.</p>
                            <p class="card-text"><small class="text-muted">Last updated 10 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="col">
            <div class="card h-100">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="assets/images/cctv.jpg" class="img-fluid rounded-start" alt="Instalasi CCTV">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Instalasi CCTV</h5>
                            <p class="card-text">Pemasangan berbagai jenis CCTV untuk keamanan.</p>
                            <p class="card-text"><small class="text-muted">Last updated 15 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 5 -->
        <div class="col">
            <div class="card h-100">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="assets/images/petir.jpg" class="img-fluid rounded-start" alt="Penangkal Petir">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Penangkal Petir</h5>
                            <p class="card-text">Memasang perangkat untuk menangkal petir pada bangunan.</p>
                            <p class="card-text"><small class="text-muted">Last updated 15 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    <a href="order-page.html" class="btn btn-primary">Pesan Sekarang</a>
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