
<?php 
include 'db_connect.php';

?>
  <div id="topbar" class="d-none d-lg-flex align-items-center fixed-top">
    <div class="container d-flex">
      <div class="contact-info mr-auto">
        <i class="icofont-envelope"></i> <a href="mailto:<?php echo isset($meta['email']) ? $meta['email'] : '' ?>"><?php echo isset($meta['email']) ? $meta['email'] : '' ?></a>
        <i class="icofont-phone"></i> <?php echo isset($meta['contact']) ? $meta['contact'] : '' ?>
      </div>
      <div class="social-links">
        <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
        <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
        <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
        <a href="#" class="skype"><i class="icofont-skype"></i></a>
        <a href="#" class="linkedin"><i class="icofont-linkedin"></i></i></a>
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="/"><?php echo isset($meta['blog_name']) ? $meta['blog_name'] : '' ?></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="nav-home"><a href="index.php?page=home">Главная</a></li>
          <li class="drop-down"><a href="javascript:void(0)">Категории</a>
            <ul>
              <?php
              $qry = $conn->query("SELECT * from category where status = 1"); 
            while($row=$qry->fetch_assoc()){
               ?>
                <li><a href="index.php?page=category&id=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a></li>
              <?php } ?>
            </ul>
          </li>
          <li class="nav-about"><a href="index.php?page=about">О нас</a></li>


        </ul>
      </nav><!-- .nav-menu -->


    </div>
  </header><!-- End Header -->
  <script>
  	$('.nav-<?php echo !isset($_GET['page']) ? 'home': $_GET['page'] ?>').addClass('active');
  </script>