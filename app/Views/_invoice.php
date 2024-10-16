<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Informasi
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
                            New Invoice
                        </button>
                    </div>
                    <div class="box-body">
                        <?php if ((session()->getFlashdata('pesan') !== NULL)) {
                            echo session()->getFlashdata('pesan');
                        }  ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="8%">No</th>
                                    <th width="10%">Tanggal</th>
                                    <th width="12%">Invoice Number</th>
                                    <th>Penerima</th>
                                    <th width="12%">Notelp</th>
                                    <th width="10%">status</th>
                                    <th width="10%">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nom = 1;
                                foreach ($invoice as $dt) { ?>
                                    <tr>
                                        <td width="5%" class="text-center"><?= $nom++; ?></td>
                                        <td><?= date('d-m-Y', strtotime($dt['tgl_dibuat'])); ?></td>
                                        <td><?= $invoicecode . date('Y', strtotime($dt['tgl_dibuat'])) . '-' . $dt['id']; ?></td>
                                        <td><?= $dt['penerima'] . '<br>' . $dt['alamat']; ?></td>
                                        <td><?= $dt['notelp']; ?></td>
                                        <td><?php
                                            if ($dt['status'] == '1')
                                                echo 'Belum di bayar';
                                            else if ($dt['status'] == '2')
                                                echo 'Belum Lunas';
                                            else
                                                echo 'Lunas';
                                            ?></td>
                                        <td class="text-right"><?= number_format($dt['jumlah']); ?></td>
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
<div class="modal fade" id="tambahData" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Invoice</h4>
            </div>
            <form class="form" method="post" action="<?= base_url() ?>/simpaninvoice">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Invoice Number</label>
                        <input type="hidden" class="form-control" name="id_invoice" value="<?= $id  ?>">
                        <input type="text" class="form-control" name="id" value="<?= $id ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Date</label>
                        <input type="text" class="form-control" name="tgl_dibuat" id="datepicker" placeholder="Selec Date" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">To</label>
                        <input type="text" class="form-control" name="penerima" placeholder="To" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Address</label>
                        <input type="text" class="form-control" name="alamat" value="-" placeholder="Address" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone Number</label>
                        <input type="text" class="form-control" name="notelp" value="-" placeholder="Phone Number" required>
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

<script src="<?= base_url() ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>

<script>
    $(document).ready(function() {

        var rupiah = document.getElementById('jumlah');
        rupiah.addEventListener('keyup', function(e) {
            rupiah.value = formatRupiah(this.value, 'Rp. ');
        })

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    });
</script>