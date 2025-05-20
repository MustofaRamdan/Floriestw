<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>
    <link rel="stylesheet" href="{{asset('css/masuk.css')}}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="wrepper">
        <form action="{{route('login.submit')}}" method="post">
            @csrf
            <h1>Masuk</h1>
            <div class="input-box">
        <input type="text" placeholder="Email" required name="email">
        <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" required name="password">
                <i class='bx bx-lock'></i>
            </div>
            <button type="Kirim" class="btn">Masuk</button>
            @if (session('gagal'))
            <p class="text-danger">{{session('gagal')}}</p>
            @endif
            <div class="register-link">
                <p>Tidak punya akun? <a href="{{route('daftar')}}">Daftar</a></p>
            </div>

        </form>
    </div>
</body>
</html>
