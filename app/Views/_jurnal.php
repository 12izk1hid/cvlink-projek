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
                        <div class="row">
                            <div class="pull-right">
                                <button class="btn btn-default">Kas Saat ini Rp. <?= number_format($kas) ?></button>
                            </div>
                            <form class="form" method="post" action="<?= base_url() ?>cetakjurnal" target="_blank">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <select name="pilihancetak" class="form-control" required>
                                            <option value="">..:: PILIH TYPE CETAK::..</option>
                                            <option value="A">SEMUA</option>
                                            <option value="D">DEBET</option>
                                            <option value="K">KREDIT</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <select name="bulan" class="form-control" required>
                                            <option value="0">..:: PILIH BULAN ::..</option>
                                            <option value="1">Januari</option>
                                            <option value="2">Februari</option>
                                            <option value="3">Maret</option>
                                            <option value="4">April</option>
                                            <option value="5">Mei</option>
                                            <option value="6">Juni</option>
                                            <option value="7">Juli</option>
                                            <option value="8">Agustus</option>
                                            <option value="9">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desesmber</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <select name="tahun" class="form-control" required>
                                            <option value="0">..:: PILIH TAHUN ::..</option>
                                            <?php $thn = date('Y');
                                            for ($i = $thn; $i >= $thn - 2; $i--) { ?>
                                                <option value="<?= $i ?>"><?= $i ?></option>
                                            <?php  } ?>
                                        </select>
                                    </div>
                                </div>
                                <button type="submint" class="btn btn-success"><i class="fa fa-print"></i> Cetak</button>
                            </form>
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="10%">Tanggal</th>
                                    <th>Keterangan</th>
                                    <th width="10%">Saldo awal</th>
                                    <th width="10%">Debet</th>
                                    <th width="10%">Kredit</th>
                                    <th width="10%">Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nom = 1;
                                $saldo = 0;

                                foreach ($jurnal as $dt) {
                                    if ($dt['saldoawal'] > 0) {
                                        $saldo =  $dt['saldoawal'];
                                    }
                                    if ($dt['debet'] > 0) {
                                        $saldo = $saldo + $dt['debet'];
                                    } else {
                                        $saldo = $saldo - $dt['kredit'];
                                    }
                                ?>
                                    <tr>
                                        <td width="5%" class="text-center"><?= $nom++; ?></td>
                                        <td class="text-center"><?= date('d-M-Y', strtotime($dt['tgltransaksi'])); ?></td>
                                        <td><?= $dt['ket'] . ' (' . $dt['referensi'] . ')'; ?></td>
                                        <td class="text-right"><?php if ($dt['saldoawal'] > 0) {
                                                                    echo number_format($dt['saldoawal']);
                                                                } ?></td>
                                        <td class="text-right"><?= number_format($dt['debet']); ?></td>
                                        <td class="text-right"><?= number_format($dt['kredit']); ?></td>
                                        <td class="text-right"><?= number_format($saldo) ?></td>
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