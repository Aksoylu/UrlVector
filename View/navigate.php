<?php
PROTON::TITLE("Proton Framework Example");
PROTON::CSSDEF("css/bootstrap.css");
PROTON::CSSDEF("css/style.css");
PROTON::CSSDEF("css/animate.min.css");
PROTON::FAVDEF("favicon.ico");
PROTON::JSDEF("js/action.js");

PROTON::JSCONST("userMessageHeader", $language->user_message_header);
PROTON::JSCONST("userMessagePlaceholder", $language->user_message_placeholder);
PROTON::JSCONST("userMessageText", $language->user_message_text);
PROTON::JSCONST("serviceServerError", $language->service_server_error);

?>

  <!-- Page content -->
  <main role="main" class="container mt-5">
  
      <div class="row">
        <div class="col-2">
        </div>
        <div class="col-8">
          <p class="lead header"><?php echo $language->header;?></p>
          <p class="lead subheader"><?php echo TEXT::FORMAT($language->navigating_text, $controller->navigationUrl);?></p>

          
          <div class="input-group">
            <input type="search" onKeyDown="checkInput(this)" id="searchInput" class="form-control rounded" placeholder="<?php echo $language->checkout;?>" aria-label="Search" aria-describedby="search-addon" />
            <button type="button" onClick="fetchService()" id="checkButton" class="btn btn-outline-primary" disabled>
              <?php echo $language->check;?>
            </button>
          </div>
          <p class="lead available"><?php echo $language->available;?></p>

              
          <div class="action-form animate__animated" >
            <form>
              <div class="form-group">
                <label for="formUrl"><?php echo $language->navigation_url;?></label>
                <input type="url" class="form-control" id="formUrl" placeholder="<?php echo $language->navigation_placeholder;?>">
                <small class="form-text text-muted"><?php echo $language->navigation_url_sub;?></small>
              </div>
              <div class="form-group">
                <label for="formPinInput">Pin</label>
                <input type="password" class="form-control" id="formPinInput" placeholder="Password">
                <small class="form-text text-muted"><?php echo $language->pin_sub;?></small>
              </div>
              <div class="form-group form-check">
                <input type="checkbox" onChange="navigationDelayChanged()" class="form-check-input" id="formNavigationDelayCheck">
                <label class="form-check-label" for="formNavigationDelayCheck"><?php echo $language->navigation_delay;?></label>
              </div>
              <div id="dynamicArea">
              </div>
              <button type="button" onClick="issueService()" class="btn btn-outline-primary"><?php echo $language->ok_button;?></button>
              <br>
              <div id="responseDynamicArea"></div>
            </form>
          </div>

        </div>
      </div>

  </main>

  <footer class="footer fixed-bottom center">
      <center>
        <span class="text-muted"><?php echo $language->credits; ?> <a href="https://github.com/Aksoylu/url-vector">Github.com/Aksoylu</a></span>
      </center>
    </footer>