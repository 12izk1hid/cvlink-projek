<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .invoice-header h1 {
            margin-bottom: 10px;
        }
        .table {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="invoice-header">
        <h1>Invoice</h1>
        <p><?= date('d F Y') ?></p>
    </div>

    <div class="client-details mb-4">
        <h4>Detail Klien</h4>
        <p><strong>Nama Klien:</strong> <?= htmlspecialchars($client_name, ENT_QUOTES, 'UTF-8') ?></p>
        <p><strong>Tanggal Pesanan:</strong> <?= htmlspecialchars($order_date, ENT_QUOTES, 'UTF-8') ?></p>
    </div>

    <div class="order-details mb-4">
        <h4>Detail Pesanan</h4>
        <table class="table table-bordered">
            <thead class="bg-primary text-white">
                <tr>
                    <th>Layanan</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $service): ?>
                    <tr>
                        <td><?= htmlspecialchars($service['nama_service'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td>Rp <?= number_format($service['harga_total'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="total-price">
        <h4>Total Harga</h4>
        <p><strong>Rp <?= number_format($total_price, 0, ',', '.') ?></strong></p>
    </div>

    <div class="text-center mt-5">
        <p>Terima kasih atas pesanan Anda!</p>
    </div>
</body>
</html>
