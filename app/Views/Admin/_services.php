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
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th>Foto</th>
                                    <th width="12%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $nom = 1; foreach ($services as $service): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($service['nama']) ?></td>
                                        <td><?= htmlspecialchars($service['deskripsi']) ?></td>
                                        <td><?= number_format($service['harga'], 0, ',', '.'); ?></td>
                                        <td>
                                            <img src="data:image/jpeg;base64,<?= base64_encode($service['img_url']) ?>" 
                                                class="img-fluid rounded-start" 
                                                alt="<?= $service['nama'] ?>" 
                                                style="width: 40px; height: 40px; object-fit: cover;">
                                        </td>
                                        <td class="text-center">
                                            <a data-toggle="modal" data-id="<?= $service['id'] ?>"
                                               data-nama="<?= htmlspecialchars($service['nama']) ?>"
                                               data-deskripsi="<?= htmlspecialchars($service['deskripsi']) ?>"
                                               data-harga="<?= $service['harga'] ?>"
                                               href="#edit" class="edit-service" title="Edit Jasa">
                                                <button class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button>
                                            </a>
                                            <a href="<?= base_url('service/delete/' . $service['id']); ?>" class="delete" title="Delete" onclick="return confirm('Apakah Anda yakin ingin menghapus jasa ini?');">
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
            <form method="post" action="<?= base_url('service/save') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama Jasa</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Jasa" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" placeholder="Masukkan Deskripsi Jasa" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" name="harga" placeholder="Masukkan Harga Jasa" required>
                    </div>
                    <div class="form-group">
                        <label for="img_url">Foto Jasa</label>
                        <input type="file" class="form-control" name="img_url" accept="image/*" required>
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
            <form method="post" action="<?= base_url('service/update') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama Jasa</label>
                        <input type="hidden" class="form-control" name="id" id="id">
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama Jasa" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="Masukkan Deskripsi Jasa" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" name="harga" id="harga" placeholder="Masukkan Harga Jasa" required>
                    </div>
                    <div class="form-group">
                        <label for="img_url">Foto Jasa (Jika ingin mengganti)</label>
                        <input type="file" class="form-control" id="img_url" name="img_url" accept="image/*">
                        <small>Biarkan kosong jika tidak mengganti foto</small>
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
        $(document).on("click", ".edit-service", function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            var deskripsi = $(this).data('deskripsi');
            var harga = $(this).data('harga');
            var img_url = $(this).data('img_url');

            $(".modal-body #id").val(id);
            $(".modal-body #nama").val(nama);
            $(".modal-body #deskripsi").val(deskripsi);
            $(".modal-body #harga").val(harga);
            $(".modal-body #img_url").val(img_url);
        });
    });
</script>

