<?php
/*
*   Author:  Umit Aksoylu
*   Date:    31.12.2020
*   Project: Proton Framework
*   Description: Core Module of Proton Framework
*/
class PROTON
{
    public static $_lang = [];
    public static function RENDER($viewName, $controller = [], $flag= false)
	{

        $language = PROTON::$_lang;
           

        if ($flag == true)
        {
            $viewName = "View/".$viewName.".php";
        }
        else
        {
            $viewName = "View/".$viewName.".php";
        }

        if (file_exists($viewName))
            {
                require_once $viewName;
                
                return $viewName;
            }

        else
            {
                self::RENDER("_error", ["reason"=>"This view is not exist"], $flag = true);
                exit();
            }

        return $viewName;
        //$parameters = $def;
        //require_once $viewName;
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

                    PROTON::$_lang = $language;
                    return $language;
                }

        
    }

    public static function CONTROLLER($controllerName, $def =[])
	{
        $cName = $controllerName;
        $controllerName = "Controller/".$controllerName.".php";

        if (file_exists($controllerName))
            {
                require_once $controllerName;

                $controller = new $cName($def);
                return $controller;
            }

        else
            {
                self::RENDER("_error", ["reason"=>"Controller '".$controllerName."' is not exist"], $flag = true);
                exit();
            }

        return $viewName;
        //$parameters = $def;
        //require_once $viewName;
    }

    public static function LAYOUT($viewName, $controller=[], $flag= false)
	{

        $language = PROTON::$_lang;
        
        $layoutName = "View/_layouts/".$viewName.".php";
        if (file_exists($layoutName))
            {
                require_once $layoutName;
                return $layoutName;
            }

        else
            {
                self::RENDER("_error", ["reason"=>"Layout file '".$layoutName."' is not exist"], $flag = true);
                exit();
            }

        return $viewName;
        //$parameters = $def;
        //require_once $viewName;
    }

    public static function TITLE($title, $recursive = false)
    {
        echo "<title>".$title."</title>";
    }

    public static function CSSDEF($path, $recursive= false)
    {
        //TODO  Recursive ise pathdekilerin hepsini dahil et.

        $assetName = ASSETS."/".$path;
        if (file_exists($assetName))
            echo '<link href="'.$assetName.'" rel="stylesheet">';
        else
            self::RENDER("_error", ["reason"=>"Asset '".$path."' is not exist"], $flag = true);

    }
    public static function FAVDEF($path)
    {
        $assetName = ASSETS."/".$path;
        if (file_exists($assetName))
            echo '<link href="'.$assetName.'" rel="icon">';
        else
            self::RENDER("_error", ["reason"=>"Asset '".$path."' is not exist"], $flag = true);
    }

    public static function JSDEF($path, $recursive= false)
    {
        //TODO  Recursive ise pathdekilerin hepsini dahil et.

        $assetName = ASSETS."/".$path;
        if (file_exists($assetName))
            echo '<script src="'.$assetName.'"></script>';
        else
            self::RENDER("_error", ["reason"=>"Asset '".$path."' is not exist"], $flag = true);
    }

    public static function IMDEF($path, $className = '', $css = '')
    {
        $assetName = ASSETS."/".$path;
        if ($className == '')
        {
            echo '<img src="'.$assetName.'" style="'.$css.'"/>';
        }
        else
        {
            echo '<img src="'.$assetName.'" style="'.$className.'"/>';
        }
       
    }
    public static function EXECUTEJS($code)
    {
        echo "<script>".$code."</script>";        
    }
    
    public static function DETECTLANGUAGE()
    {
        
        $acceptLang = array(
            'af', // afrikaans.
            'ar', // arabic.
            'bg', // bulgarian.
            'ca', // catalan.
            'cs', // czech.
            'da', // danish.
            'de', // german.
            'el', // greek.
            'en', // english.
            'es', // spanish.
            'et', // estonian.
            'fi', // finnish.
            'fr', // french.
            'gl', // galician.
            'he', // hebrew.
            'hi', // hindi.
            'hr', // croatian.
            'hu', // hungarian.
            'id', // indonesian.
            'it', // italian.
            'ja', // japanese.
            'ko', // korean.
            'ka', // georgian.
            'lt', // lithuanian.
            'lv', // latvian.
            'ms', // malay.
            'nl', // dutch.
            'no', // norwegian.
            'pl', // polish.
            'pt', // portuguese.
            'ro', // romanian.
            'ru', // russian.
            'sk', // slovak.
            'sl', // slovenian.
            'sq', // albanian.
            'sr', // serbian.
            'sv', // swedish.
            'th', // thai.
            'tr', // turkish.
            'uk', // ukrainian.
            'zh' // chinese.
        );

        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

        $lang = in_array($lang, $acceptLang) ? $lang : 'en';

        PROTON::SETLANGUAGE($lang);
        return $lang;
    }

    public static function SETLANGUAGE($lang)
    {
        setcookie("clientLanguage", $lang, time()+3600); 
    }

    public static function GETLANGUAGE()
    {
        if(isset($_COOKIE["clientLanguage"]))
        {
            return $_COOKIE["clientLanguage"];
        }
        else
        {
            return PROTON::DETECTLANGUAGE();
        }

    }

    public static function GETSESSION($key)
    {
        if(isset($_SESSION[$key]))
            return $_SESSION[$key];
        else
            return FALSE;
    }

    public static function SETSESSION($key,$value)
    {

        $_SESSION[$key] = $value;
    }

    public static function DELETESESSION($key)
    {
        unset($_SESSION[$key]);
    }

}

?>