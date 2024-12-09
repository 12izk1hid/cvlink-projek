<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <style>
        /* Desain untuk tampilan cetak */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .invoice {
            width: 80%;
            margin: 0 auto;
        }
        .header, .footer {
            text-align: center;
            margin: 20px 0;
        }
        .details {
            margin: 30px 0;
        }
        .details table {
            width: 100%;
            border-collapse: collapse;
        }
        .details th, .details td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        .details th {
            background-color: #f4f4f4;
        }
        .total {
            font-weight: bold;
            font-size: 1.2em;
            text-align: right;
            padding: 10px;
            border-top: 2px solid #000;
        }
    </style>
</head>
<body>
    <div class="invoice">
        <div class="header">
            <h1>Invoice</h1>
            <p><?= $invoice['invoice_number']; ?></p>
        </div>

        <div class="details">
            <h2>Detail Invoice</h2>
            <table>
                <tr>
                    <th>Nama Pengguna</th>
                    <td><?= $user['name']; ?></td>
                </tr>
                <tr>
                    <th>Tanggal Invoice</th>
                    <td><?= $invoice['date']; ?></td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td><?= number_format($invoice['amount'], 2); ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><?= $invoice['confirmed'] == 1 ? 'Accepted' : 'Pending'; ?></td>
                </tr>
            </table>

            <!-- Menambahkan total harga -->
            <div class="total">
                <p>Total Harga: <?= number_format($invoice['total_price'], 2); ?></p>
            </div>
        </div>

        <div class="footer">
            <p>Terima kasih telah melakukan transaksi dengan kami.</p>
        </div>
    </div>
</body>
</html>
