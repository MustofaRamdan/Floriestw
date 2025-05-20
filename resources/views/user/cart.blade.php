    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Keranjang Saya</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            button:disabled {
                opacity: 0.5;
                cursor: not-allowed;
            }

            .bg-ungu{
                background: #2B073B;
            }
        </style>
    </head>
    <body class="p-6 bg-gray-100">
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold mb-4">Keranjang Belanja</h1>

            <!-- Tabel Keranjang -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-md rounded-lg">
                    <thead class="bg-ungu text-white ">
                        <tr>
                            <th class="px-6 py-3 text-left">Produk</th>
                            <th class="px-6 py-3 text-left">Harga</th>
                            <th class="px-6 py-3 text-center">Jumlah</th>
                            <th class="px-6 py-3 text-left">Subtotal</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Produk 1 -->
                        @foreach($carts as $item)
                        <tr data-cart-id="{{ $item->id }}" data-stock="{{ $item->bunga->stock }}">
                            <td class="px-6 py-3 flex items-center">
                                <img src="{{ asset('image/database/' . $item->bunga->image) }}" alt="{{ $item->bunga->nama }}" class="w-16 h-16 mr-4 rounded">
                                {{ $item->bunga->nama }}
                                <!-- Tampilkan pesan error jika stok habis -->
                                @if($item->bunga->stock == 0)
                                    <div class="stock-error text-red-500 ml-4">Stock bunga telah habis</div>
                                @else
                                    <div class="stock-error text-red-500 ml-4 hidden">Stock bunga telah habis</div>
                                @endif
                            </td>
                            <td class="px-6 py-3">Rp<span class="harga">{{ number_format( $item->bunga->harga   , 0, ',', '.') }}</span></td>
                            <td class="px-6 py-3 text-center">
                                <button class="bg-gray-300 px-2 py-1 rounded" onclick="updateQuantity(this, -1)">-</button>
                                <input type="text" class="quantity w-10 text-center border mx-2" value="{{ $item->quantity }}" readonly>
                                <button class="bg-gray-300 px-2 py-1 rounded" onclick="updateQuantity(this, 1)">+</button>
                            </td>
                            <td class="px-6 py-3">Rp<span class="subtotal">{{ number_format($item->bunga->harga * $item->quantity   , 0, ',', '.') }}</span></td>
                            <td class="px-6 py-3 text-center">
                                <form action="{{ route('remove.from.cart', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-ungu text-white px-3 py-1 rounded">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <p class="font-semibold mt-4">Total: Rp<span id="total-harga">{{ number_format($totalHarga, 0, ',', '.') }}</span></p>
            <button id="checkout-button" class="mt-4 px-4 py-2 bg-ungu text-white rounded" @if($isStockUnavailable) disabled @endif>
                <a href="{{ route('checkout.form') }}">Buat Pesanan</a>
            </button>
        </div>
    <script src="{{asset('js/main.js')}}"></script>
    </body>
    </html>

