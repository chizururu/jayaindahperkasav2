<!DOCTYPE html>
<html>
<head>
    <title>Laporan Barang {{ $produk->nama_barang }}</title>
    <style>
        /* CSS styles for tables */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        /* Other CSS styles */
        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<h1>Laporan Barang {{ $produk->nama_barang }}</h1>

<div>
    <h2>Informasi Produk</h2>
    <p>Nama Barang: <span id="productName">{{ $produk->nama_barang }}</span></p>
    <p>Harga Jual: <span id="sellingPrice">{{ $produk->harga_jual }}</span></p>
    <p>Harga Beli: <span id="purchasePrice">{{ $produk->harga_beli }}</span></p>
    <p>Jumlah Stok: <span id="stockQuantity">{{ $produk->jumlah_stok }}</span></p>
</div>

<div>
    <h2>Ringkasan Stok Produk</h2>
    <p>Total Pemasukan: {{ $totalPemasukan }}</p>
    <p>Total Pengeluaran: {{ $totalPengeluaran }}</p>
</div>

<div>
    <h2>Tabel Pemasukan</h2>
    <table>
        <thead>
        <tr>
            <th>Tanggal</th>
            <th>Pemasukan</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($laporanPemasukan as $pemasukan)
        <tr>
            <td>{{ $pemasukan->created_at }}</td>
            <td>{{ $pemasukan->pemasukan }}</td>
            <td>{{ $pemasukan->status }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div>
    <h2>Tabel Pengeluaran</h2>
    <table>
        <thead>
        <tr>
            <th>Tanggal</th>
            <th>Pengeluaran</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($laporanPengeluaran as $pengeluaran)
        <tr>
            <td>{{ $pengeluaran->created_at }}</td>
            <td>{{ $pengeluaran->pengeluaran }}</td>
            <td>{{ $pengeluaran->status }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
