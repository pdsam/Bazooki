<?php $path = explode('/', $_SERVER['REQUEST_URI']); array_pop($path); array_pop($path); $files_path = join("/", $path);?>
<footer id="sticky-footer" class="py-4">
  <link rel="stylesheet" href="../css/components/footer.css">
  <div class="container text-center">
    <div class="">
      <h6>© 2020 Copyright <a href="<?= $files_path ?>/auctions"> Bazooki.com </a><br>
      </h6>
    </div>

    <div class="">
		<h6>
			<span class="footer-links">
			  <a href="/about">About</a>
			  <a href="/faq">FAQ</a>
			  <a href="/contact">Contact Us</a>
			  <a href="/terms">Terms</a>
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
