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
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahData">
                            <i class="fa fa-plus"></i>
                            Tambah
                        </button>
                    </div>
                    <div class="box-body">
                        <?php if ((session()->getFlashdata('pesan') !== NULL)) {
                            echo session()->getFlashdata('pesan');
                        }  ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Kategori</th>                                    
                                    <th width="12%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $nom = 1;
                                foreach ($kategori as $dt) {
                                    echo '<pre>';
                                    print_r($dt);  // Debugging untuk melihat isi dari $dt
                                    echo '</pre>';
                                ?>
                                    <tr>
                                        <td width="5%" class="text-center"><?= $nom++; ?></td>
                                        <td><?= isset($dt['kategori']) ? $dt['kategori'] : 'Kategori tidak ada'; ?></td>
                                        <td class="text-center">
                                        <a data-toggle="modal" data-id="<?= $dt['id'] ?>" data-kategori="<?= $dt['kategori'] ?>" 
                                        href="#editData" class="edit-data" title="Edit Kategori">
                                        <button class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button></a>

                                        <a data-toggle="modal" data-id="<?= $dt['id'] ?>" data-kategori="<?= $dt['kategori'] ?>" 
                                        href="#hapusData" class="hapus-data" title="Hapus Kategori">
                                        <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a>
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

<!-- Tambah Data -->
<div class="modal fade" id="tambahData" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Kategori</h4>
            </div>
            <form class="form" method="post" action="<?= base_url() ?>simpankategori">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kategori </label>
                        <input type="text" class="form-control" name="kategori" placeholder="Masukan Kategori" required>
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

<!-- Edit Data -->
<div class="modal fade" id="editData" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Kategori</h4>
            </div>
            <form class="form" method="post" action="<?= base_url() ?>updatekategori">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kategori </label>
                        <input type="hidden" class="form-control" name="id" id="id">
                        <input type="text" class="form-control" name="kategori" id="kategori" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light ">
                        <i class="fa fa-save"></i>
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= base_url() ?>/assets/plugins/jquery/jquery-2.2.3.min.js"></script>
<script>
    $(document).ready(function() {
        $(document).on("click", ".edit-data", function() {
            var Kategori = $(this).data('kategori');
            var Id = $(this).data('id');

            $(".modal-body #kategori").val(Kategori);
            $(".modal-body #id").val(Id);
        });
    });
</script>
