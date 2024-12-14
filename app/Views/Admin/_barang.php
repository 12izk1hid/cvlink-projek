<!-- Sertakan CSS Bootstrap dan Bootstrap Select -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">

<!-- Sertakan JS jQuery, Bootstrap, dan Bootstrap Select -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Manajemen Barang</h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambah">
                            <i class="fa fa-plus"></i> Tambah Barang
                        </button>
                    </div>
                    <div class="box-body">
                        <?php if (session()->getFlashdata('pesan') !== NULL): ?>
                            <div class="alert alert-info">
                                <?= session()->getFlashdata('pesan'); ?>
                            </div>
                        <?php endif; ?>
                        <table id="barangTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Merk</th>
                                    <th>Harga</th>
                                    <th>Besaran</th>
                                    <th width="12%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($barang as $b): ?>
                                    <tr>
                                        <td><?= esc($b['id']); ?></td>
                                        <td><?= esc($b['nama_barang']); ?></td>
                                        <td><?= esc($b['merk']); ?></td>
                                        <td><?= esc($b['harga']); ?></td>
                                        <td><?= esc($b['besaran']); ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-success edit-barang" data-id="<?= esc($b['id']); ?>"
                                                    data-nama="<?= esc($b['nama_barang']); ?>" data-merk="<?= esc($b['merk']); ?>"
                                                    data-harga="<?= esc($b['harga']); ?>" data-besaran="<?= esc($b['besaran']); ?>">
                                                <i class="fa fa-edit"></i> Edit
                                            </button>
                                            <a href="<?= base_url('barang/delete/' . esc($b['id'])); ?>" class="btn btn-sm btn-danger"
                                               onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">
                                                <i class="fa fa-trash"></i> Hapus
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

<!-- Modal Tambah Barang -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang</h4>
            </div>
            <form method="post" action="<?= base_url('barang/save'); ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="merk">Merk</label>
                        <input type="text" class="form-control" id="merk" name="merk" required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" required>
                    </div>
                    <div class="form-group">
                        <label for="besaran">Besaran</label>
                        <input type="text" class="form-control" id="besaran" name="besaran" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Barang -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Barang</h4>
            </div>
            <form method="post" action="<?= base_url('barang/update'); ?>">
                <div class="modal-body">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="form-group">
                        <label for="edit-nama">Nama</label>
                        <input type="text" class="form-control" id="edit-nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-merk">Merk</label>
                        <input type="text" class="form-control" id="edit-merk" name="merk" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-harga">Harga</label>
                        <input type="number" class="form-control" id="edit-harga" name="harga" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-besaran">Besaran</label>
                        <input type="text" class="form-control" id="edit-besaran" name="besaran" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).on("click", ".edit-barang", function () {
        $("#edit-id").val($(this).data("id"));
        $("#edit-nama").val($(this).data("nama"));
        $("#edit-merk").val($(this).data("merk"));
        $("#edit-harga").val($(this).data("harga"));
        $("#edit-besaran").val($(this).data("besaran"));
        $("#edit").modal("show");
    });
</script>
