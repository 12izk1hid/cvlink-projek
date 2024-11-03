<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Registrasi Pengguna
            <small>Silakan isi informasi di bawah ini</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Form Registrasi</h3>
                    </div>
                    <div class="box-body">
                        <form class="form" method="post" action="<?= base_url('register/save'); ?>">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Masukkan Username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Masukkan Password" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Masukkan Email" required>
                            </div>
                            <div class="form-group">
                                <label for="no_hp">No HP</label>
                                <input type="text" class="form-control" name="no_hp" placeholder="Masukkan No HP" required>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <input type="text" class="form-control" value="Klien" disabled>
                                <input type="hidden" name="role" value="klien">
                            </div>

                            <div class="modal-footer">
                                <button type="reset" class="btn btn-default pull-left">Reset</button>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
