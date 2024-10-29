<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small><?= htmlspecialchars($title) ?></small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambah">
                            <i class="fa fa-plus"></i>
                            Tambah Jasa
                        </button>
                    </div>
                    <div class="box-body">
                        <?= session()->getFlashdata('pesan') ? session()->getFlashdata('pesan') : ''; ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <!-- <th width="5%">ID Jasa</th> -->
                                    <th>Nama Item</th>
                                    <th>Type</th>
                                    <th>Min Harga</th>
                                    <th>Max Harga</th>
                                    <th width="12%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $nom = 1; foreach ($jasa as $dt): ?>
                                    <tr>
                                    <!-- <td class="text-center"><?= esc($dt['id']); ?></td> -->
                                        <td><?= htmlspecialchars($dt['nama_item']) ?></td>
                                        <td><?= htmlspecialchars($dt['type']); ?></td>
                                        <td><?= number_format($dt['min_harga'], 0, ',', '.'); ?></td>
                                        <td><?= number_format($dt['max_harga'], 0, ',', '.'); ?></td>
                                        <td class="text-center">
                                            <a data-toggle="modal" data-id="<?= $dt['id'] ?>" 
                                               data-nama_item="<?= htmlspecialchars($dt['nama_item']) ?>" 
                                               data-type="<?= htmlspecialchars($dt['type']) ?>" 
                                               data-min_harga="<?= $dt['min_harga'] ?>" 
                                               data-max_harga="<?= $dt['max_harga'] ?>" 
                                               href="#edit" class="edit-jasa" title="Edit Jasa">
                                                <button class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button>
                                            </a>
                                            <a href="<?= base_url('jasa/delete?id=' . $dt['id']); ?>" class="delete" title="Delete" onclick="return confirm('Apakah Anda yakin ingin menghapus jasa ini?');">
                                                <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Tambah Data Jasa -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Jasa</h4>
            </div>
            <form method="post" action="<?= base_url('jasa/save') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="namaItem">Nama Item</label>
                        <input type="text" class="form-control" name="nama_item" placeholder="Masukan Nama Item" required>
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control" name="type" placeholder="Masukan Type Jasa" required>
                            <option value="barang">Barang</option>
                            <option value="jasa">Jasa</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="minHarga">Min Harga</label>
                        <input type="number" class="form-control" name="min_harga" placeholder="Masukan Min Harga" required>
                    </div>
                    <div class="form-group">
                        <label for="maxHarga">Max Harga</label>
                        <input type="number" class="form-control" name="max_harga" placeholder="Masukan Max Harga" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Data Jasa -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Jasa</h4>
            </div>
            <form method="post" action="<?= base_url('jasa/update') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="namaItem">Nama Item</label>
                        <input type="hidden" class="form-control" name="id" id="id">
                        <input type="text" class="form-control" name="nama_item" id="nama_item" placeholder="Masukan Nama Item" required>
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control" name="type" placeholder="Masukan Type Jasa" required>
                            <option value="barang">Barang</option>
                            <option value="jasa">Jasa</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="minHarga">Min Harga</label>
                        <input type="number" class="form-control" name="min_harga" id="min_harga" placeholder="Masukan Min Harga" required>
                    </div>
                    <div class="form-group">
                        <label for="maxHarga">Max Harga</label>
                        <input type="number" class="form-control" name="max_harga" id="max_harga" placeholder="Masukan Max Harga" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= base_url() ?>/assets/plugins/jquery/jquery-2.2.3.min.js"></script>
<script>
    $(document).ready(function() {
        $(document).on("click", ".edit-jasa", function() {
            var id = $(this).data('id');
            var nama_item = $(this).data('nama_item');
            var type = $(this).data('type');
            var min_harga = $(this).data('min_harga');
            var max_harga = $(this).data('max_harga');

            $(".modal-body #id").val(id);
            $(".modal-body #nama_item").val(nama_item);
            $(".modal-body #type").val(type);
            $(".modal-body #min_harga").val(min_harga);
            $(".modal-body #max_harga").val(max_harga);
        });
    });
</script>
