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
                            <td class="toggle-details" data-id="<?= $item['id'] ?>" data-target="#details-<?= $index ?>" style="cursor: pointer;">
                                <?= htmlspecialchars($item['nama_service'], ENT_QUOTES, 'UTF-8') ?>
                                <i class="fa fa-chevron-down"></i>
                            </td>
                        </tr>
                        <tr id="details-<?= $index ?>" class="details-row" style="display: none;">
                                <table class="table barang-table">
                                    <thead>
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Merk</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Total Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Loop untuk menampilkan data barang berdasarkan id layanan -->
                                        <?php if (isset($keranjangBarang[$item['id']])): ?>
                                            <?php foreach ($keranjangBarang[$item['id']] as $barang): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($barang['nama'], ENT_QUOTES, 'UTF-8') ?></td>
                                                    <td><?= htmlspecialchars($barang['merk'] ?? '-', ENT_QUOTES, 'UTF-8') ?></td>
                                                    <td> <?= htmlspecialchars($barang['jumlah'] ?? '-', ENT_QUOTES, 'UTF-8') ?> </td>
                                                    <td><?= htmlspecialchars($barang['harga'] ? number_format($barang['harga'], 0, ',', '.') : '-', ENT_QUOTES, 'UTF-8') ?> per 
                                                        <?= htmlspecialchars($barang['besaran'] ?? '-', ENT_QUOTES, 'UTF-8') ?></td>
                                                    <td><?= number_format($barang['harga'] * $barang['jumlah'], 0, ',', '.') ?></td>
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
