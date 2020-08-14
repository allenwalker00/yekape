 <!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
              <a href="#home" class="brand-logo" style="font-size: 100%;">PT. Yekape Surabaya</a>
              <a href="#" data-target="mobile-nav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
              <ul class="right hide-on-med-and-down">
                <li><a href="#about">About Us</a></li>
                <li><a href="#produk">Produk</a></li>
                <li><a href="#contact">Contact Us</a></li>
              </ul>
            </div>
          </div>
        </nav>
      </div>

      <!-- sidenav -->
      <ul class="sidenav" id="mobile-nav">
        <li><a href="#about">About Us</a></li>
        <li><a href="#produk">Produk</a></li>
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
            <h5>We Are Professional</h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam perspiciatis neque, expedita mollitia! Velit est, qui repudiandae distinctio quis maxime obcaecati ad enim deleniti ex! Dolorem at porro doloremque quis.</p>
          </div>
           <div class="col m6 light">
            <p style="font-weight: bold">ECO MEDAYU</p>
            <div class="progress">
              <div class="determinate" style="width: 70%"></div>
            </div>
            <p style="font-weight: bold">VILLA EIDELWEISS</p>
            <div class="progress">
              <div class="determinate" style="width: 90%"></div>
            </div>
          </div>
        </div>
      </div>
      </section>

      <!-- Produk -->
      <div class="parallax-container scrollspy" id="produk">
        <div class="parallax"><img src="{{asset('assets/img/slider/4.png')}}"></div>
        <div class="container produk">
          <h3 class="center light black-text">Produk</h3>
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

      <!-- footer -->
      <footer class="teal darken-3 white-text center">
        <p class="flow-text">PT. Yekape Surabaya. Copyright 2020.</p>
      </footer>


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