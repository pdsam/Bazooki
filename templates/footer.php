<?php $path = explode('/', $_SERVER['REQUEST_URI']); array_pop($path); array_pop($path); $files_path = join("/", $path);?>
<footer id="sticky-footer" class="py-4">
  <div class="container text-center">
    <div class="">
      <h6>© 2020 Copyright <a href="<?= $files_path ?>/pages/landing_page.php"> Bazooki.com </a><br>
        <span class="footer-links">
          <a href="#">About</a>
          <a href="<?= $files_path ?>/pages/faq.php">FAQ</a>
          <a href="#">Terms</a>
        </span>
      </h6>
    </div>
    <div id="social-media" class="">
      <a href="#"><i class="fab fa-facebook"></i></a>
      <a href="#"><i class="fab fa-twitter"></i></a>
      <a href="#"><i class="fab fa-instagram"></i></a>
    </div>
  </div>    
</footer>
