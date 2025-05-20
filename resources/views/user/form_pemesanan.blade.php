<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan</title>
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
            height: 100vh;
            background: #f8f9fa;
        }

        .wrapper {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            color: #5c1d5c;
        }

        .input-box {
            position: relative;
            margin-bottom: 15px;
        }

        .input-box input {
            width: 100%;
            padding: 10px 35px 10px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .input-box i {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background: #2B073B;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: 0.3s;
        }

        .btn:hover {
            background: #2B073B;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <form action="{{route('checkout.process')}}" method="post">

            @csrf
            <h1>Bentuk Pesanan</h1>


            <!-- Input Nama -->
            <div class="input-box">
                <input type="text" placeholder="Nama Lengkap" required name="nama">
                <i class='bx bxs-user'></i>
            </div>

            <!-- Input Alamat -->
            <div class="input-box">
                <input type="text" placeholder="Alamat Lengkap" required name="alamat">
                <i class='bx bxs-map'></i>
            </div>

            <!-- Input Nomor Telepon -->
            <div class="input-box">
                <input type="tel" placeholder="Nomor Telepon" required name="telepon">
                <i class='bx bxs-phone'></i>
            </div>

            <!-- Tombol Kirim -->
            <button type="submit" class="btn">Kirim</button>
        </form>
    </div>
</body>
</html>
