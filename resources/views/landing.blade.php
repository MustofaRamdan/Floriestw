<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Floriestw - Toko Buket Bunga Terbaik</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @keyframes slideInLeft {
      from { opacity: 0; transform: translateX(-50px); }
      to { opacity: 1; transform: translateX(0); }
    }
    @keyframes slideInRight {
      from { opacity: 0; transform: translateX(50px); }
      to { opacity: 1; transform: translateX(0); }
    }
    .fade-in { animation: fadeIn 1s ease-out; }
    .slide-in-left { animation: slideInLeft 1s ease-out; }
    .slide-in-right { animation: slideInRight 1s ease-out; }
    .hover-scale { transition: transform 0.3s ease; }
    .hover-scale:hover { transform: scale(1.05); }
  </style>
</head>
<body class="bg-[#2B073B] text-white font-sans">
  <!-- Navbar -->
  <nav class="p-6 flex flex-col md:flex-row justify-between items-center bg-[#1A052B] shadow-lg">
    <div class="text-3xl font-bold" style="color: #5c1d80;">Floriestw</div>
    <div class="space-x-6 mb-4 md:mb-0">
      <a href="#" class="hover:text-purple-300 transition duration-300">Beranda</a>
      <a href="#" class="hover:text-purple-300 transition duration-300">Tentang Kami</a>
      <a href="#" class="hover:text-purple-300 transition duration-300">Produk</a>
      <a href="#" class="hover:text-purple-300 transition duration-300">Testimoni</a>
    </div>
    <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-4">
      <a href="{{route('login')}}" class="px-6 py-2 rounded-lg hover:bg-purple-700 transition duration-300 hover-scale w-full md:w-auto text-center" style="background: #5c1d80;">Masuk</a>
      <a href="{{route('daftar')}}" class="px-6 py-2 rounded-lg hover:bg-purple-900 transition duration-300 hover-scale w-full md:w-auto text-center" style="background: #5c1d80;">Daftar</a>
    </div>
  </nav>

  <!-- Hero Section with Full Background -->
  <section class="relative text-center py-20 bg-cover bg-center fade-in" style="background-image: url('{{ asset('image/lodiing2.jpg') }}');">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    <div class="relative py-20 px-6 md:px-12">
      <h1 class="text-6xl font-bold mb-6 slide-in-left" style="color: #ffffff;">Selamat Datang di Floriestw</h1>
      <p class="text-xl mb-8 max-w-2xl mx-auto slide-in-right">
        Temukan keindahan dalam setiap buket bunga kami. Floriestw hadir untuk membuat momen spesial Anda semakin berkesan.
      </p>
      <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-4">
        <a href="{{route('user.home')}}" class=" px-8 py-3 rounded-lg hover:bg-purple-700 transition duration-300 hover-scale w-full md:w-auto text-center" style="background: #5c1d80;">Lihat Katalog</a>
        <a href="https://wa.me/6289502274325?text=Saya%20ingin%20memesan%20bunga" class=" px-8 py-3 rounded-lg hover:bg-purple-900 transition duration-300 hover-scale w-full md:w-auto text-center" style="background: #5c1d80;">Hubungi Kami</a>
      </div>
    </div>
  </section>

  <section class="py-20 bg-[#1A052B] fade-in">
    <div class="container mx-auto px-6 text-center">
      <h2 class="text-4xl font-bold mb-6 slide-in-left" style="color: #5c1d80;">Mengapa Memilih Floriestw?</h2>
      <p class="text-lg mb-12 max-w-2xl mx-auto slide-in-right">
        Floriestw bukan sekadar toko bunga biasa. Kami adalah tempat di mana keindahan, kualitas, dan pelayanan terbaik bertemu. Setiap buket kami dirancang dengan penuh cinta dan perhatian, menggunakan bunga segar pilihan yang tahan lama.
      </p>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="p-6 bg-[#2B073B] rounded-lg shadow-lg hover-scale">
          <h3 class="text-2xl font-bold mb-4" style="color: #5c1d80;">Bunga Segar</h3>
          <p class="text-gray-300">Kami hanya menggunakan bunga segar berkualitas tinggi yang dipetik langsung dari kebun terbaik.</p>
        </div>
        <div class="p-6 bg-[#2B073B] rounded-lg shadow-lg hover-scale">
          <h3 class="text-2xl font-bold mb-4" style="color: #5c1d80">Desain Eksklusif</h3>
          <p class="text-gray-300">Setiap buket dirancang oleh florist profesional dengan sentuhan artistik yang memukau.</p>
        </div>
        <div class="p-6 bg-[#2B073B] rounded-lg shadow-lg hover-scale">
          <h3 class="text-2xl font-bold mb-4" style="color: #5c1d80">Pengiriman Cepat</h3>
          <p class="text-gray-300">Pesanan Anda akan dikirim dengan cepat dan aman, tepat waktu untuk momen spesial Anda.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimoni Section -->
  <section class="py-20 bg-[#2B073B] fade-in">
    <div class="container mx-auto px-6 text-center">
      <h2 class="text-4xl font-bold mb-6 slide-in-left" style="color: #5c1d80;">Apa Kata Pelanggan Kami?</h2>
      <p class="text-lg mb-12 max-w-2xl mx-auto slide-in-right">
        Berikut adalah beberapa testimoni dari pelanggan yang telah merasakan keindahan buket bunga Floriestw.
      </p>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="p-6 bg-[#1A052B] rounded-lg shadow-lg hover-scale">
          <p class="text-gray-300 italic">"Buket bunga dari Floriestw membuat hari istimewa saya semakin sempurna! Desainnya cantik dan bunga-bunganya segar sekali."</p>
          <p class="mt-4 font-bold" style="color: #5c1d80;">- Rina, Jakarta</p>
        </div>
        <div class="p-6 bg-[#1A052B] rounded-lg shadow-lg hover-scale">
          <p class="text-gray-300 italic">"Pelayanan Floriestw sangat ramah dan profesional. Buket yang saya pesan tiba tepat waktu dan sesuai ekspektasi!"</p>
          <p class="mt-4 font-bold" style="color: #5c1d80;">- Andi, Bandung</p>
        </div>
        <div class="p-6 bg-[#1A052B] rounded-lg shadow-lg hover-scale">
          <p class="text-gray-300 italic">"Saya selalu memesan buket bunga di Floriestw untuk acara-acara penting. Tidak pernah mengecewakan!"</p>
          <p class="mt-4 font-bold" style="color: #5c1d80;">- Sari, Surabaya</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="p-8 bg-[#1A052B] text-center fade-in">
    <p class="text-gray-300">&copy; 2023 Floriestw. All rights reserved.</p>
    <p class="text-gray-300 mt-2">Jl. Bunga Indah No. 123, Jakarta | Email: info@floriestw.com</p>
  </footer>

  <!-- Script untuk interaksi tombol -->
  <script>
    document.getElementById('loginBtn').addEventListener('click', () => {
      alert('Tombol Masuk diklik!');
    });

    document.getElementById('registerBtn').addEventListener('click', () => {
      alert('Tombol Daftar diklik!');
    });
  </script>
</body>
</html>
