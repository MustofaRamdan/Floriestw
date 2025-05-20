<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .edit-form {
            background: #1abc9c;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 300px;
        }
        .edit-form h2 {
            text-align: center;
            color: #fff;
        }
        .edit-form label {
            color: #fff;
            font-weight: bold;
        }
        .edit-form input, .edit-form select {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
        }
        .edit-form button {
            width: 100%;
            padding: 10px;
            background-color: #fff;
            color: #1abc9c;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        .edit-form button:hover {
            background-color: #16a085;
            color: #fff;
        }
    </style>
</head>
<body>
    <form class="edit-form" method="post" action="{{route('update.user', $user->id)}}">
        <h2>Edit User</h2>
        @csrf
        <label for="name">Nama</label>
        <input type="text" id="name" name="name" placeholder="Masukkan nama" value="{{$user->name}}">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Masukkan email" value="{{$user->email}}">

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Masukkan password (opsional)" value="{{$user->password}}">

        <label for="role">Role</label>
        <select id="role" name="role" value="{{$user->role}}">
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>

        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>
