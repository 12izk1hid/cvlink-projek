<link rel="stylesheet" href="<?= base_url('assets/css/keranjang.css') ?>">

<form class="form" method="post" action="<?= base_url('client/order/save') ?>">
    <div class="modal-body">
        <!-- Tabel Keranjang -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Layanan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($keranjangDetails)): ?>
                    <?php foreach ($keranjangDetails as $index => $item): ?>
                        <tr>
                            <td class="toggle-details" data-target="#details-<?= $index ?>" style="cursor: pointer;">
                                <?= htmlspecialchars($item['nama_service'], ENT_QUOTES, 'UTF-8') ?>
                                <i class="fa fa-chevron-down"></i>
                            </td>
                        </tr>
                        <tr id="details-<?= $index ?>" class="details-row" style="display: none;">
                            <td colspan="1">
                                <table class="table">
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Besar Jumlah</th>
                                        <th>Harga Satuan</th>
                                        <th>Besaran</th>
                                    </tr>
                                    <tr>
                                        <td><?= htmlspecialchars($item['nama_barang'] ?? '-', ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= htmlspecialchars($item['besar_jumlah'] ?? '-', ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= isset($item['harga_satuan']) ? number_format($item['harga_satuan'], 0, ',', '.') : '-' ?></td>
                                        <td><?= htmlspecialchars($item['besaran'] ?? '-', ENT_QUOTES, 'UTF-8') ?></td>
                                    </tr>
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
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.toggle-details').on('click', function () {
            const target = $(this).data('target');
            $(target).slideToggle(); // Animasi slide
            $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up'); // Ubah ikon
        });
    });
</script>
