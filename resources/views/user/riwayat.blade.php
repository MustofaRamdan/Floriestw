<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Riwayat Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-ungu{
            background: #2B073B;
        }
    </style>
</head>
<body class="p-6 bg-gray-100">
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Riwayat Transaksi</h1>

        <!-- Tabel Riwayat -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg">
                <thead class="bg-ungu text-white">
                    <tr>
                        <th class="px-6 py-3 text-left">Nama</th>
                        <th class="px-6 py-3 text-left">Email</th>
                        <th class="px-6 py-3 text-left">Telepon</th>
                        <th class="px-6 py-3 text-left">Alamat</th>
                        <th class="px-6 py-3 text-left">Produk</th>
                        <th class="px-6 py-3 text-left">Jumlah</th>
                        <th class="px-6 py-3 text-left">Total Harga</th>
                        <th class="px-6 py-3 text-left">Tanggal</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>
                    @foreach($riwayat as $item)
                    <tr>
                        <td class="px-6 py-3">{{ $item->nama }}</td>
                        <td class="px-6 py-3">{{ $item->email }}</td>
                        <td class="px-6 py-3">{{ $item->telepon }}</td>
                        <td class="px-6 py-3">{{ $item->alamat }}</td>
                        <td class="px-6 py-3">{{ $item->bunga->nama }}</td>
                        <td class="px-6 py-3">{{ $item->jumlah }}</td>
                        <td class="px-6 py-3">Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-3">{{ $item->tanggal->format('d M Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
