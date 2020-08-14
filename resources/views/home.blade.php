 <!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link href="{{asset('assets/css/materialize.min.css')}}" rel="stylesheet" type="text/css" media="screen,projection"/>
      
      <!-- my css -->
      <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css" media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>PT Yekape Surabaya</title>
    </head>

    <body>
    <!-- navbar -->
      <div class="navbar-fixed">
        <nav class="light-green darken-2">
          <div class="container">
            <div class="nav-wrapper">
              <a href="#!" class="brand-logo" style="font-size: 100%; font-weight: bold">PT. Yekape Surabaya</a>
              <a href="#" data-target="mobile-nav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
              <ul class="right hide-on-med-and-down">
                <li><a href="">About Us</a></li>
                <li><a href="">Product</a></li>
                <li><a href="">Portofolio</a></li>
                <li><a href="">Contact Us</a></li>
              </ul>
            </div>
          </div>
        </nav>
      </div>

      <!-- sidenav -->
      <ul class="sidenav" id="mobile-nav">
        <li><a href="">About Us</a></li>
        <li><a href="">Product</a></li>
        <li><a href="">Portofolio</a></li>
        <li><a href="">Contact Us</a></li>
      </ul>

      <!-- slider -->
      <div class="slider">
        <ul class="slides">
          <li>
            <img src="{{asset('assets/img/slider/1.png')}}">
            <div class="caption left-align">
              <h3>This is our big Tagline!</h3>
              <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
            </div>
          </li>
          <li>
            <img src="{{asset('assets/img/slider/2.png')}}">
            <div class="caption right-align">
              <h3>This is our big Tagline!</h3>
              <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
            </div>
          </li>
          <li>
            <img src="{{asset('assets/img/slider/3.png')}}">
            <div class="caption center-align">
              <h3>This is our big Tagline!</h3>
              <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
            </div>
          </li>
        </ul>
      </div>

      <!-- About Us -->
      <section id="about" class="about">
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
      <div class="parallax-container">
        <div class="parallax"><img src="{{asset('assets/img/slider/4.png')}}"></div>

        <div class="container produk">
          <h3 class="center light white-text">Produk</h3>
          <div class="row">
            <div class="col m3 s12">
              <img src="{{asset('assets/img/portfolio/1.png')}}" class="responsive-img materialboxed">
            </div>
            <div class="col m3 s12">
              <img src="{{asset('assets/img/portfolio/2.png')}}" class="responsive-img materialboxed">
            </div>
            <div class="col m3 s12">
              <img src="{{asset('assets/img/portfolio/3.png')}}" class="responsive-img materialboxed">
            </div>
            <div class="col m3 s12">
              <img src="{{asset('assets/img/portfolio/4.png')}}" class="responsive-img materialboxed">
            </div>
          </div>
        </div>
      </div>


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


      </script>
    </body>
  </html>