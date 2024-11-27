<link rel="stylesheet" href="<?= base_url('assets/css/keranjang.css') ?>">

<div class="modal-body">
    <!-- Tabel Keranjang -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Layanan</th>
            </tr>
        </thead>
        <tbody>
            <!-- Cek apakah ada data di keranjang -->
            <?php if (!empty($keranjangDetails)): ?>
                <?php foreach ($keranjangDetails as $index => $item): ?>
                    <tr>
                        <!-- Nama Layanan -->
                        <td class="d-flex justify-content-between align-items-center toggle-details" 
                            data-id="<?= $item['id'] ?>" 
                            data-target="#details-<?= $index ?>" 
                            style="cursor: pointer;">
                            
                            <!-- Nama Layanan (Kiri) -->
                            <span class="text-start"><?= htmlspecialchars($item['nama_service'], ENT_QUOTES, 'UTF-8') ?></span>
                            
                            <!-- Harga dan Panah (Kanan) -->
                            <div class="d-flex align-items-center">
                                <!-- Harga -->
                                <span class="fw-bold text-success me-2">
                                    Rp <?= number_format($item['harga_total'], 0, ',', '.') ?>
                                </span>
                                <!-- Ikon Panah -->
                                <i class="fa fa-chevron-down text-muted"></i>
                            </div>
                        </td>
                    </tr>

                    <!-- Detail Barang Tersembunyi -->
                    <tr id="details-<?= $index ?>" class="details-row" style="display: none;">
                        <td colspan="1">
                            <table class="table table-striped">
                                <thead class='bg-primary text-white'>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Harga Per Satuan</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data Barang -->
                                    <?php if (isset($keranjangBarang[$item['id']])): ?>
                                        <?php foreach ($keranjangBarang[$item['id']] as $barang): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($barang['nama'], ENT_QUOTES, 'UTF-8') ?></td>
                                                <td><?= htmlspecialchars($barang['jumlah'], ENT_QUOTES, 'UTF-8') ?></td>
                                                <td><?= number_format($barang['harga'], 0, ',', '.') ?> per <?= htmlspecialchars($barang['besaran'], ENT_QUOTES, 'UTF-8') ?></td>
                                                <td> Rp <?= number_format($barang['jumlah'] * $barang['harga'], 0, ',', '.') ?> </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="4">Tidak ada barang untuk layanan ini.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Keranjang kosong.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="modal-body my-2 bottom-4">
    <!-- Tombol Checkout -->
    <a href="#checkout" class="btn btn-success position-fixed bottom-1 end-0 m-1 rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; font-size: 24px;" data-bs-toggle="modal" data-bs-target="#checkoutModal">
        <i class="fa fa-shopping-cart text-white"></i>
    </a>
</div>

<!-- Modal Checkout -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalLabel">Checkout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form Checkout atau Konten Checkout lainnya -->
                <form method="post" action="<?= base_url('checkout/save') ?>" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    
                    <!-- Foto Bukti Transfer -->
                    <div class="form-group mb-3">
                        <label for="bukti_transfer" class="form-label">Foto Bukti Transfer</label>
                        <input type="file" name="bukti_transfer" class="form-control" accept="image/*" required>
                    </div>

                    <!-- Pilih Paket Layanan -->
                    <div class="form-group mb-3">
                        <label for="id_services" class="form-label">Pilih Paket Layanan</label>
                        <select name="id_services[]" class="form-control selectpicker" multiple data-live-search="true" required>
                            <?php foreach ($keranjangDetails as $item): ?>
                                <option value="<?= $item['id'] ?>">
                                    <?= htmlspecialchars($item['nama_service'], ENT_QUOTES, 'UTF-8') ?> - Rp <?= number_format($item['harga_total'], 0, ',', '.') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Checkout</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function () {
        $('.toggle-details').on('click', function () {
            const target = $(this).data('target');
            $(target).slideToggle(); // Animasi slide
            $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up'); // Ubah ikon
        });
    });
</script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka4QAt02FGGRYyAY9xERtzkoxGT5Usz6DA4vQCBP5kHjVgwp7y3qdDLbcSzZ5hAl" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.1/dist/js/bootstrap-select.min.js"></script>

<script>
    $(document).ready(function () {
        // Inisialisasi selectpicker untuk dropdown multiselect
        $('.selectpicker').selectpicker();
    });
</script>
