
<?php
// Koneksi ke database
include 'koneksi.php';

// Ambil data dari tabel gallery
$sql = "SELECT * FROM gallery";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Real Madrid</title>
    <link rel="icon" href="img/logo.png" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <!-- nav begin -->
    <nav class="navbar navbar-expand-sm bg-body-tertiary sticky-top">
      <div class="container">
        <a class="navbar-brand" href="#">Real Madrid</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
            <li class="nav-item">
              <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#article">Article</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#gallery">Gallery</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#schedule">Schedule</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#aboutme">About Me</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php" target="_blank">Login</a>
            </li>
            <button
              type="button"
              class="btn btn-dark theme"
              id="dark"
              title="dark"
            >
              <i class="bi bi-moon-stars-fill"></i>
            </button>
            <button
              type="button"
              class="btn btn-danger theme"
              id="light"
              title="light"
            >
              <i class="bi bi-brightness-high"></i>
            </button>
          </ul>
        </div>
      </div>
    </nav>
    <!-- nav end -->
    <!-- hero begin -->
    <section id="hero" class="text-center p-5 bg-danger-subtle text-sm-start">
      <div class="container">
        <div class="d-sm-flex flex-sm-row-reverse align-items-center">
          <img src="https://www.freeiconspng.com/uploads/real-madrid-logo-png-1.png" class="img-fluid" width="300" />
          <div>
            <h1 class="fw-bold display-4">
              Real Madrid
            </h1>
            <h4 class="lead display-6">
            Didirikan pada tahun 1902 sebagai Madrid Football Club, secara tradisional mengenakan kostum kandang putih. Kata Real ("dari kerajaan") Spanyol dan dianugerahkan ke klub oleh Raja Alfonso XIII pada tahun 1920 bersama-sama dengan mahkota kerajaan di lambang klub. Klub ini telah memainkan pertandingan kandang di Stadion Santiago Bernabéu dengan kapasitas 85.454 di pusat kota Madrid sejak tahun 1947.
            </h4>
            <h6>
              <span id="tanggal"></span>
              <span id="jam"></span>
            </h6>
          </div>
        </div>
      </div>
    </section>
    <!-- hero end -->
   <!-- article begin -->
<section id="article" class="text-center p-5">
  <div class="container">
    <h1 class="fw-bold display-4 pb-3">article</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
      <?php
      $sql = "SELECT * FROM article ORDER BY tanggal DESC";
      $hasil = $conn->query($sql); 

      while($row = $hasil->fetch_assoc()){
      ?>
        <div class="col">
          <div class="card h-100">
            <img src="img/<?= $row["gambar"]?>" class="card-img-top" alt="..." />
            <div class="card-body">
              <h5 class="card-title"><?= $row["judul"]?></h5>
              <p class="card-text">
                <?= $row["isi"]?>
              </p>
            </div>
            <div class="card-footer">
              <small class="text-body-secondary">
                <?= $row["tanggal"]?>
              </small>
            </div>
          </div>
        </div>
        <?php
      }
      ?> 
    </div>
  </div>
</section>
<!-- article end -->
    <!-- gallery begin -->
    <section id="gallery" class="text-center p-5 bg-danger-subtle">
  <div class="container">
    <h1 class="fw-bold display-4 pb-3">Gallery</h1>
    <div id="carouselExample" class="carousel slide">
      <div class="carousel-inner">

        <?php
        // Cek apakah ada data gambar di tabel gallery
        if ($result->num_rows > 0) {
          $active = "active"; // Menandai gambar pertama sebagai yang aktif
          while ($row = $result->fetch_assoc()) {
            $gambar = $row['gambar']; // Nama file gambar
            $nama_gambar = $row['nama']; // Nama gambar yang akan ditampilkan saat di-hover
        ?>

        <!-- Item carousel untuk setiap gambar -->
        <div class="carousel-item <?php echo $active; ?>">
          <div class="position-relative">
            <img src="img/<?= $gambar ?>" class="d-block w-100" alt="<?= $nama_gambar ?>" />
            <div class="carousel-caption d-none d-md-block">
              <h5 class="text-light">
                <?= $nama_gambar ?>
              </h5>
            </div>
          </div>
        </div>

        <?php
            $active = ""; // Set active hanya untuk gambar pertama
          }
        } else {
          echo "<p>Tidak ada gambar di galeri.</p>";
        }
        ?>

      </div>
      <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#carouselExample"
        data-bs-slide="prev"
      >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#carouselExample"
        data-bs-slide="next"
      >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</section>

<!-- Tambahkan CSS untuk efek hover dan penempatan teks di tengah -->
<style>
  .carousel-item img {
    transition: opacity 0.3s ease;
  }

  .carousel-item:hover img {
    opacity: 0.5; /* Memberikan efek opacity pada gambar saat hover */
  }

  /* Menampilkan dan menempatkan caption di tengah */
  .carousel-item .carousel-caption {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%); /* Menggeser posisi supaya benar-benar di tengah */
    background: rgba(0, 0, 0, 0.5); /* Latar belakang hitam transparan */
    padding: 10px;
    border-radius: 5px;
    text-align: center; /* Memastikan teks berada di tengah */
    width: 100%;
  }

  .carousel-item .carousel-caption h5 {
    margin: 0;
    font-size: 1.5rem;
  }

  .carousel-item:hover .carousel-caption {
    display: block; /* Menampilkan caption saat gambar di-hover */
  }
</style>
    <!-- gallery end -->
    <!-- schedule begin -->
    <section id="schedule" class="text-center p-5">
      <div class="container">
        <h1 class="fw-bold display-4 pb-3">Schedule</h1>
        <div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center">
          <div class="col">
            <div class="card h-100">
              <div class="card-header bg-danger text-white">SENIN</div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  Etika Profesi<br />16.20-18.00 | H.4.4
                </li>
                <li class="list-group-item">
                  Sistem Operasi<br />18.30-21.00 | H.4.8
                </li>
              </ul>
            </div>
          </div>
          <div class="col">
            <div class="card h-100">
              <div class="card-header bg-danger text-white">SELASA</div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  Pendidikan Kewarganegaraan<br />12.30-13.10 | Kulino
                </li>
                <li class="list-group-item">
                  Probabilitas dan Statistik<br />15.30-18.00 | H.4.9
                </li>
                <li class="list-group-item">
                  Kecerdasan Buatan<br />18.30-21.00 | H.4.11
                </li>
              </ul>
            </div>
          </div>
          <div class="col">
            <div class="card h-100">
              <div class="card-header bg-danger text-white">RABU</div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  Manajemen Proyek Teknologi Informasi<br />15.30-18.00 | H.4.6
                </li>
              </ul>
            </div>
          </div>
          <div class="col">
            <div class="card h-100">
              <div class="card-header bg-danger text-white">KAMIS</div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  Bahasa Indonesia<br />12.30-14.10 | Kulino
                </li>
                <li class="list-group-item">
                  Pendidikan Agama Islam<br />16.20-18.00 | Kulino
                </li>
                <li class="list-group-item">
                  Penambangan Data<br />18.30-21.00 | H.4.9
                </li>
              </ul>
            </div>
          </div>
          <div class="col">
            <div class="card h-100">
              <div class="card-header bg-danger text-white">JUMAT</div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  Pemrograman Web Lanjut<br />10.20-12.00 | D.2.K
                </li>
              </ul>
            </div>
          </div>
          <div class="col">
            <div class="card h-100">
              <div class="card-header bg-danger text-white">SABTU</div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">FREE</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- schedule end -->
    <!-- about me begin -->
    <section id="aboutme" class="text-center p-5 bg-danger-subtle">
      <div class="container">
        <div class="d-sm-flex align-items-center justify-content-center">
          <div class="p-3">
            <img
              src="https://cdn.antaranews.com/cache/1200x800/2018/04/ronaldo.jpg"
              class="rounded-circle border shadow"
              width="300"
            />
          </div>
          <div class="p-md-5 text-sm-start">
            <h3 class="lead">A11.2023.14919</h3>
            <h1 class="fw-bold">Harits Martsyabel Ristyan Jessy</h1>
            Program Studi Teknik Informatika<br />
            <a href="https://dinus.ac.id/" class="fw-bold text-decoration-none"
              >Universitas Dian Nuswantoro</a
            >
          </div>
        </div>
      </div>
    </section>
    <!-- about me end -->
    <!-- footer begin -->
    <footer id="footer" class="text-center p-5">
      <div>
        <a href="https://www.instagram.com/ristyanharits_"
          ><i class="bi bi-instagram h2 p-2"></i
        ></a>
        <a href="https://twitter.com/udinusofficial"
          ><i class="bi bi-twitter h2 p-2"></i
        ></a>
        <a href="https://wa.me/+62123456"
          ><i class="bi bi-whatsapp h2 p-2"></i
        ></a>
      </div>
      <div>Harits Martsyabel Ristyan Jessy &copy; 2024</div>
    </footer>
    <!-- footer end -->

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <script type="text/javascript">
      window.setTimeout("tampilWaktu()", 1000);

      function tampilWaktu() {
        var waktu = new Date();
        var bulan = waktu.getMonth() + 1;

        setTimeout("tampilWaktu()", 1000);
        document.getElementById("tanggal").innerHTML =
          waktu.getDate() + "/" + bulan + "/" + waktu.getFullYear();
        document.getElementById("jam").innerHTML =
          waktu.getHours() +
          ":" +
          waktu.getMinutes() +
          ":" +
          waktu.getSeconds();
      }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
      document.getElementById("dark").onclick = function () {
        document.body.style.backgroundColor = "black";

        document
          .getElementById("hero")
          .classList.remove("bg-danger-subtle", "text-black");
        document
          .getElementById("hero")
          .classList.add("bg-secondary", "text-white");

        document
          .getElementById("gallery")
          .classList.remove("bg-danger-subtle", "text-black");
        document
          .getElementById("gallery")
          .classList.add("bg-secondary", "text-white");

        document
          .getElementById("aboutme")
          .classList.remove("bg-danger-subtle", "text-black");
        document
          .getElementById("aboutme")
          .classList.add("bg-secondary", "text-white");

        document.getElementById("footer").classList.remove("text-black");
        document.getElementById("footer").classList.add("text-white");

        document.getElementById("article").classList.remove("text-black");
        document.getElementById("article").classList.add("text-white");

        document.getElementById("schedule").classList.remove("text-black");
        document.getElementById("schedule").classList.add("text-white");

        const collection = document.getElementsByClassName("card");
        for (let i = 0; i < collection.length; i++) {
          collection[i].classList.add("bg-secondary", "text-white");
        }

        const collection2 = document.getElementsByClassName("list-group-item");
        for (let i = 0; i < collection2.length; i++) {
          collection2[i].classList.add("bg-secondary", "text-white");
        }
      };

      document.getElementById("light").onclick = function () {
        document.body.style.backgroundColor = "white";

        document
          .getElementById("hero")
          .classList.remove("bg-secondary", "text-white");
        document
          .getElementById("hero")
          .classList.add("bg-danger-subtle", "text-black");

        document
          .getElementById("gallery")
          .classList.remove("bg-secondary", "text-white");
        document
          .getElementById("gallery")
          .classList.add("bg-danger-subtle", "text-black");

        document
          .getElementById("aboutme")
          .classList.remove("bg-secondary", "text-white");
        document
          .getElementById("aboutme")
          .classList.add("bg-danger-subtle", "text-black");

        document.getElementById("footer").classList.remove("text-white");
        document.getElementById("footer").classList.add("text-black");

        document.getElementById("article").classList.remove("text-white");
        document.getElementById("article").classList.add("text-black");

        document.getElementById("schedule").classList.remove("text-white");
        document.getElementById("schedule").classList.add("text-black");

        const collection = document.getElementsByClassName("card");
        for (let i = 0; i < collection.length; i++) {
          collection[i].classList.remove("bg-secondary", "text-white");
        }

        const collection2 = document.getElementsByClassName("list-group-item");
        for (let i = 0; i < collection2.length; i++) {
          collection2[i].classList.remove("bg-secondary", "text-white");
        }
      };
    </script>
  </body>
</html>