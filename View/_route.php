<?php
/* Description: Router for Proton Framework */


PROTON::SETLANGUAGE(PROTON::DETECTLANGUAGE());

Route::GET("/", function(){ 
  
  PROTON::LANGUAGE("mainLanguage");
  $controller = PROTON::CONTROLLER("mainController");
  PROTON::RENDER("main", $controller);


});


Route::GET("(:any)", function($e){ 
  
  if($e == null)
    return;

  PROTON::LANGUAGE("mainLanguage");
  $controller = PROTON::CONTROLLER("navigateController", ["target" => $e]);
  PROTON::RENDER("navigate", $controller);

});


/* Error Handler */

Route::ERROR(function(){ 

  //TODO : Check is exist on database. If not exist, show error page

  /*
  PROTON::LANGUAGE("mainLanguage");
  $controller = PROTON::CONTROLLER("maincontroller", ["page" => "error"]);
  PROTON::RENDER("_error", $controller);
  */
  });


  


?>