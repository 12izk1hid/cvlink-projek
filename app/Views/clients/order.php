<link rel="stylesheet" href="<?= base_url('assets/css/keranjang.css') ?>">

<div class="modal-body">
    <table class="table">
        <thead class='bg-primary text-white'>
            <tr>
                <th>Pilih</th>
                <th>Keranjang Belanja</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($keranjangDetails)): ?>
                <?php foreach ($keranjangDetails as $index => $item): ?>
                    <tr>
                        <td>
                            <input type="checkbox" class="form-check-input cart-item" 
                                   data-id="<?= $item['id'] ?>" 
                                   data-price="<?= $item['harga_total'] ?>">
                        </td>
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
                    <tr id="details-<?= $index ?>" class="details-row" style="display: none;">
                        <td colspan="3">
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
                                                <td><?= htmlspecialchars($barang['nama_barang'], ENT_QUOTES, 'UTF-8') ?></td>
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

<!-- Tombol Checkout -->
<button id="checkoutButton" class="btn btn-success position-fixed bottom-1 end-0 m-1 rounded-circle d-flex align-items-center justify-content-center" 
        style="width: 60px; height: 60px; font-size: 24px;">
    <i class="fa fa-shopping-cart text-white"></i>
</button>

<!-- Modal Checkout -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Header Modal -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="checkoutModalLabel">
                    <i class="fa fa-shopping-cart me-2"></i> Checkout
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body Modal -->
            <div class="modal-body">
                <form method="post" action="<?= base_url('client/order/checkout') ?>" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name='id_services' id='id_services_all'>
                    <div class="form-group mb-3">
                        <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                        <div class="d-flex align-items-center border rounded p-2">
                            <img src="<?= base_url('assets/images/gopay.png') ?>" 
                                alt="Logo GoPay" width="50" class="me-3">
                            <div>
                                Transfer ke GoPay
                                <small class="text-muted">
                                    Nomor Tujuan: <strong>+62 815-3622-3687</strong>
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="bukti_transfer" class="form-label">Upload Bukti Transfer</label>
                        <input type="file" name="bukti_transfer" class="form-control" accept="image/*" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="total_harga_display" class="form-label">Total Harga</label>
                        <input type="text" id="total_harga_display" class="form-control" value="Rp 0" readonly>
                        <input type="hidden" id="total_harga" name="total_harga" value="0">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i> Tutup
                        </button>
                        <button type="submit" class="btn btn-primary checkout-btn" disabled>
                            <i class="fa fa-check"></i> Checkout
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= base_url() ?>/assets/plugins/jquery/jquery-2.2.3.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Selektor tombol checkout
        const checkoutButton = document.getElementById('checkoutButton');
        const checkoutModal = new bootstrap.Modal(document.getElementById('checkoutModal'), {
            keyboard: true
        });

        // Event klik tombol checkout
        checkoutButton.addEventListener('click', function () {
            // Cek apakah tombol checkout diaktifkan
            const checkoutDisabled = document.querySelector('.checkout-btn').disabled;

            if (!checkoutDisabled) {
                // Munculkan modal jika tombol aktif
                checkoutModal.show();
            } else {
                alert('Silakan pilih item terlebih dahulu!');
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.cart-item');
        const totalHargaInput = document.getElementById('total_harga');
        const totalHargaDisplay = document.getElementById('total_harga_display');
        const idServicesSend = document.getElementById('id_services_all');
        const checkoutButton = document.querySelector('.checkout-btn');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                let totalHarga = 0;
                let selectedCount = 0;
                let idServices = []

                checkboxes.forEach(item => {
                    if (item.checked) {
                        totalHarga += parseFloat(item.dataset.price);
                        idServices.push(item.dataset.id)
                        selectedCount++;
                    }
                });

                totalHargaDisplay.value = 'Rp ' + totalHarga.toLocaleString('id-ID', { minimumFractionDigits: 0 });
                idServicesSend.value = idServices
                totalHargaInput.value = totalHarga;

                checkoutButton.disabled = selectedCount === 0;
            });
        });
    });
</script>
<script>
    $(document).on('click', '.toggle-details', function () {
        const targetId = $(this).data('target'); // Ambil ID dari data-target
        $(targetId).toggle(); // Tampilkan/sembunyikan baris tabel inner
    });
</script>