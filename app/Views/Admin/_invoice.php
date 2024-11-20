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
                            Tambah Invoice
                        </button>
                    </div>
                    <div class="box-body">
                        <?php if (session()->getFlashdata('pesan') !== NULL) {
                            echo session()->getFlashdata('pesan');
                        } ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Surveyor</th>
                                    <th>Teknisi</th>
                                    <th width="12%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nom = 1;
                                foreach ($invoice as $dt) { ?>
                                    <tr>
                                        <td><?= esc($dt['id']); ?></td>
                                        <td><?= esc($dt['nama_user']) ?></td>
                                        <td><?= esc($dt['harga']); ?></td>
                                        <td><?= esc($dt['Status']); ?></td>
                                        <td><?= isset($dt['teknisi']) ? $dt['teknisi'] : 'Belum Ditentukan'; ?></td>
                                        <td><?= isset($dt['surveyor']) ? $dt['surveyor'] : 'Belum Ditentukan'; ?></td>
                                        <td class="text-center">
                                            <a data-id="<?= esc($dt['id']) ?>" 
                                                data-username="<?= esc($dt['username']) ?>"
                                                data-harga="<?= esc($dt['harga']) ?>" 
                                                data-status="<?= esc($dt['Status']) ?>"
                                                data-teknisi="<?= isset($dt['id_teknisi']) ? $dt['id_teknisi'] : ''; ?>" 
                                                data-surveyor="<?= isset($dt['id_surveyor']) ? $dt['id_surveyor'] : ''; ?>" 
                                                href="#edit" class="edit-invoice" title="Edit Invoice">
                                                <button class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button>
                                            </a>
                                            <a href="<?= base_url('invoice/delete?id=' . esc($dt['id'])); ?>" class="delete" title="Delete">
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

<!-- Modal Tambah Invoice -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Invoice</h4>
            </div>
            <form class="form" method="post" action="<?= base_url('invoice/save') ?>">
                <input type='hidden' name='harga' value='0' >
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user_id">Client</label>
                        <select class="form-control" name="username" id="user_id" required>
                            <?php foreach($clients as $client) { ?>
                                <option value="<?= $client['username'] ?>"><?= $client['nama'] ?></option>
                            <?php } ?>
                        </select>   
                    </div>
                    <div class="form-group">
                        <label for="teknisi">Teknisi</label>
                        <select class="form-control" name="teknisi" id="teknisi" required>
                            <option value="">Not Defined</option>
                            <?php foreach($technicians as $technician) { ?>
                                <option value="<?= $technician['username'] ?>"><?=  $technician['nama'] ?></option>
                            <?php } ?>
                        </select>                      
                     </div>
                     <div class="form-group">
                        <label for="surveyor">Surveyor</label>
                        <select class="form-control" name="surveyor" id="surveyor">
                            <option value="">Not Defined</option>
                            <?php foreach($surveyors as $surveyor) { ?>
                                <option value="<?= $surveyor['username'] ?>"><?=  $surveyor['nama'] ?></option>
                            <?php } ?>
                        </select>                      
                     </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input id='status' name='status' readonly value='unsurveyed' class='form-control'>
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

<!-- Edit Invoice -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Invoice</h4>
            </div>
            <form class="form" method="post" action="<?= base_url('invoice/update') ?>">
             <input type="hidden"name="id" id='edit_id' readonly>

                <div class="modal-body">
                    <div class="form-group">
                        <label for='username'>Client</label>
                        <input type="text" id="edit_username" readonly class='form-control'>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" id="harga_edit" class="form-control" name="harga" placeholder="Harga" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_teknisi">Teknisi</label>
                        <select class="form-control" name="teknisi" id="edit_teknisi" required>
                            <option value="">Not Defined</option>
                            <?php foreach($technicians as $technician) { ?>
                                <option value="<?= $technician['username'] ?>"><?=  $technician['nama'] ?></option>
                            <?php } ?>
                        </select>                      
                     </div>
                     <div class="form-group">
                        <label for="edit_surveyor">Surveyor</label>
                        <select class="form-control" name="surveyor" id="edit_surveyor">
                            <option value="">Not Defined</option>
                            <?php foreach($surveyors as $surveyor) { ?>
                                <option value="<?= $surveyor['username'] ?>"><?=  $surveyor['nama'] ?></option>
                            <?php } ?>
                        </select>                      
                     </div>
                    <div class="form-group">
                        <label for="Status">Status</label>
                        <select class="form-control" name="status" id="status_edit" required>
                            <option value="">Pilih Role</option>
                            <option value="selesai">Selesai</option>
                            <option value="pending">Pending</option> 
                            <option value="unsurveyed">Belum di Survey</option> 
                        </select>                      
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
        $('.edit-invoice').on('click', function() {
            var id = $(this).data('id')
            var harga = $(this).data('harga')
            var status = $(this).data('status')
            var username = $(this).data('username')
            var surveyor = $(this).data('surveyor')
            var teknisi = $(this).data('teknisi')

            $('#edit_id').val(id);
            $('#harga_edit').val(harga);
            $('#status_edit').val(status)
            $('#edit_username').val(username)
            $('#edit_surveyor').val(surveyor)
            $('#edit_teknisi').val(teknisi)

            $('#edit').modal('show');
        });
    });

</script>
