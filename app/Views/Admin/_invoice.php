<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="<?= base_url('assets/css/invoice.css'); ?>">
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small><?= esc($title) ?></small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#tambah">
                            <i class="fa fa-plus"></i> Tambah Invoice
                        </button> -->
                    </div>
                    <div class="box-body">
                        <?php if (session()->getFlashdata('pesan') !== NULL): ?>
                            <?= session()->getFlashdata('pesan'); ?>
                        <?php endif; ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Pengguna</th> <!-- Kolom untuk Nama Pengguna -->
                                    <th>Bukti Bayar</th>
                                    <th>Tanggal Checkout</th>
                                    <th>Confirmed</th>
                                    <th>Harga Layanan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($invoice)): ?>
                                <?php foreach ($invoice as $dt): ?>
                                    <tr>
                                        <td><?= esc($dt['id_invoice']); ?></td>
                                        <td>
                                            <?= $dt['nama'] ?>
                                        </td>
                                        <td>
                                            <?php if (!empty($dt['bukti_bayar'])): ?>
                                                <a href="#" class="lihat-gambar" data-gambar="<?= base_url('assets/images/evidence/' . esc($dt['bukti_bayar'])); ?>">Lihat</a>
                                            <?php else: ?>
                                                Belum Ada
                                            <?php endif; ?>
                                        </td>
                                        <td><?= esc($dt['tanggal_checkout']); ?></td>
                                        <td><?php 
                                            if($dt['confirmed']) {
                                                if ($dt['confirmed'] == 1) {
                                                    echo 'Valid';
                                                } else {
                                                    echo 'Invalid';
                                                }
                                            } else {
                                                echo 'Belum Dikonfirmasi';
                                            }
                                        ?></td>
                                        <td> <?= $dt['harga_layanan']; ?></td>
                                        <td class="text-center">
                                            <a 
                                                href="<?= base_url('invoice/accept/' . esc($dt['id_invoice'])); ?>"
                                                class="edit-invoice btn btn-sm btn-success">
                                                <i class="fa fa-edit"></i> Valid
                                            </a>
                                            <a href="<?= base_url('invoice/reject/' . esc($dt['id_invoice'])); ?>" 
                                            class="btn btn-sm btn-danger delete">
                                                <i class="fa fa-trash"></i> Invalid
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="6">No data found.</td></tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Pop-up Gambar -->
<div id="popup-gambar" class="popup-gambar" style="display: none;">
    <div class="popup-content">
        <span class="close-btn">&times;</span>
        <img id="popup-image" src="" alt="Gambar Bukti Bayar" />
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.lihat-gambar').on('click', function(e) {
            e.preventDefault();
            var gambarUrl = $(this).data('gambar');
            console.log('gambar', gambarUrl)
            $('#popup-image').attr('src', gambarUrl);
            $('#popup-gambar').fadeIn();
        });

        $('.close-btn').on('click', function() {
            $('#popup-gambar').fadeOut();
        });
    });
</script>

<style>
</style>
