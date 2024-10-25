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
                            Tambah Survei
                        </button>
                    </div>
                    <div class="box-body">
                        <?php if (session()->getFlashdata('pesan') !== NULL) {
                            echo session()->getFlashdata('pesan');
                        } ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">ID Survei</th>
                                    <th>ID Surveyors</th>
                                    <th>Tanggal Survei</th>
                                    <th>Jenis Instalasi</th>
                                    <th>Kebutuhan Material</th>
                                    <th>Estimasi Waktu</th>
                                    <th>Catatan Hasil Survei</th>
                                    <th width="12%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nom = 1;
                                foreach ($hasil_survei as $dt) { ?>
                                    <tr>
                                        <td class="text-center"><?= esc($dt['id']); ?></td>
                                        <td><?= esc($dt['id_surveyors']); ?></td>
                                        <td><?= esc($dt['Tanggal_survei']); ?></td>
                                        <td><?= esc($dt['Jenis_instalasi']); ?></td>
                                        <td><?= esc($dt['kebutuhan_material']); ?></td>
                                        <td><?= esc($dt['estimasi_waktu']); ?></td>
                                        <td><?= esc($dt['catatan_hasil_survei']); ?></td>
                                        <td class="text-center">
                                            <a data-toggle="modal" data-id="<?= esc($dt['id']) ?>" 
                                               data-id_surveyors="<?= esc($dt['id_surveyors']) ?>" 
                                               data-tanggal_survei="<?= esc($dt['Tanggal_survei']) ?>" 
                                               data-jenis_instalasi="<?= esc($dt['Jenis_instalasi']) ?>" 
                                               data-kebutuhan_material="<?= esc($dt['kebutuhan_material']) ?>" 
                                               data-estimasi_waktu="<?= esc($dt['estimasi_waktu']) ?>" 
                                               data-catatan_hasil_survei="<?= esc($dt['catatan_hasil_survei']) ?>" 
                                               href="#edit" class="edit-survei" title="Edit Survei">
                                                <button class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button>
                                            </a>
                                            <a href="<?= base_url('survei/delete?id=' . esc($dt['id'])); ?>" class="delete" title="Delete">
                                                <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Tambah survei -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Survei</h4>
            </div>
            <form class="form" method="post" action="<?= base_url('survey/save') ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_surveyors">ID Surveyor</label>
                        <select id="id_surveyors" name="id_surveyors" required>
                            <?php foreach ($surveyors as $surveyor): ?>
                                <option value="<?= esc($surveyor['id']); ?>"><?= esc($surveyor['id']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Tanggal_survei">Tanggal Survei</label>
                        <input type="date" class="form-control" name="Tanggal_survei" placeholder="Masukkan Tanggal Survei" required>
                    </div>
                    <div class="form-group">
                        <label for="Jenis_instalasi">Jenis Instalasi</label>
                        <input type="text" class="form-control" name="Jenis_instalasi" placeholder="Masukkan Jenis Instalasi" required>
                    </div>
                    <div class="form-group">
                        <label for="kebutuhan_material">Kebutuhan Material</label>
                        <input type="text" class="form-control" name="kebutuhan_material" placeholder="Masukkan Kebutuhan Material" required>
                    </div>
                    <div class="form-group">
                        <label for="estimasi_waktu">Estimasi Waktu</label>
                        <input type="text" class="form-control" name="estimasi_waktu" placeholder="Masukkan Estimasi Waktu" required>
                    </div>
                    <div class="form-group">
                        <label for="catatan_hasil_survei">Catatan Hasil Survei</label>
                        <input type="text" class="form-control" name="catatan_hasil_survei" placeholder="Masukkan Catatan Hasil Survei" required>
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

<!-- Edit survei -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Survei</h4>
            </div>
            <form class="form" method="post" action="<?= base_url('survey/edit') ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_surveyors">ID Surveyor</label>
                        <input type="hidden" name="id" id="id">
                        <select id="id_surveyors" name="id_surveyors" required>
                            <?php foreach ($surveyors as $surveyor): ?>
                                <option value="<?= esc($surveyor['id']); ?>"><?= esc($surveyor['id']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Tanggal_survei">Tanggal Survei</label>
                        <input type="date" class="form-control" name="Tanggal_survei" id="Tanggal_survei" placeholder="Masukkan Tanggal Survei" required>
                    </div>
                    <div class="form-group">
                        <label for="Jenis_instalasi">Jenis Instalasi</label>
                        <input type="text" class="form-control" name="Jenis_instalasi" id="Jenis_instalasi" placeholder="Masukkan Jenis Instalasi" required>
                    </div>
                    <div class="form-group">
                        <label for="kebutuhan_material">Kebutuhan Material</label>
                        <input type="text" class="form-control" name="kebutuhan_material" id="kebutuhan_material" placeholder="Masukkan Kebutuhan Material" required>
                    </div>
                    <div class="form-group">
                        <label for="estimasi_waktu">Estimasi Waktu</label>
                        <input type="text" class="form-control" name="estimasi_waktu" id="estimasi_waktu" placeholder="Masukkan Estimasi Waktu" required>
                    </div>
                    <div class="form-group">
                        <label for="catatan_hasil_survei">Catatan Hasil Survei</label>
                        <input type="text" class="form-control" name="catatan_hasil_survei" id="catatan_hasil_survei" placeholder="Masukkan Catatan Hasil Survei" required>
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
        $('.edit-survei').on('click', function() {
            var id = $(this).data('id');
            var id_surveyors = $(this).data('id_surveyors');
            var tanggal_survei = $(this).data('tanggal_survei');
            var jenis_instalasi = $(this).data('jenis_instalasi');
            var kebutuhan_material = $(this).data('kebutuhan_material');
            var estimasi_waktu = $(this).data('estimasi_waktu');
            var catatan_hasil_survei = $(this).data('catatan_hasil_survei');

            $('#id').val(id);
            $('#id_surveyors').val(id_surveyors);
            $('#Tanggal_survei').val(tanggal_survei);
            $('#Jenis_instalasi').val(jenis_instalasi);
            $('#kebutuhan_material').val(kebutuhan_material);
            $('#estimasi_waktu').val(estimasi_waktu);
            $('#catatan_hasil_survei').val(catatan_hasil_survei);
        });
    });
</script>
