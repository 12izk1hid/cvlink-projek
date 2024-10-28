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
                                    <th>ID Kontrak</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th width="12%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nom = 1;
                                foreach ($invoice as $dt) { ?>
                                    <tr>
                                        <td><?= esc($dt['id_kontrak']); ?></td>
                                        <td><?= esc($dt['harga']); ?></td>
                                        <td><?= esc($dt['Status']); ?></td>
                                        <td class="text-center">
                                            <a data-id_kontrak="<?= esc($dt['id_kontrak']) ?>" 
                                               data-harga="<?= esc($dt['harga']) ?>" 
                                               data-status="<?= esc($dt['Status']) ?>" 
                                               href="#edit" class="edit-invoice" title="Edit Invoice">
                                                <button class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button>
                                            </a>
                                            <a href="<?= base_url('invoice/delete?id_kontrak=' . esc($dt['id_kontrak'])); ?>" class="delete" title="Delete">
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
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_kontrak">ID Kontrak</label>
                        <select id="id_kontrak" name="id_kontrak" onchange="fetchHarga(this.value)" required>
                            <?php foreach ($kontrak as $k): ?>
                                <option value="<?= esc($k['id']); ?>"><?= esc($k['id']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" id="harga" class="form-control" name="harga" placeholder="Harga" readonly required>
                    </div>

                    <div class="form-group">
                        <label for="Status">Status</label>
                        <select class="form-control" name="status" id="Status" required>
                            <option value="">Pilih Status</option>
                            <option value="selesai">Selesai</option>
                            <option value="pending">Pending</option> 
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

<!-- Edit Invoice -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Invoice</h4>
            </div>
            <form class="form" method="post" action="<?= base_url('invoice/update') ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_kontrak">ID Kontrak</label>
                        <input type="text" id="id_kontrak_edit" name="id_kontrak" readonly class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" id="harga_edit" class="form-control" name="harga" placeholder="Harga" required>
                    </div>
                    <div class="form-group">
                        <label for="Status">Status</label>
                 
                        <select class="form-control" name="status" id="status" required>
                            <option value="">Pilih Role</option>
                            <option value="selesai">Selesai</option>
                            <option value="pending">Pending</option> 
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
            var id_kontrak = $(this).data('id_kontrak');
            var harga = $(this).data('harga');
            var status = $(this).data('status');

            $('#id_kontrak_edit').val(id_kontrak);
            $('#harga_edit').val(harga);
            $('#status').val(status)

            $('#edit').modal('show');
        });
    });

</script>
