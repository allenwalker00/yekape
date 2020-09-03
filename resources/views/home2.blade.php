 <!DOCTYPE html>
<html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!-- <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script> -->
      <!--Import materialize.css-->
      <link href="{{asset('assets/css/materialize.min.css')}}" rel="stylesheet" type="text/css"/>
      
      <!-- my css -->
      <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
      <link rel="shortcut icon" href="{{asset('assets/lg-original.png')}}" />

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>PT Yekape Surabaya</title>
    </head>

    <body id="home" class="scrollspy">
    <!-- navbar -->
      <div class="navbar-fixed">
        <nav class="teal darken-3">
          <div class="container">
            <div class="nav-wrapper">
              <a href="#home" class="brand-logo responsive" style="font-size: 100%;">PT. Yekape Surabaya</a>
              <a href="#" data-target="mobile-nav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
              <ul class="right hide-on-med-and-down">
                <li><a href="#about">About Us</a></li>
                <li><a href="#portofolio">Portofolio</a></li>
                <li><a href="#product">Product</a></li>
                <li><a href="#contact">Contact Us</a></li>
              </ul>
            </div>
          </div>
        </nav>
      </div>

      <!-- sidenav -->
      <ul class="sidenav" id="mobile-nav">
        <li><a href="#about">About Us</a></li>
        <li><a href="#portofolio">Portofolio</a></li>
        <li><a href="#product">Product</a></li>
        <li><a href="#contact">Contact Us</a></li>
      </ul>

      <!-- slider -->
      <div class="slider">
        <ul class="slides">
          <li>
            <img src="{{asset('assets/img/slider/1.jpg')}}">
            <div class="caption right-align">
              <h3 class="blue-text text-darken-3">This is our big Tagline!</h3>
              <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
            </div>
          </li>
          <li>
            <img src="{{asset('assets/img/slider/2.jpg')}}">
            <div class="caption left-align">
              <h3 class="blue-text text-darken-3">This is our big Tagline!</h3>
              <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
            </div>
          </li>
          <li>
            <img src="{{asset('assets/img/slider/3.jpg')}}">
            <div class="caption center-align">
              <h3 class="blue-text text-darken-3">This is our big Tagline!</h3>
              <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
            </div>
          </li>
        </ul>
      </div>

      <!-- About Us -->
      <section id="about" class="about scrollspy">
      <div class="container">
        <div class="row">
          <h3 class="center light grey-text text-darken-3">About Us</h3>
          <div class="col m6 light">
            <h5>Sejarah Yekape</h5>
            <p>Didirikan pada tanggal 15 Februari 1995 oleh Yayasan Kas Pembangunan untuk memenuhi kebutuhan rumah untuk masyarakat surabaya khususnya Aparatur Sipil Negara (ASN) Kota Surabaya yang belum memiliki rumah. </p>
            <p>Seiring berjalannya waktu PT. Yekape saat ini bergerak dengan cakupan yang lebih luas lagi di bidang perumahan untuk Masyarakat Umum terkait kebutuhan rumah dengan Pelayanan Terbaik.</p>
          </div>
           <div class="col m6 light">
            <h5>VISI :</h5>
            <p>Menjadi Perusahaan Pengembang yang berkualitas di Kotamadya Surabaya.</p>
            <h5>MISI :</h5>
            <table border="0" class="striped responsive">
              <tr>
                <td>1</td>
                <td>Mengembangkan tipe rumah yang terjangkau lapisan masyarakat.</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Memberikan pelayanan yang mudah dan transparansi.</td>
              </tr>
              <tr>
                <td>3</td>
                <td>Menjaga kualitas pelayanan administrasi.</td>
              </tr>
               <tr>
                <td>4</td>
                <td>Menjaga kualitas hunian hasil pekerjaan.</td>
              </tr>
               <tr>
                <td>5</td>
                <td>Menerapkan Sistem Manajemen Mutu ISO 9001:2008 di semua kegiatan operasional perusahaan dan senantiasa melakukan improvement.</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      </section>

      <!-- Portofolio -->
      <div class="portofolio parallax-container scrollspy" id="portofolio">
        <div class="parallax"><img src="{{asset('assets/img/slider/2.png')}}"></div>
        <div class="container produk">
          <div class="row">
            <h3 class="center light black-text text-darken-3">Portofolio</h3>
            <div class="col m12 light">
              <div class="card-panel">
                <div class="row">
                  <div class="col m6 light">
                    <h5>Taman Rivera</h5>
                    <p>Didirikan pada tanggal 15 Februari 1995 oleh Yayasan Kas Pembangunan untuk memenuhi kebutuhan rumah untuk masyarakat surabaya khususnya Aparatur Sipil Negara (ASN) Kota Surabaya yang belum memiliki rumah. </p>
                  </div>
                  <div class="col m6 light">
                    <img src="{{asset('assets/img/portfolio/1.jpg')}}" class="responsive-img">
                  </div>
                </div>
              </div>
              <div class="card-panel">
                <div class="row">
                  <div class="col m6 light">
                    <img src="{{asset('assets/img/portfolio/1.jpg')}}" class="responsive-img">
                  </div>
                  <div class="col m6 light">
                    <h5>Taman Rivera</h5>
                    <p>Didirikan pada tanggal 15 Februari 1995 oleh Yayasan Kas Pembangunan untuk memenuhi kebutuhan rumah untuk masyarakat surabaya khususnya Aparatur Sipil Negara (ASN) Kota Surabaya yang belum memiliki rumah. </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Produk -->
      <section id="product" class="product scrollspy grey lighten-1">
      <div class="container">
        <div class="row">
          <h3 class="center light white-text text-darken-3">Available Now</h3>
          <div class="col m12 light">
            <div class="card-panel">
              <h5 class="center">ECO MEDAYU</h5>
              <p>Didirikan pada tanggal 15 Februari 1995 oleh Yayasan Kas Pembangunan untuk memenuhi kebutuhan rumah untuk masyarakat surabaya khususnya Aparatur Sipil Negara (ASN) Kota Surabaya yang belum memiliki rumah. </p>
              <div class="row">
                <div class="col m4 s12">
                  <img src="{{asset('assets/img/portfolio/1.jpg')}}" class="responsive-img materialboxed">
                </div>
                <div class="col m4 s12">
                  <img src="{{asset('assets/img/portfolio/2.jpg')}}" class="responsive-img materialboxed">
                </div>
                <div class="col m4 s12">
                  <img src="{{asset('assets/img/portfolio/3.jpg')}}" class="responsive-img materialboxed">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </section>


      <!-- Contact Us -->
      <section id="contact" class="contact grey lighten-3 scrollspy">
      <div class="container">
        <div class="row">
          <h3 class="center light grey-text text-darken-3">Contact Us</h3>
          <div class="row">
            <div class="col m5 s12">
              <div class="card-panel teal darken-3 center white-text">
                <i class="material-icons">email</i>
                <h5>Contact</h5>
                <p>yekape.sby@gmail.com</p>
              </div>
              <ul class="collection with-header">
                <li class="collection-header">Our Office</li>
                <li class="collection-item">Jalan Wijaya Kusuma No.36</li>
                <li class="collection-item">Surabaya</li>
                <li class="collection-item">031 12312 123123</li>
              </ul>
            </div>

            <div class="col m7 s12">
              <div class="card-panel">
                <h5>Please Fill this Form to ask Us</h5>
                <div class="input-field">
                  <input type="text" name="nama" id="nama">
                  <label for="nama">Nama</label>
                </div>
                <div class="input-field">
                  <input type="text" name="telp" id="telp">
                  <label for="telp">No WA</label>
                </div>
                <div class="input-field">
                  <textarea name="question" id="question" class="materialize-textarea"></textarea>
                  <label for="question">Pertanyaan</label>
                </div>
                <button type="submit" class="btn teal darken-3">Send</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      </section>

      <!-- begin:: Footer -->
          <div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
            <div class="kt-container  kt-container--fluid ">
              <div class="kt-footer__copyright">
                2019&nbsp;&copy;&nbsp;<a href="http://keenthemes.com/metronic" target="_blank" class="kt-link">Keenthemes</a>
              </div>
              <div class="kt-footer__menu">
                <a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">About</a>
                <a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">Team</a>
                <a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">Contact</a>
              </div>
            </div>
          </div>


      <!-- footer -->
      <!-- <footer class="teal darken-3 white-text">
        <div class="container">
          <div class="row">
            <h3 class="center light text-darken-3">Contact Us</h3>
          </div>
          <div class="row">
            <div class="col m4">
              <p style="margin-bottom: 0; font-weight: bold">Our Office :</p>
              Jalan Wijaya Kusuma No.36 Surabaya
              <p style="margin-bottom: 0; font-weight: bold">Telp :</p>
              (031) 3222 1234
            </div>
            <div class="col m4 center center-align">
              <img alt="Logo" src="{{asset('assets/lg-original.png')}}" height="150" />
            </div>
            <div class="col m4" style="text-align: center">
              <p style="margin-bottom: 0; font-weight: bold">Email :</p>
              yekape.sby@gmail.com
              <p style="margin-bottom: 0; font-weight: bold">Connect with us :</p>
              <div class="form-group">
                <label>&nbsp;</label>
                <div class="form-group-append">
                  <button type="button" class="btn btn-brand btn-sm" id="filter">FILTER</button>
                </div>
              </div>
            </div>
          </div>
        </div> -->
        <!-- <p class="flow-text">PT. Yekape Surabaya. Copyright 2020.</p> -->
      <!-- </footer> -->

      <!--JavaScript at end of body for optimized loading-->
      <script src="{{asset('assets/js/materialize.min.js')}}" type="text/javascript"></script>
      <script type="text/javascript">
        const sideNav = document.querySelectorAll('.sidenav');
        M.Sidenav.init(sideNav);

        const slider = document.querySelectorAll('.slider');
        M.Slider.init(slider, {
          indicators: false,
          height: 500,
          transition: 600,
          interval: 3000
        });

        const carousel = document.querySelectorAll('.carousel');
        M.Carousel.init(carousel, {
          fullWidth: true
        });

        const parallax = document.querySelectorAll('.parallax');
        M.Parallax.init(parallax);

        const materialbox = document.querySelectorAll('.materialboxed');
        M.Materialbox.init(materialbox);

        const scroll = document.querySelectorAll('.scrollspy');
        M.ScrollSpy.init(scroll, {
          scrollOffset: 60
        });


      </script>
    </body>
  </html>