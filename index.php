<?php
/* Description: Project Startup For Proton Framework */

require_once "config.php";

// DATABASE ACTIVATION
if(DB == "ENABLED")
{
    require_once "Proton/database.php";
 
}

// SERVICE HANDLING
if( strpos($_SERVER['REQUEST_URI'], '.'.SERVICE_EXTENSION))
{
    
    require_once "Proton/route.php";
    require_once "Proton/globals.php";
    require_once "Proton/querybuilder.php";
    require_once "Proton/servicecore.php";
    require_once "Proton/functions.php";
    require_once "Services/_route.php";
}
else
{
    require_once "Proton/globals.php";
    require_once "Proton/core.php";
    require_once "Proton/route.php";
    require_once "Proton/querybuilder.php";
    require_once "Proton/functions.php";
    require_once "View/_route.php";

}

// ERROR REPORTING
if (ERRORS_ENABLED)
{
    error_reporting(E_ALL);
    ini_set('display_errors', 'on');
}





?>