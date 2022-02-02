<?php
PROTON::TITLE("Proton Framework Example");
PROTON::CSSDEF("css/bootstrap.css");
PROTON::CSSDEF("css/style.css");
PROTON::CSSDEF("css/animate.min.css");

PROTON::FAVDEF("favicon.ico");
PROTON::JSDEF("js/action.js");
?>

<link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"   />

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <!-- Page content -->
  <main role="main" class="container mt-5">
  
      <div class="row">
        <div class="col-2">
        </div>
        <div class="col-8">
          <p class="lead header"><?php echo $language->header;?></p>
          <p class="lead subheader"><?php echo $language->subHeader;?></p>
          <div class="input-group">
            <input type="search" onKeyDown="checkInput(this)" id="searchInput" class="form-control rounded" placeholder="<?php echo $language->checkout;?>" aria-label="Search" aria-describedby="search-addon" />
            <button type="button" onClick="fetchService()" id="checkButton" class="btn btn-outline-primary" disabled>
              <?php echo $language->check;?>
            </button>
          </div>
          <p class="lead available"><?php echo $language->available;?></p>

              
          <div class="action-form animate__animated" >
            Place modal here 
          </div>

        </div>
      </div>

  </main>

  <footer class="footer fixed-bottom center">
      <center>
        <span class="text-muted"><?php echo $language->credits; ?> <a href="https://github.com/Aksoylu/url-vector">Github.com/Aksoylu</a></span>
      </center>
    </footer>