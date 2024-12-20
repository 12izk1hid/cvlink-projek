<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true"
         aria-label="Slide 1"></button>
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
        <?php if (!empty($services)) : ?>
            <?php foreach ($services as $service) : ?>
                <div class="col">
                    <div class="card h-100">
                        <div class="row g-0">
                            <!-- Gambar Service -->
                            <div class="col-md-4">
                                <?php 
                                // Ambil img_url dari database
                                $imgUrl = $service['img_url'];

                                // Cek apakah gambar valid
                                if (!empty($imgUrl) && file_exists($imgUrl)) : ?>
                                    <img src="<?= base_url($imgUrl) ?>" 
                                         class="img-fluid rounded-start" 
                                         alt="<?= esc($service['nama_service'] ?? 'Gambar Service', 'html') ?>" 
                                         style="width: 100%; height: 150px; object-fit: cover;">
                                <?php else : ?>
                                    <!-- Tampilkan gambar default -->
                                    <img src="<?= base_url('assets/images/default.png') ?>" 
                                         class="img-fluid rounded-start" 
                                         alt="Default Image" 
                                         style="width: 100%; height: 150px; object-fit: cover;">
                                <?php endif; ?>
                            </div>

                            <!-- Detail Service -->
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?= esc($service['nama_service'] ?? 'Nama Service Tidak Diketahui', 'html') ?>
                                    </h5>
                                    <p class="card-text text-primary fw-bold">
                                        Rp <?= number_format($service['harga_total'] ?? 0, 0, ',', '.') ?>
                                    </p>
                                    <p class="card-text">
                                        <small class="text-muted">
                                            <?= esc($service['deskripsi'] ?? 'Deskripsi tidak tersedia', 'html') ?>
                                        </small>
                                    </p>
                                    <button class="btn btn-outline-primary btn-add-to-cart" 
                                            data-id="<?= esc($service['id'] ?? '', 'html') ?>"
                                            aria-label="Tambah <?= esc($service['nama_service'] ?? 'Service', 'html') ?> ke Keranjang">
                                        Tambah ke Keranjang
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="text-center text-muted">Tidak ada layanan yang tersedia saat ini.</p>
        <?php endif; ?>
    </div>
</div>




<!-- About Us Section -->
<div class="about-us container">
    <h2 class="section-title">About Us</h2>
    <p>CV LINK adalah perusahaan yang bergerak di bidang instalasi jaringan, pengeboran air, pemasangan CCTV, 
        dan penangkal petir. Kami berkomitmen memberikan layanan terbaik untuk memenuhi kebutuhan pelanggan dengan 
        kualitas dan profesionalitas yang tinggi.</p>
</div>

<!-- Order Now Section -->
<div class="order-now container">
    <h2 class="section-title">Pesan Sekarang</h2>
    <p>Hubungi kami sekarang untuk konsultasi dan pemesanan layanan yang Anda butuhkan. 
        Kami siap melayani Anda dengan layanan instalasi yang cepat dan terpercaya.</p>
    <a href="<?= base_url('client/order') ?>" class="btn btn-primary">Pesan Sekarang</a>
</div>

<!-- Contact Section -->
<div class="contact container">
    <h2 class="section-title">Contact</h2>
    <p>Untuk informasi lebih lanjut atau pertanyaan, hubungi kami melalui:</p>
    <ul>
        <li>Email: info@cvlink.com</li>
        <li>Telepon: +62 123 4567 890</li>
        <li>Alamat: Kab. Dairi, Kec. Sidikalang, Jl. Tigalingga km.15 no.95</li>
    </ul>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Event listener untuk tombol +
        $('.btn-add-to-cart').on('click', function () {
            const id = $(this).data('id'); // Ambil id dari data-id tombol

            $.ajax({
                url: '<?= base_url('client/order/save') ?>', // Endpoint untuk menambah ke keranjang
                type: 'POST',
                data: {
                    id_services: id,
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>' // Format CSRF harus dalam bentuk kunci dan nilai
                },
                success: function (response) {
                    console.log('Response dari server:', response);
                    if (response.success) {
                        alert(response.message || 'Berhasil menambahkan ke keranjang.');
                    } else {
                        if (response.message === 'NOT-LOGGED') {
                            alert('Anda harus login terlebih dahulu.');
                            window.location.href = response.url || '<?= base_url('login') ?>';
                        } else {
                            alert(response.message || 'Gagal menambahkan ke keranjang.');
                        }
                    }
                },
                error: function (xhr) {
                    console.log('Error dari server:', xhr);
                    if (xhr.responseJSON?.message === 'NOT-LOGGED') {
                        alert('Anda harus login terlebih dahulu.');
                        window.location.href = xhr.responseJSON?.url || '<?= base_url('login') ?>';
                    } else {
                        alert(xhr.responseJSON?.message || 'Terjadi kesalahan saat menambahkan ke keranjang.');
                    }
                }
            });
        });
    });
</script>