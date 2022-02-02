<?php
/* Description: Router for Proton Framework */


PROTON::SETLANGUAGE(PROTON::DETECTLANGUAGE());

Route::GET("/", function(){ 
  
  PROTON::LANGUAGE("mainLanguage");
  $controller = PROTON::CONTROLLER("mainController");
  PROTON::RENDER("main", $controller);


});


/* Error Handler */

Route::ERROR(function(){ 

  PROTON::LANGUAGE("mainLanguage");
  $controller = PROTON::CONTROLLER("maincontroller", ["page" => "error"]);
  PROTON::RENDER("_error", $controller);

  });


  


?>