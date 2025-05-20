<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Riwayat Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        .bg-ungu {
            background: #2B073B;
        }
        .hover\:bg-ungu:hover {
            background: #3A0A4D;
        }
    </style>
</head>
<body class="p-6 bg-gray-100">
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Status Pesanan</h1>

        <!-- Tabel Riwayat -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full">
                <thead class="bg-ungu text-white">
                    <tr>
                        <th class="px-6 py-4 text-left">Nama</th>
                        <th class="px-6 py-4 text-left">Email</th>
                        <th class="px-6 py-4 text-left">Telepon</th>
                        <th class="px-6 py-4 text-left">Alamat</th>
                        <th class="px-6 py-4 text-left">Produk</th>
                        <th class="px-6 py-4 text-left">Jumlah</th>
                        <th class="px-6 py-4 text-left">Total Harga</th>
                        <th class="px-6 py-4 text-left">Status</th>
                        <th class="px-6 py-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($pembelian as $item)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">{{ $item->nama }}</td>
                        <td class="px-6 py-4">{{ $item->email }}</td>
                        <td class="px-6 py-4">{{ $item->telepon }}</td>
                        <td class="px-6 py-4">{{ $item->alamat }}</td>
                        <td class="px-6 py-4">{{ $item->bunga->nama }}</td>
                        <td class="px-6 py-4">{{ $item->jumlah }}</td>
                        <td class="px-6 py-4">Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-sm rounded-full
                                {{ $item->status == 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                   ($item->status == 'settlement' ? 'bg-green-100 text-green-800' :
                                   'bg-red-100 text-red-800') }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($item->status == 'pending')
                            <a href="{{ route('checkout.retry', $item->order_id) }}"
                               class="inline-flex items-center bg-ungu text-white px-4 py-2 rounded-lg hover:bg-ungu-hover transition-colors">
                                <i class='bx bx-credit-card mr-2'></i> Bayar
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
