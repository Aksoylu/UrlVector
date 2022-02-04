<?php
/*
*   Author:  Umit Aksoylu
*   Date:    31.12.2020
*   Project: Proton Framework
*   Description: Multi-usable function module for Proton Framework. Contains REQUEST and SECURITY classes for now
*/

class REQUEST{


	//$res = REQUEST::POST("http://localhost/listener.service/ContainersLookup", []);
	public static function POST($url,$data)
	{
		//$url = 'http://server.com/path';
        //$data = array('key1' => 'value1', 'key2' => 'value2');

        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) {  return false;/* Handle error */ }

		return $result;
        //var_dump($result);
	}
	//$res = REQUEST::GET("http://localhost/listener.service/ContainersLookup", []);
	public static function GET($url,$data)
	{
		//$url = 'http://server.com/path';
        //$data = array('key1' => 'value1', 'key2' => 'value2');

        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'GET',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) {  return false;/* Handle error */ }

		return $result;
        //var_dump($result);
	}

}

class TEXT{

    public static function FORMAT(){
        $args = func_get_args();
        if (sizeof($args) < 1)
            return NULL;
        
        if (!is_string($args[0]))
            return NULL;

        if (sizeof($args) == 1 )
            return $args[0];

        $text_for_replace = $args[0];
        
        if(sizeof($args) > 2)
        {
            //do format with order and return
            $pattern="/\{.*?\}/";
            preg_match_all($pattern, $text_for_replace, $matches);
            
            if(sizeof($matches[0]) != sizeof($args) - 1)
                return NULL;

            $i = 1;
            foreach($matches[0] as $match)
            {
                $text_for_replace = str_replace($match, $args[$i], $text_for_replace);
                $i += 1;
            }
            return $text_for_replace;
        }
        else if (sizeof($args) == 2)
        {
            if(!is_array($args[1]))
                return $args[0];
            
            //do format with naming
            foreach($args[1] as $key => $value)
            {
                str_replace('{'.$key.'}', $value, $text_for_replace);
            }
            return $text_for_replace;
        }
        
        return NULL;
        
    }

}

class SECURITY{ 


public static function  isJson($string,$return_data = false)
{
    $data = json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE) ? ($return_data ? $data : TRUE) : FALSE;
}
    
public static function ESCAPE($data)
{
	//variable security
	$data = htmlspecialchars(strip_tags(trim(addslashes($data))));

	return $data;

}

} 

function sqlToDate($date)
{
	$timestamp = strtotime($date);
	$new_date = date("d.m.Y", $timestamp);
	return $new_date; // Outputs: DD.MM.YY

}

function ip_bul(){
	if(getenv("HTTP_CLIENT_IP")) {
 		$ip = getenv("HTTP_CLIENT_IP");
 	} elseif(getenv("HTTP_X_FORWARDED_FOR")) {
 		$ip = getenv("HTTP_X_FORWARDED_FOR");
 		if (strstr($ip, ',')) {
 			$tmp = explode (',', $ip);
 			$ip = trim($tmp[0]);
 		}
 	} else {
 	$ip = getenv("REMOTE_ADDR");
 	}
	return $ip;
}

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function mailcheck($veri)
{

	//e-posta biçemi doðru mu 
	 if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$veri))
   {
      list($username,$domain)= explode('@',$veri);
      if(!checkdnsrr($domain,'MX')) 
	  {
		  return false;
	  }
		else
		{

      return true;
		}
   }
   else
   {

 return false;
	}

}

/* Base64 image String	,	Output Image name Without Extension		,	path with / end	*/
function base64ToImage($b64_image, $output_image, $path="" ) {
	
    $arr = explode(',', substr( $b64_image , 5 ) , 2);
    $mime=$arr[0];
    $data=$arr[1];

    $mime_split_without_base64=explode(';', $mime,2);
    $mime_split=explode('/', $mime_split_without_base64[0],2);
    if(count($mime_split)==2)
    {
        $extension=$mime_split[1];
        if($extension=='jpeg')$extension='jpg';
		if($extension=='png')$extension='png';
		
		

        $output_complete=$output_image.'.'.$extension;
    }
    file_put_contents( $_SERVER['DOCUMENT_ROOT'].$path . $output_complete, base64_decode($data) );
    return $output_complete;
}



?>