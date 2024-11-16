<form class="form" method="post" action="<?= base_url('client/order/save') ?>">
    <div class="modal-body">

        <!-- Tabel Keranjang -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Layanan</th>
                    <th>Nama Barang</th>
                    <th>Besar Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Besaran</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($keranjangDetails as $item): ?>
                    <tr>
                        <!-- Nama Layanan -->
                        <td><?= $item['nama_service'] ?></td>

                        <!-- Nama Barang -->
                        <td><?//= //$item['nama_barang'] ?></td>

                        <!-- Besar Jumlah -->
                        <td><?//= $item['besar_jumlah'] ?></td>

                        <!-- Harga Satuan -->
                        <td><?//= number_format($item['harga_satuan'], 0, ',', '.') ?></td>

                        <!-- Besaran -->
                        <td><?//= $item['besaran'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i> Simpan
        </button>
    </div>
</form>