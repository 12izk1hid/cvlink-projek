<!--
<div class="content-wrapper">
   Content Header (Page header) 
    <section class="content-header">
        <h1>
            Dashboard
            <small><?= $title ?></small>
        </h1>
    </section>
 Main content 
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
                                    <th width="5%">id</th>
                                    <th>UserName</th>
                                    <th>Nama</th>
                                    <th>Password</th>
                                    <th>Level User</th>
                                    <th>Aktif</th>
                                    <th width="12%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nom = 1;

                                foreach ($user as $dt) { ?>
                                    <tr>
                                        <td width="5%" name="id" class="text-center"><?= $nom++; ?></td>
                                        <td><?= $dt['username'] ?></td>
                                        <td><?= $dt['nama']; ?></td>
                                        <td><?= $dt['password']; ?></td>
                                        <td><?= $dt['level']; ?></td>
                                        <td><?= $dt['aktif']; ?></td>
                                        <td width="8%" class="text-center">
                                            <a data-toggle="modal" data-id="<?= $dt['id'] ?>" data-username="<?= $dt['username'] ?>" data-nama="<?= $dt['nama'] ?>" data-password="<?= $dt['password'] ?>" data-id_level="<?= $dt['id_level'] ?>" href="#editData" class="edit-data" title="Edit User"><button class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button></a>
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
                <h4 class="modal-title">Tambah User</h4>
            </div>
            <form class="form" method="post" action="<?= base_url() ?>/user">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">User Name </label>
                        <input type="text" class="form-control" name="username" placeholder="Masukan Username" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama User </label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukan Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Pasword </label>
                        <input type="password" class="form-control" name="password" placeholder="Masukan passowrd" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Level User </label>
                        <select class="form-control" name="id_level" required>
                            <option value="">..:: Pilih Level User ::..</option>
                            <?php foreach ($level as $dt) { ?>
                                <option value="<?= $dt['id_level'] ?>"> <?= $dt['level'] ?></option>
                            <?php } ?>
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

<!-- Edit Data -->
<div class="modal fade" id="editData" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit User</h4>
            </div>
            <form class="form" method="post" action="<?= base_url() ?>updateuser">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">User Name </label>
                        <input type="hidden" class="form-control" name="id" id="id">
                        <input type="text" class="form-control" name="username" id="username" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama User </label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukan Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Pasword </label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Masukan passowrd" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Level User </label>
                        <select class="form-control" name="id_level" id="id_level" required>
                            <option value="">..:: Pilih Level User ::..</option>
                            <?php foreach ($level as $dt) { ?>
                                <option value="<?= $dt['id_level'] ?>"> <?= $dt['level'] ?></option>
                            <?php } ?>
                        </select>
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
            var Username = $(this).data('username');
            var Nama = $(this).data('nama');
            var Password = $(this).data('password');
            var Id_level = $(this).data('id_level');
            var Id = $(this).data('id');

            $(".modal-body #username").val(Username);
            $(".modal-body #nama").val(Nama);
            $(".modal-body #password").val(password);
            $(".modal-body #id_level").val(Id_level);
            $(".modal-body #id").val(Id);
        });
    });
</script>