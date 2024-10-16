<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WGSL | Cetak Jurnal <?= $title . '-' . date('d-m-Y') ?> </title>
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body onload="window.print();">
  <div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
      <div class="row invoice-info">
        <div class="col-sm-12 text-center">
          <strong>PT. Wiragawa Setia Logistik.</strong><br>
          <?php echo  $alamat . '<br>' . $title ?>
        </div>
      </div>

      <!-- Table row -->
      <div class="row">
        <div class="pull-right">
          Kas Saat ini Rp. <?= number_format($kas) ?>
        </div>
        <div class="col-xs-12 table-responsive">
          <br>
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="5%">No</th>
                <th width="12%">Tanggal</th>
                <th>Keterangan</th>
                <th width="12%">Saldo awal</th>
                <th width="10%">Debet</th>
                <th width="10%">Kredit</th>
                <th width="10%">Saldo</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $session = session();
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
                  <td class="text-center"><?= date('d-m-Y', strtotime($dt['tgltransaksi'])); ?></td>
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
        <!-- /.col -->
      </div>
      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-7">

        </div>
        <!-- /.col -->
        <div class="col-xs-5">
          Tanggal Cetak, <?= date('d-M-Y') . '<br>dibuat oleh:<br><br><br>' . $session->get('nama') ?>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- ./wrapper -->
</body>

</html>