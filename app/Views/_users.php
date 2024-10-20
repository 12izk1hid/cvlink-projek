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
                            Tambah User
                        </button>
                    </div>
                    <div class="box-body">
                        <?php if (session()->getFlashdata('pesan') !== NULL) {
                            echo session()->getFlashdata('pesan');
                        } ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">id</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Alamat</th>
                                    <th>Email</th>
                                    <th>No HP</th>
                                    <th>Role</th>
                                    <th width="12%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nom = 1;
                                foreach ($users as $dt) { ?>
                                    <tr>
                                        <td <?= esc($dt['id']); ?> width="5%" class="text-center"><?= $nom++; ?></td>
                                        <td><?= esc($dt['nama']); ?></td>
                                        <td><?= esc($dt['username']); ?></td>
                                        <td><?= esc($dt['password']); ?></td>
                                        <td><?= esc($dt['alamat']); ?></td>
                                        <td><?= esc($dt['email']); ?></td>
                                        <td><?= esc($dt['no_hp']); ?></td>
                                        <td><?= esc($dt['role']); ?></td>
                                        <td width="8%" class="text-center">
                                            <a data-toggle="modal" data-id="<?= $dt['id'] ?>" data-nama="<?= esc($dt['nama']) ?>" data-username="<?= esc($dt['username']) ?>" data-password="<?= esc($dt['password']) ?>" data-alamat="<?= esc($dt['alamat']) ?>" data-email="<?= esc($dt['email']) ?>" data-no_hp="<?= esc($dt['no_hp']) ?>" data-role="<?= esc($dt['role']) ?>"  href="#edit" class="edit-user" title="Edit User">
                                                <button class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button>
                                            </a>
                                            <a href="<?= base_url('delete?id=' . $dt['id']); ?>" class="delete" title="Delete">
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

<!-- Tambah User -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah User</h4>
            </div>
            <form class="form" method="post" action="<?= base_url() ?>/save">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukan Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Masukan Username" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Password</label>
                        <input type="text" class="form-control" name="password"  placeholder="Masukan Password" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" name="alamat"  placeholder="Masukan Alamat" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Masukan Email" required>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <input type="text" class="form-control" name="no_hp" placeholder="Masukan No HP" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" name="role" id="role" placeholder="Masukan Role" required>
                        <option value="">Pilih Role</option>
                            <option value="admin">Admin</option>
                            <option value="klien">Klien</option>
                            <option value="surveyor">Surveyor</option>
                            <option value="teknisi">Teknisi</option>
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

<!-- Edit User -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit User</h4>
            </div>
            <form class="form" method="post" action="<?= base_url() ?>/update">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="hidden" class="form-control" name="id" id="id">
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukan Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Masukan Username" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Password</label>
                        <input type="text" class="form-control" name="password" id="password" placeholder="Masukan Password" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Masukan Alamat" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Masukan Email" required>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="Masukan No HP" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" name="role" id="role" placeholder="Masukan Role" required>
                            <option value="">Pilih Role</option>
                            <option value="admin">Admin</option>
                            <option value="klien">Klien</option>
                            <option value="surveyor">Surveyor</option>
                            <option value="teknisi">Teknisi</option>
                        </select>
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

<script type="text/javascript" src="<?= base_url() ?>/assets/plugins/jquery/jquery-2.2.3.min.js"></script>
<script>
    $(document).ready(function() {
        $(document).on("click", ".edit-user", function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            var username = $(this).data('username');
            var password = $(this).data('password');
            var alamat = $(this).data('alamat');
            var email = $(this).data('email');
            var no_hp = $(this).data('no_hp');
            var role = $(this).data('role');

            $(".modal-body #id").val(id);
            $(".modal-body #nama").val(nama);
            $(".modal-body #username").val(username);
            $(".modal-body #password").val(password);
            $(".modal-body #alamat").val(alamat);
            $(".modal-body #email").val(email);
            $(".modal-body #no_hp").val(no_hp);
            $(".modal-body #role").val(role);
        });
    });
</script>
