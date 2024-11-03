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
                                    <th>ID Invoice</th>
                                    <th>Permintaan</th>
                                    <th>Client</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($invoice as $dt) {
                                    // Hanya tampilkan invoice yang sesuai dengan id_surveyor
                                    if ($dt['id_surveyor'] == $current_user_id) { // Ganti $current_user_id dengan ID surveyor yang sesuai
                                        ?>
                                        <tr>
                                            <td><?= esc($dt['id']); ?></td>
                                            <td><?= esc($dt['request_description']); ?></td>
                                            <td><?= esc($dt['username']); ?></td>
                                            <td>
                                                <?php if ($dt['Status'] == 'unsurveyed'): ?>
                                                    <button class="btn btn-warning" onclick="startSurvey(<?= esc($dt['id']); ?>)">Survey</button>
                                                <?php else: ?>
                                                    <?= esc($dt['Status']); ?>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url('invoice/delete?id=' . esc($dt['id'])); ?>" class="delete" title="Delete">
                                                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } ?>
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
                <input type='hidden' name='harga' value='0'>
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

<script type="text/javascript" src="<?= base_url() ?>/assets/plugins/jquery/jquery-2.2.3.min.js"></script>
<script>
    function startSurvey(invoiceId) {
        // Logic untuk memulai survey
        alert('Mulai survey untuk Invoice ID: ' + invoiceId);
        // Anda dapat menambahkan panggilan AJAX atau redirect sesuai kebutuhan
    }
</script>
