 <!DOCTYPE html>
<html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

      <link href="{{asset('assets/css/materialize.css')}}" type="text/css" rel="stylesheet" media="screen,projection" />
      <link href="{{asset('assets/css/style.css')}}" type="text/css" rel="stylesheet" media="screen,projection" />
      <link rel="stylesheet" href="{{asset('assets/css/materialize-social.css')}}">
      
      <!-- my css -->
      <link href="{{asset('assets/css/myStyle.css')}}" rel="stylesheet" type="text/css"/>
      <link rel="shortcut icon" href="{{asset('assets/lg-original.png')}}" />

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>PT Yekape Surabaya</title>
    </head>

    <body id="home" class="scrollspy">
      <div class="navbar-fixed">
        <nav class="teal darken-3">
          <div class="container">
            <div class="nav-wrapper">
              <a href="{{url('/admin')}}" class="brand-logo responsive" style="font-size: 100%;">PT. Yekape Surabaya</a>
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
              <h3 class="yellow-text text-darken-3" style="font-weight: bold">This is our big Tagline!</h3>
              <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
            </div>
          </li>
          <li>
            <img src="{{asset('assets/img/slider/2.jpg')}}">
            <div class="caption left-align">
              <h3 class="yellow-text text-darken-3" style="font-weight: bold">This is our big Tagline!</h3>
              <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
            </div>
          </li>
          <li>
            <img src="{{asset('assets/img/slider/3.jpg')}}">
            <div class="caption center-align">
              <h3 class="yellow-text text-darken-3" style="font-weight: bold">This is our big Tagline!</h3>
              <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
            </div>
          </li>
        </ul>
      </div>

      <!-- About Us -->
      <section id="about" class="about scrollspy">
      <div class="container">
        <div class="row">
          <h3 class="center light grey-text text-darken-3" style="font-weight: bold">About Us</h3>
          <div class="col m6 light">
            <h5>HISTORY</h5>
            <p>Didirikan pada tanggal 15 Februari 1995 oleh Yayasan Kas Pembangunan untuk memenuhi kebutuhan rumah untuk masyarakat surabaya khususnya Aparatur Sipil Negara (ASN) Kota Surabaya yang belum memiliki rumah. </p>
            <p>Seiring berjalannya waktu PT. Yekape saat ini bergerak dengan cakupan yang lebih luas lagi di bidang perumahan untuk Masyarakat Umum terkait kebutuhan rumah dengan Pelayanan Terbaik.</p>
            <h5>VISI</h5>
            <p>Menjadi Perusahaan Pengembang yang berkualitas di Kotamadya Surabaya.</p>
          </div>
           <div class="col m6 light">
            <h5>MISI</h5>
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
            <h3 class="center light black-text text-darken-3" style="font-weight: bold">Portofolio</h3>
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
          <h3 class="center light white-text text-darken-3" style="font-weight: bold">Available Now</h3>
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

      <!-- footer -->
      <footer class="teal darken-3 white-text" id="contact">
          <div class="row">
            <h3 class="center light text-darken-3" style="font-weight: bold">Contact Us</h3>
          </div>
          <div class="container">
            <div class="row">
              <div class="col m4 s12 center">
                <p style="margin-bottom: 0; font-weight: bold">Our Office :</p>
                Jalan Wijaya Kusuma No.36 Surabaya
                <p style="margin-bottom: 0; font-weight: bold">Telp :</p>
                (031) 3222 1234
              </div>
              <div class="col m4 s12 center center-align">
                <img alt="Logo" src="{{asset('assets/lg-original.png')}}" height="150" />
              </div>
              <div class="col m4 s12" style="text-align: center">
                <p style="margin-bottom: 0; font-weight: bold">Email :</p>
                yekape.sby@gmail.com
                <p style="margin-bottom: 0; font-weight: bold">Connect with us :</p>
                <p>
                <a href="https://www.instagram.com/yekapesurabaya/" class="waves-effect waves-light btn-floating social instagram social-icon" target="_blank"><i class="fa fa-instagram"></i> Sign in with instagram</a>
                <a href="https://www.instagram.com/yekapesurabaya/" class="waves-effect waves-light btn-floating social facebook social-icon" target="_blank"><i class="fa fa-facebook"></i> Sign in with instagram</a>
                <p>
              </div>
            </div>
          </div>
      </footer>

      <!--JavaScript at end of body for optimized loading-->
      <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <!-- <script src="{{asset('assets/js/materialize.min.js')}}" type="text/javascript"></script> -->
      <script src="{{asset('assets/js/materialize.js')}}" type="text/javascript"></script>
      <!-- <script src="{{asset('assets/js/init.js')}}" type="text/javascript"></script> -->
      <script type="text/javascript">
        const sideNav = document.querySelectorAll('.sidenav');
        M.Sidenav.init(sideNav);

        const slider = document.querySelectorAll('.slider');
        M.Slider.init(slider, {
          indicators: false,
          height: 500,
          transition: 300,
          interval: 4000
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