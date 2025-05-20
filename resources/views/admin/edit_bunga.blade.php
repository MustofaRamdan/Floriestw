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

        .preview-img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
            border-radius: 5px;
        }    
    </style>
</head>
<body>
    <form class="edit-form" method="post" action="{{route('update.bunga', $bunga->id)}}" enctype="multipart/form-data">
        <h2>Edit User</h2>
        @csrf
        <label for="name">Nama</label>
        <input type="text" id="nama" name="nama"  value="{{$bunga->nama}}">

        <label for="Harga">Harga</label>
        <input type="number" id="harga" name="harga" value="{{$bunga->harga}}">

        <label for="stock">Stock</label>
        <input type="text" id="stock" name="stock" value="{{$bunga->stock}}">
        <label for="flowerImage">Gambar:</label>
        <input type="file" id="flowerImage" onchange="previewImage(event)" accept="image/*" name="image">
        <img id="preview" class="preview-img" src="#" alt="Preview Gambar" style="display: none;">


        <button type="submit">Simpan Perubahan</button>
    </form>


    <script>
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
