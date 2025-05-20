<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Gateway</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #f8f9fa;
            padding: 20px;
        }

        .payment-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            color: #5c1d5c;
            font-size: 24px;
        }

        .order-details {
            text-align: left;
            margin-bottom: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .order-details h2 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }

        .order-details p {
            margin: 5px 0;
            color: #555;
        }

        .payment-instructions {
            text-align: left;
            margin-bottom: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .payment-instructions h2 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }

        .payment-instructions p {
            margin: 5px 0;
            color: #555;
        }

        .pay-button {
            width: 100%;
            padding: 15px;
            background: #2B073B;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 10px;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pay-button:hover {
            background: #2B073B;
        }

        .pay-button i {
            margin-right: 10px;
            font-size: 20px;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <h1>Pembayaran</h1>

        <!-- Detail Pesanan -->
        <div class="order-details">
            <h2>Detail Pesanan</h2>
            <p><strong>Nama:</strong> {{ session('nama') }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>Telepon:</strong> {{ session('telepon') }}</p>
            <p><strong>Alamat:</strong> {{ session('alamat') }}</p>
            <p><strong>Total Harga:</strong> Rp {{ number_format($totalHarga, 0, ',', '.') }}</p>
        </div>

        <!-- Instruksi Pembayaran -->
        <div class="payment-instructions">
            <h2>Instruksi Pembayaran</h2>
            <p>1. Klik tombol "Bayar Sekarang" di bawah ini.</p>
            <p>2. Anda akan diarahkan ke halaman pembayaran Midtrans.</p>
            <p>3. Selesaikan pembayaran sesuai metode yang Anda pilih.</p>
            <p>4. Setelah pembayaran berhasil, Anda akan diarahkan kembali ke halaman dashboard.</p>
        </div>

        <!-- Tombol Bayar -->
        <button id="pay-button" class="pay-button">
            <i class='bx bx-credit-card'></i> Bayar Sekarang
        </button>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; 2025 Florist. Semua hak dilindungi.</p>
        </div>
    </div>

    <!-- Midtrans Snap JS -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').addEventListener('click', function () {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function (result) {
    // Redirect ke route yang memproses pembayaran sukses
    window.location.href = "{{secure_url( route('payment.success')) }}?order_id=" + result.order_id;
},
                onPending: function (result) {
                    alert("Pembayaran tertunda! Silakan selesaikan pembayaran Anda.");
                },
                onError: function (result) {
                    alert("Pembayaran gagal! Silakan coba lagi.");
                },
                onClose: function () {
                    alert("Anda menutup popup pembayaran tanpa menyelesaikan transaksi.");
                }
            });
        });
    </script>
</body>
</html>
