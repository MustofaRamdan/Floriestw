<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Florist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        .bagian {
    background: #2B073B;
}


.playfair-display-<uniquifier> {
  font-family: "Playfair Display",   serif;
  font-optical-sizing: auto;
  font-weight: <weight>;
  font-style: normal;
}

.sound-icon {
            width: 50px;
            height: 50px;
            cursor: pointer;
        }
    </style>
  </head>
  <body>
    <nav class="navbar position-fixed navbar-expand-lg navbar-dark">
        <div class="container d-flex align-items-center">
            <!-- Logo di kiri -->
            <a class="navbar-brand me-5" href="#">
                <img src="{{ asset('image/logo/logoflorist-removebg-preview.png') }}" alt="Logo Florist" style="height: 70px;">
            </a>



            <!-- Ikon-ikon (pencarian, keranjang, dll) -->
            <div class="navbar-icons d-flex align-items-center ms-auto">
                <a href="#search">
                    <div class="position-relative me-4" style="cursor: pointer;" onclick="toggleSearch()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </div>
                </a>

                <a href="{{ route('riwayat') }}">
                    <div class="position-relative me-4" style="cursor: pointer;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                </a>

                <a href="{{ route('status.pembayaran') }}">
                    <div class="d-inline-block position-relative me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="7" width="20" height="10" rx="2" ry="2"></rect>
                            <path d="M5 7V4a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v3"></path>
                            <line x1="12" y1="11" x2="12" y2="15"></line>
                            <line x1="9" y1="15" x2="15" y2="15"></line>
                        </svg>
                    </div>
                </a>

                <a href="{{ route('view.cart') }}">
                    <div class="position-relative me-3" style="cursor: pointer;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2 14h13l2-10H5"></path>
                        </svg>
                        <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ $cart }}</span>
                    </div>
                </a>

                <audio id="backgroundAudio" loop>
        <source src="{{asset('audio/backsound.mp3')}}" type="audio/mp3">
        Browser Anda tidak mendukung elemen audio.
    </audio>
    
    <div id="soundToggle" class="sound-icon">
        <svg id="soundOn" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="50" height="50" fill="white">
            <path d="M3 10v4h4l5 5V5l-5 5H3zm13.5 2c0-1.77-1.02-3.29-2.5-4.03v8.06c1.48-.74 2.5-2.26 2.5-4.03zm2.5 0c0 2.69-1.65 5-4 6v-2.07c1.45-.84 2.5-2.36 2.5-3.93s-1.05-3.09-2.5-3.93V4c2.35 1 4 3.31 4 6z"/>
        </svg>
        <svg id="soundOff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="50" height="50" fill="white" style="display: none;">
            <path d="M3 10v4h4l5 5V5l-5 5H3zm14.59 2l2.7 2.71-1.41 1.41L16 13.41l-2.89 2.89-1.41-1.41L14.59 12l-2.89-2.89 1.41-1.41L16 10.59l2.89-2.89 1.41 1.41L17.41 12z"/>
        </svg>
    </div>


            </div>

            <!-- Tombol Hamburger di kanan -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu yang muncul saat hamburger diklik -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav gap-4">
                    <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#buket-bunga">Buket</a></li>
                    <li class="nav-item"><a class="nav-link" href="#costumer-kita">Pelanggan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#galeri">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link" href="#galleryCarousel">Tentang Kami</a></li>
                    <li class="nav-item">                <form action="{{ route('logout.user') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h9"></path>
                                <polyline points="17 16 21 12 17 8"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                        </button>
                    </form></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Input Pencarian -->
    <div id="search-box" class="position-fixed top-0 start-0 w-100 bg-white p-3 d-none" style="z-index: 1050;">
        <div class="container d-flex">
            <input type="text" class="form-control me-2" placeholder="Cari bunga...">
            <button class="btn btn-danger" onclick="toggleSearch()">Tutup</button>
        </div>
    </div>

  <!-- Carousel -->
  <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner" id="beranda">
        <div class="carousel-item active">
            <img src="{{asset('image/corosel-ungu.jpg')}}" class="d-block w-100" alt="Slide 1">
            <!-- Teks di tengah kiri -->
            <div class="carousel-text-left">
                <h2>SELAMAT DATANG DI <br>
                    #1 TOKO BUNGA</h2>
            </div>
            <!-- Teks di kanan bawah -->
            <div class="carousel-text-right">
                <h2>FLORIESTW</h2>
                <p>Kami memberikan layanan terbaik untuk memenuhi kebutuhan Anda.<br>
                    Jelajahi berbagai fitur dan layanan yang kami tawarkan.</p>
            </div>
        </div>
    </div>
</div>

<div data-aos="fade-up" id="search">
    <div class="wrapper">
        <div class="container mt-5" id="buket-bunga">
            <h2 align="center" style="color: #5c1d80; font-weight: 700; font-family: 'Poppins';">Buket</h2><br>

            <!-- Form Pencarian -->
            <form action="{{ route('buket.bunga') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama bunga..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>


            <div class="row">
                @foreach ($bunga as $data_bunga)
                <div class="col-md-4">
                    <div class="card flower-card">
                        <!-- Gambar dengan ukuran tetap -->
                        <img src="{{ asset('image/database/' . $data_bunga->image) }}" class="card-img-top fixed-image" alt="{{ $data_bunga->nama }}">
                        <div class="card-body text-center">
                            <h5>{{ $data_bunga->nama }}</h5>
                            <p class="card-text">Rp {{ number_format($data_bunga->harga, 0, ',', '.') }}</p>
                        </div>
                        @if ($data_bunga->stock > 0)
                            <!-- Ikon keranjang -->
                            <form action="{{ route('add.to.cart') }}" method="POST">
                                @csrf
                                <input type="hidden" name="bunga_id" value="{{ $data_bunga->id }}">
                                <button type="submit" class="cart-icon">
                                    <i class="fas fa-shopping-cart fa-2x"></i>
                                </button>
                            </form>
                        @else
                            <!-- Tampilkan teks "Habis" jika stok 0 -->
                            <div class="out-of-stock">
                                <span>Habis</span>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
</div>
    <div data-aos="fade-up">
        <div class="bagian" id="costumer-kita">
          <section id="costumer">
            <div class="tengah">
            <div class="kolom">
                <h2 style="font-family: 'Poppins';">Pelanggan Kami</h2>
                <p>Kami memberikan layanan terbaik untuk memenuhi kebutuhan Anda.
                  Jelajahi berbagai fitur dan layanan yang kami tawarkan.</p>
            </div>

            <div class="bunga-list">
                <div class="card-cus">
                    <img src="{{asset('image/depin.jpg')}}" alt="">
                    <p>Devinka Nazhwa Fadila</p>
                </div>

                <div class="card-cus">
                  <img src="{{asset('image/WhatsApp Image 2025-02-13 at 08.07.38_85ca652e.jpg')}}" alt="">
                  <p>Daffa Dwi Putra</p>
              </div>

              <div class="card-cus">
                <img src="{{asset('image/billy.jpg')}}" alt="">
                <p>Billy Caesar R</p>
            </div>

            <div class="card-cus">
              <img src="{{asset('image/padlan.jpg')}}" alt="">
              <p>M. Fadlan Novriansyah</p>
          </div>
              </div>
            </div>
        </div>
    </div>

    <div data-aos="fade-up">
        <div class="container" id="mama">
            <h2 id="galeri" style="color: #5c1d80; font-weight: 700;font-family: 'Poppins';">Galeri</h2>
            <div class="box">
                <div class="mimpi">
                    <img src="{{asset('image/galeri/bunga1.jpg')}}" alt="">
                    <img src="{{asset('image/galeri/bunga2.jpg')}}" alt="">
                    <img src="{{asset('image/galeri/bunga3.jpg')}}" alt="">
                </div>
                <div class="mimpi">
                    <img src="{{asset('image/galeri/bunga4.jpg')}}" alt="">
                    <img src="{{asset('image/galeri/bunga5.jpg')}}" alt="">
                    <img src="{{asset('image/galeri/bunga6.jpg')}}" alt="">
                </div>
                <div class="mimpi">
                    <img src="{{asset('image/galeri/bunga7.jpg')}}" alt="">
                    <img src="{{asset('image/galeri/bunga8.jpg')}}" alt="">
                    <img src="{{asset('image/galeri/bunga9.jpg')}}" alt="">
                </div>
            </div>
        </div>
    </div>

    <div data-aos="fade-up">
    <div id="galleryCarousel" class="carousel slide" data-bs-ride="carousel">
    <h2 align="center" id="tentang" style="color: #5c1d80; font-weight: 700; font-family: 'Poppins';">Tentang Kami</h2><br>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row justify-content-center">
                    <div class="col-md-3 mb-3 text-center">
                        <img src="{{asset('image/owner/nisa-removebg-preview.png')}}" class="img-fluid" alt="Gallery Image 1">
                        <h5 class="mt-3">Annisa Ramadhani</h5>
                        <p>Anissa adalah UI Florium dan toko bunga yang sangat berpengalaman.</p>
                    </div>
                    <div class="col-md-3 mb-3 text-center">
                        <img src="{{asset('image/owner/azka-removebg-preview.png')}}" class="img-fluid" alt="Gallery Image 2">
                        <h5 class="mt-3">Azkania Putri</h5>
                        <p>Azka adalah QA Florium dan toko bunga yang sangat berpengalaman.</p>
                    </div>
                    <div class="col-md-3 mb-3 text-center">
                        <img src="{{asset('image/owner/fadhli-removebg-preview.png')}}" class="img-fluid" alt="Gallery Image 3">
                        <h5 class="mt-3">Fadli Rahman A.</h5>
                        <p>Fadli adalah UX Florium dan toko bunga yang sangat berpengalaman.</p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="row justify-content-center">
                    <div class="col-md-3 mb-3 text-center">
                        <img src="{{asset('image/owner/fathur-removebg-preview.png')}}" class="img-fluid" alt="Gallery Image 5">
                        <h5 class="mt-3">Muhammad Fathur R.</h5>
                        <p>Fathur adalah Frontend Developer Florium dan toko bunga yang sangat berpengalaman.</p>
                    </div>
                    <div class="col-md-3 mb-3 text-center">
                        <img src="{{asset('image/owner/ramdan-removebg-preview.png')}}" class="img-fluid" alt="Gallery Image 4">
                        <h5 class="mt-3">Mustofa Ramdan</h5>
                        <p>Ramdan adalah Backend Developer Florium dan toko bunga yang sangat berpengalaman.</p>
                    </div>
                    <div class="col-md-3 mb-3 text-center">
                        <img src="{{asset('image/owner/atun-removebg-preview.png')}}" class="img-fluid" alt="Gallery Image 6">
                        <h5 class="mt-3">Zahratun Syifa A.</h5>
                        <p>Zahratun adalah Manajer Pemasaran Florium dan toko bunga yang sangat berpengalaman.</p>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div data-aos="fade-up">
    <footer class="text-white py-4 mt-5" style="background:#5c1d80;">
        <div class="container mt-4">
            <div class="row text-center text-md-start">
                
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold" style="color:#ffffff; font-size:30px;">My Dream Cards</h5>
                    <div style="display: flex; gap: 10px;">
                    <img src="img/buket_bunga_dan_boneka_wisuda_1683554256_de108652_progressive.jpg" alt="Gambar 1" width="60">
                    <img src="img/pink.jpg" alt="Gambar 2" width="60">
                    <img src="img/pink.jpg" alt="Gambar 3" width="60">
                    <img src="img/IMG_1827.JPG" alt="Gambar 4" width="60">
                </div>
                </div>
      
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold" style="color:#ffffff; font-size:30px">Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#corousell" class="text-white text-decoration-none">Beranda</a></li>
                        <li><a href="#buket-bunga" class="text-white text-decoration-none">Buket</a></li> 
                        <li><a href="#" class="text-white text-decoration-none">Pelanggan</a></li> 
                        <li><a href="#" class="text-white text-decoration-none">Galeri</a></li> 
                        <li><a href="#galleryCarousel" class="text-white text-decoration-none">Tentang Kami</a></li> 
                    </ul>
                </div> 
              
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold" style="color:#ffffff; font-size:30px">Ikuti Kami</h5>
                    <a href="#" class="text-white text-decoration-none d-block"><i class="bi bi-facebook me-2"></i><strong>Facebook :</strong> DreamCards_offical</a>
                    <a href="#" class="text-white text-decoration-none d-block"><i class="bi bi-instagram me-2"></i><strong>Instagram :</strong> DreamCards_offical</a>
                    <a href="#" class="text-white text-decoration-none d-block"><i class="bi bi-twitter me-2"></i><strong>Twitter :</strong> DreamCard_offical</a>
                </div>
            </div>
      
            <hr class="border-secondary">
    
            <div class="text-center pb-3">
                <p class="mb-0">&copy; 2025 mydreamcards.com | All rights reserved.</p>
            </div>
        </div>
      
      </footer>


<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
    document.addEventListener("DOMContentLoaded", function() {
        var myCarousel = new bootstrap.Carousel(document.getElementById("galleryCarousel"), {
            interval: 3000, // Auto-slide setiap 3 detik
            wrap: true // Ulang dari awal setelah slide terakhir
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
            let audio = document.getElementById("backgroundAudio");
            let soundOn = document.getElementById("soundOn");
            let soundOff = document.getElementById("soundOff");
            
            audio.play();
            
            document.getElementById("soundToggle").addEventListener("click", function() {
                if (audio.paused) {
                    audio.play();
                    soundOn.style.display = "block";
                    soundOff.style.display = "none";
                } else {
                    audio.pause();
                    soundOn.style.display = "none";
                    soundOff.style.display = "block";
                }
            });
        });
</script>
        <script src="{{asset('js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>

