<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{asset('css/daftar.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="wrapper">
        <form action="{{route('registrasi')}}" method="post">
            @csrf
            <h1>Register</h1>

            <div class="input-box">
                <input type="text" placeholder="Nama Lengkap" required name="name">
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <input type="email" placeholder="Email" required name="email">
                <i class='bx bx-envelope'></i>
            </div>

            <div class="input-box">
                <input type="password" placeholder="Password min: 6" required name="password">
                <i class='bx bx-lock'></i>
            </div>


            <button type="submit" class="btn">Daftar</button>

            <div class="login-link">
                <p>Sudah punya akun? <a href="{{route('login')}}">Login</a></p>
            </div>
        </form>
    </div>
</body>
</html>
