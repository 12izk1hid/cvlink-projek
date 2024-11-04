<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/profile.css') ?>"> <!-- Sesuaikan path CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <!-- Profil Pengguna -->
        <div class="col-md-4">
            <div class="card profile-card">
                <div class="card-body text-center">
                    <img src="<?= base_url('assets/images/rizki.jpg') ?>" alt="Profile Picture" class="img-fluid rounded-circle mb-3" width="100">
                    <h3><?= esc($user['nama']) ?></h3>
                    <p class="text-muted"><?= esc($user['role']) ?></p>
                   <!-- <button class="btn btn-primary mt-3" onclick="toggleEdit()">Edit Profil</button> -->
                </div>
            </div>
        </div>

        <!-- Detail Informasi Profil -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Detail Profil</h4>
                </div>
                <div class="card-body">
                    <form id="profileForm" action="<?= base_url('') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= esc($user['nama']) ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= esc($user['username']) ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= esc($user['email']) ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No. HP</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= esc($user['no_hp']) ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" readonly><?= esc($user['alamat']) ?></textarea>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-success d-none" id="saveButton">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleEdit() {
        const isReadonly = document.getElementById('nama').hasAttribute('readonly');
        document.querySelectorAll('#profileForm .form-control').forEach(input => {
            if (isReadonly) {
                input.removeAttribute('readonly');
            } else {
                input.setAttribute('readonly', true);
            }
        });

        // Tampilkan tombol simpan jika mode edit diaktifkan
        document.getElementById('saveButton').classList.toggle('d-none', isReadonly);
    }
</script>

</body>
</html>
