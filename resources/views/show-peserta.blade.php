<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('sneat') }}/assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Under Maintenance - Pages</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('sneat') }}/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('sneat') }}/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('sneat') }}/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('sneat') }}/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('sneat') }}/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('sneat') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('sneat') }}/assets/vendor/css/pages/page-misc.css" />
    <!-- Helpers -->
    <script src="{{ asset('sneat') }}/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('sneat') }}/assets/js/config.js"></script>

  </head>

  <body>
    <!-- Content -->

    <!--Under Maintenance -->
    {{-- <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme">
      <div class="container-fluid">
          <!-- Logo di bagian kiri -->
          <a class="navbar-brand" href="http://skytama.com" target="blank">
              <img src="{{ asset('img/logobaru.png') }}" alt="Logo" width="100" class="d-inline-block align-text-top">
          </a>
          
          <!-- Judul di bagian kanan -->
          <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                <span class="navbar-text" style="color: #000066; font-size: 16px;">
                    <strong>PT. SKYNET MEDIA UTAMA</strong>
                    <br>
                    <span style="color: #000066; font-size: 14px;">
                      <a href="https://maps.app.goo.gl/jFPtGNT7Bn7kP78L8" target="blank">
                        Kalikatir RT.05 RW.03, Kalikatir, Gondang, Mojokerto
                      </a>
                    </span>
                </span>
                </li>
            </ul>
          </div>
      </div>
    </nav> --}}

<div class="half-background"></div>
<div class="container-xxl container-p-y" style="color: #000000; width: 75%">
  <div class="row">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
      <div class="col-md">
        <!-- Logo -->
        <a class="navbar-brand" href="http://skytama.com" target="blank">
          <img src="{{ asset('img/logobaru.png') }}" alt="Logo" width="130" class="d-inline-block align-text-top">
        </a>
      </div>
    <div class="col-md">
      <div class="mt-2 mt-md-0 text-end">
        <a href="https://wa.me/6285791559252" target="blank">
            <img src="{{ asset('img/whatsapp.png') }}" alt="Whatsapp" width="20" class="me-3">
        </a>
        <a href="https://www.instagram.com" target="blank">
            <img src="{{ asset('img/instagram.png') }}" alt="Instagram" width="20" class="me-3">
        </a>
        <a href="https://www.tiktok.com/@skynet.media.utam?_t=8p1gNlVPf9u&_r=1" target="blank">
            <img src="{{ asset('img/tiktok.png') }}" alt="Tiktok" width="20" class="me-3">
        </a>
        <a href="https://maps.app.goo.gl/jFPtGNT7Bn7kP78L8" target="blank">
            <img src="{{ asset('img/pin.png') }}" alt="Pin" width="20">
        </a>
    </div>
    </div>
  </div>

  {{-- <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">  
    <!-- Logo -->
    <a class="navbar-brand" href="http://skytama.com" target="blank">
        <img src="{{ asset('img/logobaru.png') }}" alt="Logo" width="130" class="d-inline-block align-text-top">
    </a>

    <!-- Ikon Sosmed -->
    <div class="d-flex mt-2 mt-md-0">
        <a href="https://wa.me/6285791559252" target="blank">
            <img src="{{ asset('img/whatsapp.png') }}" alt="Whatsapp" width="20" class="me-3">
        </a>
        <a href="https://www.instagram.com" target="blank">
            <img src="{{ asset('img/instagram.png') }}" alt="Instagram" width="20" class="me-3">
        </a>
        <a href="https://www.tiktok.com/@skynet.media.utam?_t=8p1gNlVPf9u&_r=1" target="blank">
            <img src="{{ asset('img/tiktok.png') }}" alt="Tiktok" width="20" class="me-3">
        </a>
        <a href="https://maps.app.goo.gl/jFPtGNT7Bn7kP78L8" target="blank">
            <img src="{{ asset('img/pin.png') }}" alt="Pin" width="20">
        </a>
    </div>
  </div> --}}
    
  <div class="card" style="box-shadow: 0 4px 10px rgba(0, 0, 0, 0.244);">  
    <div class="row">
      <div class="col-md-6 col-sm-12 d-flex mb-2 mt-2 justify-content-center" style="max-width: 40%; margin-left: auto; margin-right: auto;">
        @if ($peserta->fileDokumen && Storage::disk('public')->exists($peserta->fileDokumen->file_path))
          @php
            $fileExtension = pathinfo($peserta->fileDokumen->file_path, PATHINFO_EXTENSION);
          @endphp
          @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
            <img
              src="{{ Storage::url($peserta->fileDokumen->file_path) }}"
                alt="e-sertifikat"
                width="100%"
                class="img-fluid"
            />
          @else
            <p>File tidak dapat ditampilkan.</p>
          @endif
        @else
          <p>Dokumen belum di upload.</p>
        @endif
      </div>
      <div class="col-md-7 col-sm-12">
        <h2 class="mt-2" style="text-align: center">Sertifikat Verified!         
          <img src="{{ asset('img/verified2.png') }}" alt="Verified" width="30" height="30" class="ms-2">
        </h2>
        <div class="form-group mb-2 mt-3 d-flex align-items-center">
            <label for="nama" class="col-sm-4" style="white-space: nowrap;">Nama</label>
            <input type="text" class="form-control" id="nama" value="{{ $peserta->nama }}" readonly>
        </div>
        <div class="form-group mb-2 mt-2 d-flex align-items-center">
            <label for="sekolah" class="col-sm-4" style="white-space: nowrap;">Asal Sekolah</label>
            <input type="text" class="form-control" id="sekolah" value="{{ $peserta->sekolah }}" readonly>
        </div>
        <div class="form-group mb-2 mt-2 d-flex align-items-center">
            <label for="jurusan" class="col-sm-4" style="white-space: nowrap;">Jurusan</label>
            <input type="text" class="form-control" id="jurusan" value="{{ $peserta->jurusan }}" readonly>
        </div>
        <div class="form-group mb-2 mt-2 d-flex align-items-center">
            <label for="ttl" class="col-sm-4" style="white-space: nowrap;">Tempat Tanggal Lahir</label>
            <input type="text" class="form-control" id="ttl" value="{{ $peserta->ttl }}" readonly>
        </div>
        <div class="form-group mb-2 mt-2 d-flex align-items-center">
            <label for="nomor_sertifikat" class="col-sm-4" style="white-space: nowrap;">Nomor Sertifikat</label>
            <input type="text" class="form-control" id="nomor_sertifikat" value="{{ $peserta->nomor_sertifikat }}" readonly>
        </div>
        <div class="form-group mb-2 mt-2 d-flex align-items-center">
          <label for="periode_magang" class="col-sm-4" style="white-space: nowrap;">Periode Magang</label>
          <input type="text" class="form-control" id="periode_magang" value="{{ $peserta->tanggal_masuk->isoFormat('D MMMM Y') }}  -  {{ $peserta->tanggal_keluar->isoFormat('D MMMM Y') }}" readonly>
        </div>
        <div class="form-group mb-2 mt-3" style="text-align: end">
            <p><a href="{{ route('public.pesertas.download', $peserta->id) }}" class="btn btn-primary">Download Sertifikat</a></p>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<style>
  .half-background {
      background-color: #6190ff; /* Warna latar belakang yang diinginkan */
      height: 50vh; /* Tinggi penuh halaman */
      width: 100%; /* Setengah dari lebar halaman */
      position: absolute;
      margin-top: 28%;
      left: 0;
      z-index: -1; /* Agar berada di belakang konten */
  }
  @media (max-width: 768px) {
  /* Sesuaikan container untuk perangkat kecil */
  .container-xxl {
    width: 100%;
    padding: 20px; /* Tambahkan padding pada kontainer */
  }

  .card {
    width: 100%;
    margin: 0 auto;
    padding: 15px; /* Tambahkan padding di dalam card */
  }

  .col-md-6,
  .col-md-7 {
    max-width: 100%;
    margin: 10px 0; 
  }

  .d-flex {
    flex-direction: column;
  }

  .form-group {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    width: 100%;
  }

  .form-group label {
    width: 100%;
    margin-bottom: 2px;
  }

  .form-group input {
    width: 100%;
    padding: 4px;
    box-sizing: border-box;
  }
  
  .card img {
    max-width: 100%;
    height: auto;
    margin-bottom: 6px; 
  }
}
</style>

    <!-- /Under Maintenance -->

    <!-- / Content -->

    {{-- <div class="buy-now">
      <a
        href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/"
        target="_blank"
        class="btn btn-danger btn-buy-now"
        >Upgrade to Pro</a
      >
    </div> --}}

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('sneat') }}/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('sneat') }}/assets/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('sneat') }}/assets/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('sneat') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="{{ asset('sneat') }}/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('sneat') }}/assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
