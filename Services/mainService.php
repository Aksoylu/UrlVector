<?php
class mainService{

    public $params;
    public function __construct($params = [])
    {  
        $this->params = $params;
    }

    public function isAvailable()
    {
        if(!$this->checkVariable($this->params->url_name))
            SERVICE::RESPONSE([
                "code" => 301,
                "msg" => TEXT::FORMAT(
                    $this->language->variable_not_available, 
                    $this->language->text_target_path, 3, 32),
                "isAvailable" => FALSE
            ]);
        
        $url_name = $this->fixUrlName($this->params->url_name);
        $available = FALSE;

        $query = new XQuery();
        $query->select('urls',['id'])->where('name={url_name}', ["url_name" => $url_name]);    //._param()
        $result = $query->fetch(1);
        if ($result)
            $userMessage = $this->language->not_available;
        else
        {
            $userMessage = $this->language->available;
            $available = TRUE;
        }
           
        SERVICE::RESPONSE([

            "code" => 200,
            "msg" => $userMessage,
            "isAvailable" => $available

        ]);
    }

    public function issueUrl()
    {
        if(!$this->checkVariable($this->params->target_path,3))
            SERVICE::RESPONSE([
                "code" => 301,
                "msg" => TEXT::FORMAT(
                    $this->language->variable_not_available, 
                    $this->language->text_target_path, 3, 15),
                "isAvailable" => FALSE
            ]);
        
        if(isset($this->params->is_intranet_domain))
            $this->params->is_intranet_domain = $this->parseBoolean($this->params->is_intranet_domain);
        else
            $this->params->is_intranet_domain = FALSE;

        if(!$this->checkIsUrl($this->params->source_url, $this->params->is_intranet_domain))
            SERVICE::RESPONSE([
                "code" => 301,
                "msg" => TEXT::FORMAT(
                    $this->language->url_not_valid, 
                    $this->params->source_url),
                "isAvailable" => FALSE
            ]);
        
        if(!$this->checkVariable($this->params->password,3))
            SERVICE::RESPONSE([
                "code" => 301,
                "msg" => TEXT::FORMAT(
                    $this->language->variable_not_available, 
                    $this->language->text_password, 3, 8),
                "isAvailable" => FALSE
            ]);
        
        $available = FALSE;
        $response_code;
        $userMessage;
        $target_path = $this->fixUrlName($this->params->target_path);

        $query = new XQuery();
        $query->select('urls',['id'])->where('name={target_path}', ["target_path" => $target_path]  );
        $result = $query->fetch(1);
        if ($result)
        {
            $userMessage = $this->language->not_available;
            $response_code = 305;
        }
        else
        {
            $query = new XQuery();

            if ($this->params->delay == 1)
                $this->params->delay = 3;
            else
            {
                $this->params->delay = 0;
                $this->params->user_message = "";
            }

            $query->insert('urls', [
                "name"=> $target_path,
                "issuing_date" => date("Y-m-d H:i:s"),
                "password" => md5($this->params->password),
                "navigation_url" => $this->params->source_url,
                "navigation_delay" => $this->params->delay,
                "navigation_text" => $this->params->user_message,
                "is_intranet_domain" => $this->params->is_intranet_domain

            ]);
            $result = $query->run();
            if($result)
            {
                $available = TRUE;
                $userMessage = $this->language->issued;
                $response_code = 200;
                $target_path = TEXT::FORMAT("{protocol}://{domain}/{target_path}", PROTOCOL, DOMAIN, $target_path);
            }
            else
            {
                $userMessage = $this->language->service_server_error;
                $response_code = 500;
            }
        }

        SERVICE::RESPONSE([
            "code" => $response_code,
            "msg" => $userMessage,
            "isAvailable" => $available,
            "issuedDomain" => $target_path
        ]);
        
    }

    function checkVariable($value, $limit = 3)
    {
        if (is_null($value))
            return FALSE;

        if(strlen($value) < $limit )
            return FALSE;
        
        if(strlen($value)> 64)
            return FALSE;
        
        return TRUE;
    }


    function  fixUrlName($value)
    {
        $unavailable = array("/", ".", "'", "!", "/", "%", "+", "{", "}", "*", "?", "[", "]", "&", "$", "(", ")", "^", "=", " ", "  ");
        $available   = array("-", "_", "-", "|", "-", "-", "-", "_", "_", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-");
        return str_replace($unavailable, $available, $value);
    }
    
    function checkIsUrl($url, $isIntranetDomain)
    {
        
        if (preg_match("#^https?://.+#", $url))
            {
                if ($isIntranetDomain)
                    return TRUE;
                else
                    {
                        if (@fopen($url,"r"))
                            return TRUE;
                        else
                            return FALSE;
                    }
            }
        else
            return FALSE;
    }

    function parseBoolean($val){
        return $isIntranetDomain == "true" ? TRUE : FALSE;
    }

}

?>