<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">

<div class="content-wrapper">
    <section class="content-header">
        <h1>Dashboard <small><?= esc($title) ?></small></h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambah">
                            <i class="fa fa-plus"></i> Tambah Paket Layanan
                        </button>
                    </div>
                    <div class="box-body">
                        <?php if (session()->getFlashdata('pesan')): ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('pesan'); ?></div>
                        <?php endif; ?>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID Paket</th>
                                    <th>Nama Layanan</th>
                                    <th>Nama Barang</th>
                                    <th>Besar</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($paket_layanan as $paket): ?>
                                    <tr>
                                        <td><?= esc($paket['id']); ?></td>
                                        <td><?= esc($paket['service_name']); ?></td>
                                        <td><?= esc($paket['barang_name']); ?></td>
                                        <td><?= esc($paket['besar']); ?></td>
                                        <td>
                                            <?php if ($paket['photo_url']): ?>
                                                <img src="<?= base_url('uploads/' . esc($paket['photo_url'])); ?>" 
                                                     alt="Foto <?= esc($paket['service_name']); ?>" 
                                                     class="img-thumbnail" style="width: 80px;">
                                            <?php else: ?>
                                                <span class="text-muted">Tidak ada foto</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-success btn-sm edit-paket" 
                                                    data-toggle="modal" data-target="#editModal"
                                                    data-id="<?= esc($paket['id']); ?>" 
                                                    data-idservices="<?= esc($paket['id_services']); ?>"
                                                    data-idbarang="<?= esc($paket['id_barang']); ?>" 
                                                    data-besar="<?= esc($paket['besar']); ?>"
                                                    data-photourl="<?= esc($paket['photo_url']); ?>"
                                                    >
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <a href="<?= base_url('paketlayanan/delete/' . esc($paket['id'])); ?>" 
                                               onclick="return confirm('Apakah Anda yakin ingin menghapus paket ini?')" 
                                               class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
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

<!-- Tambah Modal -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="<?= base_url('paketlayanan/save') ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Paket Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_services" class="form-label">Nama Layanan</label>
                        <select name="id_services" class="form-control selectpicker" data-live-search="true" required>
                            <?php foreach ($services as $service): ?>
                                <option value="<?= esc($service['id']); ?>"><?= esc($service['nama']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_barang" class="form-label">Nama Barang</label>
                        <select name="id_barang" class="form-control selectpicker" data-live-search="true" required>
                            <?php foreach ($barang as $barang_item): ?>
                                <option value="<?= esc($barang_item['id']); ?>"><?= esc($barang_item['nama_barang']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="besar" class="form-label">Besar</label>
                        <input type="text" name="besar" class="form-control" required>
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

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="<?= base_url('paketlayanan/update/' . $paket['id'])  ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Paket Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="form-group">
                        <label for="edit-id_services" class="form-label">Nama Layanan</label>
                        <select name="id_services" id="id_services" class="form-control" data-live-search="true" required>
                            <?php foreach ($services as $service): ?>
                                <option value="<?= esc($service['id']); ?>"><?= esc($service['nama']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-id_barang" class="form-label">Nama Barang</label>
                        <select name="id_barang" id="edit-id_barang" class="form-control" data-live-search="true" required>
                            <?php foreach ($barang as $barang_item): ?>
                                <option value="<?= esc($barang_item['id']); ?>"><?= esc($barang_item['nama_barang']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-besar" class="form-label">Besar</label>
                        <input type="text" name="besar" id="edit-besar" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-photo_url" class="form-label">Foto</label>
                        <input type="file" name="photo_url" class="form-control" accept="image/*">
                    </div>
                    <!-- Gambar Foto jika ada -->
                    <div class="form-group">
                        <label for="currentImg" class="form-label">Foto Sebelumnya</label>
                        <img id="currentImg" src="" class="img-thumbnail" style="max-width: 100px; display: none;" alt="Foto Sebelumnya">
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

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
$(document).ready(function () {
    // Fungsi untuk menangani klik pada tombol Edit
    $('.edit-paket').on('click', function () {
        const id = $(this).data('id');  // Ambil ID Paket
        const idservices = $(this).data('idservices');  // Ambil ID Layanan
        const idbarang = $(this).data('idbarang');  // Ambil ID Barang
        const besar = $(this).data('besar');  // Ambil Besar
        const photourl = $(this).data('photourl');  // Ambil URL Foto

        $('#edit-id').val(id);  // Isi field ID
        $('#id_services').val(idservices);  // Isi field Layanan dengan ID layanan
        $('#edit-id_barang').val(idbarang);  // Isi field Barang dengan ID barang
        $('#edit-besar').val(besar);  // Isi field Besar

        // Periksa apakah ada foto dan tampilkan jika ada
        if (photourl && photourl.trim() !== "") {
            $('#edit-photo_url').val(photourl);  // Set field foto URL
            // Jika ingin menampilkan foto sebelumnya, Anda bisa menambahkan elemen gambar
            $('#currentImg').attr('src', '<?= base_url('uploads/') ?>' + photourl).show();
        } else {
            $('#edit-photo_url').val('');  // Jika tidak ada foto, biarkan kosong
            $('#currentImg').hide();  // Sembunyikan gambar jika tidak ada foto
        }
    });
});
</script>
