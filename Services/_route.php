<?php
/* Description: Service Router for Proton Framework */

Route::CONFIG(array(
	"extension"=>SERVICE_EXTENSION  
  ));

  PROTON::SETLANGUAGE(PROTON::DETECTLANGUAGE());

  Route::POST("isAvailable", function(){ 

      SERVICE::LANGUAGE("mainLanguage");
      SERVICE::BIND("mainService@isAvailable", $_POST);
  
  });

  Route::POST("issueUrl", function(){ 

    SERVICE::LANGUAGE("mainLanguage");
    SERVICE::BIND("mainService@issueUrl", $_POST);

  });

Route::ERROR(function(){ 

    echo "Error, service not found";

  });


?>