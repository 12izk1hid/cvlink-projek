<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <h1>
            Service
            <small><?= htmlspecialchars($title) ?></small>
        </h1>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambah">
                            <i class="fa fa-plus"></i> Tambah Jasa
                        </button>
                    </div>
                    <div class="box-body">
                        <?= session()->getFlashdata('pesan') ?? ''; ?>
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
                            <?php foreach ($services as $service): ?>
                                <tr>
                                    <td><?= htmlspecialchars($service['nama']) ?></td>
                                    <td><?= htmlspecialchars($service['deskripsi']) ?></td>
                                    <td><?= number_format($service['harga'], 0, ',', '.') ?></td>
                                    <td>
                                        <?php if (!empty($service['img_url']) && file_exists(FCPATH . $service['img_url'])): ?>
                                            <img src="<?= base_url($service['img_url']) ?>" 
                                                class="img-fluid rounded" 
                                                alt="<?= htmlspecialchars($service['nama']) ?>" 
                                                style="width: 40px; height: 40px; object-fit: cover;">
                                        <?php else: ?>
                                            <!-- Gambar default jika img_url kosong atau gambar tidak ditemukan -->
                                            <div style="width: 40px; height: 40px; background-color: #ccc; display: flex; align-items: center; justify-content: center;">
                                                <span><?= htmlspecialchars($service['nama'])[0] ?></span> <!-- Menampilkan huruf pertama dari nama -->
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <button 
                                            class="btn btn-sm btn-success edit-service" 
                                            data-toggle="modal" 
                                            data-target="#edit"
                                            data-id="<?= $service['id'] ?>"
                                            data-nama="<?= htmlspecialchars($service['nama']) ?>"
                                            data-deskripsi="<?= htmlspecialchars($service['deskripsi']) ?>"
                                            data-harga="<?= $service['harga'] ?>"
                                            data-img_url="<?= htmlspecialchars($service['img_url']) ?>"
                                            title="Edit Jasa">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <a href="<?= base_url('service/delete/' . $service['id']) ?>" 
                                        class="delete" 
                                        title="Delete" 
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus jasa ini?');">
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

<!-- Tambah Data Jasa Modal -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="tambahLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="tambahLabel">Tambah Jasa</h4>
            </div>
            <form method="post" action="<?= base_url('services/save') ?>" enctype="multipart/form-data">
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
                        <label for="foto">Foto Jasa</label>
                        <input type="file" class="form-control-file" id="foto" name="foto" accept="image/png, image/jpeg" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Data Jasa Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="editLabel">Edit Jasa</h4>
            </div>
            <form method="post" action="<?= base_url('services/update') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama Jasa</label>
                        <input type="hidden" class="form-control" name="id" id="id">  <!-- Hidden input untuk ID -->
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
                        <label for="foto">Foto Jasa</label>
                        <input type="file" class="form-control-file" id="foto" name="foto" accept="image/png, image/jpeg">
                        <small>Biarkan kosong jika tidak ingin mengganti foto.</small>
                        <div class="mt-3">
                            <!-- Gambar yang ditampilkan di modal -->
                            <img id="currentImg" src="" alt="Foto Saat Ini" width="100" style="display: none;">
                        </div>
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



<!-- JavaScript -->
<script>
$(document).ready(function() {
    $(document).on("click", ".edit-service", function() {
        const id = $(this).data('id');
        const nama = $(this).data('nama');
        const deskripsi = $(this).data('deskripsi');
        const harga = $(this).data('harga');
        const img_url = $(this).data('img_url');

        // Isi input form dengan data yang diterima
        $("#id").val(id);  // Isi input dengan ID
        $("#nama").val(nama);  // Isi input nama
        $("#deskripsi").val(deskripsi);  // Isi input deskripsi
        $("#harga").val(harga);  // Isi input harga

        // Periksa apakah img_url ada dan file gambar ditemukan
        if (img_url && img_url.trim() !== "") {
            $("#currentImg").attr("src", "<?= base_url('assets/images/') ?>" + img_url);
            $("#currentImg").show();  // Tampilkan gambar jika img_url ada
        } else {
            $("#currentImg").hide();  // Sembunyikan gambar jika img_url kosong
        }
    });
});
</script>
