<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Beranda</title>
	<link rel="icon" href="img/Fevicon.png" type="image/png">

  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="vendors/linericon/style.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet"> <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <!--================Header Menu Area =================-->
  <header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container box_1620">
          <!-- Brand and toggle get grouped for better mobile display -->
          <a class="navbar-brand logo_h" href="{{ route('home') }}"><img src="img/One1.png" alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav justify-content-center">
              <li class="nav-item"><a class="nav-link text-warning" href="{{ route('home') }}">Home</a></li> 
              <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right navbar-social">
              <li><a href="#"><i class="ti-facebook"></i></a></li>
              <li><a href="#"><i class="ti-twitter-alt"></i></a></li>
              <li><a href="#"><i class="ti-instagram"></i></a></li>
              <li><a href="#"><i class="ti-skype"></i></a></li>
            </ul>
          </div> 
        </div>
      </nav>
    </div>
  </header>
  <!--================Header Menu Area =================-->
  
  <!--================ Hero sm Banner start =================-->        
  <section class="mb-30px">
    <div class="container">
      <div class="hero-banner hero-banner--sm">
        <div class="hero-banner__content">
          <h1>Category Page</h1>
          <nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Category Page</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <!--================ Hero sm Banner end =================-->      
  

 <!--================ Start Blog Post Area =================-->
<section class="blog-post-area section-margin">
  <div class="container">
      <div class="row">
        <!-- Main Blog Content -->
        <div class="col-lg-8">
          <div class="row">
            @foreach($posts->sortByDesc('created_at') as $post)
            <div class="col-md-6 mb-4">
              <div class="single-recent-blog-post card-view">
                <div class="card h-100"> <!-- Tambahkan class h-100 untuk membuat tinggi card sama -->
                  <div class="media">
                    <!-- Jika postingan memiliki gambar -->
                    @if(in_array(pathinfo($post->media, PATHINFO_EXTENSION), ['jpeg', 'jpg', 'png', 'gif']))
                    <img src="{{ asset('/storage/posts/'.$post->media) }}" class="card-img-top rounded" alt="Post Image">
                    <!-- Jika postingan memiliki video -->
                    @elseif(in_array(pathinfo($post->media, PATHINFO_EXTENSION), ['mp4', 'mov', 'avi']))
                    <video class="card-img-top" width="100%" height="auto" controls>
                      <source src="{{ asset('/storage/posts/'.$post->media) }}" type="video/{{ pathinfo($post->media, PATHINFO_EXTENSION) }}">
                      Your browser does not support the video tag.
                    </video>
                    @endif
                  </div>
                  <div class="card-body">
                    <div class="details mt-2">
                      <!-- Judul -->
                      <h5 class="card-title">{{ $post->title }}</h5>
                      <!-- Kategori dengan efek -->
                      <p class="card-text text-muted category">Kategori: {{ $post->category->name }}</p>
                    </div>
                  </div>
                  <div class="card-footer">
                    <!-- Tombol Read More -->
                    <a href="{{ route('posts.show', $post->id) }}" class="button">Read More <i class="ti-arrow-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>      
        <!-- Pagination -->
        <div class="row">
          <div class="col-lg-12">
            <nav class="blog-pagination justify-content-center d-flex">
              <ul class="pagination">
                <li class="page-item">
                  <a href="#" class="page-link" aria-label="Previous">
                    <span aria-hidden="true"><i class="ti-angle-left"></i></span>
                  </a>
                </li>
                <li class="page-item active"><a href="#" class="page-link">1</a></li>
                <li class="page-item"><a href="#" class="page-link">2</a></li>
                <li class="page-item">
                  <a href="#" class="page-link" aria-label="Next">
                    <span aria-hidden="true"><i class="ti-angle-right"></i></span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
      <!-- End Main Blog Content -->

  
  
        <!-- Blog Post Sidebar -->
        <div class="col-lg-4 sidebar-widgets">
          <div class="widget-wrap"> 
        {{-- random post --}}
        <div class="single-sidebar-widget random-post-widget">
            <h4 class="single-sidebar-widget__title">Random Post</h4>
            <div class="random-post-list">
                <?php 
                    // Ambil semua ID postingan
                    $postIds = $posts->pluck('id')->toArray();
                    
                    // Acak urutan ID postingan
                    shuffle($postIds);
                    
                    // Ambil 3 ID postingan pertama yang sudah diacak
                    $randomPostIds = array_slice($postIds, 0, 4);
                ?>
                @foreach($randomPostIds as $postId)
                    <?php $post = $posts->firstWhere('id', $postId); ?>
                    <div class="single-post-list mb-4">
                        <div class="media mb-2">
                            <!-- Jika postingan memiliki gambar -->
                            @if(in_array(pathinfo($post->media, PATHINFO_EXTENSION), ['jpeg', 'jpg', 'png', 'gif']))
                            <img src="{{ asset('/storage/posts/'.$post->media) }}" class="rounded" style="width: 100%; height: auto;">
                            <!-- Jika postingan memiliki video -->
                            @elseif(in_array(pathinfo($post->media, PATHINFO_EXTENSION), ['mp4', 'mov', 'avi']))
                            <video width="100%" height="auto" controls>
                                <source src="{{ asset('/storage/posts/'.$post->media) }}" type="video/{{ pathinfo($post->media, PATHINFO_EXTENSION) }}">
                                Your browser does not support the video tag.
                            </video>
                            @endif
                        </div>
                        <div class="details">
                            <a href="{{ route('posts.show', $post->id) }}" class="text-dark">
                                <h6 class="card-title font-weight-bold">{{ $post->title }}</h6>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
          </div>
          
                </div>
                </div> 
              </div>
            </div>
          </div>
        </div>
        <!-- End Blog Post Sidebar -->
      </div>
    </div>
  </section>
  <!--================ End Blog Post Area =================-->
  
  
  <!--================ End Blog Post Area =================-->

  <!--================ Start Footer Area =================-->
  <footer class="footer-area section-padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-3  col-md-6 col-sm-6">
          <div class="single-footer-widget">
            <h6>About Us</h6>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore
              magna aliqua.
            </p>
          </div>
        </div>
        <div class="col-lg-4  col-md-6 col-sm-6">
          <div class="single-footer-widget">
            <h6>Newsletter</h6>
            <p>Stay update with our latest</p>
            <div class="" id="mc_embed_signup">

              <form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                method="get" class="form-inline">

                <div class="d-flex flex-row">

                  <input class="form-control" name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '"
                    required="" type="email">


                  <button class="click-btn btn btn-default"><span class="lnr lnr-arrow-right"></span></button>
                  <div style="position: absolute; left: -5000px;">
                    <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                  </div>

                  <!-- <div class="col-lg-4 col-md-4">
                        <button class="bb-btn btn"><span class="lnr lnr-arrow-right"></span></button>
                      </div>  -->
                </div>
                <div class="info"></div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-3  col-md-6 col-sm-6">
          <div class="single-footer-widget mail-chimp">
            <h6 class="mb-20">Instragram Feed</h6>
            <ul class="instafeed d-flex flex-wrap">
              <li><img src="img/instagram/i1.jpg" alt=""></li>
              <li><img src="img/instagram/i2.jpg" alt=""></li>
              <li><img src="img/instagram/i3.jpg" alt=""></li>
              <li><img src="img/instagram/i4.jpg" alt=""></li>
              <li><img src="img/instagram/i5.jpg" alt=""></li>
              <li><img src="img/instagram/i6.jpg" alt=""></li>
              <li><img src="img/instagram/i7.jpg" alt=""></li>
              <li><img src="img/instagram/i8.jpg" alt=""></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6">
          <div class="single-footer-widget">
            <h6>Follow Us</h6>
            <p>Let us be social</p>
            <div class="footer-social d-flex align-items-center">
              <a href="#">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#">
                <i class="fab fa-dribbble"></i>
              </a>
              <a href="#">
                <i class="fab fa-behance"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
        <p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
      </div>
    </div>
  </footer>
  <!--================ End Footer Area =================-->

  <script src="vendors/jquery/jquery-3.2.1.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
  <script src="js/jquery.ajaxchimp.min.js"></script>
  <script src="js/mail-script.js"></script>
  <script src="js/main.js"></script>
</body>
</html>
<style>
    /* CSS untuk efek pada keterangan kategori */
    .category {
      font-style: italic; /* Memberikan gaya font italic */
      color: #666; /* Warna teks abu-abu */
    }
  
    .category:hover {
      color: #333; /* Warna teks menjadi lebih gelap saat dihover */
      text-decoration: underline; /* Garis bawah pada teks saat dihover */
      cursor: pointer; /* Ubah kursor menjadi tanda tangan saat dihover */
    }
   /* CSS untuk mengatur ukuran card header dan efek hover */
/* CSS untuk mengatur ukuran card header dan efek hover */

.card:hover {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}

.card-header {
    transition: transform 0.3s ease; /* Efek zoom */
}

.card:hover .card-header {
    transform: scale(1.1);
}

.card-footer {
    background-color: #f9f9f9;
    padding: 20px;
}

.card-footer a {
    text-decoration: none;
    color: #333;
}

.card-footer a:hover {
    color: #007bff;
}

.card-body {
    padding: 20px;
}

.card-title {
    font-size: 20px;
    margin-bottom: 10px;
}

.card-text {
    font-size: 14px;
    color: #666;
    margin-bottom: 20px;
}
/* CSS untuk mengubah warna tombol Read More */
.card-footer a.button {
    background-color: #ff6600; /* Warna latar belakang */
    color: #fff; /* Warna teks */
    border: 2px solid #ff6600; /* Warna border */
}

.card-footer a.button:hover {
    background-color: #e65100; /* Warna latar belakang saat dihover */
    border-color: #e65100; /* Warna border saat dihover */
}

 .popular-post-widget {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 5px;
    }
    .popular-post-widget .single-sidebar-widget__title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 15px;
        border-bottom: 2px solid #007bff;
        padding-bottom: 5px;
    }
    .popular-post-list .single-post-list {
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
    }
    .popular-post-list .single-post-list:last-child {
        border-bottom: none;
    }
    .popular-post-list .media img,
    .popular-post-list .media video {
        border-radius: 5px;
    }
    .popular-post-list .details a {
        text-decoration: none;
    }
    .popular-post-list .details a:hover {
        text-decoration: underline;
    }
    .popular-post-list .details .card-title {
        margin-top: 10px;
        font-size: 16px;
    }

  </style>
  <script>
    // Ambil semua card dalam array
    const cards = document.querySelectorAll('.single-recent-blog-post');
  
    // Inisialisasi variabel untuk menyimpan tinggi terbesar
    let maxHeight = 0;
  
    // Loop melalui setiap card dan temukan tinggi terbesar
    cards.forEach(card => {
      const cardHeight = card.clientHeight;
      if (cardHeight > maxHeight) {
        maxHeight = cardHeight;
      }
    });
  
    // Setel tinggi semua card menjadi tinggi terbesar
    cards.forEach(card => {
      card.style.height = maxHeight + 'px';
    });
  </script>
  