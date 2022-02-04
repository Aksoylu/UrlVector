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
        
        if(!$this->checkVariable($this->params->source_url,12))
            SERVICE::RESPONSE([
                "code" => 301,
                "msg" => TEXT::FORMAT(
                    $this->language->variable_not_available, 
                    $this->language->text_target_path, 12, 32),
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
                "password" => md5($this->params->password),
                "navigation_url" => $this->params->source_url,
                "navigation_delay" => $this->params->delay,
                "navigation_text" => $this->params->user_message

            ]);
            $result = $query->run();
            if($result)
            {
                $userMessage = $this->language->issued;
                $response_code = 200;
            }
            else
            {
                $userMessage = $this->language->service_server_error;
                $response_code = 500;
            }
        }

        //TODO : Implement issuing query
        SERVICE::RESPONSE([
            "code" => $response_code,
            "msg" => $userMessage,
            "isAvailable" => $available
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

    //TODO : Replace url critical characters
    function  fixUrlName($value)
    {
        return $value;
    }



}

?>