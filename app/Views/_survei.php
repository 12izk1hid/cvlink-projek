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
                                    <th width="5%">id survei</th>
                                
                                    <th>id Surveyors</th>
                                    <th>Tanggal_survei</th>
                                    <th>Jenis_instalasi</th>
                                    <th>kebutuhan_material</th>
                                    <th>estimasi_waktu</th>
                                    <th>catatan_hasil_survei</th>
                                    
                                    <th width="12%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nom = 1;
                                foreach ($hasil_survei as $dt) { ?>
                                    <tr>
                                        <td <?= esc($dt['id']);?> width="5%"  class="text-center"><?= $nom++; ?></td>
                                        <td><?= esc($dt['id_surveyors']); ?></td>
                                        <td><?= esc($dt['Tanggal_survei']); ?></td>
                                        <td><?= esc($dt['Jenis_instalasi']); ?></td>
                                        <td><?= esc($dt['kebutuhan_material']); ?></td>
                                        <td><?= esc($dt['estimasi_waktu']); ?></td>
                                        <td><?= esc($dt['catatan_hasil_survei']); ?></td>
                                        <td width="8%" class="text-center">
                                            <a data-toggle="modal" data-id="<?= $dt['id'] ?>" data-id_surveyors="<?= esc($dt['id_surveyors']) ?>" data-tanggal_survei="<?= esc($dt['Tanggal_survei']) ?>" 
                                            data-jenis_instalasi="<?= $dt['Jenis_instalasi'] ?>" data-kebutuhan_material="<?= esc($dt['kebutuhan_material']) ?>" data-estimasi_waktu="<?= esc($dt['estimasi_waktu']) ?>" 
                                            data-catatan_hasil_survei="<?= esc($dt['catatan_hasil_survei']) ?>" href="#edit" class="edit-survei" title="Edit Survei">
                                            <button class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button>
                                            </a>
                                            <a href="<?= base_url('survei/delete?id=' . $dt['id']); ?>" class="delete" title="Delete">
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
                        <label for="id_surveyors" id="id_surveyors" >ID Surveyor</label>
                        <select  id="id_surveyors" name="id_surveyors">
                        <?php foreach ($surveyors as $surveyor): ?>
                            <option value="<?= $surveyor['id']; ?>"><?= $surveyor['id']; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Tanggal_survei">Tanggal Survei</label>
                        <input type="date" class="form-control" name="Tanggal_survei" placeholder="Masukkan Tanggal survei" required>
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
                        <input type="text" class="form-control" name="id_surveyors" id ="id_surveyors" placeholder="ID Surveyor" required>
                    </div>
                    <div class="form-group">
                        <label for="Tanggal_survei">Tanggal Survei</label>
                        <input type="date" class="form-control"   name="Tanggal_survei" id ="Tanggal_survei" placeholder="Masukan Tanggal survei" required>
                    </div>
                    <div class="form-group">
                        <label for="Jenis_instalasi">Jenis Instalasi</label>
                        <input type="text" class="form-control"  name="Jenis_instalasi" id ="Jenis_instalasi" placeholder="Masukan Jenis Instalasi" required>
                    </div>
                    <div class="form-group">
                        <label for="Kebutuhan_material">Kebutuhan Material</label>
                        <input type="text" class="form-control"   name="kebutuhan_material" id ="kebutuhan_material" placeholder="Masukan Kebutuhan Material" required>
                    </div>
                    <div class="form-group">
                        <label for="estimasi_waktu">estimasi_waktu</label>
                        <input type="text" class="form-control" name="estimasi_waktu" id ="estimasi_waktu" placeholder="Masukan Estimasi Waktu" required>
                    </div>
                    <div class="form-group">
                        <label for="catatan_hasil_survei">Catatan Hasil Survei</label>
                        <input type="text" class="form-control" name="catatan_hasil_survei" id ="catatan_hasil_survei" placeholder="Masukan Catatan Hasil Survei" required>
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
        $(document).on("click", ".edit-survei", function() {
          var id = $(this).data('id');
            var id_surveyors= $(this).data('id_surveyors');
            var date = $(this).data('tanggal_survei')
            var Jenis_instalasi = $(this).data('jenis_instalasi');
            var kebutuhan_material = $(this).data('kebutuhan_material');
            var estimasi_waktu = $(this).data('estimasi_waktu');
            var catatan_hasil_survei = $(this).data('catatan_hasil_survei');
      $(".modal-body #id").val(id);
            $(".modal-body #id_surveyors").val(id_surveyors);
            $(".modal-body #Tanggal_survei").val(date);
            $(".modal-body #Jenis_instalasi").val(Jenis_instalasi);
            $(".modal-body #kebutuhan_material").val(kebutuhan_material);
            $(".modal-body #estimasi_waktu").val(estimasi_waktu);
            $(".modal-body #catatan_hasil_survei").val(catatan_hasil_survei);
            // Tampilkan modal edit
            $('#edit').modal('show');
        });
    });
</script>
