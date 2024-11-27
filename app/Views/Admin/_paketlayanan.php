<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

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
                                                    data-id="<?= esc($paket['id']); ?>" 
                                                    data-id-services="<?= esc($paket['id_services']); ?>"
                                                    data-id-barang="<?= esc($paket['id_barang']); ?>" 
                                                    data-besar="<?= esc($paket['besar']); ?>"
                                                    data-photo-url="<?= esc($paket['photo_url']); ?>"
                                                    data-bs-toggle="modal" data-bs-target="#editModal">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <a href="<?= base_url('paket/delete/' . esc($paket['id'])); ?>" 
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
                                <option value="<?= esc($barang_item['id']); ?>"><?= esc($barang_item['nama']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="besar" class="form-label">Besar</label>
                        <input type="text" name="besar" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="photo_url" class="form-label">Foto</label>
                        <input type="file" name="photo_url" class="form-control" accept="image/*">
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
            <form method="post" action="<?= base_url('paket/update') ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Paket Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="form-group">
                        <label for="edit-id_services" class="form-label">Nama Layanan</label>
                        <select name="id_services" id="edit-id_services" class="form-control selectpicker" data-live-search="true" required>
                            <?php foreach ($services as $service): ?>
                                <option value="<?= esc($service['id']); ?>"><?= esc($service['nama']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-id_barang" class="form-label">Nama Barang</label>
                        <select name="id_barang" id="edit-id_barang" class="form-control selectpicker" data-live-search="true" required>
                            <?php foreach ($barang as $barang_item): ?>
                                <option value="<?= esc($barang_item['id']); ?>"><?= esc($barang_item['nama']); ?></option>
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
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 
<script>
$(document).ready(function () {
    $('.selectpicker').selectpicker();
    $('.edit-paket').on('click', function () {
        $('#edit-id').val($(this).data('id'));
        $('#edit-id_services').val($(this).data('id-services')).selectpicker('refresh');
        $('#edit-id_barang').val($(this).data('id-barang')).selectpicker('refresh');
        $('#edit-besar').val($(this).data('besar'));
        $('#edit-photo_url').val($(this).data('photo-url'));
    });
});
</script> -->
