<!DOCTYPE html>
<!--
Template: Metronic Frontend Freebie - Responsive HTML Template Based On Twitter Bootstrap 3.3.4
Version: 1.0.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase Premium Metronic Admin Theme: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>PT Yekape Surabaya</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href='http://fonts.googleapis.com/css?family=Hind:400,500,300,600,700' rel='stylesheet' type='text/css'>
<link href="{{asset('assets/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="{{asset('assets/pages/css/animate.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/owl.carousel/assets/owl.carousel.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/cubeportfolio/cubeportfolio/css/cubeportfolio.min.css')}}" rel="stylesheet">
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="{{asset('assets/onepage2/css/layout.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/onepage2/css/custom.css')}}" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="{{asset('assets/lg-original.png')}}" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-on-scroll" class to the body element to set fixed header layout -->
<body class="page-header-fixed">

  <!-- BEGIN MAIN LAYOUT -->
  <!-- Header BEGIN -->
    <header class="page-header">
        <nav class="navbar navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="toggle-icon">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#intro">
                        <img class="logo-default" src="assets/onepage2/img/logo_default.png" alt="Logo">
                        <img class="logo-scroll" src="assets/onepage2/img/logo_scroll.png" alt="Logo">
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-responsive-collapse">
                    <ul class="nav navbar-nav">
                        <li class="page-scroll active">
                            <a href="#intro">Home</a>
                        </li>
                        <li class="page-scroll">
                            <a href="#about">About Us</a>
                        </li>
                        <li class="page-scroll">
                            <a href="#team">Executive</a>
                        </li>
                        <li class="page-scroll">
                            <a href="#clients">Portofolio</a>
                        </li>                    
                        <li class="page-scroll">
                            <a href="#portfolio">Available</a>
                        </li>
                        <li class="page-scroll">
                            <a href="#contact">Contact Us</a>
                        </li>
                        <li class="page-scroll">
                            <a href="{{url('/admin')}}">Login</a>
                        </li>
                    </ul>
                </div>
                <!-- End Navbar Collapse -->
            </div>
            <!--/container-->
        </nav>
    </header>
    <!-- Header END -->

    <!-- BEGIN INTRO SECTION -->
    <section id="intro">
        <div id="carousel-example-generic" class="carousel slide">
            <!-- Indicators -->
            <!-- <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol> -->

            <!-- Wrapper for slides -->
            <div class="carousel-inner text-uppercase" role="listbox">
                <!-- First slide -->
                <div class="item carousel-item-one active">
                    <div class="container">
                        <h3 class="carousel-position-one animate-delay carousel-title-v1" data-animation="animated fadeInDown">
                            BUILD A FUTURE
                        </h3>
                        <p class="carousel-position-two animate-delay carousel-subtitle-v1" data-animation="animated fadeInDown">
                            Real Estate Developer <br> with 26 years of experience in landed house
                        </p>
                        <!-- <a href="#" class="carousel-position-three animate-delay btn-brd-white" data-animation="animated fadeInUp">Learn More</a> -->
                    </div>
                </div>
               
                <!-- Second slide -->
                <div class="item carousel-item-two">
                    <div class="container">
                        <h3 class="carousel-position-one animate-delay carousel-title-v2" data-animation="animated fadeInDown">
                            Ultimate Apps <br> for Business
                        </h3>
                        <p class="carousel-position-three animate-delay carousel-subtitle-v2" data-animation="animated fadeInDown">
                            Available in: Android &amp; IOS
                        </p>
                    </div>
                </div>

                <!-- Third slide -->
                <div class="item carousel-item-three">
                    <div class="center-block">
                        <div class="center-block-wrap">
                            <div class="center-block-body">
                                <h3 class="margin-bottom-20 animate-delay carousel-title-v1" data-animation="animated fadeInDown">
                                    Let us show you
                                </h3>
                                <p class="margin-bottom-20 animate-delay carousel-title-v3" data-animation="animated fadeInDown">
                                    A few things
                                </p>
                                <a href="#" class="animate-delay btn-brd-white" data-animation="animated fadeInUp">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END INTRO SECTION -->

    <!-- BEGIN MAIN LAYOUT -->
    <div class="page-content">

        <!-- BEGIN ABOUT SECTION -->
        <section id="about">
            <!-- Services BEGIN -->
            <div class="container service-bg">
                <div class="heading">
                    <h2><strong>About</strong> Us</h2>
                </div><!-- //end heading -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="services sm-margin-bottom-100" style="text-align: left">
                            <h2>HISTORY</h2>
                            <p>Didirikan pada tanggal 15 Februari 1995 oleh Yayasan Kas Pembangunan untuk memenuhi kebutuhan rumah untuk masyarakat surabaya khususnya Aparatur Sipil Negara (ASN) Kota Surabaya yang belum memiliki rumah. </p>
                            <p>Seiring berjalannya waktu PT. Yekape saat ini bergerak dengan cakupan yang lebih luas lagi di bidang perumahan untuk Masyarakat Umum terkait kebutuhan rumah dengan Pelayanan Terbaik.</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="services sm-margin-bottom-100" style="text-align: left">
                            <h2>VISI</h2>
                            <p>Menjadi Perusahaan Pengembang yang berkualitas di Kotamadya Surabaya.</p>
                            <br>
                            <h2>MISI</h2>
                            <p>1. Mengembangkan tipe rumah yang terjangkau lapisan masyarakat.</p>
                            <p>2. Memberikan pelayanan yang mudah dan transparansi.</p>
                            <p>3. Menjaga kualitas pelayanan administrasi.</p>
                            <p>4. Menjaga kualitas hunian hasil pekerjaan.</p>
                            <p>5. Menerapkan Sistem Manajemen Mutu ISO 9001:2008 di semua kegiatan operasional perusahaan dan senantiasa melakukan improvement.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Services END -->
        </section>
        <!-- END ABOUT SECTION -->

        <!-- BEGIN TEAM SECTION -->
        <section id="team">
            <!-- Team BEGIN -->
            <div class="team-bg parallax">
                <div class="container">
                    <div class="heading-light">
                        <h2>Our <strong>Executive</strong></h2>
                    </div><!-- //end heading -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-sm-4">
                                    &nbsp;
                                </div>
                                <div class="col-sm-4">
                                    <div class="team-members">
                                        <div class="team-avatar">
                                            <img class="img-responsive" src="assets/onepage2/img/member/member2.png" alt="">
                                        </div>
                                        <div class="team-desc">
                                            <div class="team-details">
                                                <h4>John Doe</h4>
                                                <span>President Director</span>
                                            </div>
                                            <!-- <ul class="team-socials">
                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                <li><a href="#"><`i class="fa fa-twitter"></i></a></li>
                                            </ul> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    &nbsp;
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    &nbsp;
                                </div>
                                <div class="col-sm-2">
                                    <div class="team-members">
                                        <div class="team-avatar">
                                            <img class="img-responsive" src="assets/onepage2/img/member/member6.png" alt="">
                                        </div>
                                        <div class="team-desc">
                                            <div class="team-details">
                                                <h4>John Doe</h4>
                                                <span>Bag. Umum</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="team-members">
                                        <div class="team-avatar">
                                            <img class="img-responsive" src="assets/onepage2/img/member/member1.png" alt="">
                                        </div>
                                        <div class="team-desc">
                                            <div class="team-details">
                                                <h4>John Doe</h4>
                                                <span>Bag. Pemasaran</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="team-members">
                                        <div class="team-avatar">
                                            <img class="img-responsive" src="assets/onepage2/img/member/member3.png" alt="">
                                        </div>
                                        <div class="team-desc">
                                            <div class="team-details">
                                                <h4>John Doe</h4>
                                                <span>Bag. Keuangan</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="team-members">
                                        <div class="team-avatar">
                                            <img class="img-responsive" src="assets/onepage2/img/member/member4.png" alt="">
                                        </div>
                                        <div class="team-desc">
                                            <div class="team-details">
                                                <h4>John Doe</h4>
                                                <span>Bag Pemeliharaan</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="team-members">
                                        <div class="team-avatar">
                                            <img class="img-responsive" src="assets/onepage2/img/member/member5.png" alt="">
                                        </div>
                                        <div class="team-desc">
                                            <div class="team-details">
                                                <h4>John Doe</h4>
                                                <span>Bag. Pembangunan</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    &nbsp;
                                </div>
                            </div><!-- //end row -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Team END -->
        </section>
        <!-- END TEAM SECTION -->

        <!-- BEGIN CLIENTS SECTION -->
        <section id="clients">
            <div class="clients">
                <div class="clients-bg">
                    <div class="container">
                        <div class="heading-blue">
                            <h2>Over <strong>10.000</strong> Units</h2>
                            <p>that We Build From 1952 until Now and it's still counting</p>
                        </div><!-- //end heading -->

                        <!-- Owl Carousel -->
                        <div class="owl-carousel">
                            <div class="item" data-quote="#client-quote-1">
                                <img src="assets/onepage2/img/clients/logo1.png" alt="">
                            </div>
                            <div class="item" data-quote="#client-quote-2">
                                <img src="assets/onepage2/img/clients/logo2.png" alt="">
                            </div>
                            <div class="item" data-quote="#client-quote-3">
                                <img src="assets/onepage2/img/clients/logo3.png" alt="">
                            </div>
                            <div class="item" data-quote="#client-quote-4">
                                <img src="assets/onepage2/img/clients/logo4.png" alt="">
                            </div>
                            <div class="item" data-quote="#client-quote-5">
                                <img src="assets/onepage2/img/clients/logo5.png" alt="">
                            </div>
                            <div class="item" data-quote="#client-quote-6">
                                <img src="assets/onepage2/img/clients/logo6.png" alt="">
                            </div>
                            <div class="item" data-quote="#client-quote-7">
                                <img src="assets/onepage2/img/clients/logo7.png" alt="">
                            </div>
                            <div class="item" data-quote="#client-quote-8">
                                <img src="assets/onepage2/img/clients/logo8.png" alt="">
                            </div>
                            <div class="item" data-quote="#client-quote-9">
                                <img src="assets/onepage2/img/clients/logo9.png" alt="">
                            </div>
                            <div class="item" data-quote="#client-quote-10">
                                <img src="assets/onepage2/img/clients/logo10.png" alt="">
                            </div>
                            <div class="item" data-quote="#client-quote-11">
                                <img src="assets/onepage2/img/clients/logo11.png" alt="">
                            </div>
                            <div class="item" data-quote="#client-quote-12">
                                <img src="assets/onepage2/img/clients/logo12.png" alt="">
                            </div>
                            <div class="item" data-quote="#client-quote-13">
                                <img src="assets/onepage2/img/clients/logo13.png" alt="">
                            </div>
                            <div class="item" data-quote="#client-quote-14">
                                <img src="assets/onepage2/img/clients/logo14.png" alt="">
                            </div>
                            <div class="item" data-quote="#client-quote-15">
                                <img src="assets/onepage2/img/clients/logo15.png" alt="">
                            </div>
                            <div class="item" data-quote="#client-quote-16">
                                <img src="assets/onepage2/img/clients/logo16.png" alt="">
                            </div>
                            <div class="item" data-quote="#client-quote-17">
                                <img src="assets/onepage2/img/clients/logo17.png" alt="">
                            </div>
                            <div class="item" data-quote="#client-quote-18">
                                <img src="assets/onepage2/img/clients/logo18.png" alt="">
                            </div>
                            <div class="item" data-quote="#client-quote-19">
                                <img src="assets/onepage2/img/clients/logo19.png" alt="">
                            </div>
                            <div class="item" data-quote="#client-quote-20">
                                <img src="assets/onepage2/img/clients/logo20.png" alt="">
                            </div>
                        </div>
                        <!-- End Owl Carousel -->
                    </div>
                </div>
                
                <!-- Clients Quotes -->
                <div class="clients-quotes">
                    <div class="container">
                        <div class="client-quote" id="client-quote-1">
                            <p>Luas Tanah 1 Ha; Jumlah Rumah 23 Unit; Panjang Jalan 1,085 Km</p>
                            <h4>Tahun 1952 - 1953</h4>
                        </div>
                        <div class="client-quote" id="client-quote-2">
                            <p>Luas Tanah 2 Ha; Jumlah Rumah 62 Unit; Panjang Jalan 0,78 Km</p>
                            <h4>Tahun 1952 - 1956</h4>
                        </div>
                        <div class="client-quote" id="client-quote-3">
                            <p>Luas Tanah 2,5 Ha; Jumlah Rumah 171 Unit; Panjang Jalan 2,55 Km</p>
                            <h4>Tahun 1953 - 1957</h4>
                        </div>
                        <div class="client-quote" id="client-quote-4">
                            <p>Luas Tanah 0,75 Ha; Jumlah Rumah 16 Unit; Panjang Jalan 0,26 Km</p>
                            <h4>Tahun 1953</h4>
                        </div>
                        <div class="client-quote" id="client-quote-5">
                            <p>Luas Tanah 1 Ha; Jumlah Rumah 22 Unit; Panjang Jalan 0,93 Km</p>
                            <h4>Tahun 1956 - 1958</h4>
                        </div>
                        <div class="client-quote" id="client-quote-6">
                            <p>Luas Tanah 8,5 Ha; Jumlah Rumah 200 Unit; Panjang Jalan 2,55 Km</p>
                            <h4>Tahun 1956 - 1960</h4>
                        </div>
                        <div class="client-quote" id="client-quote-7">
                            <p>Luas Tanah 0,5 Ha; Jumlah Rumah 10 Unit; Panjang Jalan 0,15 Km</p>
                            <h4>Tahun 1958</h4>
                        </div>
                        <div class="client-quote" id="client-quote-8">
                            <p>Luas Tanah 15 Ha; Jumlah Rumah 302 Unit; Panjang Jalan 4,5 Km</p>
                            <h4>Tahun 1960 - 1964</h4>
                        </div>
                        <div class="client-quote" id="client-quote-9">
                            <p>Luas Tanah 1,25 Ha; Jumlah Rumah 29 Unit; Panjang Jalan 0,4 Km</p>
                            <h4>Tahun 1962 - 1963</h4>
                        </div>
                        <div class="client-quote" id="client-quote-10">
                            <p>Luas Tanah 5,5 Ha; Jumlah Rumah 122 Unit; Panjang Jalan 1,75 Km</p>
                            <h4>Tahun 1962 - 1964</h4>
                        </div>
                        <div class="client-quote" id="client-quote-11">
                            <p>Luas Tanah 2 Ha; Jumlah Rumah 44 Unit; Panjang Jalan 1 Km</p>
                            <h4>Tahun 1963 - 1964</h4>
                        </div>
                        <div class="client-quote" id="client-quote-12">
                            <p>Luas Tanah 9,85 Ha; Jumlah Rumah 228 Unit; Panjang Jalan 1,68 Km</p>
                            <h4>Tahun 1964 - 1973</h4>
                        </div>
                        <div class="client-quote" id="client-quote-13">
                            <p>Luas Tanah 14,8 Ha; Jumlah Rumah 361 Unit; Panjang Jalan 3,5 Km</p>
                            <h4>Tahun 1965 - 1973</h4>
                        </div>
                        <div class="client-quote" id="client-quote-14">
                            <p>Luas Tanah 42 Ha; Jumlah Rumah 901 Unit; Panjang Jalan 8,08 Km</p>
                            <h4>Tahun 1972 - 1975</h4>
                        </div>
                        <div class="client-quote" id="client-quote-15">
                            <p>Luas Tanah 90,5 Ha; Jumlah Rumah 1.343 Unit; Panjang Jalan 22,035 Km</p>
                            <h4>Tahun 1974 - 1980</h4>
                        </div>
                        <div class="client-quote" id="client-quote-16">
                            <p>Luas Tanah 78 Ha; Jumlah Rumah 1.336 Unit; Panjang Jalan 17,88 Km</p>
                            <h4>Tahun 1979 - 1983</h4>
                        </div>
                        <div class="client-quote" id="client-quote-17">
                            <p>Luas Tanah 115 Ha; Jumlah Rumah 2.675 Unit; Panjang Jalan 11,28 Km</p>
                            <h4>Tahun 1983 - 1987</h4>
                        </div>
                        <div class="client-quote" id="client-quote-18">
                            <p>Luas Tanah 130 Ha; Jumlah Rumah 1.668 Unit; Panjang Jalan 12,4 Km</p>
                            <h4>Tahun 1994</h4>
                        </div>
                        <div class="client-quote" id="client-quote-19">
                            <p>Luas Tanah 10 Ha; Jumlah Rumah 135 Unit; Panjang Jalan 2,44 Km</p>
                            <h4>Tahun 1995 - 1996</h4>
                        </div>
                        <div class="client-quote" id="client-quote-20">
                            <p>Luas Tanah 12 Ha; Jumlah Rumah 200 Unit; Panjang Jalan 3,96 Km</p>
                            <h4>Tahun 1995 - 1996</h4>
                        </div>
                    </div>
                </div>
                <!-- End Clients Quotes -->
            </div>
        </section>
        <!-- END CLIENTS SECTION -->

        <!-- BEGIN PORTFOLIO SECTION -->
        <section id="portfolio">
            <div class="portfolio">
                <div class="container">
                    <div class="heading">
                        <h2>Available <strong>Products</strong></h2>
                    </div>

                    
                    <div class="cube-portfolio">
                        <div id="filters-container" class="cbp-l-filters-alignCenter">
                            <div data-filter="*" class="cbp-filter-item-active cbp-filter-item"> All </div>
                            <div data-filter=".ecomedayu" class="cbp-filter-item"> Eco Medayu </div>
                            <div data-filter=".rivera" class="cbp-filter-item"> Taman Rivera </div>
                            <<!-- div data-filter=".corporate" class="cbp-filter-item"> Corporate </div>
                            <div data-filter=".retail" class="cbp-filter-item"> Retail </div> -->
                        </div>
                        <div class="row">
                            
                            <div class="col-md-12">
                                <!-- Cube Portfolio -->
                                <div id="grid-container" class="cbp-l-grid-agency">
                                    <div class="cbp-item ecomedayu">
                                        <div class="cbp-caption">
                                            <div class="cbp-caption-hover-gradient">
                                                <img src="assets/onepage2/img/portfolio/01.png" alt="">
                                            </div>
                                            <div class="cbp-caption-activeWrap">
                                                <div class="cbp-l-caption-alignCenter">
                                                    <div class="cbp-l-caption-body portfolio-icons">
                                                        <a href="assets/onepage2/img/portfolio/01.png" class="cbp-lightbox" data-title="Title"><i class="fa fa-search"></i></a>
                                                        <a href="#"><i class="fa fa-file"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cbp-item ecomedayu">
                                        <div class="cbp-caption">
                                            <div class="cbp-caption-hover-gradient">
                                                <img src="assets/onepage2/img/portfolio/02.png" alt="">
                                            </div>
                                            <div class="cbp-caption-activeWrap">
                                                <div class="cbp-l-caption-alignCenter">
                                                    <div class="cbp-l-caption-body portfolio-icons">
                                                        <a href="assets/onepage2/img/portfolio/02.png" class="cbp-lightbox" data-title="Title"><i class="fa fa-search"></i></a>
                                                        <a href="#"><i class="fa fa-file"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cbp-item ecomedayu">
                                        <div class="cbp-caption">
                                            <div class="cbp-caption-hover-gradient">
                                                <img src="assets/onepage2/img/portfolio/03.png" alt="">
                                            </div>
                                            <div class="cbp-caption-activeWrap">
                                                <div class="cbp-l-caption-alignCenter">
                                                    <div class="cbp-l-caption-body portfolio-icons">
                                                        <a href="assets/onepage2/img/portfolio/03.png" class="cbp-lightbox" data-title="Title"><i class="fa fa-search"></i></a>
                                                        <a href="#"><i class="fa fa-file"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cbp-item ecomedayu">
                                        <div class="cbp-caption">
                                            <div class="cbp-caption-hover-gradient">
                                                <img src="assets/onepage2/img/portfolio/04.png" alt="">
                                            </div>
                                            <div class="cbp-caption-activeWrap">
                                                <div class="cbp-l-caption-alignCenter">
                                                    <div class="cbp-l-caption-body portfolio-icons">
                                                        <a href="assets/onepage2/img/portfolio/04.png" class="cbp-lightbox" data-title="Title"><i class="fa fa-search"></i></a>
                                                        <a href="#"><i class="fa fa-file"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cbp-item ecomedayu">
                                        <div class="cbp-caption">
                                            <div class="cbp-caption-hover-gradient">
                                                <img src="assets/onepage2/img/portfolio/05.png" alt="">
                                            </div>
                                            <div class="cbp-caption-activeWrap">
                                                <div class="cbp-l-caption-alignCenter">
                                                    <div class="cbp-l-caption-body portfolio-icons">
                                                        <a href="assets/onepage2/img/portfolio/05.png" class="cbp-lightbox" data-title="Title"><i class="fa fa-search"></i></a>
                                                        <a href="#"><i class="fa fa-file"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cbp-item ecomedayu">
                                        <div class="cbp-caption">
                                            <div class="cbp-caption-hover-gradient">
                                                <img src="assets/onepage2/img/portfolio/06.png" alt="">
                                            </div>
                                            <div class="cbp-caption-activeWrap">
                                                <div class="cbp-l-caption-alignCenter">
                                                    <div class="cbp-l-caption-body portfolio-icons">
                                                        <a href="assets/onepage2/img/portfolio/06.png" class="cbp-lightbox" data-title="Title"><i class="fa fa-search"></i></a>
                                                        <a href="#"><i class="fa fa-file"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   <div class="cbp-item ecomedayu">
                                        <div class="cbp-caption">
                                            <div class="cbp-caption-hover-gradient">
                                                <img src="assets/onepage2/img/portfolio/07.png" alt="">
                                            </div>
                                            <div class="cbp-caption-activeWrap">
                                                <div class="cbp-l-caption-alignCenter">
                                                    <div class="cbp-l-caption-body portfolio-icons">
                                                        <a href="assets/onepage2/img/portfolio/07.png" class="cbp-lightbox" data-title="Title"><i class="fa fa-search"></i></a>
                                                        <a href="#"><i class="fa fa-file"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cbp-item ecomedayu">
                                        <div class="cbp-caption">
                                            <div class="cbp-caption-hover-gradient">
                                                <img src="assets/onepage2/img/portfolio/08.png" alt="">
                                            </div>
                                            <div class="cbp-caption-activeWrap">
                                                <div class="cbp-l-caption-alignCenter">
                                                    <div class="cbp-l-caption-body portfolio-icons">
                                                        <a href="assets/onepage2/img/portfolio/08.png" class="cbp-lightbox" data-title="Title"><i class="fa fa-search"></i></a>
                                                        <a href="#"><i class="fa fa-file"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cbp-item ecomedayu">
                                        <div class="cbp-caption">
                                            <div class="cbp-caption-hover-gradient">
                                                <img src="assets/onepage2/img/portfolio/09.png" alt="">
                                            </div>
                                            <div class="cbp-caption-activeWrap">
                                                <div class="cbp-l-caption-alignCenter">
                                                    <div class="cbp-l-caption-body portfolio-icons">
                                                        <a href="assets/onepage2/img/portfolio/09.png" class="cbp-lightbox" data-title="Title"><i class="fa fa-search"></i></a>
                                                        <a href="#"><i class="fa fa-file"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cbp-item ecomedayu">
                                        <div class="cbp-caption">
                                            <div class="cbp-caption-hover-gradient">
                                                <img src="assets/onepage2/img/portfolio/10.png" alt="">
                                            </div>
                                            <div class="cbp-caption-activeWrap">
                                                <div class="cbp-l-caption-alignCenter">
                                                    <div class="cbp-l-caption-body portfolio-icons">
                                                        <a href="assets/onepage2/img/portfolio/10.png" class="cbp-lightbox" data-title="Title"><i class="fa fa-search"></i></a>
                                                        <a href="#"><i class="fa fa-file"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cbp-item ecomedayu">
                                        <div class="cbp-caption">
                                            <div class="cbp-caption-hover-gradient">
                                                <img src="assets/onepage2/img/portfolio/11.png" alt="">
                                            </div>
                                            <div class="cbp-caption-activeWrap">
                                                <div class="cbp-l-caption-alignCenter">
                                                    <div class="cbp-l-caption-body portfolio-icons">
                                                        <a href="assets/onepage2/img/portfolio/11.png" class="cbp-lightbox" data-title="Title"><i class="fa fa-search"></i></a>
                                                        <a href="#"><i class="fa fa-file"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Cube Portfolio -->
                        </div>
                    </div><!-- //end row -->
                </div>
            </div>
        </section>
        <!-- END PORTFOLIO SECTION -->


        <!-- BEGIN CONTACT SECTION -->
        <section id="contact">
            <!-- Footer Coypright -->
            <div class="footer-copyright" style="background: #2c3a46;">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3">
                            <img alt="Logo" src="{{asset('assets/lg-original.png')}}" height="150" />
                            <br><br>
                        </div>
                        <div class="col-sm-5" style="text-align: left">
                            <div class="col-sm-12">
                                <h3>Our Office</h3>
                                <p>Jl. Wijaya Kusuma No.36, Ketabang, Kec. Genteng, Kota SBY, Jawa Timur 60272<br><br></p>
                            </div>
                            <div class="col-sm-6">
                                <h3>Telp</h3>
                                <p>(031) 123123 60272<br><br></p>
                            </div>
                            <div class="col-sm-6">
                                <h3>Email</h3>
                                <p>yekape.sby@gmail.com <br><br></p>
                            </div>
                        </div>
                        <div class="col-sm-4" style="text-align: left">
                            <h3 style="text-align: center;">Our Marketting</h3>
                            <div class="col-sm-6">
                                <ul class="copyright-socials">
                                    <li style="color: #8693a7;"><a href="https://wa.me/6285731315556"><i class="fa fa-whatsapp"></i></a> Rahmat </li>
                                </ul>
                                <ul class="copyright-socials">
                                    <li style="color: #8693a7;"><a href="https://wa.me/6285731315556"><i class="fa fa-whatsapp"></i></a> TZISA </li>
                                </ul>
                                <ul class="copyright-socials">
                                    <li style="color: #8693a7;"><a href="https://wa.me/6285731315556"><i class="fa fa-whatsapp"></i></a> EDDY </li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul class="copyright-socials">
                                    <li style="color: #8693a7;"><a href="https://wa.me/6285731315556"><i class="fa fa-whatsapp"></i></a> DIMAS </li>
                                </ul>
                                <ul class="copyright-socials">
                                    <li style="color: #8693a7;"><a href="https://wa.me/6285731315556"><i class="fa fa-whatsapp"></i></a> NUR HAYATI </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container">
                    <div class="row">
                        <h3>Connect With Us</h3>
                        <ul class="copyright-socials">
                            <li><a href="https://www.instagram.com/yekapesurabaya/"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://www.instagram.com/yekapesurabaya/"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                        <!-- <P>Designed with love by <a href="http://www.keenthemes.com/">Rama D. Hidayat</a></P> -->
                        <p>Copyright @ 2020 <a href="">PT Yekape Surabaya</a></p>
                    </div>
                </div>
            </div>
            <!-- End Footer Coypright -->
        </section>
        <!-- END CONTACT SECTION -->
    </div>
    <!-- END MAIN LAYOUT -->
    <a href="#intro" class="go2top"><i class="fa fa-arrow-up"></i></a>

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="assets/plugins/respond.min.js"></script>
<script src="assets/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="{{asset('assets/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/jquery-migrate.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{asset('assets/plugins/jquery.easing.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/jquery.parallax.js')}}" type="text/javascript"></script>
<!-- <script src="{{asset('assets/plugins/smooth-scroll/smooth-scroll.js')}}" type="text/javascript"></script> -->
<script src="{{asset('assets/plugins/owl.carousel/owl.carousel.min.js')}}" type="text/javascript"></script>
<!-- BEGIN CUBEPORTFOLIO -->
<script src="{{asset('assets/plugins/cubeportfolio/cubeportfolio/js/jquery.cubeportfolio.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/onepage2/scripts/portfolio.js')}}" type="text/javascript"></script>
<!-- END CUBEPORTFOLIO -->
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('assets/onepage2/scripts/layout.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/bs-carousel.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function() {    
        Layout.init();
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>