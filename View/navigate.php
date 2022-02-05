<?php
PROTON::TITLE("Url Vector");
PROTON::CSSDEF("css/bootstrap.css");
PROTON::CSSDEF("css/style.css");
PROTON::CSSDEF("css/animate.min.css");
PROTON::FAVDEF("favicon.ico");
PROTON::JSDEF("js/navigation.js");

PROTON::JSCONST("userMessageHeader", $language->user_message_header);
PROTON::JSCONST("navigationUrl", $controller->navigationUrl);
PROTON::JSCONST("navigationTimeLeft", $language->time_left);

?>

  <!-- Page content -->
  <main role="main" class="container mt-5">
  
      <div class="row">
        <div class="col-2">
        </div>
        <div class="col-8">
          <?php PROTON::IMDEF("img/logo.png",$className = "header_logo") ?>
          <p class="lead header"><?php echo $language->header;?></p>
          <p class="lead subheader"><?php echo TEXT::FORMAT($language->navigating_text, $controller->navigationUrl);?></p>
          <p class="lead available" id="timeLeft"><?php echo $language->available;?></p>

        </div>
      </div>

  </main>

  <footer class="footer fixed-bottom center">
      <center>
        <span class="text-muted"><?php echo $language->credits; ?> <a href="https://github.com/Aksoylu/url-vector">Github.com/Aksoylu</a></span>
      </center>
    </footer>