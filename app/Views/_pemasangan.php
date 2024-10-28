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
                            Tambah Pemasangan
                        </button>
                    </div>
                    <div class="box-body">
                        <?php if (session()->getFlashdata('pesan') !== NULL) {
                            echo session()->getFlashdata('pesan');
                        } ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">Id Pemasangan</th>
                                    <th>Id Kontrak</th>
                                    <th>tanggal mulai</th>
                                    <th>tanggal selesai</th>
                                    <th>Status Pemasangan</th>
                                    <th>ID Teknisi</th>
                                    <th>Catatan Pemasangan</th>
                           
                                    <th width="12%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nom = 1;
                                foreach ($pemasangan as $dt) { ?>
                                    <tr>
                                        <td class="text-center"><?= esc($dt['id']); ?></td>
                                        <td><?= esc($dt['id_kontrak']); ?></td>
                                        <td><?= esc($dt['tanggal_mulai']); ?></td>
                                        <td><?= esc($dt['tanggal_selesai']); ?></td>
                                        <td><?= esc($dt['status_pemasangan']); ?></td>
                                        <td><?= esc($dt['id_teknisi']); ?></td>
                                        <td><?= esc($dt['catatan_pemasangan']); ?></td>
                                        <td class="text-center">
                                            <a data-toggle="modal" data-id="<?= esc($dt['id']) ?>" 
                                               data-id_kontrak="<?= esc($dt['id_kontrak']) ?>" 
                                               data-tanggal_mulai="<?= esc($dt['tanggal_mulai']) ?>" 
                                               data-tanggal_selesai="<?= esc($dt['tanggal_selesai']) ?>" 
                                               data-status_pemasangan="<?= esc($dt['status_pemasangan']) ?>" 
                                               data-id_teknisi="<?= esc($dt['id_teknisi']) ?>" 
                                               data-catatan_pemasangan="<?= esc($dt['catatan_pemasangan']) ?>" 
                                               href="#edit" class="edit-pemasangan" title="Edit Pemasangan">
                                                <button class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button>
                                            </a>
                                            <a href="<?= base_url('pemasangan/delete?id=' . esc($dt['id'])); ?>" class="delete" title="Delete">
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
                <h4 class="modal-title">Tambah Pemasangan</h4>
            </div>
            <form class="form" method="post" action="<?= base_url('pemasangan/save') ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_kontrak">Id kontrak</label>
                        <select id="id_kontrak" name="id_kontrak" required>
                            <?php foreach ($Id_kontrak as $kontrak): ?>
                                <option value="<?= esc($kontrak['id']); ?>"><?= esc($kontrak['id']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" class="form-control" name="tanggal_mulai" placeholder="Tanggal Mulai" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_selesai">Tanggal Selesai</label>
                        <input type="date" class="form-control" name="tanggal_selesai" placeholder="Tanggal Selesai" required>
                    </div>
                    <div class="form-group">
                        <label for="status_pemasangan">Role</label>
                        <select class="form-control" name="status_pemasangan" id="status_pemasangan" required>
                            <option value="">Pilih Status</option>
                            <option value="selesai">Selesai</option>
                            <option value="Proses Pengerjaan">Proses Pengerjaan</option>
                            <option value="Belum Ada Pengerjaan">Belum Ada Pengerjaan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_teknisi">Id Teknisi</label>
                        <select id="id_teknisi" name="id_teknisi" required>
                            <?php foreach ($Id_teknisi as $teknisi): ?>
                                <option value="<?= esc($teknisi['id']); ?>"><?= esc($teknisi['id']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="catatan_pemasangan">Catatan Pemasangan</label>
                        <input type="text" class="form-control" name="catatan_pemasangan" placeholder="Masukkan Catatan Pemasangan" required>
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
                <h4 class="modal-title">Edit Pemasangan</h4>
            </div>
            <form class="form" method="post" action="<?= base_url('pemasangan/edit') ?>">
                <input type="hidden" name="id" id="id_edit">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_kontrak">Id kontrak</label>
                        <select id="id_kontrak_edit" name="id_kontrak" required>
                            <?php foreach ($Id_kontrak as $kontrak): ?>
                                <option value="<?= esc($kontrak['id']); ?>"><?= esc($kontrak['id']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai" placeholder="Tanggal Mulai" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_selesai">Tanggal Selesai</label>
                        <input type="date" class="form-control" name="tanggal_selesai" id="tanggal_selesai" placeholder="Tanggal Selesai" required>
                    </div>
                    <div class="form-group">
                        <label for="status_pemasangan">Role</label>
                        <select class="form-control" name="status_pemasangan" id="spe" required>
                            <option value="">Pilih Status</option>
                            <option value="Selesai">Selesai</option>
                            <option value="proses">Proses Pengerjaan</option>
                            <option value="Belum Ada Pengerjaan">Belum Ada Pengerjaan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_teknisi">Id Teknisi</label>
                        <select id="id_teknisi_edit" name="id_teknisi" required>
                            <?php foreach ($Id_teknisi as $teknisi): ?>
                                <option value="<?= esc($teknisi['id']); ?>"><?= esc($teknisi['id']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="catatan_pemasangan">Catatan Pemasangan</label>
                        <input type="text" class="form-control" name="catatan_pemasangan" id="catatan_pemasangan" placeholder="Masukkan Catatan Pemasangan" required>
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
        $(document).on("click", ".edit-pemasangan", function() {
            var id = $(this).data('id');
            var id_kontrak = $(this).data('id_kontrak');
            var tanggal_mulai = $(this).data('tanggal_mulai');
            var tanggal_selesai = $(this).data('tanggal_selesai');
            var status_pemasangan = $(this).data('status_pemasangan');
            var id_teknisi = $(this).data('id_teknisi');
            var catatan_pemasangan = $(this).data('catatan_pemasangan');

            $('#id_edit').val(id);
            $('#id_kontrak_edit').val(id_kontrak);
            $('#tanggal_mulai').val(tanggal_mulai);
            $('#tanggal_selesai').val(tanggal_selesai);
            $('#spe').val(status_pemasangan);
            $('#id_teknisi_edit').val(id_teknisi);
            $('#catatan_pemasangan').val(catatan_pemasangan);
        });
    });
</script>
