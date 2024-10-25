<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small><?= $title ?></small>
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
                            Tambah Kontrak
                        </button>
                    </div>
                    <div class="box-body">
                        <?php if (session()->getFlashdata('pesan') !== NULL) {
                            echo session()->getFlashdata('pesan');
                        } ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">ID Kontrak</th>
                                    <th>ID Hasil Survei</th>
                                    <th>ID Klien</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Harga</th>
                                    <th width="12%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($kontrak as $dt): ?>
                                    <tr>
                                        <td class="text-center"><?= esc($dt['id']); ?></td> <!-- Ambil ID dari database -->
                                        <td><?= esc($dt['id_hasil_survei']); ?></td>
                                        <td><?= esc($dt['id_klien']); ?></td>
                                        <td><?= esc($dt['created_at']); ?></td>
                                        <td><?= esc($dt['updated_at']); ?></td>
                                        <td><?= esc($dt['harga']); ?></td>
                                        <td width="8%" class="text-center">
                                            <a data-toggle="modal" data-id="<?= esc($dt['id']) ?>" 
                                               data-id_hasil_survei="<?= esc($dt['id_hasil_survei']) ?>" 
                                               data-id_klien="<?= esc($dt['id_klien']) ?>" 
                                               data-created_at="<?= esc($dt['created_at']) ?>" 
                                               data-updated_at="<?= esc($dt['updated_at']) ?>" 
                                               data-harga="<?= esc($dt['harga']) ?>" 
                                               href="#edit" class="edit-kontrak" title="Edit kontrak">
                                                <button class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button>
                                            </a>
                                            <a href="<?= base_url('kontrak/delete?id=' . esc($dt['id'])); ?>" class="delete" title="Delete">
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

<!-- Tambah kontrak -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Kontrak</h4>
            </div>
            <form class="form" method="post" action="<?= base_url('kontrak/save') ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_hasil_survei">ID Hasil Survei</label>
                        <select id="id_hasil_survei" name="id_hasil_survei" required>
                            <?php foreach ($id_hasil_survei as $survei): ?>
                                <option value="<?= esc($survei['id']); ?>"><?= esc($survei['id']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_klien">ID klien</label>
                        <select id="id_klien" name="id_klien" required>
                        <?php foreach ($kliens as $klien): ?>
                                <option value="<?= esc($klien['id']); ?>"><?= esc($klien['id']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="created_at">Created At</label>
                        <input type="date" class="form-control" name="created_at" required>
                    </div>
                    <div class="form-group">
                        <label for="updated_at">Updated At</label>
                        <input type="date" class="form-control" name="updated_at" required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control" name="harga" required>
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

<!-- Edit kontrak -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Kontrak</h4>
            </div>
            <form class="form" method="post" action="<?= base_url('kontrak/edit') ?>">
                <div class="modal-body">
                <div class="form-group">
                        <label for="id_hasil_survei">ID Hasil Survei</label>
                        <input type="hidden" name="id" id="id">
                        <select id="id_hasil_survei" name="id_hasil_survei" required>
                            <?php foreach ($id_hasil_survei as $survei): ?>
                                <option value="<?= esc($survei['id']); ?>"><?= esc($survei['id']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_klien">ID klien</label>
                        <input type="hidden" name="id" id="id">
                        <select id="id_klien" name="id_klien" required>
                        <?php foreach ($kliens as $klien): ?>
                                <option value="<?= esc($klien['id']); ?>"><?= esc($klien['id']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="created_at">Created At</label>
                        <input type="date" class="form-control" name="created_at" id="created_at" required>
                    </div>
                    <div class="form-group">
                        <label for="updated_at">Updated At</label>
                        <input type="date" class="form-control" name="updated_at" id="updated_at" required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control" name="harga" id="harga" required>
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

<script type="text/javascript" src="<?= base_url() ?>/assets/plugins/jquery/jquery-2.2.3.min.js"></script>
<script>
    $(document).ready(function() {
        $(document).on("click", ".edit-kontrak", function() {
            var id = $(this).data('id');
            var id_hasil_survei = $(this).data('id_hasil_survei');
            var id_klien = $(this).data('id_klien');
            var created_at = $(this).data('created_at');
            var updated_at = $(this).data('updated_at');
            var harga = $(this).data('harga');

            // Mengisi data ke modal edit
            $(".modal-body #id").val(id);
            $(".modal-body #id_hasil_survei").val(id_hasil_survei);
            $(".modal-body #id_klien").val(id_klien);
            $(".modal-body #created_at").val(created_at);
            $(".modal-body #updated_at").val(updated_at);
            $(".modal-body #harga").val(harga);
       
            // Tampilkan modal edit
            $('#edit').modal('show');
        });
    });
</script>
