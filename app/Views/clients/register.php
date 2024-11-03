<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Log in Aplikasi WGSL</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/AdminLTE.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/iCheck/square/blue.css">
</head>

<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<a href="<?= base_url() ?>"><b>Login</b> CV LINK</a>
		</div>
		<div class="login-box-body">
			<p class="login-box-msg">Masukan Username dan Password</p>
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
			<div class="social-auth-links text-center">
				<p>- CV LINK -</p>
			</div>

			<!-- Teks Registrasi -->
			<div class="text-center">
				<p>Jika anda tidak memiliki akun silahkan <a href="<?= base_url('register') ?>">registrasi </a>dahulu</p>
			</div>
		</div>
	</div>

	<script src="<?= base_url() ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
	<script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>