<link rel="stylesheet" href="<?= base_url('assets/css/keranjang.css') ?>">

<div class="modal-body">
    <table class="table">
        <thead class='bg-primary text-white'>
            <tr>
                <th>Service Yang Dibayar</th>
                <th>Aksi</th> <!-- Tambahkan kolom aksi untuk tombol cetak -->
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($keranjangDetails)): ?>
                <?php foreach ($keranjangDetails as $index => $item): ?>
                    <tr>
                        <td class="d-flex justify-content-between align-items-center toggle-details" 
                            data-id="<?= $item['id'] ?>" 
                            data-target="#details-<?= $index ?>" 
                            style="cursor: pointer;">
                            <span class="text-start"><?= htmlspecialchars($item['nama_service'], ENT_QUOTES, 'UTF-8') ?></span>
                            <div class="d-flex align-items-center">
                                <span class="fw-bold text-success me-2">
                                    Rp <?= number_format($item['harga_total'], 0, ',', '.') ?>
                                </span>
                                <i class="fa fa-chevron-down text-muted"></i>
                            </div>
                        </td>
                        <td>
                            <!-- Tombol Cetak Invoice untuk setiap layanan -->
                            <button class="btn btn-primary print-invoice" data-invoice-id="<?= $item['id'] ?>">Cetak Invoice</button>
                        </td>
                    </tr>
                    <tr id="details-<?= $index ?>" class="details-row" style="display: none;">
                        <td colspan="4">
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
                    <td colspan="5">Anda Belum Melakukan Pembayaran Produk Apapun</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script type="text/javascript" src="<?= base_url() ?>/assets/plugins/jquery/jquery-2.2.3.min.js"></script>
<script>
    // Toggle detail layanan
    $(document).on('click', '.toggle-details', function () {
        const targetId = $(this).data('target');
        $(targetId).toggle();
    });

    // Cetak invoice untuk setiap pesanan
    $(document).on('click', '.print-invoice', function () {
        const invoiceId = $(this).data('invoice-id');
        window.open('<?= base_url("invoice/print/") ?>' + invoiceId, '_blank');
    });
</script>
