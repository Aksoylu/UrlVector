<?php
/*
*   Author:  Umit Aksoylu
*   Date:    31.12.2020
*   Project: Proton Framework
*   Description: Core Service Class For Proton Framework. 
*/

require_once "Proton/core.php";

class SERVICE
{
    public static $POST = [];
    public static $_lang = [];
    public static function BIND($endPoint, $parameters = [])
	{
        self::$POST = $_POST;
        $language = SERVICE::$_lang;
        $end = explode("@", $endPoint);
        $className = $end[0];
        $functionName = $end[1];
        $classPath = "Services/".$className.".php";

        if (file_exists($classPath))
        {
            //Convert parameters into object
            $dataObject = new DATAOBJECT($parameters);
            
            require_once $classPath;
            $serviceObject = new $className($dataObject);
            $serviceObject->language = $language; 
            if(method_exists($serviceObject,$functionName))
            {   
                
                $serviceObject->$functionName($dataObject);
            }
            else
            {
    
                $errorLog = ["error" => "Proton Framework error: Function '".$functionName."' is not exist in '".$className."' service bind class"];
                echo json_encode($errorLog);
            }
            
        }
        else
        {
            $errorLog = ["error" => "Proton Framework error: Service '".$className."'  is not exist"];
            echo json_encode($errorLog);
            exit();
        }
        
    }

    public static function RESPONSE($parameters)
    {
        echo json_encode($parameters);
        exit();
    }

    public static function DEBUG($parameters)
    {   
        if (is_array($parameters))
            print_r($parameters);
        else
            echo $parameters;
        exit();
    }
    
    public static function LANGUAGE($languageFileName)
    {
        
                $languageName = "Language/".$languageFileName.".php";
                if (file_exists($languageName))
                {
                    require_once $languageName;

                    $currentLanguage = PROTON::GETLANGUAGE();
                    $_language = new $languageFileName();
                    $language = $clasa = (object)$_language->$currentLanguage;

                    SERVICE::$_lang = $language;
                    return $language;
                }

        
    }

    

}

class DATAOBJECT {


    public function __construct(Array $properties=array()){
      foreach($properties as $key => $value){
        $this->{$key} = $value;
      }
    }

    public function toArray(){
        $tmp_array = array();
        foreach ($this as $key => $value) {
            $tmp_array[$key] = $value;
        }
        return $tmp_array;
    }

    public function dump(){
        $tmp_array = $this->toArray();
        print_r($tmp_array);
    }
}
?>