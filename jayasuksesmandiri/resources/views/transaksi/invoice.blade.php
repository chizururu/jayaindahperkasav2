<!DOCTYPE html>
<html>
<head>
    <title>Nota Transaksi</title>
    <style>
        /* CSS styles for the nota */
        body {
            font-family: Arial, sans-serif;
        }

        h1, h3 {
            text-align: center;
        }

        .nota-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .nota-table th, .nota-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .nota-table th {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
<h1>Jaya Sukses Mandiri</h1>
<h3>Invoice</h3>
<p><strong>Tanggal</strong> {{ $transaksi->created_at }}</p>
<p><strong>Nomor Transaksi:</strong> {{ $transaksi->id }}</p>
<p><strong>Nama Pelanggan:</strong> {{ $transaksi->nama_pelanggan }}</p>
<p><strong>No Telepon:</strong> {{ $transaksi->no_telepon }}</p>
<p><strong>Alamat:</strong> {{ $transaksi->alamat }}</p>
<hr>
<table class="nota-table">
    <thead>
    <tr>
        <th>Nama Barang</th>
        <th>Jumlah</th>
        <th>Harga Satuan</th>
        <th>Subtotal</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($detailTransaksi as $detail)
        <tr>
            <td>{{ $detail->nama_barang }}</td>
            <td>{{ $detail->jumlah_barang }}</td>
            <td>{{ $detail->harga_barang }}</td>
            <td>{{ $detail->sub_total }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<hr>
<p><strong>Total Harga:</strong> {{ $transaksi->total_harga }}</p>
</body>
</html>
