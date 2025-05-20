<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin Florist</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f6;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            height: 100vh;
            padding: 20px;
            position: fixed;
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Memisahkan konten atas dan bawah */
        }

        .sidebar h2 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }

        .sidebar nav button {
            display: block;
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            background-color: #34495e;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: left;
            font-size: 16px;
        }

        .sidebar nav button:hover {
            background-color: #1abc9c;
        }

        /* Tombol Logout */
        .logout-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            background-color: #34495e;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: left;
            font-size: 16px;
            width: 100%;
        }

        .logout-btn:hover {
            background-color: #1abc9c;
        }

        .logout-btn i {
            font-size: 18px;
        }

        /* main */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 28px;
            color: #2c3e50;
        }

        .cards {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .card {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            flex: 1;
            text-align: center;
        }

        .card h3 {
            font-size: 18px;
            color: #34495e;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 24px;
            color: #1abc9c;
            font-weight: bold;
        }

        .table-section {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table-section h2 {
            margin-bottom: 20px;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #1abc9c;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .edit-btn, .delete-btn, .add-btn {
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }



        .add-btn {
            background-color: #1abc9c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .add-btn:hover {
            background-color: #16a085;
        }

        .flower-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }

        /* isi modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
        }

        .modal-content h2 {
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .modal-content label {
            display: block;
            margin-bottom: 5px;
            color: #34495e;
        }

        .modal-content input, .modal-content select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .modal-content button {
            width: 100%;
            padding: 10px;
            background-color: #1abc9c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .modal-content button:hover {
            background-color: #16a085;
        }

        .preview-img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
            border-radius: 5px;
        }
        .mb{
            margin-bottom: 5px;
        }

        .action-buttons {
         display: flex;
         gap: 8px; /* Jarak antara tombol */
         }

        .action-buttons a,
        .action-buttons button {
            padding: 6px 12px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            border-radius: 4px;
            text-decoration: none;
            text-align: center;
        }

        /* Styling tombol Edit */
        .btn-edit {
            background-color: #ffc107; /* Warna kuning */
            color: black;
        }

        /* Styling tombol Hapus */
        .btn-delete {
            background-color: #dc3545; /* Warna merah */
            color: white;
        }

        /* Efek hover */
        .btn-edit:hover {
            background-color: #e0a800;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }




    </style>
</head>
<body>
    <!-- sidebar ny -->
    <div class="sidebar">
        <div>
            <h2>Admin Florist</h2>
            <nav>
                <button onclick="showFlowers()">Tabel Bunga</button>
                <button onclick="showUsers()">Tabel Users</button>
                <button onclick="showPembeli()">Tabel Pembeli</button>
            </nav>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>

    <!-- main -->
    <div class="main-content">
        <!-- head -->
        <div class="header">
            <h1>Dashboard</h1>
        </div>

        <!-- card -->
        <div class="cards">
            <div class="card">
                <h3>Total Bunga</h3>
                <p>{{$totalbunga}}</p>
            </div>
            <div class="card">
                <h3>Total Users</h3>
                <p>{{$totaluser}}</p>
            </div>
            <div class="card">
                <h3>Pendapatan</h3>
                <p>Rp. {{ number_format($totalpendapatan, 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Tabel Bunga -->
        <section id="flowersTable" class="table-section">
            <h2>Tabel Bunga</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Gambar</th>
                        <th>Nama Bunga</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $bunga as $data_bunga )

                    <tr>
                        <td>{{$data_bunga->id}}</td>
                        <td><img src="{{asset('image/database/'. $data_bunga->image)}}" alt="" class="flower-img"></td>
                        <td>{{$data_bunga->nama}}</td>
                        <td>Rp. {{ number_format($data_bunga->harga, 0, ',', '.') }} </td>
                        <td>{{$data_bunga->stock}}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('edit.bunga', $data_bunga->id) }}" class="btn-edit">Edit</a>
                                <form action="{{ route('delete.bunga', $data_bunga->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-delete">Hapus</button>
                                </form>
                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
                <div class="pagination mt-3">
                    {{ $bunga->links() }}
                </div>

            </table>
            <button class="add-btn" onclick="openAddFlowerModal()">Tambah Bunga</button>
        </section>

        <!-- Tabel Users -->
        <section id="usersTable" class="table-section" style="display: none;">
            <h2>Tabel Users</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $user as $data )

                    <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->email}}</td>
                        <td>{{$data->role}}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('edit.user', $data->id) }}" class="btn-edit">Edit</a>
                                <form action="{{ route('delete.user', $data->id) }}" method="POST">
                                        @csrf

                                    <button type="submit" class="btn-delete">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination mt-3">
                {{ $user->links() }}
            </div>
            <button class="add-btn" onclick="openAddUserModal()">Tambah User</button>
        </section>

        <section id="pembeliTable" class="table-section" style="display: none;">
            <h2>Tabel Pembeli</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>ID Bunga</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pembelis as $pembeli)
                    <tr>
                        <td>{{ $pembeli->id }}</td>
                        <td>{{ $pembeli->nama }}</td>
                        <td>{{ $pembeli->telepon }}</td>
                        <td>{{ $pembeli->alamat }}</td>
                        <td>{{ $pembeli->bunga_id }}</td>
                        <td>{{ $pembeli->jumlah }}</td>
                        <td>Rp. {{ number_format($pembeli->total_harga, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination mt-3">
                {{ $pembelis->links() }}
            </div>
        </section>




    <!-- Modal Tambah User -->
    <div id="addUserModal" class="modal">
        <div class="modal-content">
            <h2>Tambah User</h2>
            <form action="{{route('tambah.user')}}" method="post">
                @csrf
                <label for="userName">Nama User:</label>
                <input type="text" id="userName" placeholder="Masukkan Nama User" name="name" >
                <label for="userEmail">Email:</label>
                <input type="email" id="userEmail" placeholder="Masukkan Email" name="email">
                <label for="userPassword">Password:</label>
                <input type="password" id="userPassword" placeholder="Masukkan Password" name="password">
                <label for="userRole">Role:</label>
                <select id="userRole" name="role">
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
                <button class="mb">Tambah</button>
                <button onclick="closeModalUser()" type="button">Batal</button>
            </form>
        </div>
    </div>



    <!-- Modal Tambah Bunga -->
    <div id="addFlowerModal" class="modal">
        <div class="modal-content">
            <h2>Tambah Bunga</h2>
            <form action="{{route('tambah.bunga')}}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="flowerName">Nama Bunga:</label>
                <input type="text" id="flowerName" placeholder="Masukkan Nama Bunga" name="nama">
                <label for="flowerPrice">Harga:</label>
                <input type="number" id="flowerPrice" placeholder="Masukkan Harga" name="harga">
                <label for="flowerStock">Stok:</label>
                <input type="number" id="flowerStock" placeholder="Masukkan Stok" name="stock">
                <label for="flowerImage">Gambar:</label>
                <input type="file" id="flowerImage" onchange="previewImage(event)" accept="image/*" name="image">
                <img id="preview" class="preview-img" src="#" alt="Preview Gambar" style="display: none;">
                <button class="mb" type="submit">Tambah</button>
                <button onclick="closeModalFlower()" type="button">Batal</button>
            </form>
        </div>
    </div>

    <script>
        function showFlowers() {
            document.getElementById('flowersTable').style.display = 'block';
            document.getElementById('usersTable').style.display = 'none';
            document.getElementById('pembeliTable').style.display = 'none';
        }

        function showUsers() {
            document.getElementById('usersTable').style.display = 'block';
            document.getElementById('flowersTable').style.display = 'none';
            document.getElementById('pembeliTable').style.display = 'none';
        }
        function showPembeli() {
            document.getElementById('usersTable').style.display = 'none';
            document.getElementById('flowersTable').style.display = 'none';
            document.getElementById('pembeliTable').style.display = 'block';
        }

        function openAddUserModal() {
            document.getElementById('addUserModal').style.display = 'flex';
        }


        function openAddFlowerModal() {
            document.getElementById('addFlowerModal').style.display = 'flex';
        }

        function closeModalFlower() {
            document.getElementById('addFlowerModal').style.display = 'none';
        }

        function closeModalUser() {
            document.getElementById('addUserModal').style.display = 'none   ';
        }



        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('preview');
                preview.src = reader.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>
